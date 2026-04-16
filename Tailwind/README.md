# Tailwind CSS — Tarjeta de Perfil

Ejercicio práctico de Tailwind CSS que construye una **tarjeta de perfil** interactiva usando clases utilitarias, animaciones personalizadas e integración con Font Awesome.

## Vista previa

La tarjeta muestra:
- Avatar circular con borde decorativo
- Nombre, rol con icono y descripción
- Iconos de redes sociales con hover de color
- Botón "Seguir" con animación de pulso continua

## Estructura del proyecto

```
Tailwind/
└── index.html   # Componente completo (HTML + config Tailwind CDN)
```

## Tecnologías

| Herramienta | Uso |
|---|---|
| [Tailwind CSS](https://tailwindcss.com/) via CDN | Estilos utilitarios |
| [Font Awesome 6](https://fontawesome.com/) | Iconos de UI y redes sociales |
| [DiceBear Avatars](https://www.dicebear.com/) | Avatar generado dinámicamente |

## Conceptos cubiertos

### Tarea 1 — Centrado con Flexbox
```html
<body class="min-h-screen flex items-center justify-center">
```
Centra la tarjeta horizontal y verticalmente usando `flex`, `items-center` y `justify-center` en el `body`.

---

### Tarea 2 — Estilos de tarjeta (card)
```html
<div class="bg-white rounded-2xl shadow-lg p-8 w-80">
```
- `bg-white` → fondo blanco
- `rounded-2xl` → bordes muy redondeados
- `shadow-lg` → sombra suave
- `w-80` → ancho fijo de 320 px

---

### Tarea 3 — Imagen de perfil circular
```html
<img class="w-28 h-28 rounded-full object-cover border-4 border-blue-200 shadow-md">
```
- `rounded-full` → imagen completamente circular
- `object-cover` → recorte centrado sin distorsión
- `border-4 border-blue-200` → borde azul decorativo

---

### Tarea 4 — Tipografía
```html
<h2 class="text-2xl font-bold text-gray-800">Carlos Vico</h2>
<p class="text-gray-400 text-sm leading-relaxed">...</p>
```
- `text-2xl font-bold` → nombre grande y en negrita
- `text-gray-400` → color gris suave para la descripción

---

### Tarea 5 — Botón con color y hover
```html
<button class="bg-blue-500 hover:bg-blue-700 text-white rounded-full px-8 py-2">
```
- `bg-blue-500` → color primario
- `hover:bg-blue-700` → oscurecimiento al pasar el cursor
- `rounded-full` → botón tipo "pill"

---

### Tarea 6 — Efectos e iconos externos

**Hover en la tarjeta:**
```html
<div class="hover:shadow-2xl transition-shadow duration-300">
```

**Iconos de redes sociales con hover de color:**
```html
<a class="hover:text-blue-500 transition-colors duration-200">
  <i class="fa-brands fa-github"></i>
</a>
```

**Animación personalizada (keyframes en config de Tailwind):**
```js
tailwind.config = {
  theme: {
    extend: {
      keyframes: {
        pulse_btn: {
          '0%, 100%': { transform: 'scale(1)' },
          '50%':       { transform: 'scale(1.08)' },
        }
      },
      animation: {
        pulse_btn: 'pulse_btn 1.5s ease-in-out infinite',
      }
    }
  }
}
```
Aplicada al botón con `animate-pulse_btn`.

## Cómo ejecutar

Basta con abrir `index.html` directamente en el navegador — no requiere instalación ni compilación gracias al CDN de Tailwind.

```bash
# Opción rápida con VS Code
code Tailwind/index.html
# Luego usar Live Server o abrir con el navegador
```
