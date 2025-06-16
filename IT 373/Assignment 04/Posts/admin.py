from django.contrib import admin
from .models import Categories, Posts, Comments

# Register your models here.
admin.site.register(Categories)
admin.site.register(Posts)
admin.site.register(Comments)