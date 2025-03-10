<template>
  <!-- Barra de navegación superior -->
  <header class="flex justify-end items-center bg-purple-700 bg-opacity-70 py-5 px-2 w-full relative">
    <!-- Botón del menú hamburguesa -->
    <button class="text-white text-2xl focus:outline-none" @click="toggleMenu">
      <font-awesome-icon :icon="['fas', 'bars']" />
    </button>

    <!-- Menú desplegable flotante -->
    <div 
      v-if="menuAbierto" 
      class="absolute right-2 top-16 bg-purple-800 bg-opacity-80 rounded-lg p-3 shadow-lg w-48 z-50"
    >
      <ul class="text-white">
        <!-- Opciones del menú -->
        <li 
          v-for="(opcion, index) in opcionesMenu" 
          :key="index" 
          @click="seleccionarOpcion(opcion)"
          class="px-4 py-2 hover:bg-white hover:bg-opacity-20 cursor-pointer transition-colors duration-200"
        >
          {{ opcion }}
        </li>
      </ul>
    </div>
  </header>
</template>

<script setup>
import { ref } from "vue";

/**
 * Estado que controla si el menú está abierto o cerrado.
 * false = cerrado, true = abierto.
 */
const menuAbierto = ref(false);

/**
 * Lista de opciones disponibles en el menú.
 */
const opcionesMenu = ["Inicio", "Perfil", "Configuración", "Salir"];

/**
 * Alterna la visibilidad del menú desplegable.
 */
const toggleMenu = () => {
  menuAbierto.value = !menuAbierto.value;
};

/**
 * Cierra el menú al seleccionar una opción.
 * @param {string} opcion - La opción seleccionada del menú.
 */
const seleccionarOpcion = (opcion) => {
  menuAbierto.value = false;
};
</script>

<style scoped>
/* Animación de aparición y desaparición del menú */
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.2s ease-in-out;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>
