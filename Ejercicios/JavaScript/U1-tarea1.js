/**
 * @file        tarea1.js
 * @description Ejercicios RA2: arrays, bucles, tipos de datos y condicionales.
 * @author      Carlos Vico
 */

// ─────────────────────────────────────────────────────────────────────────────
// DATOS
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Ficha personal del alumno.
 * Cada índice se corresponde 1:1 con el array de etiquetas.
 */
const fichAlumno = [
  "Carlos",
  "Vico",
  "García",
  "12345678A",
  "DWEC",
  "Desarrollo de Aplicaciones Web",
  "FOC",
];

/** Etiquetas descriptivas para cada campo de fichAlumno */
const etiquetas = [
  "Nombre",
  "Apellido 1",
  "Apellido 2",
  "DNI",
  "Módulo",
  "Ciclo",
  "Centro",
];

// ─────────────────────────────────────────────────────────────────────────────
// HELPERS
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Construye un string "<etiqueta>: <valor>" para el índice dado.
 * @param {number} i - Índice del par etiqueta/valor.
 * @returns {string}
 */
function crearLineaFicha(i) {
  return `${etiquetas[i]}: ${fichAlumno[i]}`;
}

/**
 * Inyecta un párrafo <p> en el contenedor indicado.
 * @param {string} contenedorId - ID del elemento HTML destino.
 * @param {string} texto        - Texto del párrafo.
 */
function agregarParrafo(contenedorId, texto) {
  const p = document.createElement("p");
  p.textContent = texto;
  document.getElementById(contenedorId).appendChild(p);
}

// ─────────────────────────────────────────────────────────────────────────────
// RA2_f – Tres tipos de bucle distintos
// ─────────────────────────────────────────────────────────────────────────────

/** Muestra la ficha usando un bucle for clásico */
function mostrarConFor() {
  // Iteramos por índice; útil cuando necesitamos el índice explícito
  for (let i = 0; i < etiquetas.length; i++) {
    agregarParrafo("resultado-for", crearLineaFicha(i));
  }
}

/** Muestra la ficha usando un bucle while */
function mostrarConWhile() {
  let i = 0;
  // Mientras haya posiciones sin recorrer seguimos iterando
  while (i < etiquetas.length) {
    agregarParrafo("resultado-while", crearLineaFicha(i));
    i++;
  }
}

/** Muestra la ficha usando forEach (función de orden superior) */
function mostrarConForEach() {
  // forEach itera sobre cada elemento del array sin necesidad de índice manual
  etiquetas.forEach((etiqueta, i) => {
    agregarParrafo("resultado-foreach", `${etiqueta}: ${fichAlumno[i]}`);
  });
}

// Ejecutamos los tres bucles
mostrarConFor();
mostrarConWhile();
mostrarConForEach();

// ─────────────────────────────────────────────────────────────────────────────
// RA2_d – Conversión de tipos: 1 + "2"
// ─────────────────────────────────────────────────────────────────────────────

/**
 * JavaScript convierte el número 1 a string cuando lo concatena con "2".
 * El resultado es "12" (string), no 3 (number).
 * Esto se llama coerción de tipos implícita.
 */
const valorConversion = 1 + "2";
const tipoConversion   = typeof valorConversion;

fichAlumno.push(valorConversion);
etiquetas.push("1 + '2'");

document.getElementById("resultado-tipo").textContent =
  `1 + "2" = "${valorConversion}" → tipo: ${tipoConversion}` +
  ` (JavaScript convierte el número a string por coerción implícita)`;

// ─────────────────────────────────────────────────────────────────────────────
// RA2_e – Mostrar solo posiciones pares usando condicional
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Recorre ambos arrays y muestra únicamente los índices pares (0, 2, 4, 6…).
 * Se usa el operador módulo (%) para determinar si el índice es par.
 */
function mostrarPosicionesPares() {
  for (let i = 0; i < etiquetas.length; i++) {
    // Solo procesamos si el índice es divisible entre 2
    if (i % 2 === 0) {
      agregarParrafo("resultado-pares", crearLineaFicha(i));
    }
  }
}

mostrarPosicionesPares();
