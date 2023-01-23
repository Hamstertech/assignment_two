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
        mediaNames: [],
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
        async getCreatorsData() {
            try {
                const response = await axiosClient.get(`/api/`);
                this.creators = response.data.data;
            } catch (error) {
                alert(error);
            }
        },
        async getCreatorData(id) {
            try {
                const response = await axiosClient.get(`/api/creator/${id}`);
                this.creator = response.data.data;
            } catch (error) {
                alert(error);
            }
        },
        async postCreatorData(id = null) {
            const data = this.creator;

            try {
                if(id) {
                    const response = await axiosClient.put(`/api/creator/${id}`, {data});
                } else {
                    const response = await axiosClient.post('/api/creator/', {data});
                }
            } catch (error) {
                alert(error);
            }
        },
        async deleteCreatorData(id) {
            try {
                const response = await axiosClient.delete(`/api/creator/${id}`);
                this.creators = response.data.data;
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