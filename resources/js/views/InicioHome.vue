<template>
    <div class="flex flex-col h-screen bg-gray-50">
      <MenuPages />
      <main class="flex-1 p-6 animate-fade-in">
        <h1 class="text-3xl font-bold text-gray-800">Inicio</h1>
        <p class="mt-2 text-gray-600">Accede rápidamente a la información clave.</p>
  
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
          <div v-for="(item, index) in secciones" :key="index" 
               class="bg-white p-6 shadow-lg rounded-lg text-center cursor-pointer hover:scale-105 transition">
            <p class="text-lg font-semibold text-gray-800">{{ item.titulo }}</p>
            <p class="text-gray-500">{{ item.descripcion }}</p>
          </div>
        </div>
      </main>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import MenuPages from '@/components/MenuPages.vue';
  
  const secciones = ref([
    { titulo: "Cultivos", descripcion: "Información actualizada" },
    { titulo: "Noticias", descripcion: "Últimas actualizaciones" },
    { titulo: "Clima", descripcion: "Pronóstico actualizado" },
    { titulo: "Mercado", descripcion: "Tendencias actuales" },
  ]);
  
  onMounted(() => {
    console.log("Inicio cargado correctamente.");
  });
  </script>
  