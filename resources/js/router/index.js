import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "@/stores/AuthStore"; // Usamos Pinia en lugar de isAuthenticated

// Importamos los componentes de las vistas
import HomePages from "@/views/HomePages.vue";
import LoginAccess from "@/views/LoginAccess.vue";
import RegisterUsers from "@/views/RegisterUsers.vue";
import WelcomeUsers from "@/views/WelcomeUsers.vue";
import CultivosInfo from "@/views/CultivosInfo.vue";
import NoticiasInfo from "@/views/NoticiasInfo.vue";
import ClimaInfo from "@/views/ClimaInfo.vue";
import FinancieroInfo from "@/views/Financiero.vue";
import InicioHome from "@/views/InicioHome.vue";
import PerfilPerso from "@/views/PerfilPerso.vue";
import ConfiguracionSen from "@/views/ConfiguracionSen.vue";
import SalirPages from "@/views/SalirPages.vue";
import ObtenerUsers from "@/components/ObtenerUsers.vue";

// Definimos las rutas de la aplicación
const routes = [
  { path: "/", component: HomePages },
  { path: "/login", component: LoginAccess, meta: { requiresGuest: true } },
  { path: "/register", component: RegisterUsers, meta: { requiresGuest: true } },
  { path: "/welcome", component: WelcomeUsers, meta: { requiresAuth: true } },
  { path: "/cultivos", component: CultivosInfo, meta: { requiresAuth: true } },
  { path: "/noticias", component: NoticiasInfo, meta: { requiresAuth: true } },
  { path: "/clima", component: ClimaInfo, meta: { requiresAuth: true } },
  { path: "/financiero", component: FinancieroInfo, meta: { requiresAuth: true } },
  { path: "/inicio", component: InicioHome, meta: { requiresAuth: true } },
  { path: "/perfil", component: PerfilPerso, meta: { requiresAuth: true } },
  { path: "/configuracion", component: ConfiguracionSen, meta: { requiresAuth: true } },
  { path: "/salir", component: SalirPages, meta: { requiresAuth: true } },
  { path: "/usuarios", component: ObtenerUsers, meta: { requiresAuth: true } },
];

// Creamos el enrutador con historial basado en el navegador
const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Protección de rutas con beforeEach
router.beforeEach((to, from, next) => {
  const authStore = useAuthStore(); // Obtenemos la tienda de autenticación
  const token = authStore.token; // Obtenemos el token desde Pinia

  if (to.meta.requiresAuth && !token) {
    next({ path: "/login", query: { redirect: to.fullPath } });
  } else if (to.meta.requiresGuest && token) {
    next({ path: "/welcome" });
  } else {
    next();
  }
});

// Exportamos el enrutador
export default router;
