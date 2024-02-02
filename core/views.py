from django.contrib.auth import authenticate, login
from django.shortcuts import render, redirect
from .forms import AuthenticationForm, LoginForm


def login_view(request):
    if request.method == "POST":
        form = LoginForm(request, data=request.POST)
        if form.is_valid():
            user = form.get_user()
            login(request, user)
            return redirect("home")
    else:
        form = LoginForm()
    return render(request, "login.html", {"form": form})
