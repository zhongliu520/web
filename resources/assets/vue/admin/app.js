
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/display.css';
import 'element-ui/lib/theme-chalk/index.css';
import api from './api';
import store from './store';
// import 'element-ui/lib/theme-chalk/display.css';

Vue.use(ElementUI);
Vue.prototype.$api = api;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('meun-index-component', require('./components/meun/index.vue'));
Vue.component('users-index-component', require('./components/users/index.vue'));

const app = new Vue({
    el: '#app',
    store,
    // template: '<App/>'
});
