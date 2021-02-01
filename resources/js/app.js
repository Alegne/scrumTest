
require('./bootstrap');

window.Vue = require('vue').default;

//utilisation des routes en VueJs
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Activite from './components/ActiviteComponent.vue';
import Tache from './components/TacheComponent.vue';


const routes = [
    {
        path: '/',
        component: Activite,
    },
    {
        path: '/tache/:id',
        component: Tache,
    },
];

const router = new VueRouter({routes});

//Vue.component('home-component', require('./components/HomeComponent.vue').default);
Vue.component('activite-component', require('./components/ActiviteComponent.vue').default);


const app = new Vue({
    el: '#app',
    router: router,
});
