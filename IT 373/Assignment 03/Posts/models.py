from django.db import models
from django.conf import settings
from django.utils import timezone

# Create your models here.
class Categories(models.Model):
    category_name = models.CharField(max_length=255)

    def __str__(self):
        return self.category_name

class Posts(models.Model):
    author = models.ForeignKey(settings.AUTH_USER_MODEL, related_name='posts', on_delete=models.CASCADE)
    category = models.ForeignKey(Categories, related_name='posts', on_delete=models.CASCADE)

    title = models.CharField(max_length=255)
    slug = models.SlugField(max_length=255, unique=True)
    intro = models.TextField()
    content = models.TextField()
    reading_time = models.IntegerField()
    date_posted = models.DateField(auto_now_add=True)

    def __str__(self):
        return self.title