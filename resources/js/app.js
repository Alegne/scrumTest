
require('./bootstrap');

window.Vue = require('vue').default;

//utilisation des routes en VueJs
import VueRouter from 'vue-router';
Vue.use(VueRouter);

Vue.component('activite-component', require('./components/ActiviteComponent.vue').default);
Vue.component('AddActivite-component', require('./components/AddActiviteComponent.vue'));


const app = new Vue({
    el: '#app',
});
