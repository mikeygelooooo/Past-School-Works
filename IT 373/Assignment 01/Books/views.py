from django.shortcuts import render
from django.http import HttpResponse
from django.template import loader
from Books.models import Book

# Create your views here.
def home(request):
    return HttpResponse("<h1>Home Page</h1>")

def list(request):
    list_of_books = Book.objects.all().values()
    template = loader.get_template('list.html')
    context = {
        'list_of_books': list_of_books
    }
    return HttpResponse(template.render(context, request))

def index(request):
    return HttpResponse("<h1>Index Page</h1>")

def about(request):
    return HttpResponse("<h1>About Page</h1>")