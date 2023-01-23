<template>
    <div class="flex items-center justify-between">
        <div class="mt-3 col-span-3">
            <label for="media_type" class="block text-sm font-medium text-gray-700">
                Song
            </label>
        </div>

        <div v-if="!!profile.token" class="flex items-center">
            <button type="button" @click="deleteSong()" class="flex items-center text-sm px-1 py-3 rounded-full border border-transparent text-red-500 hover:border-red-600">
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
                <label :for="'name_'+song.id" class="text-left block text-sm font-medium text-gray-700">
                    Name
                </label>
                <input :disabled="!profile.token" :id="'name_'+song.id" v-model="song.name" autocomplete="name" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label :for="'genre_'+song.id" class="text-left block text-sm font-medium text-gray-700">
                    Genre
                </label>
                <input :disabled="!profile.token" :id="'genre_'+song.id" v-model="song.genre" autocomplete="genre" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label :for="'duration_'+song.id" class="text-left block text-sm font-medium text-gray-700">
                    Duration
                </label>
                <input :disabled="!profile.token" :id="'duration_'+song.id" v-model="song.duration" autocomplete="duration" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label :for="'record_label_'+song.id" class="text-left block text-sm font-medium text-gray-700">
                    Record Label
                </label>
                <input :disabled="!profile.token" :id="'record_label_'+song.id" v-model="song.record_label" autocomplete="record_label" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label :for="'tempo_'+song.id" class="text-left block text-sm font-medium text-gray-700">
                    Tempo
                </label>
                <input :disabled="!profile.token" :id="'tempo_'+song.id" v-model="song.tempo" autocomplete="tempo" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
    song: Object,
    index: Number,
});


const emit = defineEmits(["deleteSong"]);

function deleteSong() {
    emit('deleteSong', props.song)
}

</script>