from django.shortcuts import render, redirect, get_object_or_404
from django.contrib.auth.decorators import login_required
from django.contrib.auth import (
    authenticate,
    login as auth_login,
    logout as auth_logout,
    update_session_auth_hash,
)
from django.contrib import messages
from .forms import LoginForm, EditProfileForm, LectureMaterialForm
from .models import Faculty, Subjects, LectureMaterial, Tasks
from Academy.models import (
    Announcements,
    SupportChat,
    SupportMessage,
    UserAccessLogs,
    LectureMaterialsLogs,
    GradeChangesLogs,
    TaskChangesLog,
)
from Students.models import Student, Classes, Grades
from datetime import datetime, timedelta
from PIL import Image
from io import BytesIO
import sys
import logging
from django.core.files.uploadedfile import InMemoryUploadedFile


# Create your views here.
@login_required(login_url="faculty-login")
def dashboard(request):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    faculty = Faculty.objects.get(faculty_id=request.user.username)

    context = {
        "faculty_id": faculty.faculty_id,
        "first_name": faculty.first_name,
        "last_name": faculty.last_name,
        "profile_pic": faculty.profile_pic,
    }

    return render(request, "faculty/dashboard.html", context)


@login_required(login_url="faculty-login")
def subjects(request):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    faculty = Faculty.objects.get(faculty_id=request.user.username)
    subjects = Subjects.objects.filter(instructor=faculty)

    context = {
        "faculty_id": faculty.faculty_id,
        "first_name": faculty.first_name,
        "last_name": faculty.last_name,
        "profile_pic": faculty.profile_pic,
        "subjects": subjects,
    }

    return render(request, "faculty/subjects.html", context)


@login_required(login_url="faculty-login")
def subject_view(request, subject_code):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    faculty = Faculty.objects.get(faculty_id=request.user.username)
    subject = Subjects.objects.get(subject_code=subject_code)

    subject.formatted_schedule = f"{subject.schedule.strftime('%I:%M %p')}"

    tasks = Tasks.objects.filter(subject=subject).order_by('-task_deadline')
    materials = LectureMaterial.objects.filter(subject=subject)

    context = {
        "faculty_id": faculty.faculty_id,
        "first_name": faculty.first_name,
        "last_name": faculty.last_name,
        "profile_pic": faculty.profile_pic,
        "subject": subject,
        "tasks": tasks,
        "materials": materials,
    }

    return render(request, "faculty/subject_view.html", context)


@login_required(login_url="faculty-login")
def upload_material(request, subject_code):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    subject = Subjects.objects.get(subject_code=subject_code)

    if request.method == "POST":
        # Get the subject from the hidden input
        subject_from_form = request.POST.get("subject")
        lecture_id_from_form = request.POST.get("lecture_id")

        # Verify the subject from form matches the URL parameter
        if subject_from_form != str(subject_code):
            messages.error(request, "Invalid subject code in form submission")
            return redirect("faculty-subject-view", subject_code=subject_code)

        form = LectureMaterialForm(request.POST, request.FILES)
        if form.is_valid():
            material = form.save(commit=False)
            material.subject = subject  # Set the subject from URL
            material.save()

            LectureMaterialsLogs.objects.create(
                material_id=f"{subject_from_form} - {lecture_id_from_form}",
                action="Created",
            )

            messages.success(request, "Material uploaded successfully!")
            return redirect("faculty-subject-view", subject_code=subject_code)
        else:
            messages.error(
                request, "Error in form submission. Please check your inputs."
            )

    return redirect("faculty-subject-view", subject_code=subject_code)


@login_required(login_url="faculty-login")
def edit_material(request, subject_code):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    if request.method == "POST":
        material_id = request.POST.get("material_id")
        material = LectureMaterial.objects.get(id=material_id)

        # Verify the subject from form matches the URL parameter
        if str(material.subject.subject_code) != str(subject_code):
            messages.error(request, "Invalid subject code in form submission")
            return redirect("faculty-subject-view", subject_code=subject_code)

        # Update the fields
        material.lecture_id = request.POST.get("lecture_id")
        material.lecture_title = request.POST.get("lecture_title")

        # Handle file upload if a new file was provided
        if request.FILES.get("lecture_file"):
            material.lecture_file = request.FILES["lecture_file"]

        material.save()

        LectureMaterialsLogs.objects.create(
            material_id=f"{subject_code} - {material.lecture_id}",
            action="Updated",
        )

        messages.success(request, "Material updated successfully!")

    return redirect("faculty-subject-view", subject_code=subject_code)


