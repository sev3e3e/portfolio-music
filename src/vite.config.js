import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: "localhost",
        hmr: {
            host: "localhost",
        },
        watch: {
            usePolling: true,
        },
    },
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/index.js",
                "resources/js/modal.js",
            ],
            refresh: true,
        }),
    ],
});
