import axios from "axios";
import { useAuthStore } from "../store/AuthStore";

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || "http://127.0.0.1:8000/api", //  Usa la variable de entorno
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
  withCredentials: true,
});

const AuthService = {
  async login(credentials) {
    try {
      const response = await api.post("/login", credentials);
      return response.data;
    } catch (error) {
      console.error(" Error en el login:", error.response?.data || error.message);
      throw error;
    }
  },

  async refreshToken(refreshToken) {
    try {
      const response = await api.post("/refreshToken", { refresh_token: refreshToken });
      return response.data.access_token;
    } catch (error) {
      console.error(" Error al refrescar el token:", error);
      throw error;
    }
  },

  async logout() {
    try {
      await api.post("/logout", {}, { withCredentials: true }); //  Enviamos solo la cookie
    } catch (error) {
      console.error("Error en el logout:", error);
      throw error;
    }
  }
  
};

api.interceptors.request.use(
  (config) => {
    const authStore = useAuthStore();
    if (authStore.accessToken) {
      config.headers.Authorization = `Bearer ${authStore.accessToken}`;

    } return config;
  },
  (error) => Promise.reject(error)
);

export default AuthService;
