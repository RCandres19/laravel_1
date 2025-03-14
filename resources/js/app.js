import { createApp } from 'vue';
import App from './App.vue';

// 🔹 PLUGINS Y CONFIGURACIONES
import '../css/app.css'; // Importamos TailwindCSS
import router from './router'; // Importamos Vue Router
import { createPinia } from 'pinia'; // Importamos Pinia (Estado global)
import AuthService from './services/AuthService'; // Importamos el servicio de autenticación

// CREACIÓN DE LA APLICACIÓN VUE
const app = createApp(App);

// Agregamos Axios globalmente a Vue
app.config.globalProperties.$axios = AuthService.api;

// USAMOS LOS PLUGINS 
app.use(router); // Habilitamos Vue Router
app.use(createPinia()); // Habilitamos Pinia para la gestión de estado

// MONTAJE DE LA APP 
app.mount('#app'); // Montamos la aplicación en el DOM
