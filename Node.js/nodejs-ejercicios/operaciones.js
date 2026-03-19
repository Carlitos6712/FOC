/**
 * @file operaciones.js
 * @description Ejercicio 3 - Módulo con operaciones matemáticas básicas
 * @author Carlos Vico
 */

/**
 * Suma dos números.
 * @param {number} a - Primer operando
 * @param {number} b - Segundo operando
 * @returns {number} Resultado de la suma
 */
const sumar = (a, b) => a + b;

/**
 * Multiplica dos números.
 * @param {number} a - Primer operando
 * @param {number} b - Segundo operando
 * @returns {number} Resultado de la multiplicación
 */
const multiplicar = (a, b) => a * b;

// Exportamos las funciones para que otros archivos puedan usarlas
module.exports = { sumar, multiplicar };
