/**
 * @file        lenguaje.js
 * @description RA02_a – Descripción de JavaScript como lenguaje frontend.
 *              Escribe un resumen en resumen.txt usando el módulo fs de Node.js.
 * @author      Carlos Vico
 */

const fs = require("fs");

// Descripción completa de las capacidades de JavaScript en el frontend
const resumen = `
JavaScript es esencial para el desarrollo frontend porque:

1. IMPORTANCIA EN EL FRONTEND
   - Es el único lenguaje de programación que los navegadores ejecutan de forma nativa.
   - Permite crear interfaces interactivas sin recargar la página (SPA, AJAX).
   - Da vida a los elementos HTML/CSS respondiendo a eventos del usuario.

2. VENTAJAS FRENTE A OTROS LENGUAJES PARA LA WEB
   - Ejecución en el cliente: reduce la carga del servidor.
   - Ecosistema enorme: npm cuenta con más de 2 millones de paquetes.
   - Lenguaje full-stack: con Node.js también se usa en backend.
   - Sin compilación previa: el navegador interpreta el código directamente.
   - Tipado dinámico: desarrollo ágil para prototipos y proyectos pequeños.

3. INTERACCIÓN CON EL DOM (Document Object Model)
   - El DOM representa el documento HTML como un árbol de nodos.
   - JavaScript accede a él mediante document.getElementById(), querySelector(), etc.
   - Permite crear, modificar y eliminar nodos en tiempo real.
   - Los eventos (click, input, keydown…) conectan acciones del usuario con funciones JS.
   - Ejemplo básico: document.getElementById("titulo").textContent = "Hola Mundo";
`.trim();

// Mostramos el resumen por consola antes de guardarlo
console.log("=== RESUMEN DE JAVASCRIPT ===");
console.log(resumen);

// Guardamos el contenido en resumen.txt de forma asíncrona
fs.writeFile("resumen.txt", resumen, "utf8", (err) => {
  if (err) {
    // Propagamos el error para que no quede silenciado
    throw new Error(`Error al guardar resumen.txt: ${err.message}`);
  }
  console.log("✅ El archivo resumen.txt ha sido guardado correctamente.");
});
