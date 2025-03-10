<template>
  <header class="flex justify-end items-center bg-purple-700 bg-opacity-70 py-5 px-2 w-full">
    <button class="text-white text-2xl" @click="toggleMenu">
      <font-awesome-icon :icon="['fas', 'bars']" />
    </button>

    <div v-if="menuAbierto" class="absolute right-2 top-16 bg-purple-800 bg-opacity-80 rounded-lg p-3 shadow-lg">
      <ul class="text-white">
        <li v-for="(opcion, index) in opcionesMenu" 
            :key="index" 
            @click="seleccionarOpcion(opcion)"
            class="px-4 py-2 hover:bg-white hover:bg-opacity-20 cursor-pointer">
          {{ opcion }}
        </li>
      </ul>
    </div>
  </header>
</template>

<script setup>
import { ref } from "vue";

const menuAbierto = ref(false);
const opcionesMenu = ["Inicio", "Perfil", "Configuración", "Salir"];

const toggleMenu = () => {
  menuAbierto.value = !menuAbierto.value;
};

const seleccionarOpcion = (opcion) => {
  menuAbierto.value = false;
};
</script>
