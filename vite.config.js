import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/style.css', 
                'resources/css/style.css', 
                'resources/css/pages/cart.css', 
                'resources/css/pages/chat.css', 
                'resources/css/pages/contact.css', 
                'resources/css/pages/home.css', 
                'resources/css/pages/products.css', 
                'resources/css/pages/single-product.css', 
                'resources/css/pages/synthesis.css', 
                'resources/js/app.js',
                'resources/js/script.js',
                'resources/js/pages/synthesis.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
