/**
 * @file ejercicio4-servidor.js
 * @description Ejercicio 4 - Servidor HTTP nativo en el puerto 3000
 * @author Carlos Vico
 */

// http es un módulo nativo de Node.js
const http = require("http");

const PUERTO = 3000;

/**
 * Crea y arranca un servidor HTTP básico.
 * Se usa el módulo nativo para entender los fundamentos antes de Express.
 */
const servidor = http.createServer((req, res) => {
  res.writeHead(200, { "Content-Type": "text/plain; charset=utf-8" });
  res.end("Servidor funcionando correctamente");
});

servidor.listen(PUERTO, () => {
  console.log(`Servidor escuchando en http://localhost:${PUERTO}`);
});
