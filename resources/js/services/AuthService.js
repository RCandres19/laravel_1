import axios from "axios";
import { useAuthStore } from "../store/AuthStore"; // Importamos la tienda de autenticación

const AuthService = {
  async login(credentials) {
    try {
      const response = await axios.post("/api/login", credentials);
      const { access_token, refresh_token } = response.data;

      // Guardamos los tokens en la tienda de autenticación
      const authStore = useAuthStore();
      authStore.setTokens(access_token, refresh_token);

      return response.data;
    } catch (error) {
      console.error("Error en el login:", error);
      throw error;
    }
  },

  async refreshToken() {
    try {
      const authStore = useAuthStore();
      const response = await axios.post("/api/refresh-token", {
        refresh_token: authStore.refreshToken,
      });

      const { access_token } = response.data;
      authStore.setTokens(access_token, authStore.refreshToken);

      return access_token;
    } catch (error) {
      console.error("Error al refrescar el token:", error);
      authStore.clearTokens();
      throw error;
    }
  },

  async logout() {
    try {
      const authStore = useAuthStore();
      await axios.post("/api/logout", {
        refresh_token: authStore.refreshToken,
      });

      authStore.clearTokens(); // Eliminamos los tokens de la tienda
    } catch (error) {
      console.error("Error en el logout:", error);
      throw error;
    }
  },
};

export default AuthService;
