// Importamos las funciones necesarias de 'vue-router'
import { createRouter, createWebHistory } from 'vue-router';

// Importamos los componentes de las vistas
import HomePages from '../views/HomePages.vue';
import LoginAccess from '../views/LoginAccess.vue';
import RegisterUsers from '../views/RegisterUsers.vue';
import WelcomeUsers from '../views/WelcomeUsers.vue';

import CultivosInfo from '../views/CultivosInfo.vue';
import NoticiasInfo from '../views/NoticiasInfo.vue';
import ClimaInfo from '../views/ClimaInfo.vue';
import MercadoInfo from '../views/MercadoInfo.vue';
import FincaInfo from '../views/FincaInfo.vue';

import InicioHome from '../views/InicioHome.vue';
import PerfilPerso from '../views/PerfilPerso.vue';
import ConfiguracionSen from '../views/ConfiguracionSen.vue';
import SalirPages from '../views/SalirPages.vue';

import ObtenerUsers from '../components/ObtenerUsers.vue';

// Función para verificar si el usuario está autenticado
const isAuthenticated = () => !!localStorage.getItem('token');

// Definimos las rutas de la aplicación
const routes = [
  { path: '/', component: HomePages }, // Página principal
  { path: '/login', component: LoginAccess, meta: { requiresGuest: true } }, // Inicio de sesión
  { path: '/register', component: RegisterUsers, meta: { requiresGuest: true } }, // Registro
  { path: '/welcome/:name', component: WelcomeUsers, name: 'welcome', meta: { requiresAuth: true } }, // Ruta protegida

  { path: '/cultivos', component: CultivosInfo, name: 'cultivos', meta: { requiresAuth: true } },
  { path: '/noticias', component: NoticiasInfo, name: 'noticias', meta: { requiresAuth: true } },
  { path: '/clima', component: ClimaInfo, name: 'clima', meta: { requiresAuth: true } },
  { path: '/mercado', component: MercadoInfo, name: 'mercado', meta: { requiresAuth: true } },
  { path: '/finca', component: FincaInfo, name: 'finca', meta: { requiresAuth: true } },

  { path: '/inicio', component: InicioHome, name: 'inicio', meta: { requiresAuth: true } },
  { path: '/perfil', component: PerfilPerso, name: 'perfil', meta: { requiresAuth: true } },
  { path: '/configuracion', component: ConfiguracionSen, name: 'configuracion', meta: { requiresAuth: true } },
  { path: '/salir', component: SalirPages, name: 'salir', meta: { requiresAuth: true } },

  { path: '/usuarios', component: ObtenerUsers, meta: { requiresAuth: true } }
];

// Creamos el enrutador con historial basado en el navegador
const router = createRouter({
  history: createWebHistory(),
  routes
});

// Protección de rutas
router.beforeEach((to, from, next) => {
  const token = isAuthenticated();

  // Si la ruta requiere autenticación y el usuario no está autenticado
  if (to.meta.requiresAuth && !token) {
    next({ path: '/login', query: { redirect: to.fullPath } }); // Guarda la ruta a la que intentaba acceder
  }
  // Si la ruta es solo para invitados y el usuario ya está autenticado
  else if (to.meta.requiresGuest && token) {
    next({ path: `/welcome/${localStorage.getItem('userName')}` });
  } else {
    next(); // Si no hay restricciones, procede normalmente
  }
});

// Exportamos el enrutador
export default router;
