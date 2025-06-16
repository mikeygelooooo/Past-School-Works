from django.db import models
from django.contrib.auth.models import User
from django.db.models.signals import pre_save, post_save, pre_delete
from django.dispatch import receiver
from django.core.validators import FileExtensionValidator
from datetime import datetime
from Academy.models import UserAccountLogs, SubjectsChangesLogs
import os


def profile_pic_path(instance, filename):
    ext = filename.split(".")[-1]
    timestamp = datetime.now().strftime("%Y%m%d_%H%M%S")
    return f"profile_pictures/faculty/{instance.faculty_id}_{timestamp}.{ext}"


class Faculty(models.Model):
    faculty_id = models.CharField(max_length=8, unique=True, blank=True)
    first_name = models.CharField(max_length=100)
    last_name = models.CharField(max_length=100)
    email = models.EmailField(unique=True)
    phone_number = models.CharField(max_length=15)
    password = models.CharField(max_length=100)
    profile_pic = models.ImageField(
        upload_to=profile_pic_path,
        default="profile_pictures/blank.jpg",
        blank=True,
    )

    def save(self, *args, **kwargs):
        # Handle profile picture changes
        if self.pk:
            try:
                old_instance = Faculty.objects.get(pk=self.pk)
                # Check if password was changed
                if old_instance.password != self.password:
                    # Update Django User password
                    try:
                        user = User.objects.get(username=self.faculty_id)
                        user.set_password(self.password)
                        user.save()
                    except User.DoesNotExist:
                        pass

                # Existing profile pic handling
                if old_instance.profile_pic != self.profile_pic:
                    if os.path.exists(
                        old_instance.profile_pic.path
                    ) and not old_instance.profile_pic.path.endswith("blank.jpg"):
                        os.remove(old_instance.profile_pic.path)
            except Faculty.DoesNotExist:
                pass

        super().save(*args, **kwargs)

    def __str__(self):
        return f"{self.faculty_id} - {self.first_name} {self.last_name}"

    class Meta:
        verbose_name = "Faculty"
        verbose_name_plural = "Faculty"
        ordering = ["faculty_id"]


@receiver(pre_save, sender=Faculty)
def generate_faculty_id(sender, instance, **kwargs):
    if not instance.faculty_id:
        # Get last faculty record
        last_faculty = Faculty.objects.order_by("-faculty_id").first()

        if last_faculty:
            # Extract number from last ID and increment
            last_number = int(last_faculty.faculty_id.split("-")[1])
            new_number = last_number + 1
        else:
            new_number = 1

        # Format new faculty ID
        instance.faculty_id = f"FAC-{new_number:04d}"


@receiver(post_save, sender=Faculty)
def create_user_account(sender, instance, created, **kwargs):
    if created:
        User.objects.create_user(
            username=instance.faculty_id,
            password=instance.password,
        )

        UserAccountLogs.objects.create(
            user_name=instance.faculty_id, user_type="Faculty", action="Created"
        )
    else:
        # Log the update action
        UserAccountLogs.objects.create(
            user_name=instance.faculty_id, user_type="Faculty", action="Updated"
        )


@receiver(pre_delete, sender=Faculty)
def delete_user_account(sender, instance, **kwargs):
    """Delete the associated User when a Faculty is deleted"""
    try:
        # Add a flag to the instance to prevent recursive deletion
        if not hasattr(instance, "_user_being_deleted"):
            user = User.objects.get(username=instance.faculty_id)
            # Set flag on user to prevent recursive deletion
            user._faculty_being_deleted = True

            UserAccountLogs.objects.create(
                user_name=instance.faculty_id, user_type="Faculty", action="Deleted"
            )

            user.delete()
    except User.DoesNotExist:
        pass


@receiver(pre_delete, sender=User)
def delete_faculty_record(sender, instance, **kwargs):
    """Delete the associated Faculty when a User is deleted"""
    try:
        # Only delete the faculty if this deletion didn't come from the faculty deletion
        if not hasattr(instance, "_faculty_being_deleted"):
            faculty = Faculty.objects.get(faculty_id=instance.username)
            # Set flag on faculty to prevent recursive deletion
            faculty._user_being_deleted = True

            UserAccountLogs.objects.create(
                user_name=instance.username, user_type="Faculty", action="Deleted"
            )

            faculty.delete()
    except Faculty.DoesNotExist:
        pass


class Subjects(models.Model):
    subject_code = models.CharField(max_length=10, unique=True)
    subject_name = models.CharField(max_length=100)
    year_level = models.ForeignKey(
        "Students.Classes", on_delete=models.SET_NULL, null=True
    )
    schedule = models.TimeField(null=True)
    instructor = models.ForeignKey(
        "Faculty.Faculty", on_delete=models.SET_NULL, null=True
    )

    def __str__(self):
        return f"{self.subject_code} - {self.subject_name}"

    class Meta:
        verbose_name = "Subject"
        verbose_name_plural = "Subjects"
        ordering = ["subject_code"]


@receiver(post_save, sender=Subjects)
def create_subject(sender, instance, created, **kwargs):
    if created:
        SubjectsChangesLogs.objects.create(
            subject_code=instance.subject_code,
            subject_name=instance.subject_name,
            action="Created",
        )
    else:
        # Log the update action
        SubjectsChangesLogs.objects.create(
            subject_code=instance.subject_code,
            subject_name=instance.subject_name,
            action="Updated",
        )


@receiver(pre_delete, sender=Subjects)
def handle_class_deletion(sender, instance, **kwargs):
    SubjectsChangesLogs.objects.create(
        subject_code=instance.subject_code,
        subject_name=instance.subject_name,
        action="Deleted",
    )


def lecture_material_path(instance, filename):
    # Get the file extension from the original filename
    file_extension = filename.split(".")[-1]

    # Create new filename using subject_code and lecture_id
    new_filename = (
        f"{instance.subject.subject_code}_{instance.lecture_id}.{file_extension}"
    )

    # This function will create path like: lecture_materials/MATH101/filename.pdf
    return f"lecture_materials/{instance.subject.subject_code}/{new_filename}"


class LectureMaterial(models.Model):
    lecture_id = models.CharField(max_length=20)
    lecture_title = models.CharField(max_length=50)
    subject = models.ForeignKey("Faculty.Subjects", on_delete=models.CASCADE)

    lecture_file = models.FileField(
        upload_to=lecture_material_path,
        validators=[
            FileExtensionValidator(
                allowed_extensions=["pdf", "doc", "docx", "ppt", "pptx"]
            )
        ],
    )

    def __str__(self):
        return f"{self.subject.subject_code} - {self.lecture_id} - {self.lecture_title}"

    def delete(self, *args, **kwargs):
        # Store the file path
        file_path = self.lecture_file.path
        # Delete the model instance first
        super().delete(*args, **kwargs)
        # Then delete the file if it exists
        if os.path.isfile(file_path):
            os.remove(file_path)

    class Meta:
        verbose_name = "Lecture Material"
        verbose_name_plural = "Lecture Materials"
        ordering = ["lecture_id"]


class Tasks(models.Model):
    task_id = models.CharField(max_length=20)
    task_title = models.CharField(max_length=50)
    task_description = models.TextField()
    task_deadline = models.DateField()
    subject = models.ForeignKey("Faculty.Subjects", on_delete=models.CASCADE)

    def __str__(self):
        return f"{self.subject.subject_code} - {self.task_id}"

    class Meta:
        verbose_name = "Task"
        verbose_name_plural = "Tasks"
        ordering = ["task_id"]
