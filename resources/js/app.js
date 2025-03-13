//import { createApp } from 'vue'
//import App from './App.vue'
//createApp(App).mount('#app')


import { createApp } from 'vue'; // Importamos Vue
import App from './App.vue'; // Importamos el componente principal

//  PLUGINS Y CONFIGURACIONES 
import router from './router'; // Importamos Vue Router
import { createPinia } from 'pinia'; // Importamos Pinia (Estado global)
import axios from 'axios'; // Importamos Axios para solicitudes HTTP
import './assets/app.css'; // Importamos los estilos globales

// Configuración de Axios para que todas las solicitudes apunten a la API de Laravel
axios.defaults.baseURL = 'http://127.0.0.1:8000/api'; 

// CREACIÓN DE LA APLICACIÓN VUE
const app = createApp(App);

// Agregamos Axios como propiedad global para usarlo en cualquier componente con `this.$axios`
app.config.globalProperties.$axios = axios;

// USAMOS LOS PLUGINS 
app.use(router); // Habilitamos Vue Router
app.use(createPinia()); // Habilitamos Pinia para la gestión de estado

// MONTAJE DE LA APP 
app.mount('#app'); // Montamos la aplicación en el DOM


//import './bootstrap';
