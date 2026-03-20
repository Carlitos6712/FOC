/**
 * @file        tarea3.js
 * @description RA3 – Lógica del botón "Dame la hora": abre la ventana
 *              emergente reloj.html con las dimensiones especificadas.
 * @author      Carlos Vico
 */

/**
 * Abre la ventana emergente con el reloj digital.
 * Propiedades de la ventana según el enunciado:
 *   - width:  450px
 *   - height: 350px
 *   - top:    300px (desde el borde superior de la pantalla)
 *   - left:   200px (desde el borde izquierdo de la pantalla)
 */
function abrirReloj() {
  // RA3_h – Log por consola cada vez que se pulsa el botón
  console.log("Botón 'Dame la hora' pulsado –", new Date().toLocaleTimeString());

  // window.open() permite especificar las características de la ventana emergente
  window.open(
    "reloj.html",           // documento a abrir
    "relojDigital",         // nombre de la ventana (permite reutilizarla)
    "width=450,height=350,top=300,left=200"
  );
}

// RA3_f / RA3_e – Asociamos el evento al botón cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("btn-hora").addEventListener("click", abrirReloj);
});
