import random

from django.contrib.auth import login
from django.contrib.auth.decorators import login_required
from django.http import JsonResponse
from django.shortcuts import redirect, render

from core.forms import LoginForm


def login_view(request):
    if request.method == "POST":
        form = LoginForm(request, data=request.POST)
        if form.is_valid():
            user = form.get_user()
            login(request, user)
            return redirect("dashboard")
    else:
        form = LoginForm()
    return render(request, "login.html", {"form": form})


@login_required
def dashboard_view(request):
    return render(request, "dashboard.html")


def entity_count(request):
    data_source = request.GET.get("dataSource", None)
    count = None

    if data_source in ["ENTITY1", "ENTITY2", "ENTITY3", "ENTITY4"]:
        count = random.randint(1, 100)  # Generate a random count

    return JsonResponse({"totalRecordsInDB": count})


def element_list(request):
    elements = [
        {"DESCRIPTION": "Element1"},
        {"DESCRIPTION": "Element2"},
        {"DESCRIPTION": "Element3"},
        {"DESCRIPTION": "Element4"},
    ]

    return JsonResponse({"data": elements})

def elemenet_timeline_data(request):
    element = request.GET.get('elementCode', None)
    year_from = request.GET.get('yearFrom', None)
    year_to = request.GET.get('yearTo', None)

    data = {}

    if element and year_from and year_to:
        for year in range(int(year_from), int(year_to) + 1):
            data[str(year)] = random.randint(1, 100)  # Generate a random value for each year

    return JsonResponse({'data': data})