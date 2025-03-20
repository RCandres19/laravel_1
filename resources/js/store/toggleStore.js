// Importa la función `defineStore` de Pinia para definir un store de estado global
import { defineStore } from "pinia";

/**
 * Store de estado para gestionar la selección entre "Café" y "Mora".
 * También almacena un nombre de usuario.
 *
 * @property {boolean} isCafe - Indica si la opción seleccionada es "Café" (true) o "Mora" (false).
 * @property {string} nombre - Almacena el nombre del usuario.
 *
 * @getter tipoSeleccionado - Devuelve "Café" si `isCafe` es true, o "Mora" si es false.
 *
 * @method toggle() - Alterna entre las opciones "Café" y "Mora".
 * @method setNombre(nuevoNombre) - Establece el nombre del usuario si es un string válido.
 */
export const useToggleStore = defineStore("toggle", {
  // Definición del estado del store
  state: () => ({
    isCafe: false, // Variable que indica la opción seleccionada (false = Mora, true = Café)
    nombre: "Usuario", // Nombre predeterminado del usuario
  }),

  // Getters (propiedades computadas basadas en el estado)
  getters: {
    /**
     * Devuelve el tipo seleccionado basado en el estado `isCafe`.
     *
     * @param {Object} state - Estado actual del store.
     * @returns {string} "Café" si `isCafe` es true, "Mora" si es false.
     */
    tipoSeleccionado: (state) => (state.isCafe ? "Café" : "Mora"),
  },

  // Métodos (acciones) que modifican el estado
  actions: {
    /**
     * Alterna la selección entre "Café" y "Mora".
     */
    toggle() {
      this.isCafe = !this.isCafe;
    },

    /**
     * Asigna un nuevo nombre al usuario si es un string válido.
     *
     * @param {string} nuevoNombre - Nombre a asignar al usuario.
     */
    setNombre(nuevoNombre) {
      // Verifica que el nombre no sea vacío y sea un string antes de asignarlo
      if (nuevoNombre && typeof nuevoNombre === "string") {
        this.nombre = nuevoNombre.trim(); // Elimina espacios en blanco adicionales
      }
    },
  },
});
