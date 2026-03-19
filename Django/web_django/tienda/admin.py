# tienda/admin.py
# Author: Carlos Vico

from django.contrib import admin
from .models import Libro, Pelicula

# Ejercicio 10: Registrar modelo en el panel de administración
admin.site.register(Libro)

# Ejercicio final: Registrar modelo Pelicula
admin.site.register(Pelicula)
