from django.shortcuts import render, redirect
from django.contrib.auth.decorators import login_required
from django.contrib.auth import (
    authenticate,
    login as auth_login,
    logout as auth_logout,
    update_session_auth_hash,
)
from django.contrib import messages
from .forms import LoginForm, EditProfileForm
from .models import Parent
from Academy.models import Announcements, SupportChat, SupportMessage, UserAccessLogs
from Students.models import Student, Grades
from Faculty.models import Subjects
from datetime import datetime, timedelta
from PIL import Image
from io import BytesIO
import sys
import logging
from django.core.files.uploadedfile import InMemoryUploadedFile


# Create your views here.
@login_required(login_url="parent-login")
def dashboard(request):
    if not request.user.username.startswith("PAR-"):
        messages.error(request, "Only parent accounts can access this page")
        return redirect("parent-login")

    parent = Parent.objects.get(parent_id=request.user.username)

    context = {
        "parent_id": parent.parent_id,
        "first_name": parent.first_name,
        "last_name": parent.last_name,
        "profile_pic": parent.profile_pic,
    }

    return render(request, "parents/dashboard.html", context)


@login_required(login_url="parent-login")
def family(request):
    if not request.user.username.startswith("PAR-"):
        messages.error(request, "Only parent accounts can access this page")
        return redirect("parent-login")

    parent = Parent.objects.get(parent_id=request.user.username)
    children = Student.objects.filter(parent=parent)

    context = {
        "parent_id": parent.parent_id,
        "first_name": parent.first_name,
        "last_name": parent.last_name,
        "profile_pic": parent.profile_pic,
        "children": children,
    }

    return render(request, "parents/family.html", context)


@login_required(login_url="parent-login")
def family_view(request, student_id):
    if not request.user.username.startswith("PAR-"):
        messages.error(request, "Only parent accounts can access this page")
        return redirect("parent-login")

    parent = Parent.objects.get(parent_id=request.user.username)
    child = Student.objects.get(student_id=student_id)

    subjects = Subjects.objects.filter(year_level=child.year_level).order_by("schedule")

    for subject in subjects:
        # Convert time to datetime for calculation
        start_datetime = datetime.combine(datetime.today(), subject.schedule)
        end_datetime = start_datetime + timedelta(hours=1)

        # Format using the time component
        subject.formatted_schedule = f"{start_datetime.strftime('%I:%M %p')} - {end_datetime.strftime('%I:%M %p')}"

    context = {
        "parent_id": parent.parent_id,
        "first_name": parent.first_name,
        "last_name": parent.last_name,
        "profile_pic": parent.profile_pic,
        "child": child,
        "subjects": subjects,
    }

    return render(request, "parents/family_view.html", context)


@login_required(login_url="parent-login")
def gradebooks(request):
    if not request.user.username.startswith("PAR-"):
        messages.error(request, "Only parent accounts can access this page")
        return redirect("parent-login")

    parent = Parent.objects.get(parent_id=request.user.username)
    children = Student.objects.filter(parent=parent)

    context = {
        "parent_id": parent.parent_id,
        "first_name": parent.first_name,
        "last_name": parent.last_name,
        "profile_pic": parent.profile_pic,
        "children": children,
    }

    return render(request, "parents/gradebooks.html", context)


@login_required(login_url="parent-login")
def gradebook_view(request, student_id):
    if not request.user.username.startswith("PAR-"):
        messages.error(request, "Only parent accounts can access this page")
        return redirect("parent-login")

    parent = Parent.objects.get(parent_id=request.user.username)
    child = Student.objects.get(student_id=student_id)

    subjects = Subjects.objects.filter(year_level=child.year_level).order_by("schedule")
    grades = Grades.objects.filter(student=child)

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
        "parent_id": parent.parent_id,
        "first_name": parent.first_name,
        "last_name": parent.last_name,
        "profile_pic": parent.profile_pic,
        "child": child,
        "subjects": subjects,
    }

    return render(request, "parents/gradebook_view.html", context)


@login_required(login_url="parent-login")
def announcements(request):
    if not request.user.username.startswith("PAR-"):
        messages.error(request, "Only parent accounts can access this page")
        return redirect("parent-login")

    parent = Parent.objects.get(parent_id=request.user.username)

    announcements_to_display = Announcements.objects.all().order_by("-announcement_date")

    context = {
        "parent_id": parent.parent_id,
        "first_name": parent.first_name,
        "last_name": parent.last_name,
        "profile_pic": parent.profile_pic,
        "announcements": announcements_to_display,
    }

    return render(request, "parents/announcements.html", context)


automated_message = """St. Joseph Academy Parent Portal - System Guide and Support Chat

Welcome to your parent portal! This guide will help you stay connected with your child's academic journey and keep track of their progress at St. Joseph Academy.

DASHBOARD
The Dashboard is your central hub for monitoring your child's academic performance and staying updated with school announcements. From here, you can easily access your family information, view grades, and read important school updates.

MAIN NAVIGATION FEATURES

Family
You can access and update your family's information, manage contact details, and view your children's basic academic profiles.

Gradebooks
You can monitor your children's academic performance, view current grades across all subjects, track assessment results, and follow their educational progress.

Announcements
You can stay informed about school events, read administrative updates, and receive important notifications about academic activities and schedules.

Support & Feedback
You can report technical issues, request assistance, submit inquiries about the portal, and access parent resources and guides.

Additional Tips
- Keep your login credentials secure and confidential
- Remember to log out after each session
- Check announcements regularly for important school updates
- Use the Support & Feedback section if you need technical assistance
- Save frequently accessed pages for easier navigation

Best Practices
Review your child's grades regularly to stay informed of their academic progress. Check announcements daily for important school communications. Update your contact information promptly if changes occur. Reach out through the Support & Feedback system if you encounter any technical issues or have questions about using the portal.
"""


