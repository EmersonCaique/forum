require('./bootstrap')
window.axios = require('axios')

window.Vue = require('vue');
Vue.use(require('vue-toasted'))



Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('reply', require('./components/Reply.vue').default);



const app = new Vue({
    el: '#app',
});