@login_required(login_url="faculty-login")
def delete_material(request, subject_code):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    if request.method != "POST":
        messages.error(request, "Invalid request method")
        return redirect("faculty-subject-view", subject_code=subject_code)

    # Get necessary objects
    material_id = request.POST.get("material_id")

    # Try to find and delete the grade
    try:
        material = LectureMaterial.objects.get(pk=material_id)
        material.delete()

        LectureMaterialsLogs.objects.create(
            material_id=f"{subject_code} - {material_id}",
            action="Deleted",
        )

        messages.success(
            request,
            f"Lecture material deleted Successfully",
        )
    except LectureMaterial.DoesNotExist:
        messages.info(request, "No material found to delete")

    return redirect("faculty-subject-view", subject_code=subject_code)


@login_required(login_url="faculty-login")
def add_task(request, subject_code):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    subject = Subjects.objects.get(subject_code=subject_code)

    # Get the date from the form
    if request.method == "POST":
        deadline_date = request.POST.get("task_deadline")

        Tasks.objects.create(
            task_id=request.POST.get("task_id"),
            task_title=request.POST.get("task_title"),
            task_description=request.POST.get("task_description"),
            task_deadline=deadline_date,  # Django will automatically convert the date string to a date object
            subject=subject,
        )

        task_id = request.POST.get("task_id")

        TaskChangesLog.objects.create(
            task_id=f"{subject_code} - {task_id}",
            action="Created",
        )

        messages.success(request, "Task created successfully")
        return redirect("faculty-subject-view", subject_code=subject_code)

    return redirect("faculty-subject-view", subject_code=subject_code)


@login_required(login_url="faculty-login")
def edit_task(request, subject_code):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    # Get the subject and task or return 404
    subject = get_object_or_404(Subjects, subject_code=subject_code)
    task_id_from_form = request.POST.get("id")
    task = get_object_or_404(Tasks, id=task_id_from_form, subject=subject)

    if request.method == "POST":
        try:
            # Update the task fields
            task.task_id = request.POST.get("task_id")
            task.task_title = request.POST.get("task_title")
            task.task_description = request.POST.get("task_description")
            task.task_deadline = request.POST.get("task_deadline")

            # Save the updated task
            task.save()

            task_id = request.POST.get("task_id")

            TaskChangesLog.objects.create(
                task_id=f"{subject_code} - {task_id}",
                action="Updated",
            )

            messages.success(request, "Task updated successfully")
            return redirect("faculty-subject-view", subject_code=subject_code)

        except Exception as e:
            messages.error(request, f"Error updating task: {str(e)}")
            return redirect("faculty-subject-view", subject_code=subject_code)

    return redirect("faculty-subject-view", subject_code=subject_code)


@login_required(login_url="faculty-login")
def delete_task(request, subject_code):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    if request.method != "POST":
        messages.error(request, "Invalid request method")
        return redirect("faculty-subject-view", subject_code=subject_code)

    # Get necessary objects
    task_id = request.POST.get("task_id")

    # Try to find and delete the grade
    try:
        task = Tasks.objects.get(task_id=task_id)
        task.delete()

        TaskChangesLog.objects.create(
            task_id=f"{subject_code} - {task_id}",
            action="Updated",
        )

        messages.success(
            request,
            f"Task deleted Successfully",
        )
    except Tasks.DoesNotExist:
        messages.info(request, "No task found to delete")

    return redirect("faculty-subject-view", subject_code=subject_code)


@login_required(login_url="faculty-login")
def schedule(request):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    faculty = Faculty.objects.get(faculty_id=request.user.username)
    subjects = Subjects.objects.filter(instructor=faculty).order_by("schedule")

    for subject in subjects:
        # Convert time to datetime for calculation
        start_datetime = datetime.combine(datetime.today(), subject.schedule)
        end_datetime = start_datetime + timedelta(hours=1)

        # Format using the time component
        subject.formatted_schedule = f"{start_datetime.strftime('%I:%M %p')} - {end_datetime.strftime('%I:%M %p')}"

    context = {
        "faculty_id": faculty.faculty_id,
        "first_name": faculty.first_name,
        "last_name": faculty.last_name,
        "profile_pic": faculty.profile_pic,
        "subjects": subjects,
    }

    return render(request, "faculty/schedule.html", context)


