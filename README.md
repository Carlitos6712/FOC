# 🗂️ Repositorio de Ejercicios — Desarrollo Web

> Colección de ejercicios prácticos organizados por tecnología, cubriendo tanto el desarrollo en entorno cliente como en entorno servidor.

**Autor:** Carlos Vico  
**Ciclo:** Desarrollo de Aplicaciones Web (DAW)  
**Estándares aplicados:** Clean Code · SOLID · JSDoc / PHPDoc / PyDoc · JSON estándar `{success, data, message}`

---

## 📁 Estructura del repositorio

```
📦 repositorio/
├── 📂 API-REST/          → Reto: API REST de Libros con Node.js + Express
├── 📂 Django/            → Ejercicios con Django 5.2 (Python)
├── 📂 Ejercicios/
│   ├── 📂 JavaScript/    → Ejercicios DWEC (RA1–RA7)
│   ├── 📂 PHP/           → Ejercicios DWES (RA01–RA09)
│   └── 📂 Python/        → Ejercicios por unidades (U2–U5)
├── 📂 Laravel/           → Ejercicios con Laravel 12
├── 📂 Node.js/           → Ejercicios con Node.js + Express
├── 📂 Symfony/           → Ejercicios con Symfony 6.4 LTS
├── 📄 .gitignore
├── 📄 LICENSE
└── 📄 README.md
```

---

## 🧩 Módulos del repositorio

### 🐍 Python — Ejercicios por Unidades

**Ruta:** `Ejercicios/Python/`  
**Versión:** Python 3.10+ · SQLite3 (stdlib)

| Archivo | Unidad | Contenido |
|---|---|---|
| `unidad2_algoritmos.py` | U2 | Diagramas de flujo, par/impar, tabla de pruebas |
| `unidad3_estructuras_control.py` | U3 | `if/elif/else`, bucles, calculadora, benchmark |
| `unidad4_estructuras_datos.py` | U4 | Listas, diccionarios, tuplas, estructuras anidadas |
| `unidad5_poo_bases_datos.py` | U5 | POO (herencia, encapsulamiento), CRUD con SQLite3 |

**Convenciones:** `snake_case`, docstrings completos, funciones < 30 líneas, sin `except: pass`.

```bash
python unidad2_algoritmos.py
python unidad5_poo_bases_datos.py   # genera tienda.db automáticamente
```

---

### 🌐 JavaScript — DWEC (RA1–RA7)

**Ruta:** `Ejercicios/JavaScript/`  
**Módulo:** Desarrollo Web en Entorno Cliente

| Carpeta | Resultados de Aprendizaje | Contenido principal |
|---|---|---|
| `RA1/` | RA2_a–g | Variables, operadores, ámbitos, bucles, arrays |
| `RA2/` | RA4_a–j | OOP, clases, prototipos, `filter()`, `sort()` |
| `RA3/` | RA3_c–f | Objetos del navegador, ventanas emergentes, reloj digital |
| `RA5/` | RA5_d–h | Formulario con validación por expresiones regulares |
| `RA6/` | RA6_c–h | Manipulación del DOM, `createElement`, `addEventListener` |
| `RA7/` | RA7_c–i | AJAX: `XMLHttpRequest`, `fetch`, JSON, jQuery `$.get` |

```bash
# Archivos Node.js (RA1)
node RA1/lenguaje.js

# Resto: abrir con Live Server o servidor local
python -m http.server 8080
```

---

### 🐘 PHP — DWES (RA01–RA09)

**Ruta:** `Ejercicios/PHP/`  
**Módulo:** Desarrollo Web en Entorno Servidor  
**Entorno:** XAMPP (Apache + PHP 8.1+ + MySQL)

| Carpeta | Contenido |
|---|---|
| `RA01/` | `$_SERVER`, ficheros, PHP embebido en HTML |
| `RA02/` | Tipos, sintaxis, `$_POST`, tablas desde fichero |
| `RA03/` | Funciones, arrays, formularios, `htmlspecialchars()` |
| `RA04/` | Sesiones, cookies, autenticación por roles |
| `RA05/` | Patrón MVC con Front Controller y Template Inheritance |
| `RA06/` | PDO, prepared statements, FK `ON DELETE CASCADE` |
| `RA07/` | API REST + cliente web, JSON `{success, data, message}` |
| `RA08/` | AJAX con debounce, validación client-side + server-side |
| `RA09/` | Open Library API, índice general del módulo |

```bash
# Importar BD
mysql -u root < RA06/libros.sql

# Acceder al índice
# http://localhost/dwes/RA09/index.php
```

---

### 🟢 Node.js — Ejercicios progresivos

**Ruta:** `Node.js/`  
**Stack:** Node.js 18 LTS · Express 4.x

| Archivo | Contenido |
|---|---|
| `ejercicio1-app.js` | Primer programa, `console.log` |
| `ejercicio2-leer-archivo.js` | Módulo `fs`, lectura asíncrona |
| `ejercicio3-app.js` | Módulo propio (`operaciones.js`) |
| `ejercicio4-servidor.js` | Servidor HTTP nativo, puerto 3000 |
| `ejercicio5-rutas.js` | Rutas manuales con `http` |
| `ejercicios6al11-express.js` | Express: rutas, parámetros, POST |
| `peliculas-api.js` | API REST completa, CRUD en memoria |

```bash
npm install express
node peliculas-api.js
```

---

