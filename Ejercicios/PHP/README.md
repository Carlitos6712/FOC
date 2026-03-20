# Ejercicios PHP — Desarrollo Web en Entorno Servidor

**Autor:** Carlos Vico  
**Módulo:** Desarrollo Web en Entorno Servidor (DWES)  
**Entorno:** XAMPP (Apache + PHP 8+ + MySQL)

---

## Estructura del proyecto

```
php_ejercicios/
├── RA01/               # Introducción al servidor web
├── RA02/               # PHP embebido, tipos y sintaxis
├── RA03/               # Programación básica
├── RA04/               # Sesiones, cookies y autenticación
├── RA05/               # Patrón MVC
├── RA06/               # Acceso a base de datos
├── RA07/               # API REST
├── RA08/               # AJAX y validación
└── RA09/               # Servicios externos e índice general
```

---

## Requisitos previos

- [XAMPP](https://www.apachefriends.org/) con Apache, PHP 8.1+ y MySQL activos
- Extensiones PHP habilitadas: `pdo_mysql`, `mbstring`, `openssl`
- El proyecto debe colocarse en `C:\xampp\htdocs\dwes\` (o equivalente en Linux: `/var/www/html/dwes/`)

### Variables de entorno (opcional)

Las conexiones a base de datos leen las credenciales desde variables de entorno. Si no están definidas, usan los valores por defecto de XAMPP:

| Variable   | Por defecto |
|------------|-------------|
| `DB_HOST`  | `localhost` |
| `DB_NAME`  | `libros`    |
| `DB_USER`  | `root`      |
| `DB_PASS`  | *(vacío)*   |

Para definirlas en Windows (PowerShell):
```powershell
$env:DB_HOST = "localhost"
$env:DB_NAME = "libros"
$env:DB_USER = "root"
$env:DB_PASS = ""
```

---

## Instalación

1. Clona o descomprime el proyecto en el directorio raíz de XAMPP:
   ```
   C:\xampp\htdocs\dwes\
   ```

2. Importa la base de datos desde phpMyAdmin o por consola:
   ```bash
   mysql -u root < RA06/libros.sql
   ```

3. Accede al índice general desde el navegador:
   ```
   http://localhost/dwes/RA09/index.php
   ```

---

## Descripción de ejercicios por RA

### RA01 — Introducción al servidor web

| Archivo | Descripción |
|---------|-------------|
| `RA01/index.php` | Muestra información del servidor (`$_SERVER`) con cabecera y pie de página |
| `RA01/tareas.php` | Añade y visualiza tareas almacenadas en `tareas.txt` mediante PHP embebido en HTML |

**Conceptos:** `$_SERVER`, `file_put_contents()`, `FILE_APPEND`, integración HTML+PHP.

---

### RA02 — PHP embebido, sintaxis y tipos

| Archivo | Descripción |
|---------|-------------|
| `RA02/index.php` | Muestra la fecha actual y un saludo personalizado con `$_POST` |
| `RA02/productos.php` | Lee `productos.txt` y renderiza una tabla HTML con `file()` y `explode()` |
| `RA02/calculadora.php` | Calculadora aritmética con validación (`is_numeric`, división por cero) y `switch` |
| `RA02/variables_tipos.php` | Demuestra tipos primitivos, constantes y operadores aritméticos |
| `RA02/variables.php` | Ámbitos global y local con la keyword `global` |
| `RA02/productos.txt` | Fichero de datos de ejemplo (`Nombre,Precio`) |

**Conceptos:** `date()`, `$_POST`, `file()`, `explode()`, `is_numeric()`, `define()`, ámbito de variables.

---

### RA03 — Programación básica

| Archivo | Descripción |
|---------|-------------|
| `RA03/index.php` | Agrupa todos los ejercicios del RA en una sola página con secciones |

Funciones implementadas:

| Función | Descripción |
|---------|-------------|
| `comprobarEdad(int $edad)` | Determina mayor/menor de edad |
| `generarArray(int $valor)` | Genera array decreciente de 3 en 3 hasta 0 |
| `tabla(array $valores)` | Renderiza un array como tabla HTML |
| `listarParesImpares()` | Números del 1 al 10 indicando par/impar con `for` |

**Conceptos:** `if/else`, `for`, `foreach`, `switch`, arrays, `$_POST`, `$_GET`, `isset()`, `is_numeric()`, `htmlspecialchars()`.

---

### RA04 — Sesiones, cookies y autenticación

| Archivo | Descripción |
|---------|-------------|
| `RA04/login.php` | Formulario de login con redirección por rol (`administrador` / `usuario`) |
| `RA04/admin.php` | Panel exclusivo para administradores; redirige si no hay sesión válida |
| `RA04/user.php` | Área para usuarios estándar; protegida por sesión |
| `RA04/sesion.php` | Gestiona teléfono y email en sesión, y horario en cookie |
| `RA04/preferencias.php` | Contador de visitas por sesión + preferencia de tema en cookie |

Usuarios de prueba:

| Usuario | Contraseña | Rol |
|---------|------------|-----|
| `admin` | `admin123` | administrador |
| `user`  | `user123`  | usuario |
| `foc`   | `Fdwes!22` | usuario |

**Conceptos:** `session_start()`, `session_regenerate_id()`, `session_destroy()`, `setcookie()`, `$_COOKIE`, `$_SESSION`, protección de páginas.

---

### RA05 — Patrón MVC

| Archivo | Descripción |
|---------|-------------|
| `RA05/index.php` | Controlador frontal; parsea la URL y delega en el controlador |
| `RA05/modelo.php` | Catálogo de artículos en array `$articulos` |
| `RA05/controladores.php` | Funciones controladoras: listado, detalle, sugerencias, registro |
| `RA05/vistas/_layout.php` | Plantilla base compartida (Template Inheritance manual) |
| `RA05/vistas/listado.php` | Vista del catálogo de artículos |
| `RA05/vistas/detalle.php` | Vista del detalle de un artículo |
| `RA05/vistas/sugerencias.php` | Vista del formulario y lista de sugerencias (en sesión) |
| `RA05/vistas/registro.php` | Vista del formulario de registro (en memoria) |

**Rutas disponibles:**

| URL | Acción |
|-----|--------|
| `index.php` | Listado de artículos |
| `index.php/articulo?id=N` | Detalle del artículo N |
| `index.php/sugerencias` | Formulario de sugerencias |
| `index.php/registro` | Formulario de registro |

> Los ficheros `modelo.php` y las vistas validan la constante `CON_CONTROLADOR` para impedir el acceso directo.

**Conceptos:** MVC, Front Controller, Template Inheritance, `define()`, `ob_start()` / `ob_get_clean()`, `CON_CONTROLADOR`.

---

### RA06 — Acceso a base de datos

| Archivo | Descripción |
|---------|-------------|
| `RA06/libros.sql` | Script SQL de creación e inserción de la BD `libros` |
| `RA06/Libros.php` | Clase con todos los métodos de acceso a datos |
| `RA06/index.php` | Página que muestra autores con sus libros y permite borrarlos |

Métodos de la clase `Libros`:

| Método | Descripción |
|--------|-------------|
| `conexion(...)` | Devuelve una conexión PDO o `null` |
| `consultarAutores($con, $id?)` | Uno o todos los autores |
| `consultarLibros($con, $idAutor?)` | Libros de un autor o todos |
| `consultarDatosLibro($con, $id)` | Datos de un libro por ID |
| `borrarAutor($con, $id)` | Elimina autor (CASCADE a sus libros) |
| `borrarLibro($con, $id)` | Elimina un libro por ID |

**Conceptos:** PDO, prepared statements, `FETCH_ASSOC`, FK con `ON DELETE CASCADE`, PHPDoc.

---

### RA07 — API REST

| Archivo | Descripción |
|---------|-------------|
| `RA07/api.php` | API REST que expone datos de la BD en JSON estándar |
| `RA07/cliente.php` | Cliente web que consume la API y presenta los datos con HTML |

Endpoints de la API (`api.php?action=...`):

| Acción | Parámetros | Descripción |
|--------|-----------|-------------|
| `get_listado_autores` | — | Lista todos los autores |
| `get_datos_autor` | `id=N` | Datos de un autor + sus libros |
| `get_listado_libros` | — | Lista todos los libros (id + título) |
| `get_datos_libro` | `id=N` | Datos del libro + nombre del autor |

Todas las respuestas siguen el formato:
```json
{ "success": true, "data": [...], "message": "..." }
```

**Conceptos:** REST, JSON, `http_response_code()`, `json_encode()`, Eager Loading (JOIN en `get_datos_libro`), `file_get_contents()`.

---

### RA08 — AJAX y validación

| Archivo | Descripción |
|---------|-------------|
| `RA08/index.html` | Interfaz con campo validado (solo letras) y búsqueda en tiempo real |
| `RA08/buscar_libros.php` | Endpoint AJAX que busca libros por título con `LIKE` |

- El campo `#texto` solo acepta letras (validado con regex en JS y `preg_match` en PHP).
- La búsqueda se lanza con **debounce de 300 ms** para no saturar el servidor.
- El endpoint usa un **JOIN** para obtener el autor del libro en una sola consulta.

**Conceptos:** `fetch()`, debounce, `LIKE`, JOIN, validación client-side + server-side.

---

### RA09 — Servicios externos e índice general

| Archivo | Descripción |
|---------|-------------|
| `RA09/index.php` | Portal de navegación con enlaces a todos los ejercicios |
| `RA09/openlibrary.php` | Consume la API pública de Open Library y muestra resultados |

**Conceptos:** `file_get_contents()` con contexto HTTP, `stream_context_create()`, `json_decode()`, `http_build_query()`.

---

## Convenciones aplicadas

- **Nomenclatura:** `camelCase` en PHP, `snake_case` en BD (tablas en plural)
- **Documentación:** PHPDoc en todas las funciones y métodos (`@param`, `@return`, `@author`)
- **Seguridad:** `htmlspecialchars()` en todas las salidas, prepared statements en todas las consultas, credenciales por variables de entorno
- **Arquitectura:** SOLID, Clean Code (funciones < 30 líneas), manejo centralizado de errores
- **APIs:** JSON estándar `{success, data, message}`, verbos HTTP correctos

---

## Generar documentación con PHPDocumentor

```bash
# Descargar phpDocumentor
curl -O https://phpdoc.org/phpDocumentor.phar

# Generar documentación
C:\xampp\php\php.exe phpDocumentor.phar -d C:\xampp\htdocs\dwes -t C:\dwes-doc
```

La documentación generada estará disponible abriendo `C:\dwes-doc\index.html` en el navegador.