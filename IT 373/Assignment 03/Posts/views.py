from django.shortcuts import render, get_object_or_404
from django.utils import timezone
from .models import Posts

# Create your views here.
def home(request):
    posts = Posts.objects.all().order_by('-date_posted')
    
    return render(request, 'home.html', {'posts' : posts})

def post_details(request, slug):
    post = get_object_or_404(Posts, slug=slug)

    return render(request, 'post_details.html', {'post' : post})