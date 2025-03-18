// postcss.config.js
export default {
  plugins: {
    "postcss-import": {}, // Permite importar archivos CSS dentro de otros archivos CSS
    tailwindcss: {}, // El plugin de TailwindCSS
    autoprefixer: {}, // Agrega prefijos para la compatibilidad entre navegadores
    "postcss-nested": {}, // Permite anidar selectores como en SASS
    "postcss-flexbugs-fixes": {}, // Corrige problemas con Flexbox en algunos navegadores
  },
};
