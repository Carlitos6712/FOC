# =============================================================================
# @file        OPT06_Carlos-Vico.py
# @description Actividad individual U06 — Generadores, iteradores y cierres.
#              Implementa dos generadores que producen "números de la suerte":
#                1. numeros_suerte(limite)       → todos los enteros de 1 a limite
#                2. numeros_suerte_pares(limite) → solo los pares de 1 a limite
#              Los generadores usan `yield` para producir valores de uno en uno,
#              sin construir listas en memoria (coste O(1) de espacio).
#
# @author      Carlos Vico
# @date        2026-04-16
# @version     1.0.0
# @python      3.x
#
# @usage
#   python OPT06_Carlos-Vico.py
# =============================================================================


def numeros_suerte(limite):
    """Generador que produce los enteros del 1 al limite (inclusive).

    Usa ``yield`` para suspender la ejecución tras cada valor y reanudarla
    en la siguiente llamada a ``next()``. Esto permite iterar sobre rangos
    arbitrariamente grandes sin reservar memoria para toda la secuencia.

    Args:
        limite (int): Valor máximo de la secuencia (incluido).
                      Si limite < 1, el generador no produce ningún valor.

    Yields:
        int: Enteros consecutivos comenzando en 1 hasta limite.

    Example:
        >>> list(numeros_suerte(5))
        [1, 2, 3, 4, 5]

        >>> gen = numeros_suerte(3)
        >>> next(gen)
        1
        >>> next(gen)
        2
    """
    numero = 1
    while numero <= limite:
        yield numero      # pausa y devuelve el valor actual al iterador
        numero += 1       # se ejecuta la próxima vez que se pida un valor


def numeros_suerte_pares(limite):
    """Generador que produce solo los enteros pares del 1 al limite (inclusive).

    Recorre los enteros de 1 a limite y cede únicamente aquellos cuyo resto
    de la división entre 2 es cero (condición de paridad: ``n % 2 == 0``).

    Args:
        limite (int): Valor máximo del rango de búsqueda (incluido).
                      Si limite < 2, el generador no produce ningún valor.

    Yields:
        int: Enteros pares comenzando en 2 hasta limite.

    Example:
        >>> list(numeros_suerte_pares(10))
        [2, 4, 6, 8, 10]

        >>> list(numeros_suerte_pares(1))
        []
    """
    numero = 1
    while numero <= limite:
        if numero % 2 == 0:   # filtra solo los números pares
            yield numero
        numero += 1


# =============================================================================
# Programa principal
# Número de lista en clase: 5
# =============================================================================
if __name__ == "__main__":

    # Número de lista de Carlos en clase, usado como límite de la secuencia.
    NUMERO_DE_LISTA = 5

    # -- Ejercicio 2: todos los números del 1 al límite -----------------------
    print("=" * 40)
    print(f"  Numeros de la suerte (1 - {NUMERO_DE_LISTA})")
    print("=" * 40)

    generador = numeros_suerte(NUMERO_DE_LISTA)

    for numero in generador:
        print(f"  Numero de la suerte: {numero}")

    # -- Ejercicio 3: solo los números pares ----------------------------------
    print()
    print("=" * 40)
    print(f"  Numeros de la suerte PARES (1 - {NUMERO_DE_LISTA})")
    print("=" * 40)

    generador_pares = numeros_suerte_pares(NUMERO_DE_LISTA)

    for numero in generador_pares:
        print(f"  Numero par de la suerte: {numero}")

    print()
    print("Fin del programa.")
