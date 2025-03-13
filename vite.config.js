import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";
import tailwindcss from '@tailwindcss/vite';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(), //Habilitamos Vue
        tailwindcss(), //Habilitamos Tailwindcss
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'), // Para evitar rutas largas en imports
        },
    },
});
