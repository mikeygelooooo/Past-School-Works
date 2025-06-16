from django import forms
from .models import Posts, Categories, Comments


class CreatePost(forms.ModelForm):
    category = forms.ModelChoiceField(
        queryset=Categories.objects.all(),
        widget=forms.Select(attrs={"class": "form-select mb-3"}),
    )

    author = forms.CharField(
        widget=forms.TextInput(
            attrs={"class": "form-control mb-3", "placeholder": "Enter author name"}
        )
    )

    title = forms.CharField(
        widget=forms.TextInput(
            attrs={"class": "form-control mb-3", "placeholder": "Enter title"}
        )
    )

    intro = forms.CharField(
        widget=forms.Textarea(
            attrs={
                "class": "form-control mb-3",
                "rows": 3,
                "placeholder": "Enter introduction",
            }
        )
    )

    content = forms.CharField(
        widget=forms.Textarea(
            attrs={
                "class": "form-control mb-3",
                "rows": 10,
                "placeholder": "Enter post content",
            }
        )
    )

    class Meta:
        model = Posts
        fields = ["category", "author", "title", "intro", "content"]



class CommentForm(forms.ModelForm):
    name = forms.CharField(
        widget=forms.TextInput(
            attrs={
                "class": "form-control mb-3",
                "placeholder": "Enter your name",
            }
        )
    )
    content = forms.CharField(
        widget=forms.Textarea(
            attrs={
                "class": "form-control mb-3",
                "rows": 5,
                "placeholder": "Enter your comment",
            }
        )
    )

    class Meta:
        model = Comments
        fields = ["name", "content"]