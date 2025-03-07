//import { defineStore } from 'pinia';

//export const useToggleStore = defineStore('toggle', {
  //state: () => ({
    //isCafe: false, // Estado inicial: Mora
  //}),
  //actions: {
    //toggle() {
      //this.isCafe = !this.isCafe;
    //},
  //},
//});


import { defineStore } from "pinia";

export const useToggleStore = defineStore("toggle", {
  state: () => ({
    isCafe: false, // Estado inicial: Mora
    nombre: "Usuario", // Puedes cambiarlo según el login
  }),
  getters: {
    tipoSeleccionado: (state) => (state.isCafe ? "Café" : "Mora"),
  },
  actions: {
    toggle() {
      this.isCafe = !this.isCafe;
    },
    setNombre(nuevoNombre) {
      this.nombre = nuevoNombre;
    },
  },
});
