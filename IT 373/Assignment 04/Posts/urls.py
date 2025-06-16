from django.urls import path
from . import views

urlpatterns = [
    path("", views.home, name="home"),
    path("post/details/<str:slug>/", views.post_details, name="post_details"),
    path("post/new/", views.new_post, name="new_post"),
    path("post/edit/<str:slug>/", views.edit_post, name="edit_post"),
    path("post/delete/<str:slug>/", views.delete_post, name="delete_post"),
]
