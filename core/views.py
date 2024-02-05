import json
import math
import random
import csv
from urllib.parse import unquote

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


# Page Rendering Views
@login_required
def dashboard_view(request):
    return render(request, "dashboard.html")


@login_required
def data_explorer_view(request):
    return render(request, "data_explorer.html")


# Dashboard Views
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
    element = request.GET.get("elementCode", None)
    year_from = request.GET.get("yearFrom", None)
    year_to = request.GET.get("yearTo", None)

    data = {}

    if element and year_from and year_to:
        for year in range(int(year_from), int(year_to) + 1):
            data[str(year)] = random.randint(
                1, 100
            )  # Generate a random value for each year

    return JsonResponse({"data": data})


# Data Explorer Views


def table_list(request):
    tables = ["Table1", "Table2", "Table3", "Table4"]
    return JsonResponse({"data": tables})


def query_list(request):
    queries = ["Query1", "Query2", "Query3", "Query4"]
    return JsonResponse({"data": queries})


def table_data_view(request):
    return JsonResponse(data_explorer_demo_data(request, "table"))


def query_data_view(request):
    return JsonResponse(data_explorer_demo_data(request, "query"))


def data_explorer_demo_data(request, data_type):
    data_source = request.GET.get("dataSource", None)
    page = int(request.GET.get("page", 1))
    size = int(request.GET.get("size", 100))
    filters = []
    i = 0
    while True:
        field = request.GET.get(f"filters[{i}][field]")
        type = request.GET.get(f"filters[{i}][type]")
        value = request.GET.get(f"filters[{i}][value]")
        if field is None or type is None or value is None:
            break
        filters.append({"field": field, "type": type, "value": value})
        i += 1

    filtered_data = []
    paginated_data = []
    total_records = 0

    if data_source:
        file_path = f"core/static/core/data/data_explorer_demo_data.csv"
        with open(file_path, "r") as file:
            reader = csv.DictReader(file)
            for i, row in enumerate(reader):
                passes_filters = True
                if filters:
                    for filter in filters:
                        field = filter["field"]
                        type = filter["type"]
                        value = filter["value"]
                        if type == "like" and value.lower() not in row[field].lower():
                            passes_filters = False
                            break
                if passes_filters:
                    total_records += 1
                    filtered_data.append(dict(row))
        
        for i, row in enumerate(filtered_data):
            if i >= (page - 1) * size and i < page * size:
                paginated_data.append(dict(row))

    total_pages = math.ceil(total_records / size)

    return {
        "type": data_type,
        "name": data_source,
        "data": paginated_data,
        "totalRecordsInDB": total_records,
        "last_page": total_pages,
        "numericCols": ["id", "age"],
        "dropdownCols": {
            "profession": [
                "doctor",
                "police officer",
                "firefighter",
                "worker",
                "developer",
            ]
        },
    }
