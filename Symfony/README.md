# 📚 Ejercicios Symfony 6.4 — Documentación completa

Documentación de todos los ejercicios realizados con **Symfony 6.4 LTS**.
Cubre rutas, controladores, Twig, Doctrine y un ejercicio final completo.

**Autor:** Carlos Vico  
**Framework:** Symfony 6.4.35  
**Base de datos:** MySQL 8.0  
**Motor de plantillas:** Twig  

---

## 📋 Requisitos previos

| Herramienta | Versión mínima |
|---|---|
| PHP | 8.1+ |
| Composer | 2.x |
| MySQL | 8.0+ |

### Verificar extensiones PHP (PowerShell)

```powershell
php -v
php -m | Select-String -Pattern "xml|curl|mbstring|intl|zip|pdo"
```

Deben aparecer: `curl`, `intl`, `mbstring`, `PDO`, `pdo_mysql`, `xml`, `zip`.

> Si falta `intl` o `zip`, ábrelas en `php.ini` quitando el `;` de `extension=intl` y `extension=zip`.

---

## 🚀 Instalación del proyecto base

```powershell
# Crear proyecto con Symfony 6.4 LTS
composer create-project symfony/skeleton:"6.4.*" mi_proyecto --no-audit
cd mi_proyecto

# Instalar todas las dependencias necesarias para los ejercicios
composer require doctrine/orm doctrine/doctrine-bundle doctrine/doctrine-migrations-bundle symfony/maker-bundle symfony/twig-bundle --no-audit
```

### Arrancar el servidor

```powershell
php -S localhost:8000 -t public/
```

---

## 📁 Estructura general del proyecto

```
mi_proyecto/
├── migrations/                         # Migraciones de base de datos
├── public/
│   └── index.php                       # Punto de entrada
├── src/
│   ├── Controller/
│   │   ├── InicioController.php        # Ejercicios 1, 2, 3, 6, 7, 8
│   │   ├── ProductoController.php      # Ejercicios 4, 5
│   │   └── LibroController.php         # Ejercicios 10, 11, 12, 13, 14
│   ├── Entity/
│   │   └── Libro.php                   # Ejercicio 9
│   └── Repository/
│       └── LibroRepository.php         # Ejercicio 9
├── templates/
│   ├── bienvenida.html.twig            # Ejercicios 6, 7
│   ├── ciudades.html.twig              # Ejercicio 8
│   └── libros/
│       └── listar.html.twig            # Ejercicio 11
└── .env                                # Variables de entorno
```

---

## 🗺️ BLOQUE 1 — Rutas básicas

### Ejercicio 1 — Primera ruta

**Archivo:** `src/Controller/InicioController.php`  
**URL:** `GET /inicio`  
**Resultado:** `Bienvenido a mi primera aplicación Symfony`

```php
#[Route('/inicio', name: 'app_inicio')]
public function index(): Response
{
    return new Response('Bienvenido a mi primera aplicación Symfony');
}
```

---

### Ejercicio 2 — Ruta con parámetro

**URL:** `GET /saludo/{nombre}`  
**Ejemplo:** `/saludo/Ana`  
**Resultado:** `Hola Ana, bienvenido a Symfony`

```php
#[Route('/saludo/{nombre}', name: 'app_saludo')]
public function saludo(string $nombre): Response
{
    return new Response("Hola {$nombre}, bienvenido a Symfony");
}
```

---

### Ejercicio 3 — Ruta con dos parámetros

**URL:** `GET /multiplicar/{num1}/{num2}`  
**Ejemplo:** `/multiplicar/4/5`  
**Resultado:** `El resultado es: 20`

```php
#[Route('/multiplicar/{num1}/{num2}', name: 'app_multiplicar')]
public function multiplicar(int $num1, int $num2): Response
{
    $resultado = $num1 * $num2;
    return new Response("El resultado es: {$resultado}");
}
```

---

## 🎮 BLOQUE 2 — Controladores

### Ejercicio 4 — Controlador de productos

**Archivo:** `src/Controller/ProductoController.php`  
**URL:** `GET /productos`  
**Resultado:** `Listado de productos`

```php
#[Route('/productos', name: 'app_productos')]
public function listar(): Response
{
    return new Response('Listado de productos');
}
```

---

### Ejercicio 5 — Mostrar producto por ID

**URL:** `GET /producto/{id}`  
**Ejemplo:** `/producto/3`  
**Resultado:** `Mostrando producto con ID: 3`

```php
#[Route('/producto/{id}', name: 'app_producto_show')]
public function mostrar(int $id): Response
{
    return new Response("Mostrando producto con ID: {$id}");
}
```

---

## 🖼️ BLOQUE 3 — Twig (plantillas)

### Instalación

```powershell
composer require symfony/twig-bundle --no-audit
```

---

### Ejercicio 6 — Crear una vista

**URL:** `GET /bienvenida`  
**Archivo vista:** `templates/bienvenida.html.twig`  
**Resultado:** Renderiza la vista con mensaje de bienvenida

