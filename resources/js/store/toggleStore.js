import { defineStore } from "pinia";

export const useToggleStore = defineStore("toggle", {
  state: () => ({
    isCafe: false,
    nombre: "Usuario",
  }),
  getters: {
    tipoSeleccionado: (state) => (state.isCafe ? "Café" : "Mora"),
  },
  actions: {
    toggle() {
      this.isCafe = !this.isCafe;
    },
    setNombre(nuevoNombre) {
      if (nuevoNombre && typeof nuevoNombre === "string") {
        this.nombre = nuevoNombre.trim();
      }
    },
  },
});
