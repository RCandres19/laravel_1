// Importamos las funciones necesarias desde 'vue-router' para crear el enrutador
import { createRouter, createWebHistory } from 'vue-router';

// Importamos los componentes de las vistas que usaremos en las rutas
import HomePages from '../views/HomePages.vue';
import LoginAccess from '../views/LoginAccess.vue';
import RegisterUsers from '../views/RegisterUsers.vue';
import WelcomeUsers from '../views/WelcomeUsers.vue';

import CultivosInfo from '../views/CultivosInfo.vue';
import NoticiasInfo from '../views/NoticiasInfo.vue';
import ClimaInfo from '../views/ClimaInfo.vue';
import MercadoInfo from '../views/MercadoInfo.vue';
import FincaInfo from '../views/FincaInfo.vue';

import InicioHome from '@/views/InicioHome.vue';
import PerfilPerso from '@/views/PerfilPerso.vue';
import ConfiguracionSen from '@/views/ConfiguracionSen.vue';
import SalirPages from '@/views/SalirPages.vue';


// Definimos las rutas de la aplicación
const routes = [
  { path: '/', component: HomePages }, // Ruta para la página principal
  { path: '/login', component: LoginAccess }, // Ruta para la página de inicio de sesión
  { path: '/register', component: RegisterUsers }, // Ruta para la página de registro
  { path: '/welcome/name:', component: WelcomeUsers }, // Ruta de WelcomeUsers

  { path: '/cultivos',  component: CultivosInfo },
  { path: '/noticias',  component: NoticiasInfo },
  { path: '/clima',  component: ClimaInfo },
  { path: '/mercado',  component: MercadoInfo },
  { path: '/finca',  component: FincaInfo },

  { path: '/inicio',  component: InicioHome },
  { path: '/perfil',  component: PerfilPerso },
  { path: '/configuracion', component: ConfiguracionSen },
  { path: '/salir',  component: SalirPages }
];

// Creamos el enrutador con el historial basado en el navegador
const router = createRouter({
  history: createWebHistory(), // Utiliza el historial de navegación estándar del navegador
  routes // Pasamos las rutas definidas anteriormente
});

// Exportamos el enrutador para usarlo en la aplicación
export default router;
