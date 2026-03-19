# 📚 API REST — Gestión de Libros

> Reto de nivel medio · Node.js + Express · JSON estándar · CRUD completo  
> **Autor:** Carlos Vico

---

## Índice

1. [Descripción](#descripción)
2. [Tecnologías](#tecnologías)
3. [Instalación y arranque](#instalación-y-arranque)
4. [Variables de entorno](#variables-de-entorno)
5. [Estructura del proyecto](#estructura-del-proyecto)
6. [Modelo de datos](#modelo-de-datos)
7. [Endpoints](#endpoints)
   - [GET /libros](#get-libros)
   - [GET /libros?autor=](#get-librosautorvalor)
   - [GET /libros/:id](#get-librosid)
   - [POST /libros](#post-libros)
   - [PUT /libros/:id](#put-librosid)
   - [DELETE /libros/:id](#delete-librosid)
8. [Respuesta JSON estándar](#respuesta-json-estándar)
9. [Códigos HTTP](#códigos-http)
10. [Reglas de validación](#reglas-de-validación)
11. [Decisiones de diseño](#decisiones-de-diseño)
12. [Playground interactivo](#playground-interactivo)

---

## Descripción

API REST para gestionar una colección de libros. Permite listar, buscar, crear, actualizar y eliminar libros, con validaciones de negocio y respuestas JSON consistentes en todos los endpoints.

El almacenamiento es **en memoria** (array de JavaScript). En un entorno de producción se reemplazaría por una base de datos real con un ORM.

---

## Tecnologías

| Paquete | Versión mínima | Uso |
|---|---|---|
| Node.js | 18.x | Entorno de ejecución |
| Express | 4.x | Framework HTTP |

---

## Instalación y arranque

```bash
# 1. Instalar dependencias
npm install express

# 2. Arrancar el servidor
node libros-api.js
```

El servidor queda disponible en:

```
http://localhost:3000
```

---

## Variables de entorno

| Variable | Por defecto | Descripción |
|---|---|---|
| `PORT` | `3000` | Puerto en el que escucha el servidor |

Ejemplo con puerto personalizado:

```bash
PORT=8080 node libros-api.js
```

---

## Estructura del proyecto

```
.
├── libros-api.js               # Servidor y rutas
├── libros-api-playground.html  # Interfaz interactiva para probar la API
└── README.md
```

---

## Modelo de datos

Cada libro tiene la siguiente forma:

```json
{
  "id":     1,
  "titulo": "Don Quijote de la Mancha",
  "autor":  "Cervantes",
  "anio":   1605
}
```

| Campo | Tipo | Descripción |
|---|---|---|
| `id` | `number` | Autoincremental. **No se envía** en POST ni PUT |
| `titulo` | `string` | Título del libro. No puede ser vacío |
| `autor` | `string` | Nombre del autor. No puede ser vacío |
| `anio` | `number` | Año de publicación. Debe ser entero y mayor que 1500 |

---

## Endpoints

### GET /libros

Lista todos los libros de la colección.

**Request**
```http
GET /libros HTTP/1.1
```

**Response `200 OK`**
```json
{
  "success": true,
  "data": [
    { "id": 1, "titulo": "Don Quijote de la Mancha", "autor": "Cervantes", "anio": 1605 },
    { "id": 2, "titulo": "Cien años de soledad", "autor": "García Márquez", "anio": 1967 }
  ],
  "message": "2 libro(s) encontrado(s)."
}
```

---

### GET /libros?autor={valor}

Filtra libros cuyo campo `autor` contenga el valor indicado. La búsqueda es **parcial** y **no distingue mayúsculas**.

**Request**
```http
GET /libros?autor=Cervantes HTTP/1.1
```

**Response `200 OK`**
```json
{
  "success": true,
  "data": [
    { "id": 1, "titulo": "Don Quijote de la Mancha", "autor": "Cervantes", "anio": 1605 }
  ],
  "message": "1 libro(s) encontrado(s)."
}
```

Si no hay coincidencias, `data` es un array vacío `[]` y el código sigue siendo `200`.

---

### GET /libros/:id

Devuelve un libro concreto por su ID.

**Request**
```http
GET /libros/1 HTTP/1.1
```

**Response `200 OK`**
```json
{
  "success": true,
  "data": { "id": 1, "titulo": "Don Quijote de la Mancha", "autor": "Cervantes", "anio": 1605 },
  "message": "Libro encontrado."
}
```

**Response `404 Not Found`** — ID inexistente
```json
{
  "success": false,
  "data": null,
  "message": "No se encontró ningún libro con id=99."
}
```

---

### POST /libros

Crea un nuevo libro. Devuelve el libro creado con su `id` asignado.

**Request**
```http
POST /libros HTTP/1.1
Content-Type: application/json

{
  "titulo": "El Aleph",
  "autor":  "Borges",
  "anio":   1949
}
```

**Response `201 Created`**
```json
{
  "success": true,
  "data": { "id": 4, "titulo": "El Aleph", "autor": "Borges", "anio": 1949 },
  "message": "Libro creado correctamente."
}
```

**Response `422 Unprocessable Entity`** — Validación fallida
```json
{
  "success": false,
  "data": {
    "errors": [
      "El campo 'titulo' es obligatorio y no puede estar vacío.",
      "El campo 'anio' debe ser un número entero mayor que 1500."
    ]
  },
  "message": "Validación fallida."
}
```

---

### PUT /libros/:id

Reemplaza **completamente** un libro existente. Todos los campos son obligatorios. El `id` se preserva del recurso original.

**Request**
```http
PUT /libros/1 HTTP/1.1
Content-Type: application/json

{
  "titulo": "Don Quijote de la Mancha (Segunda parte)",
  "autor":  "Cervantes",
  "anio":   1615
}
```

**Response `200 OK`**
```json
{
  "success": true,
  "data": { "id": 1, "titulo": "Don Quijote de la Mancha (Segunda parte)", "autor": "Cervantes", "anio": 1615 },
  "message": "Libro actualizado correctamente."
}
```

**Response `404 Not Found`** — ID inexistente  
**Response `422 Unprocessable Entity`** — Validación fallida  
_(misma estructura que en POST)_

---

### DELETE /libros/:id

Elimina un libro. Devuelve el objeto eliminado en `data`.

**Request**
```http
DELETE /libros/2 HTTP/1.1
```

**Response `200 OK`**
```json
{
  "success": true,
  "data": { "id": 2, "titulo": "Cien años de soledad", "autor": "García Márquez", "anio": 1967 },
  "message": "Libro eliminado correctamente."
}
```

**Response `404 Not Found`** — ID inexistente
```json
{
  "success": false,
  "data": null,
  "message": "No se encontró ningún libro con id=99."
}
```

---

## Respuesta JSON estándar

Todos los endpoints devuelven siempre el mismo sobre:

```json
{
  "success": true | false,
  "data":    { ... } | [ ... ] | null,
  "message": "Descripción legible del resultado"
}
```

| Campo | Tipo | Descripción |
|---|---|---|
| `success` | `boolean` | `true` si la operación fue exitosa |
| `data` | `object \| array \| null` | Payload de la respuesta |
| `message` | `string` | Mensaje informativo o de error |

---

## Códigos HTTP

| Código | Nombre | Cuándo se usa |
|---|---|---|
| `200 OK` | OK | GET, PUT, DELETE correctos |
| `201 Created` | Created | POST con recurso creado |
| `404 Not Found` | Not Found | ID no existe en GET, PUT o DELETE |
| `422 Unprocessable Entity` | Unprocessable | Datos recibidos pero inválidos (POST, PUT) |
| `500 Internal Server Error` | Server Error | Error no controlado del servidor |

> **¿Por qué 422 y no 400?**  
> `400 Bad Request` indica que la petición está malformada (JSON inválido, falta Content-Type, etc.).  
> `422 Unprocessable Entity` es semánticamente más preciso: la petición es sintácticamente correcta, pero los datos no cumplen las reglas de negocio.

---

## Reglas de validación

Aplicadas en `POST /libros` y `PUT /libros/:id`:

| Campo | Regla | Error si no se cumple |
|---|---|---|
| `titulo` | No puede ser vacío ni contener solo espacios | `422` |
| `autor` | No puede ser vacío | `422` |
| `anio` | Entero estricto **mayor que 1500** | `422` |

Todos los errores de un mismo request se acumulan y se devuelven juntos en `data.errors[]`, sin cortar en el primero.

---

## Decisiones de diseño

**`jsonResponse()` como helper puro**  
Toda respuesta pasa por una única función. Si en el futuro se añade un campo (p. ej. `timestamp`), el cambio es en un solo lugar.

**`validarLibro()` centralizado**  
POST y PUT comparten exactamente la misma lógica de validación. Sin duplicación, sin riesgo de que una ruta valide de forma diferente a la otra.

**Middleware de error global**  
`app.use((err, req, res, _next) => {...})` captura cualquier excepción no controlada. No hay `try/catch` vacíos ni errores que escapen sin respuesta al cliente.

**`module.exports = app`**  
El servidor se exporta para poder importarlo en tests unitarios (Jest, Supertest) sin que el `listen` se ejecute en ese contexto.

---

## Playground interactivo

El archivo `libros-api-playground.html` es una interfaz web que simula todas las peticiones en el navegador, sin necesidad de Postman ni de tener el servidor corriendo.

Abre el fichero directamente en cualquier navegador moderno:

```
libros-api-playground.html
```

Incluye ejemplos de casos de éxito y casos de error para cada endpoint.

---

*Documentación generada para el reto "Gestión de Libros" · Carlos Vico*