@login_required(login_url="faculty-login")
def advisory_class(request):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    faculty = Faculty.objects.get(faculty_id=request.user.username)
    class_to_manage = Classes.objects.filter(adviser=faculty).first()

    if class_to_manage:
        students = Student.objects.filter(year_level=class_to_manage)
    else:
        students = []

    context = {
        "faculty_id": faculty.faculty_id,
        "first_name": faculty.first_name,
        "last_name": faculty.last_name,
        "profile_pic": faculty.profile_pic,
        "class_to_manage": class_to_manage,
        "students": students,
    }

    return render(request, "faculty/advisory_class.html", context)


@login_required(login_url="faculty-login")
def gradebooks(request):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    faculty = Faculty.objects.get(faculty_id=request.user.username)
    subjects = Subjects.objects.filter(instructor=faculty)

    context = {
        "faculty_id": faculty.faculty_id,
        "first_name": faculty.first_name,
        "last_name": faculty.last_name,
        "profile_pic": faculty.profile_pic,
        "subjects": subjects,
    }

    return render(request, "faculty/gradebooks.html", context)


@login_required(login_url="faculty-login")
def gradebook_view(request, subject_code):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    faculty = Faculty.objects.get(faculty_id=request.user.username)
    subject = Subjects.objects.get(subject_code=subject_code)
    grades = Grades.objects.filter(subject=subject)
    subject.formatted_schedule = f"{subject.schedule.strftime('%I:%M %p')}"
    students = Student.objects.filter(year_level=subject.year_level)

    # Handle POST request for grade changes
    if request.method == "POST":
        try:
            grade_input = request.POST.get("grade_input")
            student_id = request.POST.get("student_id")

            student = Student.objects.get(
                student_id=student_id
            )  # You'll need to add this to your form

            # Validate grade input
            if grade_input is None or not grade_input.isdigit():
                raise ValueError("Invalid grade value")

            grade = int(grade_input)
            if not (0 <= grade <= 100):
                raise ValueError("Grade must be between 0 and 100")

            # Get or create grade object
            grade_obj, created = Grades.objects.get_or_create(
                student=student, subject=subject, defaults={"grade": grade}
            )

            # If grade object already existed, update it
            if not created:
                grade_obj.grade = grade
                grade_obj.save()

            GradeChangesLogs.objects.create(
                student_id=student_id, subject_code=subject_code
            )

            messages.success(request, "Grade updated successfully")

        except ValueError as e:
            messages.error(request, str(e))
        except Exception as e:
            messages.error(request, "An error occurred while updating the grade")

        return redirect("faculty-gradebook-view", subject_code=subject_code)

    # Create a dictionary of student_id: grade
    grade_dict = {grade.student.student_id: grade.grade for grade in grades}

    # Assign grades to students
    for student in students:
        student.grade = grade_dict.get(student.student_id, "")

    context = {
        "faculty_id": faculty.faculty_id,
        "first_name": faculty.first_name,
        "last_name": faculty.last_name,
        "profile_pic": faculty.profile_pic,
        "subject": subject,
        "students": students,
    }

    return render(request, "faculty/gradebook_view.html", context)


@login_required(login_url="faculty-login")
def clear_grade(request, subject_code):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    if request.method != "POST":
        messages.error(request, "Invalid request method")
        return redirect("faculty-gradebook-view", subject_code=subject_code)

    try:
        # Get necessary objects
        student_id = request.POST.get("student_id")
        subject = Subjects.objects.get(subject_code=subject_code)
        student = Student.objects.get(student_id=student_id)

        # Try to find and delete the grade
        try:
            grade = Grades.objects.get(student=student, subject=subject)
            grade.delete()

            GradeChangesLogs.objects.create(
                student_id=student_id, subject_code=subject_code
            )

            messages.success(
                request,
                f"Grade cleared successfully for {student.first_name} {student.last_name}",
            )
        except Grades.DoesNotExist:
            messages.info(request, "No grade found to clear")

    except Student.DoesNotExist:
        messages.error(request, "Student not found")
    except Subjects.DoesNotExist:
        messages.error(request, "Subject not found")
    except Exception as e:
        messages.error(request, f"An error occurred while clearing the grade: {str(e)}")

    return redirect("faculty-gradebook-view", subject_code=subject_code)


