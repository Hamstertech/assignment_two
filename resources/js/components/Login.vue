<template>
    <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Login
        </h2>
    </div>
    <div class="relative flex items-top justify-center">
        <form class="w-96 mt-8 space-y-6" @submit="login">
            <!-- <div v-if="Object.keys(errors).length" class="flex-col items-stretch text-sm flex justify-between py-3 px-5 bg-red-500 text-white rounded">
                <div v-for="(field, i) of Object.keys(errors)" :key="i">
                    <div v-for="(error, index) of errors[field] || []" :key="index">
                        * {{ error }}
                    </div>
                </div>
            </div> -->

            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email-address" class="sr-only">
                        Email address
                    </label>
                    <input id="email-address" name="email" type="email" autocomplete="email" required v-model="user.email" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
                </div>
                <div>
                    <label for="password" class="sr-only">
                        Password
                        </label>
                    <input id="password" name="password" type="password" autocomplete="password" required v-model="user.password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                </div>
            </div>
        
            <div>
                <button :disabled="loading" type="submit" :class="{ 'cursor-not-allowed': loading, 'hover:bg-indigo-500': loading }"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" >
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <svg v-if="loading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Login
                </button>
            </div>
        </form>
    </div>
</template>
  
<script setup>
import { computed } from 'vue'
import { useUserStore } from '@/stores/user';
import { useDefaultData } from '@/stores/index';
import { useRouter } from 'vue-router';

const user = {
    email: '',
    password: '',
};

const router = useRouter();
const defaultStore = useDefaultData();
const userStore = useUserStore();

const loading = computed(() => {
    return defaultStore.getLoadingState;
});

async function login(ev) {
    ev.preventDefault();
    try {
        await userStore.loginUser(user);
        router.push({ name: 'MainPage' });
    } catch (error) {
        alert(error);
    }
}

</script>