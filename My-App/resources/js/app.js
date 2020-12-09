/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('../../vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js');
require('../../vendor/almasaeed2010/adminlte/plugins/jquery-ui/jquery-ui.min.js');
require('../../vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js');
require('../../vendor/almasaeed2010/adminlte/plugins/sparklines/sparkline.js');
require('../../vendor/almasaeed2010/adminlte/plugins/jqvmap/jquery.vmap.min.js');
require('../../vendor/almasaeed2010/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js');
require('../../vendor/almasaeed2010/adminlte/plugins/jquery-knob/jquery.knob.min.js');
require('../../vendor/almasaeed2010/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js');
require('../../vendor/almasaeed2010/adminlte/plugins/summernote/summernote-bs4.min.js');
require('../../vendor/almasaeed2010/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js');
require('../../vendor/almasaeed2010/adminlte/dist/js/adminlte.js');
require('../../vendor/almasaeed2010/adminlte/dist/js/pages/dashboard.js');
require('../../vendor/almasaeed2010/adminlte/dist/js/demo.js');



  $.widget.bridge('uibutton', $.ui.button)


window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
