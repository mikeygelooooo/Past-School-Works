from django.shortcuts import render, get_object_or_404, redirect
from .models import Posts
from .forms import CreatePost, CommentForm

# Create your views here.
def home(request):
    posts = Posts.objects.all()
    
    return render(request, 'home.html', {'posts' : posts})

def post_details(request, slug):
    post = get_object_or_404(Posts, slug=slug)

    if request.method == 'POST':
        form = CommentForm(request.POST)

        if form.is_valid():
            comment = form.save(commit=False)
            comment.post = post
            comment.save()
            
            return redirect('post_details', slug=post.slug)
    else:
        form = CommentForm()

    return render(request, 'post_details.html', {'post': post, 'form': form})

def new_post(request):
    if request.method == 'POST':
        form = CreatePost(request.POST)
        if form.is_valid():
            post = form.save()
            return redirect('post_details', slug=post.slug)
    else:
        form = CreatePost()
    
    return render(request, 'new_post.html', {'form': form})

def edit_post(request, slug):
    post = get_object_or_404(Posts, slug=slug)
    
    if request.method == 'POST':
        form = CreatePost(request.POST, instance=post)
        if form.is_valid():
            post = form.save()
            return redirect('post_details', slug=post.slug)
    else:
        form = CreatePost(instance=post)
    
    return render(request, 'edit_post.html', {'form': form, 'post': post})

def delete_post(request, slug):
    post = get_object_or_404(Posts, slug=slug)
    
    if request.method == 'POST':
        post.delete()
        return redirect('home')
    
    return redirect('post_details', slug=slug)