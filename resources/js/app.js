require('./bootstrap');
window.Vue = require('vue').default;

//utilisation des routes en VueJs
import VueRouter from 'vue-router';
import Activite from './components/ActiviteComponent.vue';
import Tache from './components/TacheComponent.vue';
import Dashboard from './components/DashboardComponent.vue';
import DashTache from './components/DashTacheComponent.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        component: Activite,
    },
    {
        path: '/tache/:id',
        component: Tache,
    },
    {
        path: '/dashboard',
        component: Dashboard,
    },
    {
        path: '/dashTache/:id',
        component: DashTache,
    },
];

const router = new VueRouter({routes});

Vue.component('activite-component', require('./components/ActiviteComponent.vue').default);


const app = new Vue({
    el: '#app',
    router: router,
});
