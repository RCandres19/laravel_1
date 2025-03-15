import axios from "axios";
import { useRouter } from "vue-router";

const API_URL = import.meta.env.VITE_API_URL; // Se obtiene la URL desde .env
const router = useRouter(); // Inicializa Vue Router

const AuthService = {
  // Configuración de Axios con credenciales habilitadas para manejar cookies
  api: axios.create({
    baseURL: API_URL,
    headers: {
      "Content-Type": "application/json",
    },
    withCredentials: true, // Permite enviar cookies (para el refresh token)
  }),

  // Función para iniciar sesión
  async login(credentials) {
    try {
      const response = await this.api.post("/login", credentials);
      const { access_token } = response.data;

      localStorage.setItem("token", access_token); // Guarda el token en localStorage
      return response.data;
    } catch (error) {
      console.error("Error en login:", error);
      throw error;
    }
  },

  // Función para cerrar sesión
  async logout() {
    try {
      await this.api.post("/logout");
    } catch (error) {
      console.error("Error en logout:", error);
    } finally {
      // Eliminamos todos los datos de autenticación
      localStorage.removeItem("token");
      router.push("/login"); // Redirige al login después de cerrar sesión
    }
  },

  // Función para refrescar el token
  async refreshToken() {
    try {
      const response = await this.api.post("/refresh-token");
      const { access_token } = response.data;
      localStorage.setItem("token", access_token); // Actualiza el token
      return access_token;
    } catch (error) {
      console.error("Error al refrescar el token:", error);
      await this.logout(); // Cierra sesión si falla el refresh
      throw error;
    }
  },
};

// **Interceptores para manejar el token automáticamente**
AuthService.api.interceptors.request.use(
  async (config) => {
    const token = localStorage.getItem("token");
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

// **Interceptores para manejar la expiración del token**
AuthService.api.interceptors.response.use(
  (response) => response,
  async (error) => {
    const originalRequest = error.config;

    // Si el error es por token expirado y no hemos intentado refrescarlo antes
    if (error.response?.status === 401 && !originalRequest._retry) {
      originalRequest._retry = true; // Marca el intento para evitar bucles infinitos

      try {
        const newToken = await AuthService.refreshToken();
        originalRequest.headers.Authorization = `Bearer ${newToken}`;
        return AuthService.api(originalRequest); // Reintenta la petición original
      } catch (refreshError) {
        console.error("No se pudo refrescar el token:", refreshError);
        return Promise.reject(refreshError);
      }
    }

    return Promise.reject(error);
  }
);

export default AuthService;
