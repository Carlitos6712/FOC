# tienda/models.py
# Author: Carlos Vico

from django.db import models


class Libro(models.Model):
    """
    Modelo que representa un libro en la tienda.
    Ejercicio 9.
    """
    titulo = models.CharField(max_length=200)
    autor = models.CharField(max_length=200)
    precio = models.DecimalField(max_digits=6, decimal_places=2)

    def __str__(self):
        return f"{self.titulo} - {self.autor} - {self.precio}€"
    
class Pelicula(models.Model):
    """
    Modelo que representa una película.
    Ejercicio final.
    """
    titulo = models.CharField(max_length=200)
    director = models.CharField(max_length=200)
    anio = models.IntegerField()

    def __str__(self):
        return f"{self.titulo} - {self.director} - {self.anio}"