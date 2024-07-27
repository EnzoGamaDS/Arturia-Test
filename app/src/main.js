import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faUser, faBoxOpen, faShoppingCart, faClipboardList } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import './assets/tailwind.css';

library.add(faUser, faBoxOpen, faShoppingCart, faClipboardList);

const app = createApp(App);
app.component('font-awesome-icon', FontAwesomeIcon);
app.use(router);
app.use(store);
app.mount('#app');
