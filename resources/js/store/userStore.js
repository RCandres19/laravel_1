import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
  state: () => ({
    userName: localStorage.getItem("userName") || "", // Carga inicial desde localStorage
  }),

  actions: {
    /**
     * Establece el nombre del usuario y lo almacena en `localStorage`.
     * @param {string} name - Nombre del usuario.
     */
    setUserName(name) {
      if (name && typeof name === "string") {
        this.userName = name.trim();
        localStorage.setItem("userName", this.userName);
      }
    },

    /**
     * Carga el usuario almacenado en `localStorage` y lo asigna al estado.
     */
    loadUserFromStorage() {
      const storedName = localStorage.getItem("userName");
      if (storedName) {
        this.userName = storedName;
      }
    },
  },
});
