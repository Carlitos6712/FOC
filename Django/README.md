# Django - Proyecto Web

**Autor:** Carlos Vico  
**Versión Django:** 5.2.12  
**Python:** 3.11  
**Entorno:** venv  
**SO:** Windows  

---

## Índice

1. [Instalación](#instalación)
2. [Estructura del proyecto](#estructura-del-proyecto)
3. [Ejercicio 1 - Crear proyecto](#ejercicio-1---crear-proyecto)
4. [Ejercicio 2 - Crear app](#ejercicio-2---crear-app-tienda)
5. [Ejercicio 3 - Primera vista](#ejercicio-3---primera-vista)
6. [Ejercicio 4 - Vista con parámetro](#ejercicio-4---vista-con-parámetro)
7. [Ejercicio 5 - Vista con cálculo](#ejercicio-5---vista-con-cálculo)
8. [Ejercicio 6 - Primer template](#ejercicio-6---primer-template)
9. [Ejercicio 7 - Pasar datos al template](#ejercicio-7---pasar-datos-al-template)
10. [Ejercicio 8 - Mostrar lista](#ejercicio-8---mostrar-lista)
11. [Ejercicio 9 - Crear modelo](#ejercicio-9---crear-modelo)
12. [Ejercicio 10 - Panel de administración](#ejercicio-10---panel-de-administración)
13. [Ejercicio 11 - Mostrar datos](#ejercicio-11---mostrar-datos)
14. [Ejercicio 12 - Mostrar por ID](#ejercicio-12---mostrar-libro-por-id)
15. [Ejercicio 13 - Actualizar datos](#ejercicio-13---actualizar-datos)
16. [Ejercicio 14 - Eliminar datos](#ejercicio-14---eliminar-datos)
17. [Ejercicio Final - Gestión de películas](#ejercicio-final---gestión-de-películas)
18. [Resumen de rutas](#resumen-de-rutas)

---

## Instalación

### 1. Verificar Python

```bash
python --version
# Python 3.11.x

pip --version
```

### 2. Crear el entorno virtual

```bash
mkdir web_django
cd web_django

python -m venv venv
```

### 3. Activar el entorno virtual

```bash
# PowerShell
venv\Scripts\Activate.ps1

# CMD
venv\Scripts\activate.bat
```

> Si PowerShell devuelve error de permisos:
> ```bash
> Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
> ```

El prompt mostrará `(venv)` cuando esté activo.

### 4. Instalar Django

```bash
pip install django

django-admin --version
# 5.2.12
```

### 5. Guardar dependencias

```bash
pip freeze > requirements.txt
```

Para instalar en otro entorno:

```bash
pip install -r requirements.txt
```

---

## Estructura del proyecto

```
web_django/
├── venv/
├── web_django/
│   ├── __init__.py
│   ├── settings.py
│   ├── urls.py
│   ├── asgi.py
│   └── wsgi.py
├── tienda/
│   ├── templates/
│   │   ├── inicio.html
│   │   ├── saludo.html
│   │   ├── frutas.html
│   │   ├── libros.html
│   │   ├── detalle_libro.html
│   │   ├── peliculas.html
│   │   └── detalle_pelicula.html
│   ├── __init__.py
│   ├── admin.py
│   ├── apps.py
│   ├── models.py
│   ├── urls.py
│   └── views.py
├── manage.py
└── requirements.txt
```

---

## Ejercicio 1 - Crear proyecto

```bash
django-admin startproject web_django .

python manage.py migrate

python manage.py runserver
```

Acceder a `http://127.0.0.1:8000` para verificar que el servidor funciona.

> ⚠️ El punto final `.` en el comando evita crear una carpeta anidada innecesaria.

---

## Ejercicio 2 - Crear app `tienda`

```bash
python manage.py startapp tienda
```

Registrar la app en `web_django/settings.py`:

```python
INSTALLED_APPS = [
    ...
    'tienda',  # App registrada
]
```

Configurar la ruta de templates en `web_django/settings.py`:

```python
TEMPLATES = [
    {
        ...
        'DIRS': [BASE_DIR / 'tienda' / 'templates'],
        ...
    }
]
```

Conectar las rutas de la app en `web_django/urls.py`:

```python
from django.contrib import admin
from django.urls import path, include

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', include('tienda.urls')),
]
```

---

## Ejercicio 3 - Primera vista

**`tienda/views.py`**

```python
from django.http import HttpResponse

def inicio(request):
    """Vista simple con mensaje de bienvenida."""
    return HttpResponse("Bienvenido a mi primera aplicación Django")
```

**`tienda/urls.py`**

```python
from django.urls import path
from . import views

urlpatterns = [
    path('inicio', views.inicio, name='inicio'),
]
```

**Resultado en** `http://127.0.0.1:8000/inicio`:
```
Bienvenido a mi primera aplicación Django
```

---

## Ejercicio 4 - Vista con parámetro

**`tienda/views.py`**

```python
def saludo(request, nombre):
    """Saludo personalizado recibiendo nombre por URL."""
    return HttpResponse(f"Hola {nombre}, bienvenido a Django")
```

**`tienda/urls.py`**

```python
path('saludo/<str:nombre>', views.saludo, name='saludo'),
```

**Resultado en** `http://127.0.0.1:8000/saludo/Ana`:
```
Hola Ana, bienvenido a Django
```

---

## Ejercicio 5 - Vista con cálculo

**`tienda/views.py`**

```python
def suma(request, num1, num2):
    """
    Suma de dos números recibidos por URL.
    Django convierte automáticamente los parámetros a int gracias al tipo <int:>.
    """
    return HttpResponse(f"La suma es {num1 + num2}")
```

**`tienda/urls.py`**

```python
path('suma/<int:num1>/<int:num2>', views.suma, name='suma'),
```

**Resultado en** `http://127.0.0.1:8000/suma/5/8`:
```
La suma es 13
```

---

## Ejercicio 6 - Primer template

**`tienda/templates/inicio.html`**

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
</head>
<body>
    <p>Bienvenido a la aplicación Django</p>
</body>
</html>
```

**`tienda/views.py`**

```python
from django.shortcuts import render

def inicio_template(request):
    """Carga el template inicio.html."""
    return render(request, 'inicio.html')
```

**`tienda/urls.py`**

```python
path('inicio-template', views.inicio_template, name='inicio_template'),
```

---

## Ejercicio 7 - Pasar datos al template

**`tienda/views.py`**

```python
def saludo_template(request):
    """Pasa la variable nombre al template."""
    return render(request, 'saludo.html', {'nombre': 'Carlos'})
```

**`tienda/templates/saludo.html`**

```html
<body>
    <p>Hola {{ nombre }}</p>
</body>
```

**Resultado en** `http://127.0.0.1:8000/saludo-template`:
```
Hola Carlos
```

---

## Ejercicio 8 - Mostrar lista

**`tienda/views.py`**

```python
def frutas_template(request):
    """Pasa una lista de frutas al template."""
    return render(request, 'frutas.html', {
        'frutas': ['manzana', 'pera', 'plátano', 'naranja']
    })
```

**`tienda/templates/frutas.html`**

```html
<body>
    {% for fruta in frutas %}
        <p>{{ fruta }}</p>
    {% endfor %}
</body>
```

**Resultado en** `http://127.0.0.1:8000/frutas`:
```
manzana
pera
plátano
naranja
```

---

## Ejercicio 9 - Crear modelo

**`tienda/models.py`**

```python
from django.db import models

class Libro(models.Model):
    """Modelo que representa un libro en la tienda."""
    titulo = models.CharField(max_length=200)
    autor = models.CharField(max_length=200)
    precio = models.DecimalField(max_digits=6, decimal_places=2)

    def __str__(self):
        return f"{self.titulo} - {self.autor} - {self.precio}€"
```

Ejecutar migraciones:

```bash
python manage.py makemigrations
python manage.py migrate
```

---

## Ejercicio 10 - Panel de administración

**`tienda/admin.py`**

```python
from django.contrib import admin
from .models import Libro

admin.site.register(Libro)
```

Crear superusuario:

```bash
python manage.py createsuperuser
```

Acceder a `http://127.0.0.1:8000/admin` e insertar al menos 3 libros.

---

## Ejercicio 11 - Mostrar datos

**`tienda/views.py`**

```python
def lista_libros(request):
    """Muestra todos los libros. Usa all() para evitar consultas N+1."""
    return render(request, 'libros.html', {'libros': Libro.objects.all()})
```

**`tienda/templates/libros.html`**

```html
{% for libro in libros %}
    <p>{{ libro.titulo }} - {{ libro.autor }} - {{ libro.precio }}€</p>
{% endfor %}
```

**Resultado en** `http://127.0.0.1:8000/libros`:
```
El Quijote - Cervantes - 20€
```

---

## Ejercicio 12 - Mostrar libro por ID

**`tienda/views.py`**

```python
from django.shortcuts import get_object_or_404

def detalle_libro(request, libro_id):
    """
    Muestra un libro por ID.
    get_object_or_404 devuelve 404 si no existe, evitando errores no controlados.
    """
    libro = get_object_or_404(Libro, id=libro_id)
    return render(request, 'detalle_libro.html', {'libro': libro})
```

**`tienda/urls.py`**

```python
path('libro/<int:libro_id>', views.detalle_libro, name='detalle_libro'),
```

**Resultado en** `http://127.0.0.1:8000/libro/1`.

---

## Ejercicio 13 - Actualizar datos

**`tienda/views.py`**

```python
def actualizar_precio(request, libro_id):
    """Actualiza el precio del libro a 25€."""
    libro = get_object_or_404(Libro, id=libro_id)
    libro.precio = 25
    libro.save()
    return HttpResponse(f"Precio de '{libro.titulo}' actualizado a 25€")
```

**`tienda/urls.py`**

```python
path('libro/<int:libro_id>/actualizar', views.actualizar_precio, name='actualizar_precio'),
```

---

## Ejercicio 14 - Eliminar datos

**`tienda/views.py`**

```python
def eliminar_libro(request, libro_id):
    """Elimina el libro por ID."""
    libro = get_object_or_404(Libro, id=libro_id)
    titulo = libro.titulo
    libro.delete()
    return HttpResponse(f"Libro '{titulo}' eliminado correctamente")
```

**`tienda/urls.py`**

```python
path('libro/<int:libro_id>/eliminar', views.eliminar_libro, name='eliminar_libro'),
```

---

## Ejercicio Final - Gestión de películas

### Modelo

**`tienda/models.py`**

```python
class Pelicula(models.Model):
    """Modelo que representa una película."""
    titulo = models.CharField(max_length=200)
    director = models.CharField(max_length=200)
    anio = models.IntegerField()

    def __str__(self):
        return f"{self.titulo} - {self.director} - {self.anio}"
```

```bash
python manage.py makemigrations
python manage.py migrate
```

### Registrar en admin

**`tienda/admin.py`**

```python
from .models import Libro, Pelicula

admin.site.register(Pelicula)
```

### Vistas

**`tienda/views.py`**

```python
def insertar_pelicula(request):
    """Inserta una película de ejemplo."""
    pelicula = Pelicula.objects.create(
        titulo="Inception",
        director="Christopher Nolan",
        anio=2010
    )
    return HttpResponse(f"Película '{pelicula.titulo}' insertada con ID {pelicula.id}")

def lista_peliculas(request):
    """Muestra todas las películas."""
    return render(request, 'peliculas.html', {'peliculas': Pelicula.objects.all()})

def detalle_pelicula(request, pelicula_id):
    """Muestra una película por ID."""
    pelicula = get_object_or_404(Pelicula, id=pelicula_id)
    return render(request, 'detalle_pelicula.html', {'pelicula': pelicula})

def actualizar_pelicula(request, pelicula_id):
    """Actualiza el título de una película por ID."""
    pelicula = get_object_or_404(Pelicula, id=pelicula_id)
    pelicula.titulo = "Título Actualizado"
    pelicula.save()
    return HttpResponse(f"Película {pelicula_id} actualizada a '{pelicula.titulo}'")

def eliminar_pelicula(request, pelicula_id):
    """Elimina una película por ID."""
    pelicula = get_object_or_404(Pelicula, id=pelicula_id)
    titulo = pelicula.titulo
    pelicula.delete()
    return HttpResponse(f"Película '{titulo}' eliminada correctamente")
```

### Rutas

**`tienda/urls.py`**

```python
path('peliculas', views.lista_peliculas, name='lista_peliculas'),
path('pelicula/insertar', views.insertar_pelicula, name='insertar_pelicula'),
path('pelicula/<int:pelicula_id>', views.detalle_pelicula, name='detalle_pelicula'),
path('pelicula/<int:pelicula_id>/actualizar', views.actualizar_pelicula, name='actualizar_pelicula'),
path('pelicula/<int:pelicula_id>/eliminar', views.eliminar_pelicula, name='eliminar_pelicula'),
```

---

## Resumen de rutas

| URL | Acción | Ejercicio |
|-----|--------|-----------|
| `/inicio` | Mensaje de bienvenida | 3 |
| `/saludo/Ana` | Saludo personalizado | 4 |
| `/suma/5/8` | Suma de dos números | 5 |
| `/inicio-template` | Template de bienvenida | 6 |
| `/saludo-template` | Template con variable | 7 |
| `/frutas` | Template con lista | 8 |
| `/libros` | Lista todos los libros | 11 |
| `/libro/1` | Detalle de libro por ID | 12 |
| `/libro/1/actualizar` | Actualiza precio a 25€ | 13 |
| `/libro/1/eliminar` | Elimina libro | 14 |
| `/peliculas` | Lista todas las películas | Final |
| `/pelicula/insertar` | Inserta película de ejemplo | Final |
| `/pelicula/1` | Detalle de película por ID | Final |
| `/pelicula/1/actualizar` | Actualiza título | Final |
| `/pelicula/1/eliminar` | Elimina película | Final |
| `/admin` | Panel de administración | 10 |