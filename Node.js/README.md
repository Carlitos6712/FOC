# 📦 Ejercicios de Node.js

**Autor:** Carlos Vico  
**Stack:** Node.js · Express.js  
**Descripción:** Colección de ejercicios progresivos desde la instalación de Node.js hasta la creación de una API REST completa con Express.

---

## 📋 Tabla de contenidos

1. [Instalación de Node.js](#1-instalación-de-nodejs)
2. [Estructura del proyecto](#2-estructura-del-proyecto)
3. [Ejercicio 1 — Primer programa](#3-ejercicio-1--primer-programa)
4. [Ejercicio 2 — Módulo fs](#4-ejercicio-2--módulo-fs)
5. [Ejercicio 3 — Módulo propio](#5-ejercicio-3--módulo-propio)
6. [Ejercicio 4 — Servidor HTTP](#6-ejercicio-4--servidor-http)
7. [Ejercicio 5 — Rutas manuales](#7-ejercicio-5--rutas-manuales)
8. [Ejercicios 6-11 — Express](#8-ejercicios-6-11--express)
9. [Ejercicio Final — API REST Películas](#9-ejercicio-final--api-rest-películas)

---

## 1. Instalación de Node.js

### Windows — Instalador oficial

1. Accede a [https://nodejs.org](https://nodejs.org)
2. Descarga la versión **LTS** (recomendada para desarrollo)
3. Ejecuta el archivo `.msi` y sigue el asistente con los valores por defecto
4. Abre una terminal nueva y verifica la instalación:

```bash
node --version
npm --version
```

Deberías ver algo similar a:
```
v22.x.x
10.x.x
```

> ⚠️ Si el comando no se reconoce, cierra y vuelve a abrir la terminal. El instalador modifica el PATH y necesita una sesión nueva.

---

## 2. Estructura del proyecto

```
nodejs-ejercicios/
├── ejercicio1-app.js           # Primer programa
├── ejercicio2-leer-archivo.js  # Módulo fs
├── ejercicio3-app.js           # Importar módulo propio
├── operaciones.js              # Módulo propio (sumar, multiplicar)
├── ejercicio4-servidor.js      # Servidor HTTP nativo
├── ejercicio5-rutas.js         # Servidor HTTP con rutas
├── ejercicios6al11-express.js  # Servidor Express (ejercicios 6-11)
├── peliculas-api.js            # API REST final
├── texto.txt                   # Archivo de prueba para el ejercicio 2
└── package.json
```

---

## 3. Ejercicio 1 — Primer programa

**Archivo:** `ejercicio1-app.js`

Programa básico que imprime un mensaje en consola.

```js
console.log("Hola, este es mi primer programa en Node.js");
```

**Ejecución:**
```bash
node ejercicio1-app.js
```

**Salida esperada:**
```
Hola, este es mi primer programa en Node.js
```

---

## 4. Ejercicio 2 — Módulo fs

**Archivo:** `ejercicio2-leer-archivo.js`

Lee el contenido de `texto.txt` usando el módulo nativo `fs` de Node.js.

```js
const fs = require("fs");

fs.readFile("texto.txt", "utf8", (error, contenido) => {
  if (error) {
    console.error("Error al leer el archivo:", error.message);
    return;
  }
  console.log(contenido);
});
```

**Ejecución:**
```bash
node ejercicio2-leer-archivo.js
```

> `fs` es un módulo nativo de Node.js. No requiere instalación.

---

## 5. Ejercicio 3 — Módulo propio

**Archivos:** `operaciones.js` + `ejercicio3-app.js`

Creación e importación de un módulo personalizado con funciones matemáticas.

**operaciones.js** — define y exporta las funciones:
```js
const sumar = (a, b) => a + b;
const multiplicar = (a, b) => a * b;

module.exports = { sumar, multiplicar };
```

**ejercicio3-app.js** — importa y usa el módulo:
```js
const { sumar, multiplicar } = require("./operaciones");

console.log(`5 + 3 = ${sumar(5, 3)}`);
console.log(`5 * 3 = ${multiplicar(5, 3)}`);
```

**Ejecución:**
```bash
node ejercicio3-app.js
```

**Salida esperada:**
```
5 + 3 = 8
5 * 3 = 15
```

---

## 6. Ejercicio 4 — Servidor HTTP

**Archivo:** `ejercicio4-servidor.js`

Servidor HTTP básico usando el módulo nativo `http` en el puerto 3000.

```js
const http = require("http");

const servidor = http.createServer((req, res) => {
  res.writeHead(200, { "Content-Type": "text/plain; charset=utf-8" });
  res.end("Servidor funcionando correctamente");
});

servidor.listen(3000, () => {
  console.log("Servidor escuchando en http://localhost:3000");
});
```

**Ejecución:**
```bash
node ejercicio4-servidor.js
```

Abre el navegador en [http://localhost:3000](http://localhost:3000)

---

## 7. Ejercicio 5 — Rutas manuales

**Archivo:** `ejercicio5-rutas.js`

Servidor HTTP que responde de forma diferente según la URL solicitada.

| URL | Respuesta |
|---|---|
| `/` | Bienvenido a la página principal |
| `/about` | Esta es la página sobre nosotros |
| `/contacto` | Página de contacto |
| cualquier otra | Ruta no encontrada (404) |

**Ejecución:**
```bash
node ejercicio5-rutas.js
```

Prueba en el navegador:
- [http://localhost:3000/](http://localhost:3000/)
- [http://localhost:3000/about](http://localhost:3000/about)
- [http://localhost:3000/contacto](http://localhost:3000/contacto)

---

## 8. Ejercicios 6-11 — Express

**Archivo:** `ejercicios6al11-express.js`

### Instalación previa

```bash
npm install express
```

### Rutas disponibles

| Método | Ruta | Descripción |
|---|---|---|
| GET | `/` | Mensaje de bienvenida |
| GET | `/saludo/:nombre` | Saludo personalizado |
| GET | `/suma/:num1/:num2` | Suma de dos números |
| POST | `/usuarios` | Crear usuario |
| GET | `/productos` | Listar productos |
| GET | `/productos/:id` | Producto por ID |

**Ejecución:**
```bash
node ejercicios6al11-express.js
```

### Ejemplos de uso

```bash
# Ejercicio 6 — Bienvenida
# Abre en navegador: http://localhost:3000/

# Ejercicio 7 — Saludo con parámetro
# Abre en navegador: http://localhost:3000/saludo/Carlos

# Ejercicio 8 — Suma
# Abre en navegador: http://localhost:3000/suma/5/8

# Ejercicio 9 — POST usuario (PowerShell)
$body = '{"nombre":"Carlos","edad":30}'
Invoke-RestMethod -Method POST -Uri http://localhost:3000/usuarios -ContentType "application/json" -Body $body

# Ejercicio 10 — Listar productos
# Abre en navegador: http://localhost:3000/productos

# Ejercicio 11 — Producto por ID
# Abre en navegador: http://localhost:3000/productos/1
```

---

## 9. Ejercicio Final — API REST Películas

**Archivo:** `peliculas-api.js`

API REST completa para gestionar un catálogo de películas en memoria.

### Modelo de datos

```json
{
  "id": 1,
  "titulo": "El Padrino",
  "director": "Francis Ford Coppola",
  "anio": 1972
}
```

> ℹ️ Se usa `anio` en lugar de `año` para evitar problemas de encoding en PowerShell.

### Endpoints

| Método | Ruta | Descripción | Status |
|---|---|---|---|
| GET | `/peliculas` | Listar todas | 200 |
| GET | `/peliculas/:id` | Obtener una | 200 / 404 |
| POST | `/peliculas` | Crear película | 201 / 400 |
| PUT | `/peliculas/:id` | Actualizar | 200 / 404 |
| DELETE | `/peliculas/:id` | Eliminar | 200 / 404 |

### Ejecución

```bash
node peliculas-api.js
```

### Ejemplos de uso (PowerShell)

```powershell
# GET — Listar todas las películas
Invoke-RestMethod -Uri http://localhost:3000/peliculas

# GET — Obtener película por ID
Invoke-RestMethod -Uri http://localhost:3000/peliculas/1

# POST — Crear nueva película
$body = '{"titulo":"Interstellar","director":"Christopher Nolan","anio":2014}'
Invoke-RestMethod -Method POST -Uri http://localhost:3000/peliculas -ContentType "application/json" -Body $body

# PUT — Actualizar película existente
$body = '{"titulo":"Interstellar IMAX"}'
Invoke-RestMethod -Method PUT -Uri http://localhost:3000/peliculas/4 -ContentType "application/json" -Body $body

# DELETE — Eliminar película
Invoke-RestMethod -Method DELETE -Uri http://localhost:3000/peliculas/2
```

### Formato de respuesta estándar

Todas las rutas devuelven el mismo formato JSON:

```json
{
  "success": true,
  "data": { },
  "message": "Descripción del resultado"
}
```

En caso de error:

```json
{
  "success": false,
  "data": null,
  "message": "Descripción del error"
}
```

---

## 🔧 Comandos rápidos de referencia

| Acción | Comando |
|---|---|
| Verificar Node.js | `node --version` |
| Verificar npm | `npm --version` |
| Instalar Express | `npm install express` |
| Ejecutar un archivo | `node nombre-archivo.js` |
| Parar el servidor | `Ctrl + C` en la terminal |

---

*Documentación generada por Carlos Vico*
