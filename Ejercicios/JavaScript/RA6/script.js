/**
 * @file        script.js
 * @description RA6 – Manipulación del DOM, eventos y separación de capas.
 *              Se navega por el DOM únicamente con métodos nativos,
 *              sin añadir IDs ni clases al HTML original.
 * @author      Carlos Vico
 */

// ─────────────────────────────────────────────────────────────────────────────
// RA6_e – Evento DOMContentLoaded
// Se dispara cuando el árbol DOM está completamente construido.
// ─────────────────────────────────────────────────────────────────────────────

document.addEventListener("DOMContentLoaded", () => {
  console.log("El árbol DOM está completamente cargado y listo para manipularse.");

  // Mostramos los nodos hijos del body en consola
  console.log("Nodos hijos del body:", document.body.childNodes);

  // ─────────────────────────────────────────────────────────────────────────
  // Referencias obtenidas SOLO por navegación DOM (sin IDs ni clases nuevas)
  // ─────────────────────────────────────────────────────────────────────────

  /**
   * Obtenemos el botón: primer elemento <button> del body.
   * Usamos querySelector porque es el único button del documento.
   */
  const boton  = document.querySelector("button");

  /**
   * Obtenemos el enlace: primer (y único) <a> del documento.
   */
  const enlace = document.querySelector("a");

  // ─────────────────────────────────────────────────────────────────────────
  // RA6_e – Evento click sobre el botón
  // ─────────────────────────────────────────────────────────────────────────

  boton.addEventListener("click", () => generarContenidoDinamico(boton, enlace));
});

// ─────────────────────────────────────────────────────────────────────────────
// RA6_d – Crear y modificar nodos dinámicamente
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Genera los nodos dinámicos y modifica el enlace existente.
 * Los nodos se insertan ENCIMA del botón (antes de él en el DOM).
 * No se permite innerHTML; todo se crea con métodos del DOM.
 *
 * @param {HTMLButtonElement} boton  - Referencia al botón del documento.
 * @param {HTMLAnchorElement} enlace - Referencia al enlace a modificar.
 */
function generarContenidoDinamico(boton, enlace) {
  // Evitamos que el contenido se genere más de una vez
  if (document.querySelector("h1")) {
    console.warn("El contenido ya fue generado.");
    return;
  }

  // A1) Crear <h1> con texto "Encabezado dinámico"
  const h1 = document.createElement("h1");
  h1.textContent = "Encabezado dinámico";

  // A2) Crear <hr> inmediatamente después del h1
  const hr = document.createElement("hr");

  // A3) Crear <div> que contiene un <p> con texto
  const div = document.createElement("div");
  const p   = document.createElement("p");
  p.textContent = "Párrafo creado dinámicamente";
  div.appendChild(p);

  // Insertamos h1, hr y div ANTES del botón (encima en el documento)
  // insertBefore(nuevoNodo, nodoDeReferencia) coloca nuevoNodo antes del de referencia
  document.body.insertBefore(h1,  boton);
  document.body.insertBefore(hr,  boton);
  document.body.insertBefore(div, boton);

  // B) Modificar el enlace existente: href y texto visible
  enlace.setAttribute("href", "https://www.wikipedia.org");
  enlace.textContent = "Ir a Wikipedia";

  console.log("Contenido dinámico generado correctamente.");
}
