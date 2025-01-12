import "../css/app.css";
import "./bootstrap";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

// Importações PrimeVue
import PrimeVue from "primevue/config";
import "primevue/resources/themes/saga-blue/theme.css"; // Tema PrimeVue (ajuste o tema se desejar)
import "primevue/resources/primevue.min.css"; // Estilos principais do PrimeVue
import "primeicons/primeicons.css"; // Ícones PrimeIcons

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
