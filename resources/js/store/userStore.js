// Importa la función `defineStore` de Pinia para definir un store de estado global
import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
  state: () => ({
    user: JSON.parse(sessionStorage.getItem("user")) || null, // Cargar el usuario completo
  }),

  actions: {
    /**
     * Asigna un objeto de usuario al estado global y lo almacena en sessionStorage.
     * 
     * @param {Object} user - Datos del usuario (nombre, correo, etc.).
     */
    setUser(user) {
      if (user && typeof user === "object") {
        this.user = user;
        sessionStorage.setItem("user", JSON.stringify(user));
      }
    },

    /**
     * Carga los datos del usuario desde sessionStorage al iniciar la app.
     */
    loadUserFromStorage() {
      const storedUser = sessionStorage.getItem("user");
      this.user = storedUser ? JSON.parse(storedUser) : null;
    },

    /**
     * Borra el usuario al cerrar sesión.
     */
    clearUser() {
      this.user = null;
      sessionStorage.removeItem("user");
    },
  },

  getters: {
    /**
     * Devuelve el nombre del usuario si está disponible.
     */
    userName: (state) => state.user?.name || "",
  },
});
