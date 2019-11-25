import Vue from 'vue';

const axios = require('axios');

import Main from './Main';
import 'vuetify/dist/vuetify.min.css';
import Vuetify from 'vuetify/lib';
import '@mdi/font/css/materialdesignicons.min.css';


const opts = {
    theme: {},
    components: {},
    iconfont: 'mdi'
};

const vuetify = new Vuetify(opts);

Vue.use(Vuetify);


new Vue({
    components: {Main},
    template: "<Main/>",
    vuetify: new Vuetify()
    // render: a => a(Main)
}).$mount('#main');