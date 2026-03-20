/**
 * @file        variables.js
 * @description RA02_b – Declaración de variables y uso de operadores
 *              aritméticos, relacionales y lógicos.
 * @author      Carlos Vico
 */

// ─────────────────────────────────────────────────────────────────────────────
// DECLARACIÓN DE VARIABLES
// let   → bloque, reasignable
// const → bloque, no reasignable (valor constante)
// var   → función/global, evitar en código moderno (se incluye por el ejercicio)
// ─────────────────────────────────────────────────────────────────────────────

let   numero1   = 5;
const numero2   = 10;
var   resultado;          // var queda disponible en todo el ámbito de función

// ─────────────────────────────────────────────────────────────────────────────
// OPERADORES ARITMÉTICOS
// ─────────────────────────────────────────────────────────────────────────────

resultado = numero1 + numero2;
console.log("Suma:",           numero1, "+",  numero2, "=", resultado);  // 15

resultado = numero2 - numero1;
console.log("Resta:",          numero2, "-",  numero1, "=", resultado);  // 5

resultado = numero1 * numero2;
console.log("Multiplicación:", numero1, "×",  numero2, "=", resultado);  // 50

resultado = numero2 / numero1;
console.log("División:",       numero2, "/",  numero1, "=", resultado);  // 2

resultado = numero2 % numero1;
console.log("Módulo:",         numero2, "%",  numero1, "=", resultado);  // 0

resultado = numero1 ** 2;
console.log("Potencia:",       numero1, "²  =", resultado);              // 25

// ─────────────────────────────────────────────────────────────────────────────
// OPERADORES RELACIONALES
// Devuelven boolean (true/false)
// ─────────────────────────────────────────────────────────────────────────────

console.log("¿Es número1 mayor que número2?",       numero1 >  numero2);  // false
console.log("¿Es número1 menor que número2?",       numero1 <  numero2);  // true
console.log("¿Son iguales? (==)",                   numero1 == numero2);  // false
console.log("¿Son estrictamente iguales? (===)",    numero1 === numero2); // false
console.log("¿Son distintos? (!=)",                 numero1 != numero2);  // true

// ─────────────────────────────────────────────────────────────────────────────
// OPERADORES LÓGICOS
// && → AND: ambas condiciones deben ser true
// || → OR:  al menos una condición debe ser true
// !  → NOT: invierte el valor booleano
// ─────────────────────────────────────────────────────────────────────────────

console.log(
  "¿Es número1 mayor que 3 y número2 menor que 15?",
  numero1 > 3 && numero2 < 15   // true && true → true
);

console.log(
  "¿Es número1 mayor que 10 o número2 mayor que 8?",
  numero1 > 10 || numero2 > 8   // false || true → true
);

console.log(
  "¿NO es número1 igual a número2?",
  !(numero1 === numero2)         // !(false) → true
);
