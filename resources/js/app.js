
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.$ = require('jquery')
window.JQuery = require('jquery')

window.Vue = require('vue');
import Flash from './components/Flash.vue';
import PreviewComponent from './components/Preview.vue';
import DynamicTableComponent from './components/DynamicTable.vue';
import DynamicColumnComponent from './components/DynamicColumn.vue';
import SelectDatasource from './components/pages/SelectDatasource.vue'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('flash', require('./components/Flash.vue'));
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.prototype.$eventHub = new Vue();

const app = new Vue({
    el: '#app',
    components: {
        Flash: Flash,
        PreviewComponent: PreviewComponent,
        SelectDatasource: SelectDatasource,
        DynamicTableComponent: DynamicTableComponent,
        DynamicColumnComponent: DynamicColumnComponent
    }
});

