# 📚 Ejercicios JavaScript – DWEC

**Autor:** Carlos Vico García  
**Módulo:** Desarrollo Web en Entorno Cliente (DWEC)  
**Ciclo:** Desarrollo de Aplicaciones Web  
**Centro:** FOC  

---

## 📁 Estructura del proyecto

```
Ejercicios/
└── JavaScript/
    ├── RA1/
    │   ├── ambito.js
    │   ├── lenguaje.js
    │   ├── tarea1.html
    │   ├── tarea1.js
    │   └── variables.js
    ├── RA2/
    │   ├── tarea2.html
    │   └── tarea2.js
    ├── RA3/
    │   ├── reloj.html
    │   ├── reloj.js
    │   ├── tarea3.html
    │   └── tarea3.js
    ├── RA5/
    │   ├── tarea5.css
    │   ├── tarea5.html
    │   └── tarea5.js
    ├── RA6/
    │   ├── index.html
    │   ├── script.js
    │   └── styles.css
    ├── RA7/
    │   ├── tarea7.html
    │   └── tarea7.js
    └── README.md
```

---

## 🗂️ RA1 – Fundamentos de JavaScript

### `tarea1.html` + `tarea1.js`
**Resultados de aprendizaje:** RA2_d · RA2_e · RA2_f · RA2_g

Ejercicio principal de la unidad. Trabaja con dos arrays paralelos (`fichAlumno` y `etiquetas`) y los recorre con tres tipos de bucle distintos, mostrando el resultado en el documento HTML.

**Conceptos cubiertos:**
- Declaración y uso de arrays
- Bucle `for` clásico (iteración por índice)
- Bucle `while` (condición de parada)
- Bucle `forEach` (función de orden superior)
- Estructuras condicionales (`if` + operador módulo `%`) para filtrar posiciones pares
- Coerción implícita de tipos: `1 + "2" → "12"` (string)

---

### `lenguaje.js`
**Resultado de aprendizaje:** RA2_a

Script de Node.js que describe las capacidades de JavaScript como lenguaje frontend y guarda el resumen en un archivo `resumen.txt` usando el módulo `fs`.

```bash
node lenguaje.js
# Genera resumen.txt en el mismo directorio
```

**Conceptos cubiertos:**
- `console.log()` para describir capacidades de JavaScript
- `fs.writeFile()` para escritura asíncrona de archivos
- Importancia de JS en el frontend, ventajas frente a otros lenguajes e interacción con el DOM

---

### `variables.js`
**Resultado de aprendizaje:** RA2_b

Demuestra el uso de los tres tipos de declaración de variables y los tres grupos de operadores.

```bash
node variables.js
```

**Conceptos cubiertos:**
- `let` (ámbito de bloque, reasignable)
- `const` (ámbito de bloque, no reasignable)
- `var` (ámbito de función, evitar en código moderno)
- Operadores **aritméticos**: `+`, `-`, `*`, `/`, `%`, `**`
- Operadores **relacionales**: `>`, `<`, `==`, `===`, `!=`
- Operadores **lógicos**: `&&`, `||`, `!`

---

### `ambito.js`
**Resultado de aprendizaje:** RA2_c

Demuestra el comportamiento de los tres ámbitos de variables en JavaScript.

```bash
node ambito.js
```

**Conceptos cubiertos:**
- **Ámbito global**: variable accesible desde cualquier punto del script
- **Ámbito local** (de función): variable destruida al salir de la función
- **Ámbito de bloque**: `let`/`const` respetan los bloques `{}`
- Diferencia entre `var` (ignora bloques) y `let` (respeta bloques)

---

## 🗂️ RA2 – Objetos, Arrays y Funciones

### `tarea2.html` + `tarea2.js`
**Resultados de aprendizaje:** RA4_a · RA4_b · RA4_c · RA4_d · RA4_e · RA4_f · RA4_g · RA4_h · RA4_i · RA4_j

Ejercicio completo sobre programación orientada a objetos, validación de entradas, manipulación de arrays y patrones de diseño.