```php
#[Route('/bienvenida', name: 'app_bienvenida')]
public function bienvenida(): Response
{
    $nombre = 'Carlos';
    return $this->render('bienvenida.html.twig', [
        'nombre' => $nombre,
    ]);
}
```

---

### Ejercicio 7 — Pasar variables a la vista

**Variable enviada:** `$nombre = 'Carlos'`  
**En la vista Twig:** `{{ nombre }}`  
**Resultado:** `Hola Carlos`

```twig
<h1>Bienvenido a la aplicación Symfony</h1>
<p>Hola {{ nombre }}</p>
```

---

### Ejercicio 8 — Mostrar una lista con bucle

**URL:** `GET /ciudades`  
**Archivo vista:** `templates/ciudades.html.twig`  
**Resultado:** Lista con Granada, Madrid, Sevilla, Valencia

```php
#[Route('/ciudades', name: 'app_ciudades')]
public function ciudades(): Response
{
    $ciudades = ['Granada', 'Madrid', 'Sevilla', 'Valencia'];
    return $this->render('ciudades.html.twig', [
        'ciudades' => $ciudades,
    ]);
}
```

```twig
{% for ciudad in ciudades %}
    <li>{{ ciudad }}</li>
{% endfor %}
```

---

## 🗄️ BLOQUE 4 — Base de datos (Doctrine)

### Configuración

**1. Editar `.env`:**

```env
DATABASE_URL="mysql://root:TU_PASSWORD@127.0.0.1:3306/symfony_ejercicios?serverVersion=8.0&charset=utf8mb4"
```

**2. Crear la base de datos:**

```powershell
php bin/console doctrine:database:create
```

---

### Ejercicio 9 — Crear entidad Libro

**Entidad:** `src/Entity/Libro.php`  
**Repositorio:** `src/Repository/LibroRepository.php`

| Campo | Tipo |
|---|---|
| `id` | integer (PK autoincremental) |
| `titulo` | string(255) |
| `autor` | string(255) |
| `precio` | float |

```powershell
# Crear entidad interactivamente
php bin/console make:entity Libro

# Generar y ejecutar migración
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

---

### Ejercicio 10 — Insertar datos

**URL:** `GET /libro/insertar`  
**Resultado:** Inserta Don Quijote, Cervantes, 18€

```php
#[Route('/libro/insertar', name: 'app_libro_insertar')]
public function insertar(EntityManagerInterface $em): Response
{
    $libro = new Libro();
    $libro->setTitulo('Don Quijote');
    $libro->setAutor('Cervantes');
    $libro->setPrecio(18);

    $em->persist($libro);
    $em->flush();

    return new Response('Libro insertado correctamente');
}
```

---

### Ejercicio 11 — Mostrar todos los libros

**URL:** `GET /libros`  
**Vista:** `templates/libros/listar.html.twig`  
**Resultado:** `Don Quijote - Cervantes - 18€`

```php
#[Route('/libros', name: 'app_libro_listar')]
public function listar(LibroRepository $repo): Response
{
    $libros = $repo->findAll();
    return $this->render('libros/listar.html.twig', [
        'libros' => $libros,
    ]);
}
```

```twig
{% for libro in libros %}
    <p>{{ libro.titulo }} - {{ libro.autor }} - {{ libro.precio }}€</p>
{% endfor %}
```

---

### Ejercicio 12 — Mostrar libro por ID

**URL:** `GET /libro/{id}`  
**Ejemplo:** `/libro/1`  
**Resultado:** `Don Quijote - Cervantes - 18€`

```php
#[Route('/libro/{id}', name: 'app_libro_show')]
public function mostrar(int $id, LibroRepository $repo): Response
{
    $libro = $repo->find($id);

    if (!$libro) {
        return new Response("No se encontró el libro con ID: {$id}", 404);
    }

    return new Response("{$libro->getTitulo()} - {$libro->getAutor()} - {$libro->getPrecio()}€");
}
```

---

### Ejercicio 13 — Actualizar datos

**URL:** `GET /libro/actualizar/1`  
**Resultado:** Cambia el precio del libro ID 1 a 22€

```php
#[Route('/libro/actualizar/1', name: 'app_libro_actualizar')]
public function actualizar(EntityManagerInterface $em, LibroRepository $repo): Response
{
    $libro = $repo->find(1);

    if (!$libro) {
        return new Response('Libro no encontrado', 404);
    }

    $libro->setPrecio(22);
    $em->flush();

    return new Response('Precio actualizado correctamente');
}
```

---

### Ejercicio 14 — Eliminar datos

**URL:** `GET /libro/eliminar/1`  
**Resultado:** Elimina el libro con ID 1

```php
#[Route('/libro/eliminar/1', name: 'app_libro_eliminar')]
public function eliminar(EntityManagerInterface $em, LibroRepository $repo): Response
{
    $libro = $repo->find(1);

    if (!$libro) {
        return new Response('Libro no encontrado', 404);
    }

    $em->remove($libro);
    $em->flush();

    return new Response('Libro eliminado correctamente');
}
```

---

## 🎬 EJERCICIO FINAL — Gestión de Películas

**Proyecto:** `proyecto-symfony-gestion-peliculas`  
**Puerto:** `localhost:8001`

### Entidad: Pelicula

| Campo | Tipo |
|---|---|
| `id` | integer (PK autoincremental) |
| `titulo` | string(255) |
| `director` | string(255) |
| `anyo` | integer |

### Instalación del proyecto final

```powershell
composer create-project symfony/skeleton:"6.4.*" proyecto-symfony-gestion-peliculas --no-audit
cd proyecto-symfony-gestion-peliculas

