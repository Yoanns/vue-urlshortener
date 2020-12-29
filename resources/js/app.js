require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import FormUrl from './views/FormUrl'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'formUrl',
            component: FormUrl,
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
