import { defineStore } from "pinia";

export const useToggleStore = defineStore("toggle", {
  state: () => ({
    isCafe: JSON.parse(localStorage.getItem("isCafe")) ?? false, // Carga desde localStorage
    nombre: localStorage.getItem("nombre") || "Usuario",
  }),

  getters: {
    /**
     * Devuelve el tipo seleccionado basado en el estado `isCafe`.
     * @returns {string} "Café" si `isCafe` es `true`, de lo contrario "Mora".
     */
    tipoSeleccionado: (state) => (state.isCafe ? "Café" : "Mora"),
  },

  actions: {
    /**
     * Alterna entre Café y Mora y guarda el cambio en `localStorage`.
     */
    toggle() {
      this.isCafe = !this.isCafe;
      localStorage.setItem("isCafe", JSON.stringify(this.isCafe));
    },

    /**
     * Establece el nombre del usuario y lo guarda en `localStorage`.
     * @param {string} nuevoNombre - Nombre del usuario.
     */
    setNombre(nuevoNombre) {
      if (nuevoNombre && typeof nuevoNombre === "string") {
        this.nombre = nuevoNombre.trim();
        localStorage.setItem("nombre", this.nombre);
      }
    },
  },
});
