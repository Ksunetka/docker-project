import "@mdi/font/scss/materialdesignicons.scss";
import "vuetify/dist/vuetify.min.css";
import Vue from 'vue';
import Vuetify from 'vuetify';

Vue.use(Vuetify);

const opts = {
    icons: {
        iconfont: 'mdi',
    },
    theme: {
        themes: {
            light: {
                primary: '#3f51b5',
                secondary: '#696969',
                accent: '#8c9eff',
                error: '#b71c1c',
            },
        },
    },
};

export default new Vuetify(opts);
