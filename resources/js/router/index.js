import { createRouter, createWebHistory } from 'vue-router';
import useUserStore from '@/stores/user';
import Default from '@/components/Default.vue';
import Register from '@/components/Register.vue';
import Login from '@/components/Login.vue';
import CreatorView from '@/components/CreatorView.vue';


const routes = [
    { path: '/', name: 'MainPage', component: Default, meta: { title: 'Welcome' } },
    { path: '/login', name: 'Login', component: Login, meta: { title: 'Login' } },
    { path: '/logout', name: 'Logout', meta: { title: 'Logout' } },
    { path: '/register', name: 'Register', component: Register, meta: { title: 'Register' } },
    { path: '/creator', name: 'CreateCreator', component: CreatorView, meta: { title: 'Add Creator' } },
    { path: '/creator/:id', name: 'CreatorView', component: CreatorView, meta: { title: 'Creator' } },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});


router.beforeEach((to, from, next) => {
    const userStore = useUserStore();

    document.title = 'Assignment - ' + cleanTitle(to.params.slug ?? to.meta.title);
    
    if(to.meta.requiresAuth && !userStore.getProfile.token) {
        return next({ name: 'Login' });
    } else if(userStore.getProfile.token && (to.name === 'Login' || to.name === 'Register')) {
        return next({ name: 'MainPage' });
    } else if(userStore.getProfile.token && to.name === 'Logout') {
        return next({ name: 'MainPage' });
    } else {
        return next();
    }     
});

function cleanTitle(title){
    return title.charAt(0).toUpperCase() + title.slice(1);
}

export default router;