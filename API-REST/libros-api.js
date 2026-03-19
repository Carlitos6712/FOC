/**
 * @fileoverview API REST - Gestión de Libros
 * @author Carlos Vico
 * @description Implementación completa de CRUD para libros con validaciones,
 *              filtrado por autor y respuestas JSON estándar.
 *
 * Ejecutar: node libros-api.js
 * Base URL: http://localhost:3000
 */

const express = require("express");
const app = express();

app.use(express.json());

// ─────────────────────────────────────────────
// "Base de datos" en memoria (simulada)
// En producción, reemplazar por ORM + DB real
// ─────────────────────────────────────────────
let libros = [
  { id: 1, titulo: "Don Quijote de la Mancha", autor: "Cervantes", anio: 1605 },
  { id: 2, titulo: "Cien años de soledad",    autor: "García Márquez", anio: 1967 },
  { id: 3, titulo: "La Celestina",             autor: "Rojas",       anio: 1499 + 1 },
];

/** @type {number} Contador autoincremental de IDs */
let nextId = 4;

// ─────────────────────────────────────────────
// HELPERS
// ─────────────────────────────────────────────

/**
 * Genera una respuesta JSON estándar.
 * @param {boolean} success - Indica si la operación fue exitosa.
 * @param {*}       data    - Payload de respuesta.
 * @param {string}  message - Mensaje descriptivo.
 * @returns {{ success: boolean, data: *, message: string }}
 */
const jsonResponse = (success, data, message) => ({ success, data, message });

/**
 * Valida el cuerpo de un libro entrante.
 * Centraliza las reglas de negocio de validación.
 * @param {{ titulo?: string, autor?: string, anio?: number }} body
 * @returns {{ valid: boolean, errors: string[] }}
 */
const validarLibro = ({ titulo, autor, anio }) => {
  const errors = [];

  // Regla: título no puede ser vacío ni solo espacios
  if (!titulo || String(titulo).trim() === "") {
    errors.push("El campo 'titulo' es obligatorio y no puede estar vacío.");
  }

  if (!autor || String(autor).trim() === "") {
    errors.push("El campo 'autor' es obligatorio.");
  }

  // Regla de negocio: libros anteriores a 1500 están fuera de alcance
  if (anio === undefined || anio === null) {
    errors.push("El campo 'anio' es obligatorio.");
  } else if (!Number.isInteger(anio) || anio <= 1500) {
    errors.push("El campo 'anio' debe ser un número entero mayor que 1500.");
  }

  return { valid: errors.length === 0, errors };
};

// ─────────────────────────────────────────────
// RUTAS
// ─────────────────────────────────────────────

/**
 * GET /libros
 * Lista todos los libros. Soporta filtrado opcional por ?autor=
 * @query {string} [autor] - Filtra libros cuyo autor contenga este valor (case-insensitive)
 */
app.get("/libros", (req, res) => {
  const { autor } = req.query;

  // Si se proporciona ?autor=, filtramos sin distinguir mayúsculas
  const resultado = autor
    ? libros.filter((l) =>
        l.autor.toLowerCase().includes(autor.toLowerCase())
      )
    : libros;

  return res
    .status(200)
    .json(jsonResponse(true, resultado, `${resultado.length} libro(s) encontrado(s).`));
});

/**
 * GET /libros/:id
 * Devuelve un libro específico por su ID.
 * @param {string} id - ID numérico del libro
 */
app.get("/libros/:id", (req, res) => {
  const id = parseInt(req.params.id, 10);
  const libro = libros.find((l) => l.id === id);

  if (!libro) {
    return res
      .status(404)
      .json(jsonResponse(false, null, `No se encontró ningún libro con id=${id}.`));
  }

  return res.status(200).json(jsonResponse(true, libro, "Libro encontrado."));
});

/**
 * POST /libros
 * Crea un nuevo libro con los datos del body.
 * @body {{ titulo: string, autor: string, anio: number }}
 */
app.post("/libros", (req, res) => {
  const { titulo, autor, anio } = req.body;
  const { valid, errors } = validarLibro({ titulo, autor, anio });

  if (!valid) {
    return res
      .status(422) // Unprocessable Entity: datos recibidos pero no válidos
      .json(jsonResponse(false, { errors }, "Validación fallida."));
  }

  const nuevoLibro = {
    id: nextId++,
    titulo: titulo.trim(),
    autor: autor.trim(),
    anio,
  };

  libros.push(nuevoLibro);

  return res
    .status(201) // Created
    .json(jsonResponse(true, nuevoLibro, "Libro creado correctamente."));
});

/**
 * PUT /libros/:id
 * Reemplaza completamente un libro existente.
 * @param {string} id - ID del libro a actualizar
 * @body {{ titulo: string, autor: string, anio: number }}
 */
app.put("/libros/:id", (req, res) => {
  const id = parseInt(req.params.id, 10);
  const index = libros.findIndex((l) => l.id === id);

  if (index === -1) {
    return res
      .status(404)
      .json(jsonResponse(false, null, `No se encontró ningún libro con id=${id}.`));
  }

  const { titulo, autor, anio } = req.body;
  const { valid, errors } = validarLibro({ titulo, autor, anio });

  if (!valid) {
    return res
      .status(422)
      .json(jsonResponse(false, { errors }, "Validación fallida."));
  }

  // Reemplazamos preservando el ID original
  libros[index] = { id, titulo: titulo.trim(), autor: autor.trim(), anio };

  return res
    .status(200)
    .json(jsonResponse(true, libros[index], "Libro actualizado correctamente."));
});

/**
 * DELETE /libros/:id
 * Elimina un libro de la colección.
 * @param {string} id - ID del libro a eliminar
 */
app.delete("/libros/:id", (req, res) => {
  const id = parseInt(req.params.id, 10);
  const index = libros.findIndex((l) => l.id === id);

  if (index === -1) {
    return res
      .status(404)
      .json(jsonResponse(false, null, `No se encontró ningún libro con id=${id}.`));
  }

  const [libroEliminado] = libros.splice(index, 1);

  return res
    .status(200)
    .json(jsonResponse(true, libroEliminado, "Libro eliminado correctamente."));
});

// ─────────────────────────────────────────────
// Manejo centralizado de errores
// Captura cualquier error no controlado de los handlers
// ─────────────────────────────────────────────
app.use((err, req, res, _next) => {
  console.error("[ERROR]", err.message);
  return res
    .status(500)
    .json(jsonResponse(false, null, "Error interno del servidor."));
});

// ─────────────────────────────────────────────
// Arranque del servidor
// ─────────────────────────────────────────────
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`📚 API Libros escuchando en http://localhost:${PORT}`);
});

module.exports = app; // Exportamos para poder hacer tests unitarios
