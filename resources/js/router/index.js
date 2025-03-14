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

import InicioHome from '../views/InicioHome.vue';
import PerfilPerso from '../views/PerfilPerso.vue';
import ConfiguracionSen from '../views/ConfiguracionSen.vue';
import SalirPages from '../views/SalirPages.vue';

// Definimos las rutas de la aplicación
const routes = [
  { path: '/', component: HomePages }, // Página principal
  { path: '/login', component: LoginAccess }, // Inicio de sesión
  { path: '/register', component: RegisterUsers }, // Registro
  { path: '/welcome/:name', component: WelcomeUsers, name: 'welcome', meta:{requiresAuth: true} }, // Ruta protegida con parámetro

  { path: '/cultivos', component: CultivosInfo, name: 'cultivos' },
  { path: '/noticias', component: NoticiasInfo, name: 'noticias' },
  { path: '/clima', component: ClimaInfo, name: 'clima' },
  { path: '/mercado', component: MercadoInfo, name: 'mercado' },
  { path: '/finca', component: FincaInfo, name: 'finca' },

  { path: '/inicio', component: InicioHome, name: 'inicio' },
  { path: '/perfil', component: PerfilPerso, name: 'perfil' },
  { path: '/configuracion', component: ConfiguracionSen, name: 'configuracion' },
  { path: '/salir', component: SalirPages, name: 'salir' }
];

// Creamos el enrutador con el historial basado en el navegador
const router = createRouter({
  history: createWebHistory(), // Historial de navegación estándar
  routes // Pasamos las rutas definidas
});

//Protegemos rutas que requieren autenticacion
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token');
  if (to.meta.requiresAuth && !token) {
    next('/login');
  } else {
    next();
  }
});

// Exportamos el enrutador para usarlo en la aplicación
export default router;

