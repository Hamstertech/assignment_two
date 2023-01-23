import { createRouter, createWebHistory } from 'vue-router';
import useUserStore from '@/stores/user';
import { computed } from 'vue'

import Default from '@/components/Default.vue';
import Register from '@/components/Register.vue';
import Login from '@/components/Login.vue';
import CreatorView from '@/components/CreatorView.vue';
// import Login from '../views/Login.vue';
// import Welcome from '../components/front/Welcome.vue';
// import Dashboard from '../views/Dashboard.vue';
// import Register from '../views/Register.vue';
// import PageNotFound from '../components/viewer/PageNotFound.vue';

const user = computed(() => {
    return useUserStore.getProfile;
});

const routes = [
    { path: '/', name: 'MainPage', component: Default, meta: { title: 'Welcome' } },
    { path: '/login', name: 'Login', component: Login, meta: { title: 'Login' } },
    { path: '/logout', name: 'Logout', meta: { title: 'Logout' } },
    { path: '/register', name: 'Register', component: Register, meta: { title: 'Register' } },
    { path: '/creator/:id', name: 'CreatorView', component: CreatorView, meta: { title: 'Creator' } },
    // {
    //     path: '/admin',
    //     name: 'Admin',
    //     meta: { requiresAuth: true, },
    //     component: BackLayout,
    //     children: [
    //         { path: '', name: 'Dashboard', component: Dashboard, meta: { title: 'Dashboard', requiresAuth: true, } },
    //         { path: 'register', name: 'Register', component: Register, meta: { title: 'Register', requiresAuth: true, } },
    //     ]
    // },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});


router.beforeEach((to, from, next) => {
    const userStore = useUserStore();

    document.title = 'Assignment - ' + cleanTitle(to.params.slug ?? to.meta.title);
    
    // ---Safety net to avoid infinite loop---
    if(to.name === 'PageNotFound'){ return next(); }
    
    if(to.meta.requiresAuth && !userStore.getProfile.token) {
        return next({ name: 'Login' });
    } else if(userStore.getProfile.token && (to.name === 'Login' || to.name === 'Register')) {
        return next({ name: 'MainPage' });
    } else if(userStore.getProfile.token && to.name === 'Logout') {
        return next({ name: 'MainPage' });
    } else if(to.meta.requiresAuth && userStore.getProfile.token) {
        return next({ name: 'PageNotFound' });
    } else {
        return next();
    }     
});

function cleanTitle(title){
    return title.charAt(0).toUpperCase() + title.slice(1);
}

export default router;