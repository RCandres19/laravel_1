<template>
  <!-- Contenedor principal -->
  <div class="flex flex-col h-screen bg-gray-50">
    <!-- Menú de navegación -->
    <MenuPages />
    
    <!-- Contenido principal -->
    <main class="flex-1 p-6 animate-fade-in">
      <h1 class="text-3xl font-bold text-gray-800">Inicio</h1>
      <p class="mt-2 text-gray-600">Accede rápidamente a la información clave.</p>

      <!-- Sección con tarjetas informativas -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
        <!-- Renderiza dinámicamente las secciones -->
        <div 
          v-for="(item, index) in secciones" :key="index"
          class="bg-white p-6 shadow-lg rounded-lg text-center cursor-pointer hover:scale-105 focus-visible:ring-2 focus-visible:ring-blue-500 transition"
          tabindex="0"
          @click="navegarA(item.ruta)"
          @keydown.enter="navegarA(item.ruta)"
        >
          <p class="text-lg font-semibold text-gray-800">{{ item.titulo }}</p>
          <p class="text-gray-500">{{ item.descripcion }}</p>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import MenuPages from '../components/MenuPages.vue';

// Instancia del router para manejar navegación
const router = useRouter();

// Secciones con rutas asociadas
const secciones = ref([
  { titulo: "Cultivos", descripcion: "Información actualizada", ruta: "/cultivos" },
  { titulo: "Noticias", descripcion: "Últimas actualizaciones", ruta: "/noticias" },
  { titulo: "Clima", descripcion: "Pronóstico actualizado", ruta: "/clima" },
  { titulo: "Mercado", descripcion: "Tendencias actuales", ruta: "/mercado" },
]);

// Función para navegar a la ruta correspondiente
const navegarA = (ruta) => {
  router.push(ruta);
};

// Evento al montar el componente
onMounted(() => {
  console.log("Inicio cargado correctamente.");
});
</script>
