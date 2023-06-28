import '@/bootstrap';
import Vue from 'vue';
import vuetify from '@/vuetify';
import VueI18n from "vue-i18n";
import App from '@/components/App.vue';
import { ru } from "@/lang/ru.js";

window.eventBus = new Vue();

import '@/echo';

Vue.use(VueI18n);

const messages = {
    ru: ru,
};

const i18n = new VueI18n({
    locale: "ru",
    messages,
});

const app = new Vue({
    vuetify,
    i18n,
    render: h => h(App)
}).$mount('#app');


