/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php", // Para archivos Blade de Laravel
    "./resources/**/*.vue",       // Para componentes Vue
    "./resources/**/*.js",        // Para archivos JavaScript
    "./resources/**/*.ts",        // Para archivos TypeScript (si los usas)
  ],
  theme: {
    extend: {
      colors: {
        primary: "#1D4ED8", // Azul Tailwind por defecto
        secondary: "#9333EA", // Púrpura Tailwind por defecto
        accent: "#F59E0B", // Naranja Tailwind por defecto
      },
      fontFamily: {
        sans: ["Inter", "sans-serif"], // Fuente personalizada
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'), // Mejora los estilos de formularios
    require('@tailwindcss/typography'), // Estilos mejorados para textos
    require('@tailwindcss/aspect-ratio'), // Para manejar proporciones de imágenes y videos
  ],
};
