<template>
  <!-- Contenedor principal que estructura la pantalla -->
  <div class="flex flex-col h-screen bg-gray-50">
    <!-- Componente de menú de navegación -->
    <MenuPages />
    
    <!-- Contenido principal de la página -->
    <main class="flex-1 p-6 animate-fade-in">
      <!-- Título principal -->
      <h1 class="text-3xl font-bold text-gray-800">Inicio</h1>
      <!-- Descripción breve de la página -->
      <p class="mt-2 text-gray-600">Accede rápidamente a la información clave.</p>

      <!-- Sección con tarjetas informativas -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
        <!-- Renderiza dinámicamente las secciones desde el array `secciones` -->
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
import { ref, onMounted } from 'vue'; // Importa las funciones reactivas de Vue
import MenuPages from '@/components/MenuPages.vue'; // Importa el componente de menú

// Define un array reactivo con las secciones del panel de inicio
const secciones = ref([
  { titulo: "Cultivos", descripcion: "Información actualizada" },
  { titulo: "Noticias", descripcion: "Últimas actualizaciones" },
  { titulo: "Clima", descripcion: "Pronóstico actualizado" },
  { titulo: "Mercado", descripcion: "Tendencias actuales" },
]);

// Evento que se ejecuta cuando el componente se monta en la vista
onMounted(() => {
  console.log("Inicio cargado correctamente.");
});
</script>
