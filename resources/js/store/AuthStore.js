// Importamos `defineStore` de Pinia para gestionar el estado global
import { defineStore } from "pinia";
import AuthService from "../services/AuthService"; // Importamos el servicio de autenticación
import { useUserStore } from "./userStore"; // Importamos el store del usuario

export const useAuthStore = defineStore("auth", {
  state: () => ({
    accessToken: sessionStorage.getItem("accessToken") || null,
    refreshToken: sessionStorage.getItem("refreshToken") || null,
    role: sessionStorage.getItem("role") || null, // Ahora almacenamos el rol del usuario
  }),

  actions: {
    /**
     * Almacena los tokens en el estado y en `sessionStorage`.
     */
    setTokens(accessToken, refreshToken) {
      this.accessToken = accessToken;
      this.refreshToken = refreshToken;
      sessionStorage.setItem("accessToken", accessToken);
      sessionStorage.setItem("refreshToken", refreshToken);
    },

    /**
     * Guarda el rol del usuario en el estado y `sessionStorage`.
     */
    setUserRole(role) {
      this.role = role;
      sessionStorage.setItem("role", role);
    },

    /**
     * Borra los tokens y el rol del usuario.
     */
    clearTokens() {
      this.accessToken = null;
      this.refreshToken = null;
      this.role = null;
      sessionStorage.removeItem("accessToken");
      sessionStorage.removeItem("refreshToken");
      sessionStorage.removeItem("role");
    },

    /**
     * Inicia sesión con credenciales y almacena los tokens y el rol.
     */
    async login(credentials) {
      try {
        const { access_token, refresh_token, user } = await AuthService.login(credentials);
        this.setTokens(access_token, refresh_token);
        this.setUserRole(user.role); // Guardamos el rol del usuario

        //Guarda el nombre de usuario en userStore
        const userStore = useUserStore();
        userStore.setUserName(user.name);

        return user.role; // Devolvemos el rol para redirigirlo en Vue
      } catch (error) {
        throw error;
      }
    },

    /**
     * Refresca el token de acceso.
     */
    async refreshToken() {
      try {
        if (!this.refreshToken) throw new Error("No hay refresh token disponible.");
        const newAccessToken = await AuthService.refreshToken(this.refreshToken);
        this.setTokens(newAccessToken, this.refreshToken);
        return newAccessToken;
      } catch (error) {
        this.clearTokens();
        throw error;
      }
    },

    /**
     * Cierra sesión y borra los tokens.
     */
    async logout() {
      try {
        await AuthService.logout();
        this.clearTokens();

        //Limpiar también el userStore
        const userStore = useUserStore();
        userStore.clearUser();
      } catch (error) {
        console.error("Error al cerrar sesión:", error);
      }
    },

    /**
     * Carga los datos del usuario desde sessionStorage
     */
    loadUserFromStorage() {
      this.accessToken = sessionStorage.getItem("accessToken");
      this.refreshToken = sessionStorage.getItem("refreshToken");
      this.role = sessionStorage.getItem("role");
    },
  },
});
