
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.$ = require("jquery");
// window.JQuery = require("jquery");

window.Vue = require('vue');
import CrudComponent from './components/CrudComponent.vue';
import CrudModal from './components/CrudModal.vue';
import RegexComponent from './components/RegexComponent.vue';
import FactorialComponent from './components/FactorialComponent.vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('crud-component', require('./components/CRUDComponent.vue'));

const app = new Vue({
    el: '#app',
    components: {
        CrudComponent: CrudComponent,
        CrudModal: CrudModal,
        RegexComponent: RegexComponent,
        FactorialComponent: FactorialComponent
    }
});
