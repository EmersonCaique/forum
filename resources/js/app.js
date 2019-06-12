require('./bootstrap')
window.axios = require('axios')

window.Vue = require('vue');
Vue.use(require('vue-toasted'))



Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('favorite', require('./components/Favorite.vue').default);
Vue.component('thread-view', require('./pages/Thread.vue').default);
Vue.component('subscribe-button', require('./components/SubscribeButton.vue').default);


const app = new Vue({
    el: '#app',
});


