import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/vendor/simple-notify.js",
                "resources/js/preview-card.js",
                "resources/js/download-doc.js",
            ],
            refresh: true,
        }),
    ],
});
