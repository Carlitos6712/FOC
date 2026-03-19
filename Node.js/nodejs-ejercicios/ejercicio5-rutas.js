/**
 * @file ejercicio5-rutas.js
 * @description Ejercicio 5 - Servidor HTTP con rutas manuales
 * @author Carlos Vico
 */

const http = require("http");

const PUERTO = 3000;

/**
 * Mapa de rutas → respuesta.
 * Centralizar las rutas aquí facilita añadir o modificar sin tocar la lógica del servidor.
 */
const RUTAS = {
  "/": "Bienvenido a la página principal",
  "/about": "Esta es la página sobre nosotros",
  "/contacto": "Página de contacto",
};

/**
 * Devuelve la respuesta correspondiente a la URL solicitada.
 * Si la ruta no existe, responde con 404.
 * @param {http.IncomingMessage} req
 * @param {http.ServerResponse} res
 */
const manejarPeticion = (req, res) => {
  const respuesta = RUTAS[req.url];

  if (respuesta) {
    res.writeHead(200, { "Content-Type": "text/plain; charset=utf-8" });
    res.end(respuesta);
  } else {
    res.writeHead(404, { "Content-Type": "text/plain; charset=utf-8" });
    res.end("Ruta no encontrada");
  }
};

const servidor = http.createServer(manejarPeticion);

servidor.listen(PUERTO, () => {
  console.log(`Servidor con rutas escuchando en http://localhost:${PUERTO}`);
});
