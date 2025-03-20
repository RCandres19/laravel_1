// Importamos Axios para realizar peticiones HTTP
import axios from "axios";
import { useAuthStore } from "../store/AuthStore";

// Configuración de Axios con la URL base de la API y encabezados predeterminados
const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || "http://127.0.0.1:8000/api", // Usa la variable de entorno o una URL por defecto
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
  withCredentials: true, // Permite el uso de cookies en las peticiones (útil para sesiones o refresh tokens)
});

/**
 * Servicio de autenticación que maneja el inicio de sesión, cierre de sesión y renovación de tokens.
 */
const AuthService = {
  /**
   * Inicia sesión con las credenciales proporcionadas.
   * @param {Object} credentials - Credenciales del usuario ({ name, document, password }).
   * @returns {Promise<Object>} - Retorna un objeto con el `access_token` y `refresh_token`.
   * @throws {Error} - Lanza un error si la autenticación falla.
   */
  async login(credentials) {
    try {
      const response = await api.post("/login", credentials);
      return response.data;
    } catch (error) {
      console.error("Error en el login:", error.response?.data || error.message);
      throw error;
    }
  },

  /**
   * Solicita un nuevo token de acceso usando el refresh token.
   * @param {string} refreshToken - Token de actualización del usuario.
   * @returns {Promise<string>} - Retorna un nuevo `access_token`.
   * @throws {Error} - Lanza un error si la renovación del token falla.
   */
  async refreshToken(refreshToken) {
    try {
      const response = await api.post("/refreshToken", { refresh_token: refreshToken });
      return response.data.access_token;
    } catch (error) {
      console.error("Error al refrescar el token:", error);
      throw error;
    }
  },

  /**
   * Cierra la sesión del usuario eliminando la sesión en el servidor.
   * @returns {Promise<void>} - No retorna datos, solo ejecuta la petición.
   * @throws {Error} - Lanza un error si el logout falla.
   */
  async logout() {
    try {
      await api.post("/logout", {}, { withCredentials: true }); // Enviamos solo la cookie
    } catch (error) {
      console.error("Error en el logout:", error);
      throw error;
    }
  },
};

// Interceptor para agregar el token de autenticación a cada petición
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
