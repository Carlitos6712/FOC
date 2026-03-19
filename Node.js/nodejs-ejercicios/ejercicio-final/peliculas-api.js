/**
 * @file peliculas-api.js
 * @description Ejercicio Final - API REST para gestionar peliculas con Node.js y Express
 * @author Carlos Vico
 */

const express = require("express");

const app = express();
const PUERTO = 3000;

app.use(express.json());

// ─────────────────────────────────────────────
// DATOS EN MEMORIA
// ─────────────────────────────────────────────

let peliculas = [
  { id: 1, titulo: "El Padrino",       director: "Francis Ford Coppola", anio: 1972 },
  { id: 2, titulo: "Pulp Fiction",     director: "Quentin Tarantino",    anio: 1994 },
  { id: 3, titulo: "El Gran Lebowski", director: "Joel Coen",            anio: 1998 },
];

let siguienteId = 4;

// ─────────────────────────────────────────────
// HELPERS
// ─────────────────────────────────────────────

/**
 * Busca una pelicula por su ID.
 * @param {number} id
 * @returns {Object|undefined}
 */
const buscarPeliculaPorId = (id) => peliculas.find((p) => p.id === id);

/**
 * Valida que los campos requeridos esten presentes.
 * Se usa 'anio' en lugar de 'año' para evitar problemas de encoding en PowerShell.
 * @param {Object} body
 * @returns {boolean}
 */
const camposValidos = (body) => body.titulo && body.director && body.anio;

// ─────────────────────────────────────────────
// GET /peliculas — Listar todas
// ─────────────────────────────────────────────

app.get("/peliculas", (req, res) => {
  res.json({ success: true, data: peliculas, message: "Peliculas obtenidas correctamente" });
});

// ─────────────────────────────────────────────
// GET /peliculas/:id — Obtener una
// ─────────────────────────────────────────────

app.get("/peliculas/:id", (req, res) => {
  const pelicula = buscarPeliculaPorId(Number(req.params.id));

  if (!pelicula) {
    return res.status(404).json({
      success: false, data: null,
      message: `Pelicula con id ${req.params.id} no encontrada`,
    });
  }

  res.json({ success: true, data: pelicula, message: "Pelicula encontrada" });
});

// ─────────────────────────────────────────────
// POST /peliculas — Crear pelicula
// ─────────────────────────────────────────────

app.post("/peliculas", (req, res) => {
  if (!camposValidos(req.body)) {
    return res.status(400).json({
      success: false, data: null,
      message: "Los campos titulo, director y anio son obligatorios",
    });
  }

  const { titulo, director, anio } = req.body;
  const nuevaPelicula = { id: siguienteId++, titulo, director, anio };
  peliculas.push(nuevaPelicula);

  res.status(201).json({ success: true, data: nuevaPelicula, message: "Pelicula creada correctamente" });
});

// ─────────────────────────────────────────────
// PUT /peliculas/:id — Actualizar pelicula
// ─────────────────────────────────────────────

app.put("/peliculas/:id", (req, res) => {
  const id = Number(req.params.id);
  const indice = peliculas.findIndex((p) => p.id === id);

  if (indice === -1) {
    return res.status(404).json({
      success: false, data: null,
      message: `Pelicula con id ${id} no encontrada`,
    });
  }

  // Spread: conservamos campos anteriores y sobreescribimos solo los nuevos
  peliculas[indice] = { ...peliculas[indice], ...req.body, id };

  res.json({ success: true, data: peliculas[indice], message: "Pelicula actualizada correctamente" });
});

// ─────────────────────────────────────────────
// DELETE /peliculas/:id — Eliminar pelicula
// ─────────────────────────────────────────────

app.delete("/peliculas/:id", (req, res) => {
  const id = Number(req.params.id);
  const indice = peliculas.findIndex((p) => p.id === id);

  if (indice === -1) {
    return res.status(404).json({
      success: false, data: null,
      message: `Pelicula con id ${id} no encontrada`,
    });
  }

  const eliminada = peliculas.splice(indice, 1)[0];

  res.json({ success: true, data: eliminada, message: "Pelicula eliminada correctamente" });
});

// ─────────────────────────────────────────────
// ARRANQUE
// ─────────────────────────────────────────────

app.listen(PUERTO, () => {
  console.log(`API de Peliculas escuchando en http://localhost:${PUERTO}`);
  console.log("  GET    /peliculas");
  console.log("  GET    /peliculas/:id");
  console.log("  POST   /peliculas");
  console.log("  PUT    /peliculas/:id");
  console.log("  DELETE /peliculas/:id");
});