from django.shortcuts import render, redirect, get_object_or_404
from django.contrib.auth.decorators import login_required
from django.contrib.auth import (
    authenticate,
    login as auth_login,
    logout as auth_logout,
    update_session_auth_hash,
)
from django.contrib import messages
from .forms import LoginForm, EditProfileForm
from .models import Student, Grades
from Academy.models import Announcements, SupportChat, SupportMessage, UserAccessLogs
from Faculty.models import Subjects, LectureMaterial, Tasks
from datetime import datetime, timedelta
from PIL import Image
from io import BytesIO
import sys
import logging
from django.core.files.uploadedfile import InMemoryUploadedFile


# Create your views here.
@login_required(login_url="student-login")
def dashboard(request):
    if not request.user.username.startswith("STU-"):
        messages.error(request, "Only student accounts can access this page")
        return redirect("student-login")

    student = Student.objects.get(student_id=request.user.username)

    context = {
        "student_id": student.student_id,
        "first_name": student.first_name,
        "last_name": student.last_name,
        "profile_pic": student.profile_pic,
    }

    return render(request, "students/dashboard.html", context)


@login_required(login_url="student-login")
def subjects(request):
    if not request.user.username.startswith("STU-"):
        messages.error(request, "Only student accounts can access this page")
        return redirect("student-login")

    student = Student.objects.get(student_id=request.user.username)
    subjects = Subjects.objects.filter(year_level=student.year_level)

    context = {
        "student_id": student.student_id,
        "first_name": student.first_name,
        "last_name": student.last_name,
        "profile_pic": student.profile_pic,
        "subjects": subjects,
    }

    return render(request, "students/subjects.html", context)


@login_required(login_url="student-login")
def subject_view(request, subject_code):
    if not request.user.username.startswith("STU-"):
        messages.error(request, "Only student accounts can access this page")
        return redirect("student-login")

    student = Student.objects.get(student_id=request.user.username)
    subject = Subjects.objects.get(subject_code=subject_code)

    subject.formatted_schedule = f"{subject.schedule.strftime('%I:%M %p')}"
    materials = LectureMaterial.objects.filter(subject=subject)

    tasks = Tasks.objects.filter(subject=subject).order_by('-task_deadline')

    context = {
        "student_id": student.student_id,
        "first_name": student.first_name,
        "last_name": student.last_name,
        "profile_pic": student.profile_pic,
        "subject": subject,
        "materials": materials,
        "tasks": tasks,
    }

    return render(request, "students/subject_view.html", context)


@login_required(login_url="student-login")
def schedule(request):
    if not request.user.username.startswith("STU-"):
        messages.error(request, "Only student accounts can access this page")
        return redirect("student-login")

    student = Student.objects.get(student_id=request.user.username)
    subjects = Subjects.objects.filter(year_level=student.year_level).order_by(
        "schedule"
    )

    for subject in subjects:
        # Convert time to datetime for calculation
        start_datetime = datetime.combine(datetime.today(), subject.schedule)
        end_datetime = start_datetime + timedelta(hours=1)

        # Format using the time component
        subject.formatted_schedule = f"{start_datetime.strftime('%I:%M %p')} - {end_datetime.strftime('%I:%M %p')}"

    context = {
        "student_id": student.student_id,
        "first_name": student.first_name,
        "last_name": student.last_name,
        "profile_pic": student.profile_pic,
        "subjects": subjects,
    }

    return render(request, "students/schedule.html", context)


