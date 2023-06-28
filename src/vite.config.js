import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';
import { fileURLToPath, URL } from "url";

export default defineConfig({
    plugins: [
        laravel([
            'resources/sass/app.scss',
            'resources/js/app.js'
        ]),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                }
            }
        }),
    ],
    resolve: {
        alias: {
            "@": fileURLToPath(new URL("resources/js", import.meta.url)),
            "resources": fileURLToPath(new URL("resources", import.meta.url)),
        },
    },
});
