import { defineStore } from 'pinia';
import axiosClient from '@/axios';

export const useUserStore = defineStore('user', {
    state: () => ({
        user: {
            data: {},
            token: null
        },
        errors: null,
    }),
    getters: {
        getProfile(state) {
            return state.user;
        },
        getErrors(state) {
            return state.errors;
        }
    },
    actions: {
        async registerUser(data) {
            try {
                this.errors = null;
                const response = await axiosClient.post('/api/register', {data});
                if(response.status !== 200) {
                    this.user.data = response.data.user;
                    this.user.token = response.data.token;
                    this.router.push({ name: 'MainPage' });
                } else {
                    this.errors = response.response.data.errors;
                }
            } catch (error) {
                alert(error);
            }
        },
        async loginUser(data) {
            try {
                const response = await axiosClient.post('/api/login', {data});
                this.user.data = response.data.user;
                this.user.token = response.data.token;
                this.router.push({ name: 'MainPage' });
            } catch (error) {
                alert(error);
            }
        },
        async logoutUser() {
            try {
                const response = await axiosClient.post('/api/logout');
                this.user.data = {};
                this.user.token = null;
                this.router.push({ name: 'MainPage' });
            } catch (error) {
                alert(error);
            }
        }
    },
    persist: {
        paths: ['user'],
    },
})


export default useUserStore;