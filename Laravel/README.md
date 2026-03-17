# 🎬 Laravel 12 — Ejercicios Prácticos

**Autor:** Carlos Vico  
**Framework:** Laravel 12  
**PHP:** >= 8.2  
**Base de datos:** MySQL / MariaDB  

---

## 📋 Índice

1. [Requisitos](#requisitos)
2. [Instalación](#instalación)
3. [Ejercicios de Rutas](#ejercicios-de-rutas)
4. [Ejercicios con Controladores](#ejercicios-con-controladores)
5. [Ejercicios con Vistas Blade](#ejercicios-con-vistas-blade)
6. [Ejercicios con Migraciones y Modelos](#ejercicios-con-migraciones-y-modelos)
7. [Ejercicios CRUD](#ejercicios-crud)
8. [Ejercicio Final — Gestión de Películas](#ejercicio-final--gestión-de-películas)

---

## Requisitos

| Herramienta | Versión mínima |
|---|---|
| PHP | 8.2 |
| Composer | 2.x |
| MySQL / MariaDB | 8.0 / 10.3 |

Verificar instalación:

```bash
php -v
composer -v
mysql -v
```

---

## Instalación

```bash
# 1. Crear el proyecto
composer create-project laravel/laravel nombre-proyecto
cd nombre-proyecto

# 2. Generar la App Key
php artisan key:generate

# 3. Crear la base de datos
mysql -u root -p -e "CREATE DATABASE nombre_bbdd CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 4. Configurar .env
# DB_DATABASE=nombre_bbdd
# DB_USERNAME=root
# DB_PASSWORD=tu_password

# 5. Ejecutar migraciones
php artisan migrate

# 6. Levantar servidor
php artisan serve
```

> ⚠️ **Nota Windows/XAMPP:** Si Composer muestra warnings sobre la extensión `zip`, activarla en `C:\xampp\php\php.ini` descomentando `extension=zip` y reiniciando Apache.

---

## Ejercicios de Rutas

### Ejercicio 1 — Ruta simple

**Archivo:** `routes/web.php`  
**URL:** `/inicio`  
**Resultado:** `Bienvenido a mi primera aplicación en Laravel`

```php
Route::get('/inicio', function () {
    return 'Bienvenido a mi primera aplicación en Laravel';
});
```

---

### Ejercicio 2 — Ruta con parámetro

**URL:** `/saludo/{nombre}`  
**Ejemplo:** `/saludo/Ana`  
**Resultado:** `Hola Ana, bienvenido a Laravel`

```php
Route::get('/saludo/{nombre}', function (string $nombre) {
    return "Hola {$nombre}, bienvenido a Laravel";
});
```

---

### Ejercicio 3 — Ruta con dos parámetros

**URL:** `/suma/{num1}/{num2}`  
**Ejemplo:** `/suma/5/7`  
**Resultado:** `La suma es: 12`

```php
Route::get('/suma/{num1}/{num2}', function (string $num1, string $num2) {
    $resultado = (float) $num1 + (float) $num2;
    return "La suma es: {$resultado}";
});
```

---

## Ejercicios con Controladores

### Ejercicio 4 — Crear un controlador

```bash
php artisan make:controller ProductoController
```

**Archivo:** `app/Http/Controllers/ProductoController.php`  
**URL:** `/productos`  
**Resultado:** `Listado de productos`

```php
public function index(): Response
{
    return response('Listado de productos');
}
```

**Ruta:**
```php
Route::get('/productos', [ProductoController::class, 'index']);
```

---

### Ejercicio 5 — Controlador con parámetros

**URL:** `/producto/{id}`  
**Ejemplo:** `/producto/42`  
**Resultado:** `Producto con ID: 42`

```php
public function mostrar(int|string $id): Response
{
    return response("Producto con ID: {$id}");
}
```

**Ruta:**
```php
Route::get('/producto/{id}', [ProductoController::class, 'mostrar']);
```

---

## Ejercicios con Vistas Blade

### Ejercicio 6 — Primera vista

**Archivo:** `resources/views/bienvenida.blade.php`  
**URL:** `/bienvenida`  
**Resultado:** `Bienvenido a la aplicación`

```php
// Ruta
Route::get('/bienvenida', function () {
    return view('bienvenida');
});
```

---

### Ejercicio 7 — Pasar datos a la vista

**URL:** `/hola`  
**Resultado:** `Hola Carlos`

```php
Route::get('/hola', function () {
    return view('saludo', ['nombre' => 'Carlos']);
});
```

```blade
{{-- resources/views/saludo.blade.php --}}
<h1>Hola {{ $nombre }}</h1>
```

---

### Ejercicio 8 — Mostrar lista con `@foreach`

**URL:** `/frutas`

```php
Route::get('/frutas', function () {
    $frutas = ['manzana', 'pera', 'plátano', 'naranja'];
    return view('frutas', compact('frutas'));
});
```

```blade
{{-- resources/views/frutas.blade.php --}}
@foreach ($frutas as $fruta)
    <li>{{ $fruta }}</li>
@endforeach
```

---

## Ejercicios con Migraciones y Modelos

### Ejercicio 9 — Crear migración

```bash
php artisan make:migration create_libros_table
php artisan migrate
```

**Tabla:** `libros`  
**Campos:** `id`, `titulo`, `autor`, `precio`, `created_at`, `updated_at`

```php
Schema::create('libros', function (Blueprint $table) {
    $table->id();
    $table->string('titulo');
    $table->string('autor');
    $table->decimal('precio', 8, 2);
    $table->timestamps();
});
```

---

### Ejercicio 10 — Crear modelo

```bash
php artisan make:model Libro
```

```php
protected $fillable = ['titulo', 'autor', 'precio'];
```

---

## Ejercicios CRUD

### Ejercicio 11 — Insertar

**URL:** `/libros/crear`

```php
Libro::create(['titulo' => 'El Quijote', 'autor' => 'Cervantes', 'precio' => 20]);
```

### Ejercicio 12 — Mostrar todos

**URL:** `/libros`

```php
$libros = Libro::all();
return $libros->map(fn($l) => "{$l->titulo} - {$l->autor} - {$l->precio}€")->join('<br>');
```

### Ejercicio 13 — Actualizar

**URL:** `/libros/actualizar`

```php
Libro::findOrFail(1)->update(['precio' => 25]);
```

### Ejercicio 14 — Eliminar

**URL:** `/libros/eliminar`

```php
Libro::findOrFail(1)->delete();
```

---

## Ejercicio Final — Gestión de Películas

Aplicación CRUD completa para gestionar películas.

### Instalación del proyecto

```bash
composer create-project laravel/laravel gestion-peliculas
cd gestion-peliculas

php artisan make:migration create_peliculas_table
php artisan make:model Pelicula
php artisan make:controller PeliculaController --resource

php artisan migrate
php artisan serve
```

### Tabla `peliculas`

| Campo | Tipo |
|---|---|
| id | BIGINT (PK, autoincrement) |
| titulo | VARCHAR(255) |
| director | VARCHAR(255) |
| año | SMALLINT UNSIGNED |
| created_at | TIMESTAMP |
| updated_at | TIMESTAMP |

### Rutas generadas con `Route::resource`

```php
Route::resource('peliculas', PeliculaController::class);
```

| Método HTTP | URL | Acción | Descripción |
|---|---|---|---|
| GET | `/peliculas` | index | Listado de películas |
| GET | `/peliculas/create` | create | Formulario nueva película |
| POST | `/peliculas` | store | Insertar película |
| GET | `/peliculas/{id}` | show | Detalle de película |
| GET | `/peliculas/{id}/edit` | edit | Formulario editar título |
| PUT | `/peliculas/{id}` | update | Actualizar título |
| DELETE | `/peliculas/{id}` | destroy | Eliminar película |

### Estructura de archivos

```
app/
├── Http/Controllers/PeliculaController.php
└── Models/Pelicula.php

database/migrations/
└── xxxx_create_peliculas_table.php

resources/views/
├── layouts/
│   └── app.blade.php
└── peliculas/
    ├── index.blade.php
    ├── create.blade.php
    ├── show.blade.php
    └── edit.blade.php

routes/
└── web.php
```

### URL de acceso

```
http://127.0.0.1:8000/peliculas
```

---

## 🔧 Comandos útiles

```bash
php artisan route:list          # Ver todas las rutas registradas
php artisan migrate:fresh       # Borrar y recrear todas las tablas
php artisan config:clear        # Limpiar caché de configuración
php artisan cache:clear         # Limpiar caché general
php artisan make:controller X   # Crear controlador
php artisan make:model X        # Crear modelo
php artisan make:migration X    # Crear migración
```

---

## ⚠️ Problemas frecuentes

| Error | Causa | Solución |
|---|---|---|
| `zip extension missing` | Extensión PHP desactivada | Descomentar `extension=zip` en `php.ini` |
| `Access denied for user 'root'` | Password MySQL incorrecto en `.env` | Actualizar `DB_PASSWORD` en `.env` y ejecutar `php artisan config:clear` |
| `View [x] not found` | Archivo `.blade.php` no existe | Crear el archivo en `resources/views/` |
| `404 Not Found` en `/` | No hay ruta definida para `/` | Ir a `/peliculas` o añadir redirección en `web.php` |

---

*Documentación generada para el curso práctico de Laravel 12.*