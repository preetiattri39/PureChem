import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/css/style.css',
                'resources/css/pages/cart.css',
                'resources/css/pages/chat.css',
                'resources/css/pages/contact.css',
                'resources/css/pages/home.css',
                'resources/css/pages/products.css',
                'resources/css/pages/single-product.css',
                'resources/css/pages/synthesis.css',
                'resources/css/pages/error.css',
                'resources/js/app.js',
                'resources/js/script.js',
                'resources/js/pages/synthesis.js',
                'resources/js/pages/products.js',
                'resources/js/pages/single-product.js',
                'resources/js/pages/cart.js',
                'resources/js/pages/contact.js',
                'resources/js/pages/auth/register.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            '/images': path.resolve(__dirname, 'public/images'),
        },
    },
});
