import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import inject from '@rollup/plugin-inject';

export default defineConfig({
    plugins: [
        inject({
            $: 'jquery',
        }),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'public/src/plugins/global/plugins.bundle.js',
            ],
            refresh: true,
        }),
        {
            name: 'blade',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*',
                    });
                }
            },
        }
    ],
    server: {
        https: {
            key: 'C:/laragon/etc/ssl/laragon.key',
            cert: 'C:/laragon/etc/ssl/laragon.crt',
        },
    },
    resolve: {
        alias: {
            '$': 'jQuery',
        },
    },
});
