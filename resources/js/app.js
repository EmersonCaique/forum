require('./bootstrap')

window.Vue = require('vue');
Vue.use(require('vue-toasted'))



Vue.component('flash', require('./components/Flash.vue').default);


const app = new Vue({
    el: '#app',
});


