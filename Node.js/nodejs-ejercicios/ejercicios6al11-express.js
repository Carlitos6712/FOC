/**
 * @file ejercicios6al11-express.js
 * @description Ejercicios 6 al 11 - Servidor Express con rutas, parámetros, POST y arrays
 * @author Carlos Vico
 */

const express = require("express");

const app = express();
const PUERTO = 3000;

// Middleware para parsear JSON en el body de las peticiones POST
// Sin esto, req.body sería undefined
app.use(express.json());

// ─────────────────────────────────────────────
// DATOS EN MEMORIA (simulan una base de datos)
// ─────────────────────────────────────────────

/** @type {Array<{id: number, nombre: string, precio: number}>} */
const productos = [
  { id: 1, nombre: "ordenador", precio: 800 },
  { id: 2, nombre: "ratón",     precio: 20  },
  { id: 3, nombre: "teclado",   precio: 50  },
];

// ─────────────────────────────────────────────
// EJERCICIO 6: Ruta raíz
// ─────────────────────────────────────────────

/**
 * GET /
 * Muestra mensaje de bienvenida al servidor Express.
 */
app.get("/", (req, res) => {
  res.send("Bienvenido a mi servidor con Express");
});

// ─────────────────────────────────────────────
// EJERCICIO 7: Ruta con parámetro de nombre
// ─────────────────────────────────────────────

/**
 * GET /saludo/:nombre
 * Devuelve un saludo personalizado con el nombre recibido por parámetro.
 * @example GET /saludo/Ana → "Hola Ana, bienvenido a Node.js"
 */
app.get("/saludo/:nombre", (req, res) => {
  const { nombre } = req.params;
  res.send(`Hola ${nombre}, bienvenido a Node.js`);
});

// ─────────────────────────────────────────────
// EJERCICIO 8: Ruta con cálculo de suma
// ─────────────────────────────────────────────

/**
 * GET /suma/:num1/:num2
 * Convierte los parámetros a número (vienen como string desde la URL)
 * y devuelve su suma.
 * @example GET /suma/5/8 → "La suma es 13"
 */
app.get("/suma/:num1/:num2", (req, res) => {
  const num1 = Number(req.params.num1);
  const num2 = Number(req.params.num2);

  // Validamos que ambos parámetros sean números válidos
  if (isNaN(num1) || isNaN(num2)) {
    return res.status(400).send("Los parámetros deben ser números válidos");
  }

  res.send(`La suma es ${num1 + num2}`);
});

// ─────────────────────────────────────────────
// EJERCICIO 9: POST para crear usuario
// ─────────────────────────────────────────────

/**
 * POST /usuarios
 * Recibe un JSON con { nombre, edad } y lo muestra en consola.
 * Devuelve respuesta estándar { success, data, message }.
 */
app.post("/usuarios", (req, res) => {
  const { nombre, edad } = req.body;

  // Validamos que vengan los campos requeridos
  if (!nombre || !edad) {
    return res.status(400).json({
      success: false,
      data: null,
      message: "Los campos 'nombre' y 'edad' son obligatorios",
    });
  }

  console.log("Usuario recibido:", { nombre, edad });

  res.status(201).json({
    success: true,
    data: { nombre, edad },
    message: "Usuario recibido correctamente",
  });
});

// ─────────────────────────────────────────────
// EJERCICIO 10: Listar todos los productos
// ─────────────────────────────────────────────

/**
 * GET /productos
 * Devuelve el array completo de productos en formato JSON estándar.
 */
app.get("/productos", (req, res) => {
  res.json({
    success: true,
    data: productos,
    message: "Productos obtenidos correctamente",
  });
});

// ─────────────────────────────────────────────
// EJERCICIO 11: Producto por ID
// ─────────────────────────────────────────────

/**
 * GET /productos/:id
 * Busca y devuelve el producto con el ID indicado.
 * Responde 404 si no existe, evitando devolver undefined al cliente.
 */
app.get("/productos/:id", (req, res) => {
  const id = Number(req.params.id);
  const producto = productos.find((p) => p.id === id);

  if (!producto) {
    return res.status(404).json({
      success: false,
      data: null,
      message: `Producto con id ${id} no encontrado`,
    });
  }

  res.json({
    success: true,
    data: producto,
    message: "Producto encontrado",
  });
});

// ─────────────────────────────────────────────
// ARRANQUE DEL SERVIDOR
// ─────────────────────────────────────────────

app.listen(PUERTO, () => {
  console.log(`Servidor Express escuchando en http://localhost:${PUERTO}`);
  console.log("Rutas disponibles:");
  console.log("  GET  /");
  console.log("  GET  /saludo/:nombre");
  console.log("  GET  /suma/:num1/:num2");
  console.log("  POST /usuarios");
  console.log("  GET  /productos");
  console.log("  GET  /productos/:id");
});