@login_required(login_url="parent-login")
def chat_view(request):
    if not request.user.username.startswith("PAR-"):
        messages.error(request, "Only parent accounts can access this page")
        return redirect("parent-login")

    parent = Parent.objects.get(parent_id=request.user.username)

    conversation = SupportChat.objects.filter(chat_recipient=request.user).first()

    if conversation is None:
        SupportChat.objects.create(chat_recipient=request.user)

        new_conversation = SupportChat.objects.filter(
            chat_recipient=request.user
        ).first()

        SupportMessage.objects.create(
            conversation=new_conversation, content=automated_message
        )

        return redirect("parent-chat-view")

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
        "parent_id": parent.parent_id,
        "first_name": parent.first_name,
        "last_name": parent.last_name,
        "profile_pic": parent.profile_pic,
        "chats": chats,
        "conversation": conversation,
    }

    return render(request, "parents/chat_view.html", context)


@login_required(login_url="parent-login")
def profile(request):
    if not request.user.username.startswith("PAR-"):
        messages.error(request, "Only parent accounts can access this page")
        return redirect("parent-login")

    parent = Parent.objects.get(parent_id=request.user.username)

    context = {
        "parent_id": parent.parent_id,
        "first_name": parent.first_name,
        "last_name": parent.last_name,
        "email": parent.email,
        "phone_number": parent.phone_number,
        "profile_pic": parent.profile_pic,
    }

    return render(request, "parents/profile.html", context)


@login_required(login_url="parent-login")
def edit_profile(request):
    if not request.user.username.startswith("PAR-"):
        messages.error(request, "Only parent accounts can access this page")
        return redirect("parent-login")

    parent = Parent.objects.get(parent_id=request.user.username)

    if request.method == "POST":
        form = EditProfileForm(request.POST, instance=parent)
        if form.is_valid():
            form.save()
            messages.success(request, "Profile updated successfully!")
            return redirect("parent-profile")
    else:
        form = EditProfileForm(instance=parent)

    context = {
        "form": form,
        "parent_id": parent.parent_id,
        "first_name": parent.first_name,
        "last_name": parent.last_name,
        "profile_pic": parent.profile_pic,
    }

    return render(request, "parents/edit_profile.html", context)


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


@login_required(login_url="parent-login")
def update_profile_pic(request):
    try:
        if not request.user.username.startswith("PAR-"):
            messages.error(request, "Only parent accounts can access this page")
            return redirect("parent-login")

        if request.method == "POST" and request.FILES.get("profile_pic"):
            parent = Parent.objects.get(parent_id=request.user.username)
            upload = request.FILES["profile_pic"]

            # Validate file
            if not upload.content_type.startswith("image"):
                messages.error(request, "Please upload a valid image file")
                return redirect("parent-profile")

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

                parent.profile_pic = processed_file
                parent.save()
                messages.success(request, "Profile picture updated successfully!")
            else:
                messages.error(request, "Error processing image")
        else:
            messages.error(request, "No image file provided")

        return redirect("parent-profile")

    except Exception as e:
        logger.error(f"Profile pic update error: {str(e)}")
        messages.error(request, "Error updating profile picture")
        return redirect("parent-profile")


@login_required(login_url="parent-login")
def update_password(request):
    if not request.user.username.startswith("PAR-"):
        messages.error(request, "Only parent accounts can access this page")
        return redirect("parent-login")

    if request.method == "POST":
        new_password = request.POST.get("new_password")
        confirm_password = request.POST.get("confirm_password")

        if new_password != confirm_password:
            messages.error(request, "Passwords do not match")
            return redirect("parent-profile")

        if len(new_password) < 8:
            messages.error(request, "Password must be at least 8 characters long")
            return redirect("parent-profile")

        try:
            # Get both Parent and User instances
            parent = Parent.objects.get(parent_id=request.user.username)
            user = request.user

            # Update password in both models
            parent.password = new_password
            user.set_password(new_password)

            # Save both models
            parent.save()
            user.save()

            # Update session auth hash AFTER saving
            update_session_auth_hash(request, user)
            messages.success(request, "Password updated successfully!")

        except Exception as e:
            logger.error(f"Password update error: {str(e)}")
            messages.error(request, "Error updating password")

    return redirect("parent-profile")


def login(request):
    if request.user.is_authenticated and request.user.username.startswith("PAR-"):
        return redirect("parent-dashboard")

    if request.method == "POST":
        form = LoginForm(request.POST)
        if form.is_valid():
            parent_id = form.cleaned_data.get("parent_id")
            password = form.cleaned_data.get("password")
            user = authenticate(username=parent_id, password=password)

            if user is not None:
                if not user.username.startswith("PAR-"):
                    messages.error(request, "Only parent accounts can login here")
                else:
                    auth_login(request, user)

                    # Create log entry after successful login
                    UserAccessLogs.objects.create(
                        user_name=parent_id, user_type="Parent", action="Login"
                    )

                    return redirect("parent-dashboard")
            else:
                messages.error(request, "Invalid parent ID or password")
    else:
        form = LoginForm()

    context = {"form": form}

    return render(request, "parents/login.html", context)


@login_required(login_url="parent-login")
def logout(request):
    if not request.user.username.startswith("PAR-"):
        messages.error(request, "Only parent accounts can access this page")
        return redirect("parent-login")

    parent_id = request.user.username

    if request.method == "POST":
        auth_logout(request)

        UserAccessLogs.objects.create(
            user_name=parent_id, user_type="Parent", action="Logout"
        )

    return redirect("parent-login")
