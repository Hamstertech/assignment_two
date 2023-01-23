import './bootstrap';

import { createApp, markRaw } from 'vue';
import { createPinia } from 'pinia'
import App from './App.vue';
import router from './router/index.js'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

const pinia = createPinia()
pinia.use(({ store }) => {
    store.router = markRaw(router)
})
pinia.use(piniaPluginPersistedstate)

createApp(App)
    .use(router)
    .use(pinia)
    .mount('#app');
