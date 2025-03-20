// Importa la función `defineStore` de Pinia para definir un store de estado global
import { defineStore } from "pinia";

/**
 * Store de usuario utilizando Pinia.
 * 
 * @property {string} userName - Nombre del usuario almacenado en el estado global.
 * 
 * @method setUserName(name) - Establece el nombre del usuario, validando que sea un string.
 */
export const useUserStore = defineStore("user", {
  // Definición del estado del store
  state: () => ({
    userName: sessionStorage.getItem("userName") || "", // Cargar desde sessionStorage
  }),

  // Métodos (acciones) que modifican el estado
  actions: {
    /**
     * Asigna un nombre de usuario al estado global.
     * 
     * @param {string} name - Nombre del usuario a almacenar.
     */
    setUserName(name) {
      // Verifica que el nombre no sea vacío y sea un string antes de asignarlo
      if (name && typeof name === "string") {
        this.userName = name.trim(); // Elimina espacios en blanco adicionales
        sessionStorage.setItem("userName", this.userName);
      }
    },

    /**
     * Carga el usuario almacenado en sessionStorage al iniciar la app.
     */
    loadUserFromStorage() {
      this.userName = sessionStorage.getItem("userName") || "";
    },

    /**
     * Borra el usuario al cerrar sesión.
     */
    clearUser() {
      this.userName = "";
      sessionStorage.removeItem("userName");
    },
  },
});
