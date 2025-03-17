<template>
    <!-- Barra de navegación superior con menú hamburguesa -->
    <header class="flex justify-between items-center bg-purple-700 bg-opacity-70 py-5 px-4 w-full relative">
      
      <!-- Botón de navegación a perfil -->
      <button @click="navegar('/perfil')" class="text-white font-bold hover:underline">
        Ir a Perfil
      </button>
  
      <!-- Botón del menú hamburguesa -->
      <button class="text-white text-2xl focus:outline-none" @click="toggleMenu">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"/>
        </svg>
      </button>
  
      <!-- Menú desplegable flotante -->
      <div v-if="menuAbierto" class="absolute right-4 top-16 bg-purple-800 bg-opacity-80 rounded-lg p-3 shadow-lg w-48 z-50">
        <ul class="text-white">
          <li 
            v-for="(ruta, index) in rutasMenu" 
            :key="index" 
            @click="navegar(ruta.path)" 
            class="px-4 py-2 hover:bg-white hover:bg-opacity-20 cursor-pointer transition-colors duration-200"
            :class="{ 'bg-white bg-opacity-20': ruta.path === rutaActual }"
          >
            {{ ruta.name }}
          </li>
        </ul>
      </div>
    </header>
  </template>
  
  <script setup>
  import { ref, computed } from "vue";
  import { useRouter, useRoute } from "vue-router";
  
  // Instancias de Vue Router
  const router = useRouter();
  const route = useRoute();
  
  // Estado del menú
  const menuAbierto = ref(false);
  
  // Definición de rutas del menú
  const rutasMenu = [
    { name: "Inicio", path: "/inicio" },
    { name: "Perfil", path: "/perfil" },
    { name: "Configuración", path: "/configuracion" },
    { name: "Salir", path: "/salir" },
  ];
  
  // Computed property para detectar la ruta actual
  const rutaActual = computed(() => route.path);
  
  /**
   * Alterna la visibilidad del menú hamburguesa
   */
  const toggleMenu = () => {
    menuAbierto.value = !menuAbierto.value;
  };
  
  /**
   * Navega a la ruta seleccionada y cierra el menú
   * @param {string} ruta - La ruta de navegación
   */
  const navegar = (ruta) => {
    console.log("Navegando a:", ruta);
    menuAbierto.value = false;
    router.push(ruta);
  };
  </script>
  