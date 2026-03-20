/**
 * @file        tarea2.js
 * @description RA4 – Clases, funciones, arrays, OOP y patrones de diseño.
 * @author      Carlos Vico
 */

// ─────────────────────────────────────────────────────────────────────────────
// RA4_a – Clase Producto con método aplicarDescuento
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Representa un producto con nombre, precio y stock.
 */
class Producto {
  /**
   * @param {string} nombre  - Nombre del producto.
   * @param {number} precio  - Precio en euros.
   * @param {number} stock   - Unidades disponibles.
   */
  constructor(nombre, precio, stock) {
    this.nombre = nombre;
    this.precio = precio;
    this.stock  = stock;
  }

  /**
   * Reduce el precio del producto según el porcentaje recibido.
   * @param {number} porcentaje - Valor entre 0 y 100.
   */
  aplicarDescuento(porcentaje) {
    // Evitamos descuentos fuera de rango para no obtener precios negativos
    if (porcentaje < 0 || porcentaje > 100) {
      throw new RangeError("El porcentaje debe estar entre 0 y 100.");
    }
    this.precio = this.precio * (1 - porcentaje / 100);
  }

  /** @returns {string} Representación legible del producto */
  toString() {
    return `${this.nombre} | Precio: ${this.precio.toFixed(2)}€ | Stock: ${this.stock}`;
  }
}

// Instancia y aplicación de descuento del 10%
const laptop = new Producto("Laptop Pro", 1200, 5);
const precioAntes = laptop.precio;
laptop.aplicarDescuento(10);

const divProducto = document.getElementById("resultado-producto");
const p1 = document.createElement("p");
p1.textContent = `Antes del descuento: ${precioAntes.toFixed(2)}€`;
const p2 = document.createElement("p");
p2.textContent = `Después del descuento (10%): ${laptop.toString()}`;
divProducto.append(p1, p2);

// ─────────────────────────────────────────────────────────────────────────────
// RA4_b – Validación de entero positivo y recogida de N números
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Determina si el valor recibido es un entero positivo estricto (> 0).
 * Rechaza: decimales, strings no numéricos, cero y negativos.
 * @param {*} valor - Valor a comprobar.
 * @returns {boolean}
 */
function esEnteroPositivo(valor) {
  const num = Number(valor);
  // Number.isInteger rechaza decimales; la comprobación adicional rechaza ≤ 0
  return Number.isInteger(num) && num > 0;
}

/**
 * Pide al usuario un entero positivo mediante prompt, repitiéndolo
 * mientras la entrada no sea válida.
 * @param {string} mensaje - Texto que se muestra en el prompt.
 * @returns {number} Entero positivo validado.
 */
function pedirEnteroPositivo(mensaje) {
  let entrada;
  do {
    entrada = prompt(mensaje);
    // Si el usuario cancela (null) o deja vacío también se muestra error
    if (entrada === null || entrada.trim() === "" || !esEnteroPositivo(entrada)) {
      alert("❌ Error: debes introducir un número entero positivo (> 0).");
    }
  } while (entrada === null || entrada.trim() === "" || !esEnteroPositivo(entrada));

  return Number(entrada);
}

// Pedimos N (tamaño del array)
const N = pedirEnteroPositivo("Introduce el tamaño del array (entero positivo):");

/**
 * Recoge N enteros positivos del usuario y los almacena en un array.
 * @param {number} cantidad - Número de enteros a recoger.
 * @returns {number[]}
 */
function recogerNumerosUsuario(cantidad) {
  const numeros = [];
  for (let i = 1; i <= cantidad; i++) {
    const num = pedirEnteroPositivo(`Introduce el número ${i} de ${cantidad}:`);
    numeros.push(num);
  }
  return numeros;
}

// ─────────────────────────────────────────────────────────────────────────────
// RA4_d – Guardar y ordenar el array
// ─────────────────────────────────────────────────────────────────────────────

/** Array con los números introducidos por el usuario, ordenado numéricamente */
const numerosUsuario = recogerNumerosUsuario(N);
// sort() por defecto ordena como strings; usamos comparador numérico
numerosUsuario.sort((a, b) => a - b);

