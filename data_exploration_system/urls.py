"""
URL configuration for data_exploration_system project.
"""
from django.conf import settings
from django.conf.urls.static import static
from django.contrib import admin
from django.contrib.auth import views as auth_views

from django.urls import path

from core.views import dashboard_view, login_view

urlpatterns = [
    path("admin/", admin.site.urls),
    path("login/", login_view, name="login"),
    path("dashboard/", dashboard_view, name="dashboard"),
    path('logout/', auth_views.LogoutView.as_view(), name='logout'),
]

if settings.DEBUG:
    # Serve static files from development server
    urlpatterns += static(settings.STATIC_URL, document_root=settings.STATIC_ROOT)
