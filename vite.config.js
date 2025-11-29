import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/components/navbar.js',
                'resources/js/auth/login.js',
                'resources/js/auth/register.js',
                'resources/js/auth/forgot-pass.js',
                'resources/js/pages/home.js',
                'resources/js/pages/profile.js',
                'resources/js/pages/support.js',
                'resources/js/scholarships/progress.js',
                'resources/js/scholarships/index.js',
                'resources/js/scholarships/create.js',
                'resources/js/scholarships/upload.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
})
