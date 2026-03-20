# 🐍 Ejercicios Python — Curso de Programación

> **Autor:** Carlos Vico  
> **Fecha:** 2025  
> **Asignatura:** Programación en Python  

---

## 📋 Índice

- [Descripción general](#descripción-general)
- [Estructura del proyecto](#estructura-del-proyecto)
- [Requisitos](#requisitos)
- [Cómo ejecutar](#cómo-ejecutar)
- [Unidad 2 — Algoritmos](#unidad-2--desarrollo-de-algoritmos-en-python)
- [Unidad 3 — Estructuras de control](#unidad-3--estructuras-de-control)
- [Unidad 4 — Estructuras de datos](#unidad-4--estructuras-de-datos)
- [Unidad 5 — POO y bases de datos](#unidad-5--poo-y-bases-de-datos)
- [Convenciones de código](#convenciones-de-código)

---

## Descripción general

Repositorio de tareas individuales del curso de Python, organizado por unidades temáticas. Cada archivo es autoejectable e independiente. El código sigue principios de **Clean Code**, **SOLID** y documentación estricta con **pydoc/docstrings**.

---

## Estructura del proyecto

```
📦 ejercicios-python/
├── 📄 README.md
├── 📄 unidad2_algoritmos.py
├── 📄 unidad3_estructuras_control.py
├── 📄 unidad4_estructuras_datos.py
└── 📄 unidad5_poo_bases_datos.py
    └── 🗄️  tienda.db              ← generado automáticamente al ejecutar la Unidad 5
```

---

## Requisitos

- **Python** 3.10 o superior (se usa `float | None` como tipo de retorno unión)
- **SQLite3** — incluido en la librería estándar de Python, no requiere instalación
- Sin dependencias externas

Comprueba tu versión:

```bash
python --version
```

---

## Cómo ejecutar

Cada archivo se ejecuta de forma independiente:

```bash
python unidad2_algoritmos.py
python unidad3_estructuras_control.py
python unidad4_estructuras_datos.py
python unidad5_poo_bases_datos.py
```

> **Nota:** La Unidad 3 y la Unidad 2 solicitan entrada por teclado en algunos ejercicios. Las unidades 4 y 5 son completamente automáticas.

---

## Unidad 2 — Desarrollo de algoritmos en Python

**Archivo:** `unidad2_algoritmos.py`  
**Tarea:** OPT2

### Ejercicios

| # | Descripción | Entrada | Salida |
|---|-------------|---------|--------|
| 1 | Diagrama de flujo (representado en comentario ASCII) | — | Diagrama en comentario |
| 2 | Programa par/impar con validación de entrada | Número entero por teclado | "par" o "impar" |
| 3 | Tabla de pruebas con 5 casos documentados | — | Tabla con ✔/✘ |

### Funciones principales

```python
solicitar_numero_entero() -> int
determinar_paridad(numero: int) -> str
mostrar_resultado_paridad(numero: int, paridad: str) -> None
ejecutar_pruebas_paridad() -> None
```

### Ejemplo de salida

```
==================================================
  EJERCICIO 2 - Par o Impar
==================================================
Introduce un número entero: 7

  → El número 7 es impar.

Número       Esperado     Obtenido     ¿Coincide?
--------------------------------------------------
4            par          par          ✔
7            impar        impar        ✔
-2           par          par          ✔
0            par          par          ✔
-5           impar        impar        ✔
```

---

## Unidad 3 — Estructuras de control

**Archivo:** `unidad3_estructuras_control.py`  
**Tarea:** OPT3

### Ejercicios

| # | Descripción | Estructuras usadas |
|---|-------------|-------------------|
| 1 | Mayor de tres números | `if / elif / else` |
| 2 | Números del 1 al N | `for`, validación de positivos |
| 3 | Calculadora básica (+, -, *, /) | `if / elif`, validación de operador |
| 4 | Código con errores corregido (área rectángulo) | `try / except`, `float()` |
| 5 | Benchmark: bucle `for` vs `sum()` del 1 al 1.000.000 | `for`, `time.time()` |

### Funciones principales

```python
solicitar_entero(mensaje: str) -> int
encontrar_mayor(a: int, b: int, c: int) -> int
mostrar_positivos_hasta(limite: int) -> None
calcular(a: float, b: float, operacion: str) -> float | None
area_rectangulo(base: float, altura: float) -> float        # versión corregida
suma_con_bucle(limite: int) -> int
suma_con_builtin(limite: int) -> int
medir_tiempo(funcion, *args) -> tuple
```

### Correcciones del Ejercicio 4

El código original tenía los siguientes errores:

1. `base ** altura` → debía ser `base * altura` (potencia en lugar de multiplicación)
2. `return area` fuera de la función (indentación incorrecta)
3. `input()` sin conversión a `float` → `TypeError` al operar
4. Cadena del `print` con concatenación rota
5. Sin validación de valores negativos o cero

### Ejemplo de salida — Ejercicio 5

```
  Método               Resultado            Tiempo (s)
  -------------------------------------------------------
  Bucle for            500000500000         0.068432
  sum(range(...))      500000500000         0.012105

  → sum() es aprox. 5.6x más rápido que el bucle for.
```

---

## Unidad 4 — Estructuras de datos

**Archivo:** `unidad4_estructuras_datos.py`  
**Tarea:** OPT4

### Ejercicios

| # | Descripción | Estructura usada |
|---|-------------|-----------------|
| 1 | Crear lista, mostrar completa, primero/último, `append()` | `list` |
| 2 | Ordenar alfabéticamente con `sorted()`, eliminar elemento | `list` |
| 3 | Diccionario de stock: total y filtro por mínimo | `dict` |
| 4 | Convertir lista a tupla, comparativa y demo de inmutabilidad | `tuple` |
| 5 | Diccionario anidado de almacén con precio, stock y valor total | `dict` anidado |

### Funciones principales

```python
crear_lista_productos() -> list
aniadir_producto(productos: list, nuevo_producto: str) -> list
ordenar_lista_alfabeticamente(productos: list) -> list
eliminar_producto(productos: list, producto: str) -> list
crear_diccionario_stock(productos: list) -> dict
calcular_total_productos(stock: dict) -> int
productos_con_stock_minimo(stock: dict, minimo: int) -> list
crear_tupla_productos(productos: list) -> tuple
crear_almacen() -> dict
calcular_valor_total_almacen(almacen: dict) -> float
```

### Comparativa Lista vs Tupla

| Característica | Lista | Tupla |
|----------------|-------|-------|
| ¿Mutable? | Sí | No |
| Añadir elementos | `lista.append()` | No permitido |
| Uso recomendado | Datos variables | Datos fijos/constantes |
| Rendimiento | Menor | Mayor (en memoria) |

### Flujo de datos entre ejercicios

```
Ejercicio 1 → crea lista productos
     ↓
Ejercicio 2 → ordena y elimina de esa lista
     ↓
Ejercicio 3 → crea diccionario stock desde la lista
     ↓
Ejercicio 4 → convierte la lista en tupla
```

---

## Unidad 5 — POO y bases de datos

**Archivo:** `unidad5_poo_bases_datos.py`  
**Tarea:** OPT5  
**BD generada:** `tienda.db` (SQLite3, se crea automáticamente)

### Ejercicios

| # | Descripción | Concepto POO |
|---|-------------|--------------|
| 1 | Clase `Producto` con constructor y `mostrar_info()` | Clases y objetos |
| 2 | `ProductoConPrecioPrivado` con `@property` y setter | Encapsulamiento |
| 3 | `ProductoAlimenticio` hereda de `ProductoConPrecioPrivado` + caducidad | Herencia |
| 4 | Conexión a SQLite3, creación de tabla `productos` (IF NOT EXISTS) | Persistencia |
| 5 | Clase `GestorBD` con `insertar_producto()` y `mostrar_todos_los_productos()` | CRUD + SRP |

### Jerarquía de clases

```
Producto
└── ProductoConPrecioPrivado    (precio privado con @property)
    └── ProductoAlimenticio     (+ fecha_caducidad, esta_caducado())

GestorBD                        (gestión CRUD independiente de Producto)
```

### Esquema de la base de datos

**Tabla:** `productos`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| `id` | `INTEGER PRIMARY KEY` | Identificador autoincremental |
| `nombre` | `TEXT NOT NULL` | Nombre del producto |
| `precio` | `REAL` | Precio en euros |
| `tipo` | `TEXT` | Categoría (ej: "Alimenticio") |
| `fecha_caducidad` | `TEXT` | Fecha en formato ISO 8601 (`YYYY-MM-DD`) |

### Ejemplo de salida — Unidad 5

```
  ID    Nombre               Precio   Tipo            Caducidad
  -----------------------------------------------------------------
  1     Manzana              1.20€    Alimenticio     2026-06-30
  2     Leche                0.99€    Alimenticio     2026-02-15
  3     Yogur                0.80€    Alimenticio     2026-08-10
```

---

## Convenciones de código

| Elemento | Convención |
|----------|------------|
| Variables y funciones | `snake_case` |
| Clases | `PascalCase` |
| Constantes | `MAYUSCULAS_CON_GUION` |
| Documentación | Docstrings con Args, Returns, Raises, Example |
| Longitud de función | < 30 líneas |
| Manejo de errores | Centralizado, nunca `except: pass` |
| Separación de responsabilidades | Principio SRP (una función = una responsabilidad) |
| Consultas SQL | Parámetros `?` para evitar inyección SQL |

---

*Repositorio académico — Carlos Vico — 2025*