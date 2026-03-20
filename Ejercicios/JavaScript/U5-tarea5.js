/**
 * @file        tarea5.js
 * @description RA5_f/g/d/h – Validación de formulario con expresiones regulares.
 *              El evento submit captura el envío y valida los campos antes
 *              de permitir el acceso.
 * @author      Carlos Vico
 */

// ─────────────────────────────────────────────────────────────────────────────
// EXPRESIONES REGULARES
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Valida el campo Usuario:
 *   - Solo letras minúsculas (a-z), sin acentos, sin números, sin espacios.
 *   - Longitud entre 3 y 12 caracteres.
 * @type {RegExp}
 */
const REGEX_USUARIO = /^[a-z]{3,12}$/;

/**
 * Valida el campo Contraseña:
 *   - 1 letra mayúscula (A-Z)
 *   - 1 carácter especial de entre: punto (.), coma (,) o guion medio (-)
 *   - 6 caracteres: letras minúsculas y/o dígitos ([a-z0-9]{6})
 * Ejemplos válidos: A.carbot, F,as14dg, H-951357
 * @type {RegExp}
 */
const REGEX_CONTRASENA = /^[A-Z][.,\-][a-z0-9]{6}$/;

// ─────────────────────────────────────────────────────────────────────────────
// REFERENCIAS AL DOM
// ─────────────────────────────────────────────────────────────────────────────

const inputUsuario      = document.getElementById("usuario");
const inputContrasena   = document.getElementById("contrasena");
const errorUsuario      = document.getElementById("error-usuario");
const errorContrasena   = document.getElementById("error-contrasena");
const sugerenciaUsuario = document.getElementById("sugerencia-usuario");
const sugerenciaCont    = document.getElementById("sugerencia-contrasena");
const mensajeExito      = document.getElementById("mensaje-exito");
const formulario        = document.getElementById("form-login");

// ─────────────────────────────────────────────────────────────────────────────
// FUNCIONES DE VALIDACIÓN
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Muestra u oculta el feedback visual de un campo.
 * @param {HTMLInputElement} input      - Campo de entrada.
 * @param {HTMLElement}      spanError  - Span donde se muestra el error.
 * @param {HTMLElement}      spanSuger  - Span donde se muestra la sugerencia.
 * @param {string|null}      mensajeErr - Texto del error, o null si es válido.
 * @param {string}           sugerencia - Texto de ayuda al usuario.
 */
function setFeedback(input, spanError, spanSuger, mensajeErr, sugerencia) {
  if (mensajeErr) {
    input.classList.add("invalido");
    input.classList.remove("valido");
    spanError.textContent = mensajeErr;
    spanSuger.textContent = sugerencia;
  } else {
    input.classList.add("valido");
    input.classList.remove("invalido");
    spanError.textContent = "";
    spanSuger.textContent = "";
  }
}

/**
 * Valida el campo usuario contra REGEX_USUARIO.
 * Distingue entre campo vacío y formato incorrecto para dar mensajes precisos.
 * @returns {boolean} true si es válido.
 */
function validarUsuario() {
  const valor = inputUsuario.value;

  if (valor.trim() === "") {
    setFeedback(
      inputUsuario, errorUsuario, sugerenciaUsuario,
      "El campo usuario no puede estar vacío.",
      "Sugerencia: introduce entre 3 y 12 letras minúsculas. Ej: carlos"
    );
    return false;
  }

  if (!REGEX_USUARIO.test(valor)) {
    setFeedback(
      inputUsuario, errorUsuario, sugerenciaUsuario,
      "Usuario inválido: solo letras minúsculas (a-z), entre 3 y 12 caracteres.",
      "Sugerencia válida: carlos, ana, webmaster"
    );
    return false;
  }

  setFeedback(inputUsuario, errorUsuario, sugerenciaUsuario, null, "");
  return true;
}

/**
 * Valida el campo contraseña contra REGEX_CONTRASENA.
 * @returns {boolean} true si es válida.
 */
function validarContrasena() {
  const valor = inputContrasena.value;

  if (valor.trim() === "") {
    setFeedback(
      inputContrasena, errorContrasena, sugerenciaCont,
      "El campo contraseña no puede estar vacío.",
      "Sugerencia: Mayúscula + especial(.,- ) + 6 letras/números. Ej: A.carbot"
    );
    return false;
  }

  if (!REGEX_CONTRASENA.test(valor)) {
    setFeedback(
      inputContrasena, errorContrasena, sugerenciaCont,
      "Contraseña inválida: debe seguir el formato [Mayúscula][.,−][6 letras/números].",
      "Ejemplos válidos: A.carbot  |  F,as14dg  |  H-951357"
    );
    return false;
  }

  setFeedback(inputContrasena, errorContrasena, sugerenciaCont, null, "");
  return true;
}

// ─────────────────────────────────────────────────────────────────────────────
// RA5_d – Evento submit: captura el envío del formulario y valida
// ─────────────────────────────────────────────────────────────────────────────

formulario.addEventListener("submit", (evento) => {
  // Prevenimos el envío real del formulario mientras validamos
  evento.preventDefault();

  const usuarioValido    = validarUsuario();
  const contrasenaValida = validarContrasena();

  if (usuarioValido && contrasenaValida) {
    // Ambos campos son correctos: mostramos mensaje de éxito
    mensajeExito.hidden = false;
    console.log("✅ Formulario válido – usuario:", inputUsuario.value);
  } else {
    mensajeExito.hidden = true;
  }
});

// Validación en tiempo real al salir de cada campo (mejora UX)
inputUsuario.addEventListener("blur", validarUsuario);
inputContrasena.addEventListener("blur", validarContrasena);
