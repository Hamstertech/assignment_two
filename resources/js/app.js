import './bootstrap';

import { createApp } from 'vue';
import { createPinia } from 'pinia'
import App from './App.vue';
import router from './router/index.js'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)

createApp(App)
    .use(router)
    .use(pinia)
    .mount('#app');
