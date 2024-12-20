import './bootstrap';
import '../css/app.css';

import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Button from '@/Components/ui/button/Button.vue';
import Label from '@/Components/ui/label/Label.vue';
import Input from '@/Components/ui/input/Input.vue';
import Checkbox from '@/Components/ui/checkbox/Checkbox.vue';
import {Textarea} from "@/Components/ui/textarea";
import FormField from "@/Components/FormField.vue";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('Head', Head)
            .component('Link', Link)
            .component('Button', Button)
            .component('Label', Label)
            .component('Input', Input)
            .component('Checkbox', Checkbox)
            .component('Textarea', Textarea)
            .component('FormField', FormField)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
