import { defineStore } from 'pinia';
import axiosClient from '@/axios';


export const useUserStore = defineStore('user', {
    state: () => ({
        user: {
            data: {},
            token: null
        },
        errors: {}
    }),
    getters: {
        getProfile(state) {
            return state.user;
        }
    },
    actions: {
        async registerUser(data) {
            try {
                const response = await axiosClient.post('/api/register', {data});
                this.user.data = response.data.user;
                this.user.token = response.data.token;
            } catch (error) {
                alert(error);
            }
        },
        async loginUser(data) {
            try {
                const response = await axiosClient.post('/api/login', {data});
                this.user.data = response.data.user;
                this.user.token = response.data.token;
            } catch (error) {
                alert(error);
            }
        },
        async logoutUser() {
            try {
                const response = await axiosClient.post('/api/logout');
                this.user.data = {};
                this.user.token = null;
            } catch (error) {
                alert(error);
            }
        }
    },
    persist: true,
})


export default useUserStore;