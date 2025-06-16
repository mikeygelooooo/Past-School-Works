from django.db import models
from django.utils.text import slugify

# Create your models here.
class Categories(models.Model):
    category_name = models.CharField(max_length=255)

    def __str__(self):
        return self.category_name

class Posts(models.Model):
    category = models.ForeignKey(Categories, related_name='posts', on_delete=models.CASCADE)

    author = models.CharField(max_length=100)
    title = models.CharField(max_length=255)
    slug = models.SlugField(max_length=255, unique=True)
    intro = models.TextField()
    content = models.TextField()
    reading_time = models.IntegerField()
    date_posted = models.DateTimeField(auto_now_add=True)

    class Meta():
        ordering = ('-date_posted', )

    def __str__(self):
        return self.title
    
    def save(self, *args, **kwargs):
        self.slug = slugify(self.title)
        self.reading_time = len(self.content.split()) / 50

        return super().save(*args, **kwargs)
    
class Comments(models.Model):
    post = models.ForeignKey(Posts, on_delete=models.CASCADE, related_name='comments')
    name = models.CharField(max_length=100)
    content = models.TextField()
    date_commented = models.DateTimeField(auto_now_add=True)

    class Meta():
        ordering = ('-date_commented', )

    def __str__(self):
        return self.content