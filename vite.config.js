import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'], // Archivos de entrada principales
            refresh: true, // Habilita la recarga automática en Laravel
        }),
        vue(), // Habilita Vue.js en el proyecto
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'), // Define '@' como alias de la carpeta de Vue.js
        },
    },
    css: {
        postcss: {}, // Permite procesar estilos con PostCSS
    },
    server: {
        host: 'localhost', // Servidor local
        port: 5173, // Puerto en el que corre Vite
        watch: {
            usePolling: true, // Asegura la detección de cambios en entornos con sistemas de archivos problemáticos (WSL, Docker, etc.)
        },
        proxy: {
            '/api': {
                target: 'http://127.0.0.1:8000', // URL de Laravel
                changeOrigin: true,
                secure: false,
            },
        },
    },
    optimizeDeps: {
        exclude: ['vite']
    }
});
