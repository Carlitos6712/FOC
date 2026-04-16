# U6 — Generadores, iteradores y cierres

**Archivo:** `OPT06_Carlos-Vico.py`  
**Autor:** Carlos Vico  
**Python:** 3.x · sin dependencias externas

## Descripción

Actividad individual de la Unidad 6. Implementa dos **generadores** que producen "números de la suerte" usando la sentencia `yield`, sin construir listas en memoria.

## Conceptos clave

### Generador
Función que usa `yield` en lugar de `return`. Al llamarla no ejecuta el cuerpo; devuelve un objeto generador. Cada vez que el iterador pide un valor (`next()`), la ejecución reanuda justo donde se suspendió.

```python
def mi_generador():
    yield 1   # pausa aquí, devuelve 1
    yield 2   # pausa aquí, devuelve 2
```

**Ventaja principal:** coste de memoria O(1) — produce un valor a la vez, independientemente del tamaño del rango.

### `yield` vs `return`

| | `return` | `yield` |
|---|---|---|
| Finaliza la función | Sí | No (suspende) |
| Puede usarse varias veces | No (solo 1 valor) | Sí (uno por llamada) |
| Crea un objeto generador | No | Sí |
| Uso de memoria | Proporcional a la lista | O(1) |

## Funciones

### `numeros_suerte(limite)`

Genera todos los enteros del `1` al `limite` (inclusive).

```python
def numeros_suerte(limite):
    numero = 1
    while numero <= limite:
        yield numero
        numero += 1
```

| Parámetro | Tipo | Descripción |
|---|---|---|
| `limite` | `int` | Valor máximo de la secuencia (incluido) |

**Yields:** `int` — enteros consecutivos desde 1.

```python
>>> list(numeros_suerte(5))
[1, 2, 3, 4, 5]
```

---

### `numeros_suerte_pares(limite)`

Genera solo los enteros **pares** del `1` al `limite` (inclusive).

```python
def numeros_suerte_pares(limite):
    numero = 1
    while numero <= limite:
        if numero % 2 == 0:
            yield numero
        numero += 1
```

| Parámetro | Tipo | Descripción |
|---|---|---|
| `limite` | `int` | Valor máximo del rango de búsqueda (incluido) |

**Yields:** `int` — enteros pares comenzando en 2.

```python
>>> list(numeros_suerte_pares(10))
[2, 4, 6, 8, 10]

>>> list(numeros_suerte_pares(1))
[]
```

## Ejecución

```bash
python OPT06_Carlos-Vico.py
```

### Salida esperada (número de lista = 5)

```
========================================
  Numeros de la suerte (1 - 5)
========================================
  Numero de la suerte: 1
  Numero de la suerte: 2
  Numero de la suerte: 3
  Numero de la suerte: 4
  Numero de la suerte: 5

========================================
  Numeros de la suerte PARES (1 - 5)
========================================
  Numero par de la suerte: 2
  Numero par de la suerte: 4

Fin del programa.
```
