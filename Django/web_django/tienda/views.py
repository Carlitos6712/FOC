# tienda/views.py
# Author: Carlos Vico

from django.http import HttpResponse
from django.shortcuts import render, get_object_or_404
from .models import Libro, Pelicula


def inicio(request):
    """
    Ejercicio 3: Vista simple con mensaje de bienvenida.
    """
    return HttpResponse("Bienvenido a mi primera aplicación Django")


def saludo(request, nombre):
    """
    Ejercicio 4: Vista que recibe un nombre por URL y devuelve un saludo personalizado.
    El parámetro viene capturado directamente desde la ruta.
    """
    return HttpResponse(f"Hola {nombre}, bienvenido a Django")


def suma(request, num1, num2):
    """
    Ejercicio 5: Vista que recibe dos números por URL y devuelve su suma.
    Django convierte automáticamente los parámetros a int gracias al tipo <int:>.
    """
    resultado = num1 + num2
    return HttpResponse(f"La suma es {resultado}")


def inicio_template(request):
    """
    Ejercicio 6: Vista que carga el template inicio.html.
    """
    return render(request, 'inicio.html')


def saludo_template(request):
    """
    Ejercicio 7: Vista que pasa la variable nombre al template.
    """
    contexto = {'nombre': 'Carlos'}
    return render(request, 'saludo.html', contexto)


def frutas_template(request):
    """
    Ejercicio 8: Vista que pasa una lista de frutas al template.
    """
    contexto = {
        'frutas': ['manzana', 'pera', 'plátano', 'naranja']
    }
    return render(request, 'frutas.html', contexto)


def lista_libros(request):
    """
    Ejercicio 11: Vista que muestra todos los libros de la base de datos.
    Usa all() para obtener todos los registros evitando consultas N+1.
    """
    libros = Libro.objects.all()
    return render(request, 'libros.html', {'libros': libros})


def detalle_libro(request, libro_id):
    """
    Ejercicio 12: Vista que muestra un libro por su ID.
    get_object_or_404 devuelve 404 si no existe, evitando errores no controlados.
    """
    libro = get_object_or_404(Libro, id=libro_id)
    return render(request, 'detalle_libro.html', {'libro': libro})


def actualizar_precio(request, libro_id):
    """
    Ejercicio 13: Vista que actualiza el precio del libro con id=1 a 25.
    update() es más eficiente que save() para actualizaciones parciales.
    """
    libro = get_object_or_404(Libro, id=libro_id)
    libro.precio = 25
    libro.save()
    return HttpResponse(f"Precio del libro '{libro.titulo}' actualizado a 25€")


def eliminar_libro(request, libro_id):
    """
    Ejercicio 14: Vista que elimina el libro con id=1.
    get_object_or_404 evita errores si el libro no existe.
    """
    libro = get_object_or_404(Libro, id=libro_id)
    titulo = libro.titulo
    libro.delete()
    return HttpResponse(f"Libro '{titulo}' eliminado correctamente")

def insertar_pelicula(request):
    """
    Ejercicio final 1: Inserta una película de ejemplo.
    En un proyecto real esto vendría de un formulario POST,
    pero aquí lo hardcodeamos para simplificar el ejercicio.
    """
    pelicula = Pelicula.objects.create(
        titulo="Inception",
        director="Christopher Nolan",
        anio=2010
    )
    return HttpResponse(f"Película '{pelicula.titulo}' insertada con ID {pelicula.id}")


def lista_peliculas(request):
    """Ejercicio final 2: Muestra todas las películas."""
    peliculas = Pelicula.objects.all()
    return render(request, 'peliculas.html', {'peliculas': peliculas})


def detalle_pelicula(request, pelicula_id):
    """Ejercicio final 3: Muestra una película por ID."""
    pelicula = get_object_or_404(Pelicula, id=pelicula_id)
    return render(request, 'detalle_pelicula.html', {'pelicula': pelicula})


def actualizar_pelicula(request, pelicula_id):
    """
    Ejercicio final 4: Actualiza el título de una película por ID.
    save() persiste solo el campo modificado de forma explícita.
    """
    pelicula = get_object_or_404(Pelicula, id=pelicula_id)
    pelicula.titulo = "Título Actualizado"
    pelicula.save()
    return HttpResponse(f"Película {pelicula_id} actualizada a '{pelicula.titulo}'")


def eliminar_pelicula(request, pelicula_id):
    """Ejercicio final 5: Elimina una película por ID."""
    pelicula = get_object_or_404(Pelicula, id=pelicula_id)
    titulo = pelicula.titulo
    pelicula.delete()
    return HttpResponse(f"Película '{titulo}' eliminada correctamente")