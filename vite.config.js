import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'; 

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            buildDirectory: 'public',
        }),
    ],
    build: {
        manifest: true,
        outDir: path.resolve(__dirname, 'public/build'),  // Ensure this line is correct
        rollupOptions: {
            input: {
                app: 'resources/js/app.js',
            },
        },
    },
});
