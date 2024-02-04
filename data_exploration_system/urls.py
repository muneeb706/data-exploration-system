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
)

urlpatterns = [
    path("admin/", admin.site.urls),
    path("login/", login_view, name="login"),
    path("dashboard/", dashboard_view, name="dashboard"),
    path("logout/", auth_views.LogoutView.as_view(), name="logout"),
    path("entity_count/", entity_count, name="entity_count"),
    path("element_list/", element_list, name="element_list"),
    path(
        "element_timeline_data/", elemenet_timeline_data, name="element_timeline_data"
    ),
]

if settings.DEBUG:
    # Serve static files from development server
    urlpatterns += static(settings.STATIC_URL, document_root=settings.STATIC_ROOT)
