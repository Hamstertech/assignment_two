<template>
    <div class="flex items-center justify-between">
        <div class="mt-3 col-span-3">
            <label for="media_type" class="block text-sm font-medium text-gray-700">
                Film
            </label>
        </div>

        <div v-if="!!profile.token" class="flex items-center">
            <button type="button" @click="deleteFilm()" class="flex items-center text-sm px-1 py-3 rounded-full border border-transparent text-red-500 hover:border-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Delete
            </button>
        </div>
    </div>
    
    <div>
        <div class="flex justify-between text-gray-600 text-center py-3">
            <div>
                <label :for="'title_'+film.id" class="text-left block text-sm font-medium text-gray-700">
                    Title
                </label>
                <input :disabled="!profile.token" :id="'title_'+film.id" v-model="film.title" autocomplete="title" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label :for="'genre_'+film.id" class="text-left block text-sm font-medium text-gray-700">
                    Genre
                </label>
                <input :disabled="!profile.token" :id="'genre_'+film.id" v-model="film.genre" autocomplete="genre" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label :for="'production_studio_'+film.id" class="text-left block text-sm font-medium text-gray-700">
                    Production Studio
                </label>
                <input :disabled="!profile.token" :id="'production_studio_'+film.id" v-model="film.production_studio" autocomplete="production_studio" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label :for="'cost_to_produce_'+film.id" class="text-left block text-sm font-medium text-gray-700">
                    Cost To Produce
                </label>
                <input :disabled="!profile.token" :id="'cost_to_produce_'+film.id" v-model="film.cost_to_produce" autocomplete="cost_to_produce" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label :for="'language_'+film.id" class="text-left block text-sm font-medium text-gray-700">
                    Language
                </label>
                <input :disabled="!profile.token" :id="'language_'+film.id" v-model="film.language" autocomplete="language" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
    </div>
    
    <hr class="my-4">
</template>

<script setup>
import { computed } from 'vue';
import { useUserStore } from '@/stores/user';
const userStore = useUserStore();
const profile = computed(() => {
    return userStore.getProfile;
});

const props = defineProps({
    film: Object,
    index: Number,
});

const emit = defineEmits(["deleteFilm"]);

function deleteFilm() {
    emit('deleteFilm', props.film)
}

</script>