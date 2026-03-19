/**
 * @file ejercicio2-leer-archivo.js
 * @description Ejercicio 2 - Uso del módulo fs para leer un archivo
 * @author Carlos Vico
 */

// fs es un módulo nativo de Node.js, no necesita instalación
const fs = require("fs");

/**
 * Lee el contenido de texto.txt y lo muestra en consola.
 * Se usa la versión asíncrona para no bloquear el hilo principal.
 */
fs.readFile("texto.txt", "utf8", (error, contenido) => {
  // Manejo centralizado del error: siempre informamos si algo falla
  if (error) {
    console.error("Error al leer el archivo:", error.message);
    return;
  }

  console.log("Contenido del archivo:");
  console.log(contenido);
});
