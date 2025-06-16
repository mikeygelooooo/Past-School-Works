from django.urls import path
from . import views

urlpatterns = [
    path('', views.home),
    path('<int:month>/', views.months, name='months_int'),
    path('<str:month>/', views.months, name='months_str'),
]