@login_required(login_url="faculty-login")
def announcements(request):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    faculty = Faculty.objects.get(faculty_id=request.user.username)

    announcements_to_display = Announcements.objects.all().order_by("-announcement_date")

    context = {
        "faculty_id": faculty.faculty_id,
        "first_name": faculty.first_name,
        "last_name": faculty.last_name,
        "profile_pic": faculty.profile_pic,
        "announcements": announcements_to_display,
    }

    return render(request, "faculty/announcements.html", context)


automated_message = """St. Joseph Academy Faculty Portal - System Guide and Support Chat

Welcome to your faculty portal! This guide will help you navigate and maximize the use of your administrative and teaching tools.

DASHBOARD
The Dashboard serves as your command center for managing classes and accessing academic resources. From here, you can efficiently monitor your teaching responsibilities through the quick-access cards for subjects, schedules, gradebooks, and announcements.

MAIN NAVIGATION FEATURES

Advisory Class
You can manage your advisory class, track student attendance, and oversee class-specific activities and concerns.

Subjects
You can access your teaching subjects, manage course materials, create assignments, and post subject-specific announcements.

Schedule
You can view your teaching schedule, check class timings, and manage your academic calendar.

Gradebooks
You can input and manage student grades, track academic performance, generate progress reports, and maintain assessment records.

Announcements
You can stay informed about school updates and create announcements for your classes and advisory groups.

Support & Feedback
You can report technical issues, request assistance, submit system feedback, and access faculty resources and guides.

Additional Tips
- Maintain password security and regular password updates
- Always log out after completing your session
- Review announcements daily for important administrative updates
- Utilize the Support & Feedback section for technical assistance
- Save frequently accessed pages for quick navigation

Best Practices
Update gradebooks regularly to maintain current student records. Check announcements daily for important administrative notices. Review your teaching schedule at the start of each week. Monitor student performance consistently through the gradebook feature. Report any technical issues immediately through this System Support & Feedback chat.
"""


@login_required(login_url="faculty-login")
def chat_view(request):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    faculty = Faculty.objects.get(faculty_id=request.user.username)

    conversation = SupportChat.objects.filter(chat_recipient=request.user).first()

    if conversation is None:
        SupportChat.objects.create(chat_recipient=request.user)

        new_conversation = SupportChat.objects.filter(
            chat_recipient=request.user
        ).first()

        SupportMessage.objects.create(
            conversation=new_conversation, content=automated_message
        )

        return redirect("faculty-chat-view")

    if request.method == "POST":
        # Get the message content and trim whitespace
        message_content = request.POST.get("message", "").strip()

        # Check if the message is valid (not empty after trimming)
        if message_content:
            # Create and save the new SupportMessage
            SupportMessage.objects.create(
                conversation=conversation,
                sender=request.user,
                content=message_content,
            )
            messages.success(request, "Message sent successfully!")
        else:
            # Handle empty or whitespace-only input
            messages.error(request, "Message cannot be empty or whitespace only.")

    # Fetch all chat messages for this conversation, ordered newest to oldest
    chats = SupportMessage.objects.filter(conversation=conversation)[::-1]

    context = {
        "faculty_id": faculty.faculty_id,
        "first_name": faculty.first_name,
        "last_name": faculty.last_name,
        "profile_pic": faculty.profile_pic,
        "chats": chats,
        "conversation": conversation,
    }

    return render(request, "faculty/chat_view.html", context)


@login_required(login_url="faculty-login")
def profile(request):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    faculty = Faculty.objects.get(faculty_id=request.user.username)

    context = {
        "faculty_id": faculty.faculty_id,
        "first_name": faculty.first_name,
        "last_name": faculty.last_name,
        "email": faculty.email,
        "phone_number": faculty.phone_number,
        "profile_pic": faculty.profile_pic,
    }

    return render(request, "faculty/profile.html", context)


@login_required(login_url="faculty-login")
def edit_profile(request):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    faculty = Faculty.objects.get(faculty_id=request.user.username)

    if request.method == "POST":
        form = EditProfileForm(request.POST, instance=faculty)
        if form.is_valid():
            form.save()
            messages.success(request, "Profile updated successfully!")
            return redirect("faculty-profile")
    else:
        form = EditProfileForm(instance=faculty)

    context = {
        "form": form,
        "faculty_id": faculty.faculty_id,
        "first_name": faculty.first_name,
        "last_name": faculty.last_name,
        "profile_pic": faculty.profile_pic,
    }

    return render(request, "faculty/edit_profile.html", context)