@login_required(login_url="student-login")
def grades(request):
    if not request.user.username.startswith("STU-"):
        messages.error(request, "Only student accounts can access this page")
        return redirect("student-login")

    student = Student.objects.get(student_id=request.user.username)
    subjects = Subjects.objects.filter(year_level=student.year_level).order_by(
        "schedule"
    )
    grades = Grades.objects.filter(student=student)

    for subject in subjects:
        # Convert time to datetime for calculation
        start_datetime = datetime.combine(datetime.today(), subject.schedule)
        end_datetime = start_datetime + timedelta(hours=1)

        # Format using the time component
        subject.formatted_schedule = f"{start_datetime.strftime('%I:%M %p')} - {end_datetime.strftime('%I:%M %p')}"

    # Create a dictionary of student_id: grade
    grade_dict = {grade.subject.subject_code: grade.grade for grade in grades}

    # Assign grades to students
    for subject in subjects:
        subject.grade = grade_dict.get(subject.subject_code, "")

    context = {
        "student_id": student.student_id,
        "first_name": student.first_name,
        "last_name": student.last_name,
        "profile_pic": student.profile_pic,
        "subjects": subjects,
    }

    return render(request, "students/grades.html", context)


@login_required(login_url="student-login")
def announcements(request):
    if not request.user.username.startswith("STU-"):
        messages.error(request, "Only student accounts can access this page")
        return redirect("student-login")

    student = Student.objects.get(student_id=request.user.username)

    announcements_to_display = Announcements.objects.all().order_by("-announcement_date")

    context = {
        "student_id": student.student_id,
        "first_name": student.first_name,
        "last_name": student.last_name,
        "profile_pic": student.profile_pic,
        "announcements": announcements_to_display,
    }

    return render(request, "students/announcements.html", context)


automated_message = """St. Joseph Academy Student Portal - System Guide and Support Chat

Welcome to your student portal! This guide will help you navigate and make the most of the available features.

DASHBOARD
The Dashboard is your home screen and central hub for accessing all your academic information. From here, you can quickly access your schedule, grades, and important announcements through the featured cards.

MAIN NAVIGATION FEATURES

Subjects
You can view all your enrolled courses, access course materials and resources, and see subject-specific announcements and assignments.

Schedule
You can check your daily and weekly class schedules, view class timings, and track upcoming classes.

Grades
You can review your current academic performance, view overall subject grades, and monitor your academic progress.

Announcements
You can stay updated with school-wide notifications, read important administrative messages, and view event announcements.

Support & Feedback
You can submit technical issues, request assistance, provide feedback about the portal, contact academic support, and access help resources.

Additional Tips
- Keep your login credentials secure
- Log out after each session using the Logout button
- Check announcements regularly for important updates
- Use the Support & Feedback section if you encounter any issues
- Bookmark frequently accessed pages for quick access

Best Practices
Check your dashboard daily for new announcements. Review your grades regularly to track your progress. Verify your schedule at the start of each week. Report any technical issues promptly through this System Support & Feedback chat.
"""


@login_required(login_url="student-login")
def chat_view(request):
    if not request.user.username.startswith("STU-"):
        messages.error(request, "Only student accounts can access this page")
        return redirect("student-login")

    student = Student.objects.get(student_id=request.user.username)

    conversation = SupportChat.objects.filter(chat_recipient=request.user).first()

    if conversation is None:
        SupportChat.objects.create(chat_recipient=request.user)

        new_conversation = SupportChat.objects.filter(
            chat_recipient=request.user
        ).first()

        SupportMessage.objects.create(
            conversation=new_conversation, content=automated_message
        )

        return redirect("student-chat-view")

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
        "student_id": student.student_id,
        "first_name": student.first_name,
        "last_name": student.last_name,
        "profile_pic": student.profile_pic,
        "chats": chats,
        "conversation": conversation,
    }

    return render(request, "students/chat_view.html", context)


@login_required(login_url="student-login")
def profile(request):
    if not request.user.username.startswith("STU-"):
        messages.error(request, "Only student accounts can access this page")
        return redirect("student-login")

    student = Student.objects.get(student_id=request.user.username)

    context = {
        "student_id": student.student_id,
        "first_name": student.first_name,
        "last_name": student.last_name,
        "year_level": student.year_level,
        "email": student.email,
        "phone_number": student.phone_number,
        "profile_pic": student.profile_pic,
    }

    return render(request, "students/profile.html", context)


