import axios from "axios";
import { useAuthStore } from "../store/AuthStore";

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || "http://127.0.0.1:8000/api",
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
  withCredentials: true, // Para manejar las cookies (refresh token)
});

const AuthService = {
  /**
   * Inicia sesión con las credenciales proporcionadas.
   */
  async login(credentials) {
    try {
      const response = await api.post("/login", credentials);
      const { access_token, refresh_token, user } = response.data;

      const authStore = useAuthStore();
      authStore.setTokens(access_token, refresh_token);
      authStore.setUserRole(user.role); // Guardamos el rol en Pinia

      return response.data;
    } catch (error) {
      console.error("Error en el login:", error.response?.data || error.message);
      throw error;
    }
  },

  /**
   * Obtiene los datos del usuario autenticado.
   */
  async getUserData() {
    try {
      const response = await api.get("/me");
      return response.data;
    } catch (error) {
      console.error("Error al obtener datos del usuario:", error);
      throw error;
    }
  },

  /**
   * Refresca el token de acceso.
   */
  async refreshToken() {
    try {
      const authStore = useAuthStore();
      const refreshToken = authStore.refreshToken;

      if (!refreshToken) throw new Error("No hay refresh token disponible.");

      const response = await api.post("/refreshToken", { refresh_token: refreshToken });
      const newAccessToken = response.data.access_token;

      authStore.setTokens(newAccessToken, refreshToken);

      return newAccessToken;
    } catch (error) {
      console.error("Error al refrescar el token:", error);
      throw error;
    }
  },

  /**
   * Cierra sesión eliminando los tokens.
   */
  async logout() {
    try {
      await api.post("/logout");
      const authStore = useAuthStore();
      authStore.clearTokens();
    } catch (error) {
      console.error("Error en el logout:", error);
      throw error;
    }
  },
};

// Agregar el token en cada petición
api.interceptors.request.use(
  (config) => {
    const authStore = useAuthStore();
    if (authStore.accessToken) {
      config.headers.Authorization = `Bearer ${authStore.accessToken}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

export default AuthService;