### 🔴 Laravel 12 — Ejercicios prácticos

**Ruta:** `Laravel/`  
**Stack:** Laravel 12 · PHP 8.2+ · MySQL

| Bloque | Ejercicios | Contenido |
|---|---|---|
| Rutas | 1–3 | Rutas simples y con parámetros |
| Controladores | 4–5 | `php artisan make:controller`, parámetros |
| Vistas Blade | 6–8 | Templates, variables, `@foreach` |
| Migraciones y Modelos | 9–10 | `make:migration`, `make:model`, `$fillable` |
| CRUD | 11–14 | Insertar, listar, actualizar, eliminar |
| Ejercicio Final | — | CRUD completo de Películas con `Route::resource` |

```bash
composer create-project laravel/laravel nombre-proyecto
php artisan migrate
php artisan serve
```

---

### 🟣 Symfony 6.4 LTS — Ejercicios

**Ruta:** `Symfony/`  
**Stack:** Symfony 6.4 · PHP 8.1+ · Doctrine ORM · Twig · MySQL 8

| Bloque | Ejercicios | Contenido |
|---|---|---|
| Rutas | 1–3 | `#[Route]`, parámetros dinámicos |
| Controladores | 4–5 | `AbstractController`, `Response` |
| Twig | 6–8 | Vistas, variables, bucle `for` |
| Doctrine | 9–14 | Entidades, migraciones, CRUD completo |
| Ejercicio Final | — | Gestión de Películas (CRUD completo) |

```bash
composer create-project symfony/skeleton:"6.4.*" mi_proyecto --no-audit
php bin/console doctrine:database:create
php bin/console make:migration && php bin/console doctrine:migrations:migrate
php -S localhost:8000 -t public/
```

---

### 🐍 Django 5.2 — Ejercicios

**Ruta:** `Django/`  
**Stack:** Django 5.2 · Python 3.11 · SQLite (por defecto) · venv

| Bloque | Ejercicios | Contenido |
|---|---|---|
| Proyecto y app | 1–2 | `startproject`, `startapp`, registro en `INSTALLED_APPS` |
| Vistas HTTP | 3–5 | `HttpResponse`, parámetros en URL, cálculos |
| Templates | 6–8 | `render()`, variables, `{% for %}` |
| Modelos | 9–10 | `models.Model`, `makemigrations`, panel admin |
| CRUD | 11–14 | `objects.all()`, `get_object_or_404`, `.save()`, `.delete()` |
| Ejercicio Final | — | Gestión de Películas (CRUD completo) |

```bash
python -m venv venv && venv\Scripts\Activate.ps1
pip install django
python manage.py migrate
python manage.py createsuperuser
python manage.py runserver
```

---

### 🔵 API REST — Reto Gestión de Libros

**Ruta:** `API-REST/`  
**Stack:** Node.js 18 · Express 4.x · almacenamiento en memoria

API REST completa siguiendo principios REST estrictos con respuesta JSON estándar en todos los endpoints.

| Método | Endpoint | Descripción | Status |
|---|---|---|---|
| GET | `/libros` | Listar todos (filtra por `?autor=`) | 200 |
| GET | `/libros/:id` | Obtener por ID | 200 / 404 |
| POST | `/libros` | Crear libro | 201 / 422 |
| PUT | `/libros/:id` | Reemplazar libro | 200 / 404 / 422 |
| DELETE | `/libros/:id` | Eliminar libro | 200 / 404 |

**Formato de respuesta:**
```json
{ "success": true, "data": { }, "message": "Descripción del resultado" }
```

Incluye `libros-api-playground.html`, una interfaz interactiva para probar todos los endpoints sin Postman.

```bash
npm install express
node libros-api.js
# Playground: abrir libros-api-playground.html en el navegador
```

---

## 🛠️ Tecnologías utilizadas

| Tecnología | Versión | Categoría |
|---|---|---|
| Python | 3.10+ | Backend / Scripts |
| JavaScript / Node.js | ES2022 / 18 LTS | Frontend + Backend |
| PHP | 8.1+ | Backend (DWES) |
| Django | 5.2 | Framework Python |
| Laravel | 12 | Framework PHP |
| Symfony | 6.4 LTS | Framework PHP |
| Express | 4.x | Microframework Node.js |
| MySQL | 8.0 | Base de datos relacional |
| SQLite3 | stdlib | Base de datos embebida (Python) |
| Twig / Blade | — | Motores de plantillas |

---

## 📐 Estándares de código aplicados

| Aspecto | Criterio |
|---|---|
| Nomenclatura JS/PHP/Java | `camelCase` |
| Nomenclatura Python | `snake_case` |
| Clases | `PascalCase` (todos los lenguajes) |
| Tablas BD | plural · minúsculas · `snake_case` |
| Columnas BD | `snake_case` |
| Documentación | JSDoc · PHPDoc · PyDoc (docstrings) |
| Longitud de función | < 30 líneas |
| Manejo de errores | Centralizado · nunca `catch` / `except` vacíos |
| APIs REST | JSON estándar `{success, data, message}` |
| Seguridad | Variables de entorno para credenciales · prepared statements · `htmlspecialchars()` |
| Consultas N+1 | Evitadas con Eager Loading (`JOIN`, `objects.all()`, `findAll()`) |

---

## 📜 Licencia

Consulta el archivo [`LICENSE`](./LICENSE) para los términos de uso.

---

*Repositorio académico — Carlos Vico*
