# web_django/urls.py
# Author: Carlos Vico

from django.contrib import admin
from django.urls import path, include

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', include('tienda.urls')),
]