logger = logging.getLogger(__name__)


def crop_square_image(image):
    try:
        # Convert to RGB if needed
        if image.mode != "RGB":
            image = image.convert("RGB")

        # Get dimensions
        width, height = image.size
        crop_size = min(width, height)

        # Center crop
        left = (width - crop_size) // 2
        top = (height - crop_size) // 2
        right = left + crop_size
        bottom = top + crop_size

        image = image.crop((left, top, right, bottom))
        image = image.resize((300, 300), Image.Resampling.LANCZOS)
        return image
    except Exception as e:
        logger.error(f"Image processing error: {str(e)}")
        return None


@login_required(login_url="faculty-login")
def update_profile_pic(request):
    try:
        if not request.user.username.startswith("FAC-"):
            messages.error(request, "Only faculty accounts can access this page")
            return redirect("faculty-login")

        if request.method == "POST" and request.FILES.get("profile_pic"):
            faculty = Faculty.objects.get(faculty_id=request.user.username)
            upload = request.FILES["profile_pic"]

            # Validate file
            if not upload.content_type.startswith("image"):
                messages.error(request, "Please upload a valid image file")
                return redirect("faculty-profile")

            # Process image
            img = Image.open(upload)
            processed_img = crop_square_image(img)

            if processed_img:
                # Save processed image
                output = BytesIO()
                processed_img.save(output, format="JPEG", quality=90)
                output.seek(0)

                # Create new file
                processed_file = InMemoryUploadedFile(
                    output,
                    "ImageField",
                    f"{upload.name.split('.')[0]}.jpg",
                    "image/jpeg",
                    sys.getsizeof(output),
                    None,
                )

                faculty.profile_pic = processed_file
                faculty.save()
                messages.success(request, "Profile picture updated successfully!")
            else:
                messages.error(request, "Error processing image")
        else:
            messages.error(request, "No image file provided")

        return redirect("faculty-profile")

    except Exception as e:
        logger.error(f"Profile pic update error: {str(e)}")
        messages.error(request, "Error updating profile picture")
        return redirect("faculty-profile")


@login_required(login_url="faculty-login")
def update_password(request):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    if request.method == "POST":
        new_password = request.POST.get("new_password")
        confirm_password = request.POST.get("confirm_password")

        if new_password != confirm_password:
            messages.error(request, "Passwords do not match")
            return redirect("faculty-profile")

        if len(new_password) < 8:
            messages.error(request, "Password must be at least 8 characters long")
            return redirect("faculty-profile")

        try:
            # Get both Faculty and User instances
            faculty = Faculty.objects.get(faculty_id=request.user.username)
            user = request.user

            # Update password in both models
            faculty.password = new_password
            user.set_password(new_password)

            # Save both models
            faculty.save()
            user.save()

            # Update session auth hash AFTER saving
            update_session_auth_hash(request, user)
            messages.success(request, "Password updated successfully!")

        except Exception as e:
            logger.error(f"Password update error: {str(e)}")
            messages.error(request, "Error updating password")

    return redirect("faculty-profile")


def login(request):
    if request.user.is_authenticated and request.user.username.startswith("FAC-"):
        return redirect("faculty-dashboard")

    if request.method == "POST":
        form = LoginForm(request.POST)
        if form.is_valid():
            faculty_id = form.cleaned_data.get("faculty_id")
            password = form.cleaned_data.get("password")
            user = authenticate(username=faculty_id, password=password)

            if user is not None:
                if not user.username.startswith("FAC-"):
                    messages.error(request, "Only faculty accounts can login here")
                else:
                    auth_login(request, user)

                    # Create log entry after successful login
                    UserAccessLogs.objects.create(
                        user_name=faculty_id, user_type="Faculty", action="Login"
                    )

                    return redirect("faculty-dashboard")
            else:
                messages.error(request, "Invalid faculty ID or password")
    else:
        form = LoginForm()

    context = {"form": form}

    return render(request, "faculty/login.html", context)


@login_required(login_url="faculty-login")
def logout(request):
    if not request.user.username.startswith("FAC-"):
        messages.error(request, "Only faculty accounts can access this page")
        return redirect("faculty-login")

    faculty_id = request.user.username

    if request.method == "POST":
        auth_logout(request)

        UserAccessLogs.objects.create(
            user_name=faculty_id, user_type="Faculty", action="Logout"
        )

    return redirect("faculty-login")