// ─────────────────────────────────────────────────────────────────────────────
// RA4_e – Filtrar pares e impares con filter()
// ─────────────────────────────────────────────────────────────────────────────

/** Array con los elementos pares del array del usuario */
const pares   = numerosUsuario.filter((n) => n % 2 === 0);

/** Array con los elementos impares del array del usuario */
const impares = numerosUsuario.filter((n) => n % 2 !== 0);

/**
 * Renderiza un array de números como spans dentro del elemento indicado.
 * @param {string}   contenedorId - ID del elemento destino.
 * @param {number[]} arr          - Array de números a mostrar.
 */
function renderizarArray(contenedorId, arr) {
  const div = document.getElementById(contenedorId);
  if (arr.length === 0) {
    const span = document.createElement("span");
    span.textContent = "(ninguno)";
    div.appendChild(span);
    return;
  }
  arr.forEach((num) => {
    const span = document.createElement("span");
    span.textContent = num;
    div.appendChild(span);
  });
}

renderizarArray("array-original", numerosUsuario);
renderizarArray("array-pares",    pares);
renderizarArray("array-impares",  impares);

// Datos del alumno al final de la sección
document.getElementById("datos-alumno").textContent =
  "Carlos Vico García | DNI: 12345678A";

// ─────────────────────────────────────────────────────────────────────────────
// RA4_c – Colección de Libros
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Representa un libro con título, autor y número de páginas.
 * @typedef  {Object} Libro
 * @property {string} titulo    - Título del libro.
 * @property {string} autor     - Autor del libro.
 * @property {number} numPaginas - Número de páginas.
 */

/** @type {Libro[]} */
const coleccionLibros = [
  { titulo: "Don Quijote de la Mancha", autor: "Miguel de Cervantes",  numPaginas: 1250 },
  { titulo: "El principito",            autor: "Antoine de Saint-Exupéry", numPaginas: 96  },
  { titulo: "1984",                     autor: "George Orwell",         numPaginas: 328  },
  { titulo: "Harry Potter y la piedra filosofal", autor: "J.K. Rowling", numPaginas: 309 },
  { titulo: "El alquimista",            autor: "Paulo Coelho",          numPaginas: 208  },
];

/**
 * Devuelve los títulos de los libros con más de 300 páginas.
 * @param {Libro[]} libros - Colección de libros.
 * @returns {string[]}
 */
function librosMasDe300Paginas(libros) {
  return libros
    .filter((libro) => libro.numPaginas > 300)
    .map((libro) => `${libro.titulo} (${libro.numPaginas} pág.)`);
}

const titulosLargos = librosMasDe300Paginas(coleccionLibros);
const ulLibros = document.createElement("ul");
titulosLargos.forEach((titulo) => {
  const li = document.createElement("li");
  li.textContent = titulo;
  ulLibros.appendChild(li);
});
document.getElementById("resultado-libros").appendChild(ulLibros);

// ─────────────────────────────────────────────────────────────────────────────
// RA4_f – ordenarEstudiantes por promedio y edad
// ─────────────────────────────────────────────────────────────────────────────

/**
 * @typedef  {Object} Estudiante
 * @property {string} nombre   - Nombre del estudiante.
 * @property {number} edad     - Edad en años.
 * @property {number} promedio - Nota media.
 */

/**
 * Ordena una lista de estudiantes de forma ascendente por promedio.
 * En caso de empate, el criterio secundario es la edad (también ascendente).
 * @param {Estudiante[]} estudiantes - Lista de estudiantes.
 * @returns {Estudiante[]} Nueva lista ordenada (no muta el original).
 */
function ordenarEstudiantes(estudiantes) {
  // Clonamos para no mutar el array original (principio de inmutabilidad)
  return [...estudiantes].sort((a, b) => {
    if (a.promedio !== b.promedio) return a.promedio - b.promedio;
    return a.edad - b.edad; // desempate por edad
  });
}

