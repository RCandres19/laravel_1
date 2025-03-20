// Importamos Vue Router y Pinia
import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../store/AuthStore"; // Usamos Pinia para manejar autenticación

//  Importamos los componentes de las vistas principales
import HomePages from "@/views/HomePages.vue";
import LoginAccess from "@/views/LoginAccess.vue";
import RegisterUsers from "@/views/RegisterUsers.vue";
import WelcomeUsers from "@/views/WelcomeUsers.vue";

//  Importamos los componentes de información y servicios
import CultivosInfo from "@/views/CultivosInfo.vue";
import NoticiasInfo from "@/views/NoticiasInfo.vue";
import MercadoInfo from "@/views/MercadoInfo.vue";
import ClimaInfo from "@/views/ClimaInfo.vue";
import FincaInfo from "@/views/FincaInfo.vue";

//  Importamos las vistas de usuario y configuración
import InicioHome from "@/views/InicioHome.vue";
import PerfilPerso from "@/views/PerfilPerso.vue";
import ConfiguracionSen from "@/views/ConfiguracionSen.vue";
import SalirPages from "@/views/SalirPages.vue";
import ObtenerUsers from "@/components/ObtenerUsers.vue";

//  Definimos las rutas de la aplicación con sus respectivos metadatos
const routes = [
  { path: "/", component: HomePages },
  { path: "/login", component: LoginAccess, meta: { requiresGuest: true } },
  { path: "/register", component: RegisterUsers, meta: { requiresGuest: true } },
  { path: "/welcome", component: WelcomeUsers, meta: { requiresAuth: true } },
  
  // Secciones de información y servicios
  { path: "/cultivos", component: CultivosInfo, meta: { requiresAuth: true } },
  { path: "/noticias", component: NoticiasInfo, meta: { requiresAuth: true } },
  { path: "/mercado", component: MercadoInfo, meta: { requiresAuth: true } },
  { path: "/clima", component: ClimaInfo, meta: { requiresAuth: true } },
  { path: "/finca", component: FincaInfo, meta: { requiresAuth: true } },

  // Páginas personales y configuración
  { path: "/inicio", component: InicioHome, meta: { requiresAuth: true } },
  { path: "/perfil", component: PerfilPerso, meta: { requiresAuth: true } },
  { path: "/configuracion", component: ConfiguracionSen, meta: { requiresAuth: true } },
  { path: "/salir", component: SalirPages, meta: { requiresAuth: true } },
  { path: "/usuarios", component: ObtenerUsers, meta: { requiresAuth: true } },
];

//  Creamos el enrutador con historial basado en el navegador
const router = createRouter({
  history: createWebHistory(),
  routes,
});

//  Protección de rutas con beforeEach
router.beforeEach((to, from, next) => {
  const authStore = useAuthStore(); // Accedemos a la tienda de autenticación
  const token = authStore.accessToken; // Obtenemos el token desde Pinia

  //  Si la ruta requiere autenticación y el usuario no tiene un token, redirigir al login
  if (to.meta.requiresAuth && !token) {
    next({ path: "/login", query: { redirect: to.fullPath } });

  //  Si la ruta es solo para invitados y el usuario ya está autenticado, redirigir a welcome
  } else if (to.meta.requiresGuest && token) {
    next({ path: "/welcome" });
  
  //  Si no hay restricciones, continuar con la navegación
  } else {
    next();
  }
});

// 📌 Exportamos el enrutador para su uso en la aplicación
export default router;
