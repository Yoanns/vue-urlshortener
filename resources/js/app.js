require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import Shorten from './views/Shorten'
import Home from './views/Home'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/shorten',
            name: 'shorten.index',
            component: Shorten,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
