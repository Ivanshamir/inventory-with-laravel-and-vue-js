
require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter)

import {routes} from './routes';

const router = new VueRouter({
    routes ,
    mode: 'history'
  })


const app = new Vue({
    el: '#app',
    router
});
