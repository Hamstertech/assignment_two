import { defineStore } from 'pinia';
import axiosClient from '@/axios';


export const useDefaultData = defineStore('defaultData', {
    state: () => ({
        loading: false
    }),
    getters: {
        getLoadingState(state) {
            return state.loading;
        }
    },
    actions: {
        // async getWelcomeData() {
        //     return axiosClient.get('/api/')
        //             .then((data) => {
        //                 this.creators = data.data;
        //                 // commit('setViewLoading', false);
        //                 // commit('setDashboardData', res.data);
        //             })
        //             .catch(err => {
        //                 // commit('setViewLoading', false);
        //             })
        //     ------------------------------------
        //     async getWelcomeData() {
        //         return axiosClient.get('/api/')
        //             .then((res) => {
        //                 console.log(res);
        //                 this.creators = res.data;
        //                 // commit('setViewLoading', false);
        //                 // commit('setDashboardData', res.data);
        //                 return res;
        //             })
        //             .catch(err => {
        //                 // commit('setViewLoading', false);
        //                 return err;
        //             })
        //     },
        // }
    }
})


export default useDefaultData;