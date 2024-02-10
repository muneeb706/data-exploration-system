"""
URL configuration for data_exploration_system project.
"""
from django.conf import settings
from django.conf.urls.static import static
from django.contrib import admin
from django.contrib.auth import views as auth_views

from django.urls import path

from core.views import (
    dashboard_view,
    login_view,
    entity_count,
    element_list,
    elemenet_timeline_data,
    data_explorer_view,
    data_downloader_view,
    table_list,
    query_list,
    table_data_view,
    query_data_view,
    create_test_user_view,
)

urlpatterns = [
    path("admin/", admin.site.urls),
    path("login/", login_view, name="login"),
    path("dashboard/", dashboard_view, name="dashboard"),
    path("data_explorer/", data_explorer_view, name="data_explorer"),
    path("data_downloader/", data_downloader_view, name="data_downloader"),
    path("logout/", auth_views.LogoutView.as_view(), name="logout"),
    path("entity_count/", entity_count, name="entity_count"),
    path("element_list/", element_list, name="element_list"),
    path(
        "element_timeline_data/", elemenet_timeline_data, name="element_timeline_data"
    ),
    path("table_list/", table_list, name="table_list"),
    path("query_list/", query_list, name="query_list"),
    path("table_data/", table_data_view, name="table_data"),
    path("query_data/", query_data_view, name="query_data"),
    path("create_test_user/", create_test_user_view, name="create_test_user"),
]

if settings.DEBUG:
    # Serve static files from development server
    urlpatterns += static(settings.STATIC_URL, document_root=settings.STATIC_ROOT)
