import axios from "axios";
import router from "@/router"; // Importa el router

const API_URL = import.meta.env.VITE_API_URL || "http://127.0.0.1:8000/api"; // Se obtiene la URL desde .env

const AuthService = {
  // Configuración de Axios
  api: axios.create({
    baseURL: API_URL,
    headers: { "Content-Type": "application/json" },
  }),

  // Función para iniciar sesión
  async login() {
    try {
      const response = await AuthService.api.post("/login");
      const { access_token } = response.data;
      localStorage.setItem("token", access_token);
      return access_token;
    } catch (error) {
      console.error("❌ Error en login:", error.response?.data || error.message);
      throw error;
    }
  },

  // Función para cerrar sesión
  async logout() {
    try {
      await AuthService.api.post("/logout");
    } catch (error) {
      console.error("❌ Error en logout:", error.response?.data || error.message);
    } finally {
      localStorage.removeItem("token");
      router.push("/"); // Redirige al HomePages
    }
  },

  // Función para refrescar el token
  async refreshToken() {
    try {
      console.log("🔄 Intentando refrescar el token...");
      const response = await AuthService.api.post("/refreshToken", {}, { withCredentials: true });
      if (response.data.access_token) {
        console.log("✅ Token refrescado:", response.data.access_token);
        localStorage.setItem("token", response.data.access_token);
        return response.data.access_token;
      }
    } catch (error) {
      console.error("❌ Error al refrescar el token:", error.response?.data || error.message);
      await AuthService.logout();
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

    if (error.response?.status === 401) {
      console.error(" Token inválido o expirado.");

      if (originalRequest.url.includes("/refreshToken")) {
        console.error(" El intento de refresh falló. Cerrando sesión...");
        await AuthService.logout(); // Cerrar sesión si el refresh falla
        return Promise.reject(error);
      }

      if (!originalRequest._retry) {
        originalRequest._retry = true;
        try {
          const newToken = await AuthService.refreshToken();
          originalRequest.headers.Authorization = `Bearer ${newToken}`;
          return AuthService.api(originalRequest);
        } catch (refreshError) {
          return Promise.reject(refreshError);
        }
      }
    }

    return Promise.reject(error);
  }
);


export default AuthService;
