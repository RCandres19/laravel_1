//import { createApp } from 'vue'
//import App from './App.vue'
//createApp(App).mount('#app')


import { createApp } from 'vue'; // Importa la función para crear la aplicación Vue
import App from './App.vue'; // Importa el componente principal de la aplicación
import router from './router'; // Importa el enrutador de Vue Router
import './assets/style.css'; // Importa un archivo de estilos globales
import axios from 'axios'; // Importa Axios para manejar solicitudes HTTP

import { createPinia } from 'pinia'; // Importamos Pinia
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faHome, faUser, faBell, faCog, faSignOutAlt, faBars} from "@fortawesome/free-solid-svg-icons";

// Agregar iconos a la librería
library.add(faHome, faUser, faBell, faCog, faSignOutAlt, faBars);



// Configuración de la base URL de Axios para que todas las solicitudes apunten a la API de Laravel
axios.defaults.baseURL = 'http://127.0.0.1:8000/api'; 

// Crea la instancia de la aplicación Vue
const app = createApp(App);

// Agrega Axios como una propiedad global para que pueda ser accedida desde cualquier componente
app.config.globalProperties.$axios = axios;

// Usa Vue Router para manejar la navegación entre páginas
app.use(router);

// Registra Pinia en la app
app.use(createPinia()); 

//COmponente de FontAwesome
app.component("font-awesome-icon", FontAwesomeIcon);

// Monta la aplicación en el elemento con el ID "app" en el archivo HTML
app.mount('#app');


//import './bootstrap';
