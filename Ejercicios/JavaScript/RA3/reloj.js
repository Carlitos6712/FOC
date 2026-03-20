/**
 * @file        reloj.js
 * @description RA3_e – Reloj digital que se actualiza cada segundo.
 *              Métodos utilizados:
 *                - new Date()          → objeto predefinido Date (unidad 3, apdo. 3.2)
 *                - getHours/Minutes/Seconds → métodos de Date para obtener la hora
 *                - setInterval()       → temporizador del objeto Window (unidad 3, apdo. 3.1)
 *                - innerHTML           → propiedad del objeto Element/HTMLElement (unidad 3, apdo. 3.4)
 *                - window.close()      → método del objeto Window (unidad 3, apdo. 3.1)
 * @author      Carlos Vico
 */

/**
 * Formatea un número a dos dígitos añadiendo un cero a la izquierda si es necesario.
 * Así evitamos mostrar "10:3:7" en lugar de "10:03:07".
 * @param {number} num - Número a formatear.
 * @returns {string} Número con al menos dos dígitos.
 */
function dosDigitos(num) {
  // padStart rellena con "0" por la izquierda hasta alcanzar longitud 2
  return String(num).padStart(2, "0");
}

/**
 * Lee la hora actual del sistema y la muestra en la pantalla del reloj.
 * Se invoca cada segundo mediante setInterval().
 */
function actualizarReloj() {
  const ahora    = new Date();               // Objeto Date con la hora actual
  const horas    = dosDigitos(ahora.getHours());
  const minutos  = dosDigitos(ahora.getMinutes());
  const segundos = dosDigitos(ahora.getSeconds());

  // RA3_d – Escribimos la hora en el DOM usando innerHTML
  document.getElementById("pantalla-reloj").innerHTML =
    `${horas}:${minutos}:${segundos}`;
}

// Llamamos inmediatamente para evitar el retraso del primer segundo
actualizarReloj();

// RA3_e – setInterval ejecuta actualizarReloj cada 1000ms (1 segundo)
setInterval(actualizarReloj, 1000);

// RA3_f – Botón "Cerrar" cierra la ventana emergente actual
document.getElementById("btn-cerrar").addEventListener("click", () => {
  window.close();
});
