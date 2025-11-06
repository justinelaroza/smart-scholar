import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    base: '/build/',
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/auth/login.js',
                'resources/js/auth/register.js',
                'resources/js/auth/forgot-pass.js',
                'resources/js/pages/home.js',
                'resources/js/pages/profile.js',
                'resources/js/pages/scholarship.js',
                'resources/js/pages/support.js',
                'resources/js/pages/upload.js',
                'resources/js/components/navbar.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
})
