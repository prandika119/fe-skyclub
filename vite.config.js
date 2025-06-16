import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/chart.js",
                "resources/js/tableArticle.js",
                "resources/js/tableBooking.js",
                "resources/js/tableVoucher.js",
                "resources/js/dropzoneFieldPhoto.js",
                "resources/js/descriptionField.js",
                "resources/js/editor.js",
                "resources/js/editorUpdate.js",
            ],
            refresh: true,
        }),
    ],
});
