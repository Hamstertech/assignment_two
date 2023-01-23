import axios from "axios";
//import store from "./stores/index";
//import router from "./router/index";


const axiosClient = axios.create({
  	baseURL: import.meta.env.VITE_APP_SECURE+`${import.meta.env.VITE_APP_URL}`,
});


axiosClient.defaults.withCredentials = true;
axiosClient.get('/sanctum/csrf-cookie');


// TODO: Fix this issue
// axiosClient.interceptors.request.use(config => {
// 	config.headers.Authorization = `Bearer ${store.state.user.token}`;
// 	return config;
// });


axiosClient.interceptors.response.use(response => {
	return response;
}, error => {
	// if (error.response.status === 401) {
	// 	sessionStorage.removeItem('TOKEN')
	//     router.push({name: 'Auth'});
	// } else if (error.response.status === 404) {
	// 	router.push({name: 'NotFound'});
	// } else {
	// 	return Promise.reject(error);
	// }
	return error;
});



export default axiosClient;