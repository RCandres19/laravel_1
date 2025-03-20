// Importamos `defineStore` de Pinia para gestionar el estado global
import { defineStore } from "pinia";
import AuthService from "../services/AuthService"; // Importamos el servicio de autenticación

/**
 * Store de autenticación para gestionar los tokens de acceso y refresh.
 *
 * @property {string|null} accessToken - Token de acceso del usuario, almacenado en `sessionStorage`.
 * @property {string|null} refreshToken - Token de actualización del usuario, almacenado en `sessionStorage`.
 *
 * @method setTokens(accessToken, refreshToken) - Almacena los tokens en el estado y en `sessionStorage`.
 * @method clearTokens() - Elimina los tokens del estado y del almacenamiento de sesión.
 * @method login(credentials) - Realiza la autenticación y almacena los tokens obtenidos.
 * @method refreshToken() - Solicita un nuevo token de acceso usando el `refreshToken`.
 * @method logout() - Cierra sesión eliminando los tokens y notificando al servidor.
 */
export const useAuthStore = defineStore("auth", {
  // Estado inicial del store
  state: () => ({
    accessToken: sessionStorage.getItem("accessToken") || null, // Carga el token de acceso desde sessionStorage
    refreshToken: sessionStorage.getItem("refreshToken") || null, // Carga el refresh token desde sessionStorage
  }),

  // Métodos que modifican el estado
  actions: {
    /**
     * Almacena los tokens en el estado y en `sessionStorage`.
     * 
     * @param {string} accessToken - Token de acceso recibido tras autenticación.
     * @param {string} refreshToken - Token de actualización recibido tras autenticación.
     */
    setTokens(accessToken, refreshToken) {
      this.accessToken = accessToken;
      this.refreshToken = refreshToken;

      sessionStorage.setItem("accessToken", accessToken);
      sessionStorage.setItem("refreshToken", refreshToken);
    },

    /**
     * Elimina los tokens del estado y del almacenamiento de sesión.
     */
    clearTokens() {
      this.accessToken = null;
      this.refreshToken = null;
      sessionStorage.removeItem("accessToken");
      sessionStorage.removeItem("refreshToken");
    },

    /**
     * Inicia sesión con las credenciales del usuario.
     * 
     * @param {Object} credentials - Datos de inicio de sesión (ej. { name, document, password }).
     * @returns {boolean} Retorna `true` si la autenticación es exitosa.
     * @throws {Error} Lanza un error si las credenciales son incorrectas o la API falla.
     */
    async login(credentials) {
      try {
        // Llamada a la API para autenticación
        const { access_token, refresh_token } = await AuthService.login(credentials);
        this.setTokens(access_token, refresh_token);
        return true;
      } catch (error) {
        throw error;
      }
    },

    /**
     * Solicita un nuevo token de acceso usando el `refreshToken`.
     * 
     * @returns {string} Retorna el nuevo token de acceso si la operación es exitosa.
     * @throws {Error} Si el `refreshToken` no está disponible o la solicitud falla.
     */
    async refreshToken() {
      try {
        if (!this.refreshToken) throw new Error("No hay refresh token disponible.");

        // Solicita un nuevo token de acceso a la API
        const newAccessToken = await AuthService.refreshToken(this.refreshToken);
        this.setTokens(newAccessToken, this.refreshToken);
        return newAccessToken;
      } catch (error) {
        this.clearTokens(); // Si hay un error, eliminamos los tokens y forzamos cierre de sesión
        throw error;
      }
    },

    /**
     * Cierra sesión eliminando los tokens y notificando al servidor.
     */
    async logout() {
      try {
        if (!this.refreshToken) return; // Si no hay refresh token, no se necesita cerrar sesión en el servidor

        await AuthService.logout(this.refreshToken); // Notifica al backend que el usuario cierra sesión
        this.clearTokens(); // Borra los tokens del cliente
      } catch (error) {
        console.error("Error al cerrar sesión:", error);
      }
    },
  },
});
