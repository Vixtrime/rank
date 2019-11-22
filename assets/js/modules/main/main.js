import Vue from 'vue';

const axios = require('axios');

import Main from './Main';
import 'vuetify/dist/vuetify.min.css';
import Vuetify from 'vuetify/lib';

const opts = {
    theme: {
        // themes: {
        //     light: {
        //         primary: '#455A64',
        //         secondary: '#0277BD',
        // primary: colors.blue.accent2,
        // accent: colors.shades.black,
        // error: colors.red.lighten1,
        // info: colors.lightBlue.accent2,
        // success: colors.green.accent3,
        // warning: colors.orange.accent2,
        // },
        // dark: {
        // primary: colors.blue.lighten3,
        // },
        // },
    },
    lang: {
        // locales: {ven, vru},
        // current: LANGUAGE,
    },
    components: {},
    iconfont: 'mdi'
};

const vuetify = new Vuetify(opts);

Vue.use(Vuetify);


new Vue({
    components: {Main},
    template: "<Main/>"
    // render: a => a(Main)
}).$mount('#main');