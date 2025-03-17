// Importamos las funciones necesarias de 'vue-router'
import { createRouter, createWebHistory } from "vue-router";
import { isAuthenticated } from "@/utils/auth"; // Mover la lógica a un archivo externo

// Importamos los componentes de las vistas
import HomePages from "../views/HomePages.vue";
import LoginAccess from "../views/LoginAccess.vue";
import RegisterUsers from "../views/RegisterUsers.vue";
import WelcomeUsers from "../views/WelcomeUsers.vue";

import CultivosInfo from "../views/CultivosInfo.vue";
import NoticiasInfo from "../views/NoticiasInfo.vue";
import ClimaInfo from "../views/ClimaInfo.vue";
import MercadoInfo from "../views/MercadoInfo.vue";
import FincaInfo from "../views/FincaInfo.vue";

import InicioHome from "../views/InicioHome.vue";
import PerfilPerso from "../views/PerfilPerso.vue";
import ConfiguracionSen from "../views/ConfiguracionSen.vue";
import SalirPages from "../views/SalirPages.vue";

import ObtenerUsers from "../components/ObtenerUsers.vue";

// Definimos las rutas de la aplicación
const routes = [
  { path: "/", component: HomePages },
  { path: "/login", component: LoginAccess, meta: { requiresGuest: true } },
  { path: "/register", component: RegisterUsers, meta: { requiresGuest: true } },
  { path: "/welcome", component: WelcomeUsers, name: "welcome", meta: { requiresAuth: true } },

  { path: "/cultivos", component: CultivosInfo, name: "cultivos", meta: { requiresAuth: true } },
  { path: "/noticias", component: NoticiasInfo, name: "noticias", meta: { requiresAuth: true } },
  { path: "/clima", component: ClimaInfo, name: "clima", meta: { requiresAuth: true } },
  { path: "/mercado", component: MercadoInfo, name: "mercado", meta: { requiresAuth: true } },
  { path: "/finca", component: FincaInfo, name: "finca", meta: { requiresAuth: true } },

  { path: "/inicio", component: InicioHome, name: "inicio", meta: { requiresAuth: true } },
  { path: "/perfil", component: PerfilPerso, name: "perfil", meta: { requiresAuth: true } },
  { path: "/configuracion", component: ConfiguracionSen, name: "configuracion", meta: { requiresAuth: true } },
  { path: "/salir", component: SalirPages, name: "salir", meta: { requiresAuth: true } },

  { path: "/usuarios", component: ObtenerUsers, meta: { requiresAuth: true } },
];

// Creamos el enrutador con historial basado en el navegador
const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Protección de rutas con beforeEach
router.beforeEach((to, from, next) => {
  const token = isAuthenticated();

  if (to.meta.requiresAuth && !token) {
    // Si la ruta requiere autenticación y no hay token, redirige a login
    next({ path: "/login", query: { redirect: to.fullPath } });
  } else if (to.meta.requiresGuest && token) {
    // Si la ruta es solo para invitados y el usuario ya está autenticado
    next({ path: "/welcome" });
  } else {
    next(); // Si no hay restricciones, procede normalmente
  }
});

// Exportamos el enrutador
export default router;
