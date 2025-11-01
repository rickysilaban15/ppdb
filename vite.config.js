import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        hmr: {
            host: 'stmpancur.sevalla.app',
            protocol: 'wss', // agar hot reload via HTTPS
        },
    },
    base: '/', // base path untuk production build
});
