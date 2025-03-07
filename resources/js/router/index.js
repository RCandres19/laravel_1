// Importamos las funciones necesarias desde 'vue-router' para crear el enrutador
import { createRouter, createWebHistory } from 'vue-router';

// Importamos los componentes de las vistas que usaremos en las rutas
import HomePages from '../views/HomePages.vue';
import LoginAccess from '../views/LoginAccess.vue';
import RegisterUsers from '../views/RegisterUsers.vue';
import WelcomeUsers from '../views/WelcomeUsers.vue';

//Importamos las rutas para el SidebarLateral, que llevara a las otras paginas correspondientes
import CultivosInfo from '../views/views/CultivosInfo.vue';
import NoticiasInfo from '../views/views/NoticiasInfo.vue';
import ClimaInfo from '../views/views/ClimaInfo.vue';
import MercadoInfo from '../views/views/MercadoInfo.vue';
import FincaInfo from '../views/views/FincaInfo.vue';

// Definimos las rutas de la aplicación
const routes = [
  { path: '/', component: HomePages }, // Ruta para la página principal
  { path: '/login', component: LoginAccess }, // Ruta para la página de inicio de sesión
  { path: '/register', component: RegisterUsers }, // Ruta para la página de registro
  { path: '/welcome/:name', component: WelcomeUsers }, // Ruta de WelcomeUsers

  { path: '/:tipo/cultivos', component: CultivosInfo },
  { path: '/:tipo/noticias', component: NoticiasInfo },
  { path: '/:tipo/clima', component: ClimaInfo },
  { path: '/:tipo/mercado', component: MercadoInfo },
  { path: '/:tipo/finca', component: FincaInfo },
];

// Creamos el enrutador con el historial basado en el navegador
const router = createRouter({
  history: createWebHistory(), // Utiliza el historial de navegación estándar del navegador
  routes // Pasamos las rutas definidas anteriormente
});

// Exportamos el enrutador para usarlo en la aplicación
export default router;
