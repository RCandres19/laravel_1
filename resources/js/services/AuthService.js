import axios from "axios";
import { useAuthStore } from "../store/AuthStore";

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || "http://127.0.0.1:8000/api",
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
  withCredentials: true, // Para manejar cookies (refresh token)
});

const AuthService = {
  async login(credentials) {
    try {
      const response = await api.post("/login", credentials);
      console.log("Respuesta del login:", response.data); //  Agrega este log
  
      const { access_token, refresh_token, user } = response.data;
  
      if (!user || !user.role) { // Validamos que `user` exista antes de acceder a `role`
        throw new Error("La respuesta de la API no contiene el usuario o el rol.");
      }
  
      const authStore = useAuthStore();
      authStore.setTokens(access_token, refresh_token);
      authStore.setUserRole(user.role); // Guardamos el rol en Pinia
  
      return response.data;
    } catch (error) {
      console.error("Error en el login:", error.response?.data || error.message);
      throw error;
    }
  },

  async getUserData() {
    try {
      const response = await api.get("/me");
      return response.data;
    } catch (error) {
      console.error("Error al obtener datos del usuario:", error.response?.data || error.message);
      throw error;
    }
  },

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
      console.error("Error al refrescar el token:", error.response?.data || error.message);
      throw error;
    }
  },

  async logout() {
    try {
      await api.post("/logout");
      const authStore = useAuthStore();
      authStore.clearTokens();
    } catch (error) {
      console.error("Error en el logout:", error.response?.data || error.message);
      throw error;
    }
  },
};

// Agregar el token a cada petición
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

// Refrescar token automáticamente si expira
api.interceptors.response.use(
  (response) => response,
  async (error) => {
    const authStore = useAuthStore();
    if (error.response?.status === 401 && authStore.refreshToken) {
      try {
        console.log("Token expirado, intentando refrescar...");
        const newToken = await AuthService.refreshToken();
        error.config.headers.Authorization = `Bearer ${newToken}`;
        return api.request(error.config);
      } catch (refreshError) {
        console.error("Error al refrescar token, cerrando sesión...");
        authStore.clearTokens();
      }
    }
    return Promise.reject(error);
  }
);

export default AuthService;

