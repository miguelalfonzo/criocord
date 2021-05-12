//require('./bootstrap');

window.Vue = require('vue');


//notificaciones 

import VueToast from 'vue-toast-notification';

import 'vue-toast-notification/dist/theme-sugar.css';

Vue.use(VueToast);

//u.blockui

import BlockUI from 'vue-blockui'

Vue.use(BlockUI)



//componente usuarios

Vue.component('usuario-list', require('./components/UsuarioListComponent.vue').default);

//componentes mantenimiento-cliente

Vue.component('cliente-list', require('./components/ClienteListComponent.vue').default);

//componentes prospecto

Vue.component('prospecto-list', require('./components/ProspectoListComponent.vue').default);
//componentes contratos

Vue.component('contrato-list', require('./components/ContratoListComponent.vue').default);

//componentes cobranzas - llamadas

Vue.component('llamada-list', require('./components/LlamadaListComponent.vue').default);

Vue.prototype.$base_url = 'http://localhost/criocord/public';






const app = new Vue({
    el: '#app',
});