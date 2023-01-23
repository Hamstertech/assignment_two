import { defineStore } from 'pinia';
import axiosClient from '@/axios';


export const useMediaStore = defineStore('mediaStore', {
    state: () => ({
        creators: {},
        creator: {
            first_name: '',
            last_name: '',
            date_of_birth: '',
            nationality: '',
            books: [],
            songs: [],
            films: [],
        },
    }),
    getters: {
        getCreators(state) {
            return state.creators;
        },
        getCreator(state) {
            return state.creator;
        }
    },
    actions: {
        async getCreatorData(id) {
            try {
                const response = await axiosClient.get(`/api/creator/${id}`);
                this.creator = response.data.data;
            } catch (error) {
                alert(error);
            }
        },
        async postCreatorData() {
            const payload = this.creator;
            try {
                const response = await axiosClient.post('/api/creator/', {payload});
                console.log(response);;
            } catch (error) {
                alert(error);
            }
        },
        removeMedium(type, id) {
            this.creator[`${type}s`] = this.creator[`${type}s`].filter((q) => q.id !== id);
        },
        addMedium(type, item) {
            this.creator[`${type}s`].push(item);
        }
    }
})


export default useMediaStore;