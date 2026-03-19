# tienda/urls.py
# Author: Carlos Vico

from django.urls import path
from . import views

# Rutas propias de la app tienda
urlpatterns = [
    # Ejercicios 3, 4, 5 — Vistas básicas
    path('inicio', views.inicio, name='inicio'),
    path('saludo/<str:nombre>', views.saludo, name='saludo'),
    path('suma/<int:num1>/<int:num2>', views.suma, name='suma'),

    # Ejercicios 6, 7, 8 — Templates
    path('inicio-template', views.inicio_template, name='inicio_template'),
    path('saludo-template', views.saludo_template, name='saludo_template'),
    path('frutas', views.frutas_template, name='frutas_template'),

    # Ejercicios 11, 12, 13, 14 — Base de datos
    path('libros', views.lista_libros, name='lista_libros'),
    path('libro/<int:libro_id>', views.detalle_libro, name='detalle_libro'),
    path('libro/<int:libro_id>/actualizar', views.actualizar_precio, name='actualizar_precio'),
    path('libro/<int:libro_id>/eliminar', views.eliminar_libro, name='eliminar_libro'),


    # Ejercicio final — Películas
    path('peliculas', views.lista_peliculas, name='lista_peliculas'),
    path('pelicula/insertar', views.insertar_pelicula, name='insertar_pelicula'),
    path('pelicula/<int:pelicula_id>', views.detalle_pelicula, name='detalle_pelicula'),
    path('pelicula/<int:pelicula_id>/actualizar', views.actualizar_pelicula, name='actualizar_pelicula'),
    path('pelicula/<int:pelicula_id>/eliminar', views.eliminar_pelicula, name='eliminar_pelicula'),
]