| RA | Contenido |
|---|---|
| RA4_a | Clase `Producto` con `aplicarDescuento(porcentaje)` |
| RA4_b | Función `esEnteroPositivo(n)` + prompt con validación en bucle |
| RA4_c | Colección de objetos `Libro` + función `librosMasDe300Paginas()` |
| RA4_d | Array de N números introducidos por el usuario, ordenado con `sort()` |
| RA4_e | `filter()` para obtener arrays de pares e impares |
| RA4_f | Función `ordenarEstudiantes()`: orden por promedio y desempate por edad |
| RA4_g/h | Función constructora `Smartphone` con 4 propiedades y 3 métodos |
| RA4_i | Instancia de `Smartphone` e invocación de sus métodos |
| RA4_j | Patrón Prototipo: `Smartphone.prototype.obtenDatosSmartPhone()` |

> ⚠️ Usa `prompt()` al cargarse: requiere abrirse en un navegador, no en un servidor headless.

---

## 🗂️ RA3 – Objetos del Navegador y Ventanas

### `tarea3.html` + `tarea3.js`
**Resultados de aprendizaje:** RA3_c · RA3_f · RA3_h

Página principal con encabezado, línea horizontal y el botón **"Dame la hora"** que abre la ventana emergente del reloj.

**Propiedades de la ventana emergente:**
```
width=450, height=350, top=300, left=200
```

Cada pulsación registra un `console.log` con la hora exacta en las DevTools.

---

### `reloj.html` + `reloj.js`
**Resultados de aprendizaje:** RA3_d · RA3_e · RA3_f

Ventana emergente con el reloj digital que se actualiza cada segundo.

| Método / Propiedad | Objeto | Descripción |
|---|---|---|
| `new Date()` | `Date` | Obtiene la fecha/hora actual del sistema |
| `getHours()` / `getMinutes()` / `getSeconds()` | `Date` | Extrae horas, minutos y segundos |
| `setInterval(fn, 1000)` | `Window` | Ejecuta la función de actualización cada segundo |
| `innerHTML` | `HTMLElement` | Escribe la hora formateada en el div del reloj |
| `window.close()` | `Window` | Cierra la ventana emergente al pulsar "Cerrar" |
| `padStart(2, "0")` | `String` | Formatea dígitos: `10:03:07` en lugar de `10:3:7` |

---

## 🗂️ RA5 – Validación de Formularios

### `tarea5.html` + `tarea5.js` + `tarea5.css`
**Resultados de aprendizaje:** RA5_d · RA5_f · RA5_g · RA5_h

Formulario de login con validación en tiempo real mediante **expresiones regulares**.

| Campo | Expresión regular | Restricciones |
|---|---|---|
| Usuario | `/^[a-z]{3,12}$/` | Solo minúsculas, entre 3 y 12 caracteres |
| Contraseña | `/^[A-Z][.,\-][a-z0-9]{6}$/` | 1 mayúscula + especial (`. , -`) + 6 letras/números |

**Ejemplos válidos:**
- Usuario: `carlos`, `ana`, `webmaster`
- Contraseña: `A.carbot`, `F,as14dg`, `H-951357`

**Eventos utilizados:**
- `submit` → valida el formulario al pulsar "Entrar"
- `blur` → validación en tiempo real al salir de cada campo

> Todos los eventos se asocian con `addEventListener`, nunca con atributos `onclick`/`onsubmit` en el HTML.

---

## 🗂️ RA6 – Manipulación del DOM

### `index.html` + `script.js` + `styles.css`
**Resultados de aprendizaje:** RA6_c · RA6_d · RA6_e · RA6_f · RA6_h

Separación estricta de las tres capas: contenido (HTML), aspecto (CSS) y comportamiento (JS). El HTML base no contiene IDs, clases ni atributos de evento; toda la navegación se realiza únicamente con métodos del DOM.

**Al pulsar "Generar contenido dinámico":**
1. Se crea un `<h1>` con el texto *"Encabezado dinámico"*
2. Se inserta un `<hr>` a continuación
3. Se inserta un `<div>` con un `<p>` *"Párrafo creado dinámicamente"*
4. El enlace existente se modifica → apunta a `wikipedia.org` con el texto *"Ir a Wikipedia"*

> ❌ No se usa `innerHTML` en ningún punto. Todos los nodos se crean con `createElement`, `textContent` y `appendChild` / `insertBefore`.

| Evento | Elemento | Acción |
|---|---|---|
| `DOMContentLoaded` | `document` | Log en consola + lista de nodos hijos del body |
| `click` | Botón | Genera los nodos dinámicos y modifica el enlace |

