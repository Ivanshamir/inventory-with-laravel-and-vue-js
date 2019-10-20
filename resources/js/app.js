
require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter)

import {routes} from './routes';

//import user class
import User from './Helpers/User';
window.User = User;

//import notification class
import Notification from './Helpers/Notification';
window.Notification = Notification;

//sweet alert2
import Swal from 'sweetalert2'
window.Swal = Swal;

window.Reload = new Vue();

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
})
window.Toast = Toast;

const router = new VueRouter({
    routes ,
    mode: 'history'
  })


const app = new Vue({
    el: '#app',
    router
});
