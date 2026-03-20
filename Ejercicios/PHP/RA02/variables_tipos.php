<?php
/**
 * RA02_E - Sentencias simples: muestra datos del alumno
 * RA02_G - Tipos de variables, constantes y operadores
 *
 * @author  Carlos Vico
 * @version 1.0
 */

// --- RA02_E ---
echo "Nombre: Carlos Vico<br>";
echo "NIF: 12345678A<br>";
echo "El código del script php siempre se incluye entre las etiquetas &lt;?php y ?&gt;<br>";

echo "<hr>";

// --- RA02_G ---

// Tipos primitivos de PHP
$entero   = 10;          // integer
$decimal  = 8.22;        // float
$booleano = true;        // boolean
$cadena   = "cadena";    // string

// Las constantes no tienen $ y no pueden reasignarse
define('PI', 3.14);

echo "Entero: $entero<br>";
echo "Decimal: $decimal<br>";
// var_export muestra true/false explícito en lugar de 1/vacío
echo "Booleano: " . var_export($booleano, true) . "<br>";
echo "Cadena: $cadena<br>";
echo "Constante PI: " . PI . "<br>";

// Suma entre tipos numéricos: PHP realiza coerción automática
$suma = $entero + $decimal;
echo "Suma (entero + decimal): $suma<br>";
