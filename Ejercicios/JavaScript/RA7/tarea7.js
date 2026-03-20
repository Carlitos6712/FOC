/**
 * @file        tarea7.js
 * @description RA7 – Comunicación asíncrona con XMLHttpRequest (XML y JSON)
 *              y jQuery ($.get). La página no se recarga en ningún momento;
 *              todo el contenido se inserta dinámicamente en el DOM.
 * @author      Carlos Vico
 */

// ─────────────────────────────────────────────────────────────────────────────
// CONSTANTES DE CONFIGURACIÓN
// Las URLs se centralizan aquí para facilitar el mantenimiento.
// El XML debe estar en htdocs del servidor local (XAMPP/LAMPP) por CORS.
// ─────────────────────────────────────────────────────────────────────────────

/** Ruta local al catálogo XML (cd_catalog.xml en htdocs de XAMPP) */
const URL_XML  = "http://localhost/cd_catalog.xml";

/** Endpoint JSON con lista de álbumes (JSONPlaceholder) */
const URL_JSON = "https://jsonplaceholder.typicode.com/albums";

// ─────────────────────────────────────────────────────────────────────────────
// HELPERS
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Crea y devuelve un objeto XMLHttpRequest preconfigurado.
 * Centraliza la creación para no repetir el manejo de errores.
 * @returns {XMLHttpRequest}
 */
function crearXHR() {
  return new XMLHttpRequest();
}

/**
 * Limpia todas las opciones de un <select> excepto la primera (placeholder).
 * Permite volver a cargar el contenido pulsando el botón repetidamente.
 * @param {HTMLSelectElement} selectEl - Elemento select a limpiar.
 */
function limpiarSelect(selectEl) {
  // Eliminamos todas las opciones salvo la de placeholder (índice 0)
  while (selectEl.options.length > 1) {
    selectEl.remove(1);
  }
}

/**
 * Añade una opción al select sin usar innerHTML.
 * @param {HTMLSelectElement} selectEl - Select destino.
 * @param {string}            texto    - Texto visible de la opción.
 * @param {string}            valor    - Valor del atributo value.
 */
function agregarOpcion(selectEl, texto, valor) {
  const opcion   = document.createElement("option");
  opcion.value   = valor;
  opcion.textContent = texto;
  selectEl.appendChild(opcion);
}

// ─────────────────────────────────────────────────────────────────────────────
// RA7_c / RA7_e – XMLHttpRequest con XML
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Realiza una petición asíncrona al archivo cd_catalog.xml,
 * extrae las etiquetas <ARTIST> y rellena el <select> con ellas.
 * Solo se permite XMLHttpRequest (sin fetch ni jQuery en esta función).
 */
function cargarArtistasXML() {
  const selectArtistas = document.getElementById("select-artistas");
  limpiarSelect(selectArtistas);

  const xhr = crearXHR();

  // Abrimos la petición GET de forma asíncrona (tercer argumento true)
  xhr.open("GET", URL_XML, true);

  /**
   * onload se dispara cuando la respuesta llega completamente.
   * Comprobamos el status para detectar errores HTTP (404, 500, etc.).
   */
  xhr.onload = function () {
    if (xhr.status !== 200) {
      console.error(`Error HTTP ${xhr.status} al cargar el XML.`);
      return;
    }

    // xhr.responseXML parsea automáticamente el XML en un objeto Document
    const xmlDoc   = xhr.responseXML;
    const artistas = xmlDoc.getElementsByTagName("ARTIST");

    console.log(`XML recibido: ${artistas.length} artistas encontrados.`);

    // Recorremos los nodos <ARTIST> e insertamos una opción por cada uno
    for (let i = 0; i < artistas.length; i++) {
      // textContent extrae el texto del nodo (no usar innerHTML con datos XML)
      const nombreArtista = artistas[i].textContent;
      agregarOpcion(selectArtistas, nombreArtista, nombreArtista);
    }
  };

  /** onerror captura fallos de red (sin conexión, CORS bloqueado, etc.) */
  xhr.onerror = function () {
    console.error("Error de red al cargar cd_catalog.xml. Comprueba que XAMPP está activo.");
  };

  // Enviamos la petición (sin cuerpo, ya que es GET)
  xhr.send();
}

// ─────────────────────────────────────────────────────────────────────────────
// RA7_f – XMLHttpRequest con JSON
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Realiza una petición asíncrona a la API de JSONPlaceholder,
 * procesa la respuesta JSON y muestra los títulos en una lista <ul>.
 */
function cargarAlbumesJSON() {
  const listaAlbumes = document.getElementById("lista-albumes");

  // Limpiamos la lista antes de cargar por si se pulsa el botón varias veces
  while (listaAlbumes.firstChild) {
    listaAlbumes.removeChild(listaAlbumes.firstChild);
  }

  const xhr = crearXHR();
  xhr.open("GET", URL_JSON, true);

  // Indicamos al servidor que esperamos JSON (buena práctica aunque no obligatorio)
  xhr.setRequestHeader("Accept", "application/json");

  xhr.onload = function () {
    if (xhr.status !== 200) {
      console.error(`Error HTTP ${xhr.status} al cargar el JSON.`);
      return;
    }

    /**
     * JSON.parse convierte el string de respuesta en un array de objetos.
     * Cada objeto tiene: { userId, id, title }
     */
    const albumes = JSON.parse(xhr.responseText);

    console.log(`JSON recibido: ${albumes.length} álbumes.`);

    // Mostramos solo los 20 primeros para no saturar el DOM
    albumes.slice(0, 20).forEach((album) => {
      const li = document.createElement("li");
      li.textContent = album.title;
      listaAlbumes.appendChild(li);
    });
  };

  xhr.onerror = function () {
    console.error("Error de red al cargar álbumes JSON.");
  };

  xhr.send();
}

// ─────────────────────────────────────────────────────────────────────────────
// RA7_i – Segunda versión con jQuery ($.get)
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Versión jQuery de la carga del catálogo XML.
 * $.get() realiza la petición GET y llama al callback cuando recibe la respuesta.
 * jQuery gestiona internamente el XMLHttpRequest y el parseo del XML.
 */
function cargarArtistasJQuery() {
  const selectJQuery = document.getElementById("select-artistas-jquery");
  limpiarSelect(selectJQuery);

  $.get(URL_XML, function (data) {
    // 'data' ya es un objeto XML parseado (jQuery lo detecta por Content-Type)
    const artistas = $(data).find("ARTIST");

    console.log(`[jQuery] XML recibido: ${artistas.length} artistas encontrados.`);

    artistas.each(function () {
      // $(this).text() equivale a textContent en el nodo actual
      const nombreArtista = $(this).text();
      agregarOpcion(selectJQuery, nombreArtista, nombreArtista);
    });
  })
  .fail(function (jqXHR, textStatus) {
    // .fail() captura errores HTTP y de red de forma encadenada
    console.error(`[jQuery] Error al cargar el XML: ${textStatus}`);
  });
}

// ─────────────────────────────────────────────────────────────────────────────
// ASOCIACIÓN DE EVENTOS (addEventListener, nunca atributos HTML onclick)
// ─────────────────────────────────────────────────────────────────────────────

document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("btn-xml")
    .addEventListener("click", cargarArtistasXML);

  document.getElementById("btn-json")
    .addEventListener("click", cargarAlbumesJSON);

  document.getElementById("btn-jquery")
    .addEventListener("click", cargarArtistasJQuery);
});
