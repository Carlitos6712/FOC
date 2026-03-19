/**
 * @file ejercicio3-app.js
 * @description Ejercicio 3 - Importar y usar el módulo operaciones.js
 * @author Carlos Vico
 */

// Importamos el módulo propio con ruta relativa (./)
const { sumar, multiplicar } = require("./operaciones");

// Mostramos los resultados de las operaciones
console.log(`5 + 3 = ${sumar(5, 3)}`);
console.log(`5 * 3 = ${multiplicar(5, 3)}`);