@login_required(login_url="student-login")
def edit_profile(request):
    if not request.user.username.startswith("STU-"):
        messages.error(request, "Only student accounts can access this page")
        return redirect("student-login")

    student = Student.objects.get(student_id=request.user.username)

    if request.method == "POST":
        form = EditProfileForm(request.POST, instance=student)
        if form.is_valid():
            form.save()
            messages.success(request, "Profile updated successfully!")
            return redirect("student-profile")
    else:
        form = EditProfileForm(instance=student)

    context = {
        "form": form,
        "student_id": student.student_id,
        "first_name": student.first_name,
        "last_name": student.last_name,
        "year_level": student.year_level,
        "profile_pic": student.profile_pic,
    }

    return render(request, "students/edit_profile.html", context)


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


@login_required(login_url="student-login")
def update_profile_pic(request):
    try:
        if not request.user.username.startswith("STU-"):
            messages.error(request, "Only student accounts can access this page")
            return redirect("student-login")

        if request.method == "POST" and request.FILES.get("profile_pic"):
            student = Student.objects.get(student_id=request.user.username)
            upload = request.FILES["profile_pic"]

            # Validate file
            if not upload.content_type.startswith("image"):
                messages.error(request, "Please upload a valid image file")
                return redirect("student-profile")

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

                student.profile_pic = processed_file
                student.save()
                messages.success(request, "Profile picture updated successfully!")
            else:
                messages.error(request, "Error processing image")
        else:
            messages.error(request, "No image file provided")

        return redirect("student-profile")

    except Exception as e:
        logger.error(f"Profile pic update error: {str(e)}")
        messages.error(request, "Error updating profile picture")
        return redirect("student-profile")


@login_required(login_url="student-login")
def update_password(request):
    if not request.user.username.startswith("STU-"):
        messages.error(request, "Only student accounts can access this page")
        return redirect("student-login")

    if request.method == "POST":
        new_password = request.POST.get("new_password")
        confirm_password = request.POST.get("confirm_password")

        if new_password != confirm_password:
            messages.error(request, "Passwords do not match")
            return redirect("student-profile")

        if len(new_password) < 8:
            messages.error(request, "Password must be at least 8 characters long")
            return redirect("student-profile")

        try:
            # Get both Student and User instances
            student = Student.objects.get(student_id=request.user.username)
            user = request.user

            # Update password in both models
            student.password = new_password
            user.set_password(new_password)

            # Save both models
            student.save()
            user.save()

            # Update session auth hash AFTER saving
            update_session_auth_hash(request, user)
            messages.success(request, "Password updated successfully!")

        except Exception as e:
            logger.error(f"Password update error: {str(e)}")
            messages.error(request, "Error updating password")

    return redirect("student-profile")


def login(request):
    if request.user.is_authenticated and request.user.username.startswith("STU-"):
        return redirect("student-dashboard")

    if request.method == "POST":
        form = LoginForm(request.POST)
        if form.is_valid():
            student_id = form.cleaned_data.get("student_id")
            password = form.cleaned_data.get("password")
            user = authenticate(username=student_id, password=password)

            if user is not None:
                if not user.username.startswith("STU-"):
                    messages.error(request, "Only student accounts can login here")
                else:
                    auth_login(request, user)

                    # Create log entry after successful login
                    UserAccessLogs.objects.create(
                        user_name=student_id, user_type="Student", action="Login"
                    )

                    return redirect("student-dashboard")
            else:
                messages.error(request, "Invalid student ID or password")
    else:
        form = LoginForm()

    context = {"form": form}

    return render(request, "students/login.html", context)


@login_required(login_url="student-login")
def logout(request):
    if not request.user.username.startswith("STU-"):
        messages.error(request, "Only student accounts can access this page")
        return redirect("student-login")

    student_id = request.user.username

    if request.method == "POST":
        auth_logout(request)

        UserAccessLogs.objects.create(
            user_name=student_id, user_type="Student", action="Logout"
        )

    return redirect("student-login")