composer require doctrine/orm doctrine/doctrine-bundle doctrine/doctrine-migrations-bundle symfony/maker-bundle symfony/twig-bundle --no-audit
```

Editar `.env`:

```env
DATABASE_URL="mysql://root:TU_PASSWORD@127.0.0.1:3306/gestion_peliculas?serverVersion=8.0&charset=utf8mb4"
```

```powershell
php bin/console doctrine:database:create
php bin/console make:entity Pelicula
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php -S localhost:8001 -t public/
```

### Estructura del proyecto final

```
proyecto-symfony-gestion-peliculas/
├── src/
│   ├── Controller/
│   │   └── PeliculaController.php
│   ├── Entity/
│   │   └── Pelicula.php
│   └── Repository/
│       └── PeliculaRepository.php
└── templates/
    └── peliculas/
        ├── listar.html.twig
        └── detalle.html.twig
```

### Rutas del ejercicio final

| URL | Acción |
|---|---|
| `GET /pelicula/insertar` | Inserta "El Padrino" de ejemplo |
| `GET /peliculas` | Lista todas las películas con tabla |
| `GET /pelicula/{id}` | Muestra detalle de una película |
| `GET /pelicula/actualizar/1` | Actualiza el título de la película ID 1 |
| `GET /pelicula/eliminar/1` | Elimina la película ID 1 |

### Prueba rápida en orden

```
1. localhost:8001/pelicula/insertar      → Inserta "El Padrino"
2. localhost:8001/peliculas              → Verifica que aparece en el listado
3. localhost:8001/pelicula/1             → Comprueba el detalle
4. localhost:8001/pelicula/actualizar/1  → Actualiza el título
5. localhost:8001/peliculas              → Verifica el título actualizado
6. localhost:8001/pelicula/eliminar/1    → Elimina la película
7. localhost:8001/peliculas              → Verifica que ya no aparece
```

---

## 📊 Resumen de todos los ejercicios

| # | Bloque | URL | Descripción |
|---|---|---|---|
| 1 | Rutas | `/inicio` | Primera ruta, mensaje de bienvenida |
| 2 | Rutas | `/saludo/{nombre}` | Ruta con parámetro |
| 3 | Rutas | `/multiplicar/{num1}/{num2}` | Ruta con dos parámetros |
| 4 | Controladores | `/productos` | Listar productos |
| 5 | Controladores | `/producto/{id}` | Mostrar producto por ID |
| 6 | Twig | `/bienvenida` | Cargar vista Twig |
| 7 | Twig | `/bienvenida` | Pasar variable a la vista |
| 8 | Twig | `/ciudades` | Bucle for en Twig |
| 9 | Doctrine | — | Crear entidad Libro + migración |
| 10 | Doctrine | `/libro/insertar` | Insertar libro en BD |
| 11 | Doctrine | `/libros` | Listar todos los libros |
| 12 | Doctrine | `/libro/{id}` | Mostrar libro por ID |
| 13 | Doctrine | `/libro/actualizar/1` | Actualizar precio |
| 14 | Doctrine | `/libro/eliminar/1` | Eliminar libro |
| Final | CRUD completo | `/peliculas` | Gestión completa de películas |

---

## 🛠️ Comandos útiles

```powershell
# Limpiar caché
php bin/console cache:clear

# Ver todas las rutas registradas
php bin/console debug:router

# Ver entidades mapeadas
php bin/console doctrine:mapping:info

# Crear nueva entidad
php bin/console make:entity NombreEntidad

# Generar migración tras cambios en entidades
php bin/console make:migration
php bin/console doctrine:migrations:migrate

# Ver estado de migraciones
php bin/console doctrine:migrations:status
```

---

## 📝 Conceptos clave aprendidos

- **Routing:** Definición de rutas con atributos PHP `#[Route]` y parámetros dinámicos.
- **Controladores:** Clases que extienden `AbstractController` y devuelven objetos `Response`.
- **Twig:** Motor de plantillas con variables `{{ }}`, bloques `{% %}` y bucles `for`.
- **Doctrine ORM:** Mapeo objeto-relacional con entidades, repositorios y `EntityManagerInterface`.
- **Migraciones:** Control de versiones del esquema de BD con `make:migration` y `migrations:migrate`.
- **Inyección de dependencias:** Symfony inyecta automáticamente servicios como `EntityManagerInterface` y repositorios en los controladores.
