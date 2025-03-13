/** @type {import('tailwindcss').Config} */
export default {
  content: [
      './index.html', 
      './resources/**/*.blade.php', // Asegura que los archivos Blade sean escaneados
      './resources/**/*.{vue,js,ts,jsx,tsx}',
  ],
  theme: {
      extend: {},
  },
  plugins: [],
};

  