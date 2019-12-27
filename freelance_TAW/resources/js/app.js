
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With']='XMLHttpRequest'; 


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('do-component', require('./components/PruebaComponent.vue').default);
Vue.component('third-component', require('./components/ThirdComponent.vue').default);

/*LOS BUENOS*/
Vue.component('hitos-comp', require('./components/Hitos.vue').default);

Vue.component('asignadosparami', require('./components/Asignadosparami.vue').default);
Vue.component('mis_tickets', require('./components/Mis_Tickets.vue').default);
Vue.component('man_tickets', require('./components/Manegador_Tickets.vue').default);
Vue.component('articulos', require('./components/Articulos.vue').default);
Vue.component('labores', require('./components/Labores.vue').default);
Vue.component('usuarios', require('./components/Usuarios.vue').default);
Vue.component('roles-component', require('./components/Roles.vue').default);
Vue.component('departamentos-component', require('./components/Departments.vue').default);
Vue.component('calendario', require('./components/Calendario.vue').default);
Vue.component('dashboard', require('./components/Dashboard.vue').default);
Vue.component('solicitudes', require('./components/Solicitudes.vue').default);
Vue.component('clientes', require('./components/Clientes.vue').default);
Vue.component('proyectos', require('./components/Proyectos.vue').default);
Vue.component('facturas', require('./components/Facturas.vue').default);
Vue.component('pagos', require('./components/Pagos.vue').default);
Vue.component('tickets', require('./components/Tickets.vue').default);
Vue.component('misproyectos', require('./components/MisProyectos.vue').default);
Vue.component('preguntas', require('./components/Preguntas.vue').default);
Vue.component('menupaginas', require('./components/Menupaginas.vue').default);
Vue.component('metodospago', require('./components/MetodosPago.vue').default);
// Vue.component('proyectosM', require('./components/ProyectosM.vue').default);
Vue.component('proyectosC', require('./components/ProyectosC.vue').default);


Vue.component('spinner', require('./components/spinner.vue'));





/*----------*/


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
        menu: 0,
    	ruta: 'http://jduque.me:8080'
    }
});