/** @type {Estudiante[]} */
const estudiantes = [
  { nombre: "Ana",    edad: 20, promedio: 8.5 },
  { nombre: "Carlos", edad: 22, promedio: 7.0 },
  { nombre: "Lucía",  edad: 19, promedio: 9.2 },
  { nombre: "Pedro",  edad: 21, promedio: 7.0 },
  { nombre: "Marta",  edad: 20, promedio: 6.5 },
];

const ordenados   = ordenarEstudiantes(estudiantes);
const ulEstudiantes = document.createElement("ul");
ordenados.forEach(({ nombre, edad, promedio }) => {
  const li = document.createElement("li");
  li.textContent = `${nombre} | Edad: ${edad} | Promedio: ${promedio}`;
  ulEstudiantes.appendChild(li);
});
document.getElementById("resultado-estudiantes").appendChild(ulEstudiantes);

// ─────────────────────────────────────────────────────────────────────────────
// RA4_g/h – Función constructora Smartphone con propiedades y métodos
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Función constructora Smartphone.
 * Define la estructura base de un objeto de tipo Smartphone.
 * @constructor
 * @param {string} marca   - Fabricante del dispositivo.
 * @param {string} modelo  - Modelo específico.
 * @param {string} color   - Color del dispositivo.
 * @param {number} tamanio - Tamaño de pantalla en pulgadas.
 */
function Smartphone(marca, modelo, color, tamanio) {
  this.marca   = marca;
  this.modelo  = modelo;
  this.color   = color;
  this.tamanio = tamanio;

  /**
   * Muestra un alert con la aplicación instalada.
   * @param {string} apli - Nombre de la aplicación.
   */
  this.instalarAplicacion = function (apli) {
    alert(`Aplicación ${apli} instalada con éxito en smartphone ${this.marca} ${this.modelo}.`);
  };

  /**
   * Muestra un alert confirmando el envío del mensaje.
   * @param {string} mensa - Texto del mensaje.
   */
  this.enviarCorreo = function (mensa) {
    alert(`Mensaje: ${mensa} enviado con éxito.`);
  };

  /**
   * Muestra un alert iniciando una llamada al número indicado.
   * @param {string} num - Número de teléfono destino.
   */
  this.llamar = function (num) {
    alert(`Llamando al ${num}...desde mi smartphone con tamaño ${this.tamanio} pulgadas`);
  };
}

// ─────────────────────────────────────────────────────────────────────────────
// RA4_j – Patrón Prototipo: añadir método al prototipo de Smartphone
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Muestra todas las propiedades del smartphone en un alert.
 * Se añade al prototipo para que todos los objetos Smartphone lo hereden.
 */
Smartphone.prototype.obtenDatosSmartPhone = function () {
  const datos =
    `Marca:   ${this.marca}\n` +
    `Modelo:  ${this.modelo}\n` +
    `Color:   ${this.color}\n` +
    `Tamaño:  ${this.tamanio} pulgadas`;
  alert(datos);
};

// ─────────────────────────────────────────────────────────────────────────────
// RA4_i – Crear instancia e invocar métodos
// ─────────────────────────────────────────────────────────────────────────────

const miSmartphone = new Smartphone("Samsung", "Galaxy S24", "Negro", 6.2);

// Mostramos los datos en el HTML en lugar de solo alerts para visualización
const divSmartphone = document.getElementById("resultado-smartphone");
const infoSm = document.createElement("p");
infoSm.textContent =
  `Smartphone creado: ${miSmartphone.marca} ${miSmartphone.modelo} | ` +
  `Color: ${miSmartphone.color} | Pantalla: ${miSmartphone.tamanio}"`;
divSmartphone.appendChild(infoSm);

const notaSm = document.createElement("p");
notaSm.textContent =
  "Los métodos instalarAplicacion(), enviarCorreo(), llamar() y obtenDatosSmartPhone() " +
  "muestran alerts — ábrelos desde la consola o añade botones para probarlos.";
divSmartphone.appendChild(notaSm);

// Ejemplo de invocación (comentado para no lanzar alerts al cargar):
// miSmartphone.instalarAplicacion("WhatsApp");
// miSmartphone.enviarCorreo("Hola desde JS");
// miSmartphone.llamar("666123456");
// miSmartphone.obtenDatosSmartPhone();
