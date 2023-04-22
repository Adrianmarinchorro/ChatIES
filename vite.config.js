import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vitePluginFaviconsInject from 'vite-plugin-favicons-inject';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vitePluginFaviconsInject('./resources/images/favicon.ico'),
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
