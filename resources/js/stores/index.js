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
    }
})


export default useDefaultData;