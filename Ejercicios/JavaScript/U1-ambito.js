/**
 * @file        ambito.js
 * @description RA02_c – Demostración de ámbitos de variables:
 *              global, local (función) y bloque.
 * @author      Carlos Vico
 */

// ─────────────────────────────────────────────────────────────────────────────
// ÁMBITO GLOBAL
// Accesible desde cualquier punto del script, incluyendo dentro de funciones.
// ─────────────────────────────────────────────────────────────────────────────

let globalVar = "Soy global";
console.log("Global (fuera de función):", globalVar);

// ─────────────────────────────────────────────────────────────────────────────
// ÁMBITO LOCAL (de función)
// Las variables declaradas con let/const dentro de una función
// solo existen mientras esa función se ejecuta.
// ─────────────────────────────────────────────────────────────────────────────

function demostrarAmbitoLocal() {
  // localVar solo existe dentro de esta función
  let localVar = "Soy local";
  console.log("Local (dentro de función):", localVar);
  // También podemos acceder a la variable global desde aquí
  console.log("Global vista desde función:", globalVar);
}

demostrarAmbitoLocal();

// Intentar acceder a localVar aquí lanzaría:
// ReferenceError: localVar is not defined
// console.log(localVar); // ← DESCOMENTA PARA VER EL ERROR

// ─────────────────────────────────────────────────────────────────────────────
// ÁMBITO DE BLOQUE
// let y const respetan los bloques delimitados por {}.
// var NO respeta bloques (solo función), por eso se prefiere let/const.
// ─────────────────────────────────────────────────────────────────────────────

function miBloque() {
  console.log("Dentro de miBloque:");

  if (true) {
    // bloqueVar solo existe dentro de este bloque if
    let bloqueVar = "Soy del bloque";
    console.log("  Dentro del bloque:", bloqueVar);
  }

  // Fuera del bloque, bloqueVar ya no existe
  // console.log(bloqueVar); // ← DESCOMENTA PARA VER EL ERROR
  console.log("  Fuera del bloque: bloqueVar ya no es accesible");
}

miBloque();

// ─────────────────────────────────────────────────────────────────────────────
// COMPARATIVA var vs let en bloques
// var ignora el bloque {} y queda disponible en toda la función
// ─────────────────────────────────────────────────────────────────────────────

function comparativaVarLet() {
  if (true) {
    var  conVar = "var ignora el bloque";
    let  conLet = "let respeta el bloque";
  }

  // var sí es accesible fuera del bloque (comportamiento problemático)
  console.log("var fuera del bloque:", conVar);

  // let lanzaría ReferenceError fuera del bloque
  // console.log("let fuera del bloque:", conLet); // ← ERROR
}

comparativaVarLet();
