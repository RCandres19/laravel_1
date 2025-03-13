<template>
    <div class="flex flex-col h-screen bg-gray-100">
      <MenuPages />
      <main class="flex-1 p-6 animate-fade-in">
        <h1 class="text-3xl font-bold text-gray-800">Configuración</h1>
        <p class="mt-2 text-gray-600">Ajusta la configuración de tu cuenta.</p>
  
        <div class="mt-6 bg-white shadow-md p-6 rounded-lg max-w-lg mx-auto">
          <div class="flex items-center justify-between">
            <label class="text-lg font-semibold text-gray-800">Notificaciones</label>
            <input type="checkbox" class="w-5 h-5 accent-blue-500" v-model="notificaciones" />
          </div>
  
          <div class="flex items-center justify-between mt-4">
            <label class="text-lg font-semibold text-gray-800">Modo Oscuro</label>
            <input type="checkbox" class="w-5 h-5 accent-gray-700" v-model="modoOscuro" />
          </div>
  
          <button 
            class="mt-6 w-full px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition"
            @click="guardarConfiguracion">
            Guardar Cambios
          </button>
        </div>
      </main>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import MenuPages from '@/components/MenuPages.vue';
  
  const notificaciones = ref(true);
  const modoOscuro = ref(false);
  
  const guardarConfiguracion = () => {
    alert("Configuración guardada correctamente.");
  };
  
  onMounted(() => {
    console.log("Configuración cargada.");
  });
  </script>
  