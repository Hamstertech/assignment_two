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
            <form @submit="saveCreator">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">
                                First Name
                            </label>
                            <input name="first_name" id="first_name" v-model="creator.first_name" autocomplete="first_name" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">
                                Last Name
                            </label>
                            <input name="last_name" id="last_name" v-model="creator.last_name" autocomplete="last_name" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">
                                Date of Birth
                            </label>
                            <input name="date_of_birth" id="date_of_birth" v-model="creator.date_of_birth" autocomplete="date_of_birth" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="nationality" class="block text-sm font-medium text-gray-700">
                                Nationality
                            </label>
                            <input name="nationality" id="nationality" v-model="creator.nationality" autocomplete="nationality" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="flex">
                            <button type="button" @click="addBook" class="flex items-center text-sm px-3 py-4 rounded-full text-white bg-gray-600 hover:bg-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Book
                            </button>
                            <button type="button" @click="addSong" class="flex items-center text-sm px-3 py-4 rounded-full text-white bg-gray-600 hover:bg-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Song
                            </button>
                            <button type="button" @click="addFilm" class="flex items-center text-sm px-3 py-4 rounded-full text-white bg-gray-600 hover:bg-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Movie
                            </button>
                        </div>
                        <div v-if="!creator.books || !creator.books || !creator.books" class="text-center text-gray-600">
                            No media added.
                        </div>
                        <div v-for="(book, index) in creator.books" :key="book.id">
                            <BookEditor v-if="book.id"
                                :book="book"
                                :index="index"
                                @deleteBook="deleteBook"
                            />
                        </div>
                        <div v-for="(film, index) in creator.films" :key="film.id">
                            <FilmEditor v-if="film.id"
                                :film="film"
                                :index="index"
                                @deleteFilm="deleteFilm"
                            />
                        </div>
                        <div v-for="(song, index) in creator.songs" :key="song.id">
                            <SongEditor v-if="song.id"
                                :song="song"
                                :index="index"
                                @deleteSong="deleteSong"
                            />
                        </div>
                    </div>
                    
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outlne-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                    <pre class="bg-white">{{ creator }}</pre>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { v4 as uuidv4 } from 'uuid';
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import { useUserStore } from '@/stores/user';
import { useMediaStore } from '@/stores/media';
import BookEditor from '@/components/editor/BookEditor.vue';
import FilmEditor from '@/components/editor/FilmEditor.vue';
import SongEditor from '@/components/editor/SongEditor.vue';

const route = useRoute();
const userStore = useUserStore();
const mediaStore = useMediaStore();

if (route.params.id) {
    getData();
}

async function getData() {
    try {
        await mediaStore.getCreatorData(route.params.id);
    } catch (error) {
        alert(error);
    }
}

async function saveCreator(ev) {
    ev.preventDefault();
    try {
        await mediaStore.postCreatorData();
    } catch (error) {
        alert(error);
    }
}

function deleteBook(book) {
    mediaStore.removeMedium('book', book.id);
}

function deleteSong(song) {
    mediaStore.removeMedium('song', song.id);
}

function deleteFilm(film) {
    mediaStore.removeMedium('film', film.id);
}

function addBook() {
    const newMedia = { id: uuidv4(), };
    mediaStore.addMedium('book', newMedia);
}

function addFilm() {
    const newMedia = { id: uuidv4() };
    mediaStore.addMedium('film', newMedia);
}

function addSong() {
    const newMedia = { id: uuidv4() };
    mediaStore.addMedium('song', newMedia);
}

const creator = computed(() => {
    return mediaStore.getCreator;
});

const profile = computed(() => {
    return userStore.getProfile;
});

</script>