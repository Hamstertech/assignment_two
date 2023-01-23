<template>
    <div class="flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="fixed top-0 right-0">
            <div class="relative flex flex-col">
                <span v-if="profile.data.name" :class="[ 'block px-4 py-2 text-sm text-gray-300 font-bold']">{{ profile.data.name }}</span>
                <div class="">
                    <div v-if="profile.data.name">
                        <router-link :to="{ name: 'Logout' }" :class="[ 'block px-4 py-2 text-sm text-gray-300 cursor-pointer hover:bg-slate-300']">Log Out</router-link>
                    </div>
                    <div v-else>
                        <router-link :to="{ name: 'Login' }" :class="[ 'block px-4 py-2 text-sm text-gray-300 cursor-pointer hover:bg-slate-300',]">Sign in</router-link>
                        <router-link :to="{ name: 'Register' }" :class="[ 'block px-4 py-2 text-sm text-gray-300 cursor-pointer hover:bg-slate-300',]">Register</router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-11/12">
            <span class="text-white">Creators</span>
            
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="">
                        <tr class="">
                            <th class="text-left text-base font-medium leading-none text-gray-300 mr-2">Name</th>
                            <th class="text-center text-base font-medium leading-none text-gray-300 mr-2">Nationality</th>
                            <th class="text-center text-base font-medium leading-none text-gray-300 mr-2">Date of Birth</th>
                            <th class="text-center text-base font-medium leading-none text-gray-300 mr-2">Works (Books/Songs/Film)</th>
                            <th class="text-center text-base font-medium leading-none text-gray-300 mr-2">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr v-for="creator in creators" tabindex="0" class="h-16 border border-gray-100 rounded">
                            <td class="text-left text-base font-medium leading-none text-gray-300 mr-2">
                                {{ creator.fname }} {{ creator.lname }}
                            </td>
                            <td class="text-center text-base font-medium leading-none text-gray-300 mr-2">
                                {{ creator.nationality }}
                            </td>
                            <td class="text-center text-base font-medium leading-none text-gray-300 mr-2">
                                {{ creator.dob }}
                            </td>
                            <td class="text-center text-base font-medium leading-none text-gray-300 mr-2">
                                {{ creator.books }} / {{ creator.songs }} / {{ creator.films }}
                            </td>
                            <td class="float-right font-medium leading-none text-gray-300 mr-2">
                                <a v-if="profile.data.name" @click="delete(creator.id)" 
                                    title="Delete" role="button" aria-expanded="false" tabindex="0" 
                                    class="m-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm 
                                        font-medium rounded-md text-white bg-rose-600 hover:bg-rose-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                                <router-link :to="{ name: 'CreatorView', params: { id: creator.id } }" 
                                    title="View" role="button" aria-expanded="false" tabindex="0"
                                    class="m-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm 
                                        font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</template>

<script setup>
import { onMounted, computed } from 'vue'
import { useDefaultData } from '@/stores/index';
import { useUserStore } from '@/stores/user';

const defaultStore = useDefaultData();
const userStore = useUserStore();

const creators = computed(() => {
    return defaultStore.getCreators;
});

const profile = computed(() => {
    return userStore.getProfile;
});

onMounted(() => {
    defaultStore.getWelcomeData();
});

</script>