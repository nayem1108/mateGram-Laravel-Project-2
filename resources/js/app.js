import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();




Vue.component('follow-button', require('./components/follow-button.vue').default())


const app = new Vue({
    el: '#app',
})