---

## 🗂️ RA7 – AJAX y Comunicación Asíncrona

### `tarea7.html` + `tarea7.js`
**Resultados de aprendizaje:** RA7_c · RA7_e · RA7_f · RA7_i

Tres implementaciones de peticiones asíncronas. La página nunca se recarga.

| Botón | Tecnología | Fuente | Resultado |
|---|---|---|---|
| Rellena la lista desplegable | `XMLHttpRequest` + XML | `cd_catalog.xml` (local) | `<select>` con artistas |
| Cargar álbumes (JSON) | `XMLHttpRequest` + JSON | JSONPlaceholder API | `<ul>` con títulos |
| Rellena con jQuery | `$.get` + XML | `cd_catalog.xml` (local) | `<select>` con artistas |

> ⚠️ **Requisito para el XML:** descarga `cd_catalog.xml` desde `https://www.w3schools.com/xml/cd_catalog.xml` y colócalo en `htdocs/` de XAMPP. Las peticiones directas están bloqueadas por CORS.

---

## 🚀 Cómo ejecutar

### Archivos Node.js (RA1)
```bash
cd RA1
node lenguaje.js
node variables.js
node ambito.js
```

### Resto de archivos (navegador)
```bash
# Con VS Code: extensión Live Server → clic derecho → "Open with Live Server"
# Con Python desde la raíz del proyecto:
python -m http.server 8080
```

### RA7 (requiere XAMPP)
1. Inicia Apache desde el panel de XAMPP
2. Copia `cd_catalog.xml` en `C:/xampp/htdocs/`
3. Abre `http://localhost/RA7/tarea7.html`

---

## 📋 Tabla resumen de Resultados de Aprendizaje

| RA | Descripción | Carpeta / Archivo |
|---|---|---|
| RA2_a | Selección del lenguaje y descripción de capacidades | `RA1/lenguaje.js` |
| RA2_b | Variables y operadores | `RA1/variables.js` |
| RA2_c | Ámbito de variables | `RA1/ambito.js` |
| RA2_d | Conversión entre tipos de datos | `RA1/tarea1.js` |
| RA2_e | Estructuras condicionales | `RA1/tarea1.js` |
| RA2_f | Bucles y verificación | `RA1/tarea1.js` |
| RA3_c | Objetos del navegador, aspecto del documento | `RA3/tarea3.html` + `tarea3.js` |
| RA3_d | Generación dinámica de texto con `innerHTML` | `RA3/reloj.js` |
| RA3_e | Interacción con el usuario, `setInterval`, `Date` | `RA3/reloj.js` |
| RA3_f | Documentos con varias ventanas | `RA3/tarea3.js` + `reloj.js` |
| RA4_a | Funciones predefinidas, clases | `RA2/tarea2.js` |
| RA4_b | Funciones definidas por el usuario | `RA2/tarea2.js` |
| RA4_c | Arrays de objetos | `RA2/tarea2.js` |
| RA4_d | Creación y uso de arrays | `RA2/tarea2.js` |
| RA4_e | Operaciones agregadas: `filter()` | `RA2/tarea2.js` |
| RA4_f | Orientación a objetos | `RA2/tarea2.js` |
| RA4_g/h/i/j | Constructores, métodos, prototipos | `RA2/tarea2.js` |
| RA5_d | Captura y uso de eventos | `RA5/tarea5.js` |
| RA5_f | Validación de formularios | `RA5/tarea5.js` |
| RA5_g | Expresiones regulares | `RA5/tarea5.js` |
| RA6_c | Acceso a la estructura del DOM | `RA6/script.js` |
| RA6_d | Creación y modificación de nodos | `RA6/script.js` |
| RA6_e | Eventos con `addEventListener` | `RA6/script.js` |
| RA6_h | Separación de capas HTML / CSS / JS | `RA6/` |
| RA7_c | XMLHttpRequest con XML | `RA7/tarea7.js` |
| RA7_e | Comunicación asíncrona | `RA7/tarea7.js` |
| RA7_f | Distintos formatos: XML y JSON | `RA7/tarea7.js` |
| RA7_i | jQuery (`$.get`) | `RA7/tarea7.js` |