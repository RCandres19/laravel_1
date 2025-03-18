<template>
  <!-- Contenedor principal que ocupa toda la pantalla -->
  <div class="flex flex-col h-screen bg-gray-100">
    
    <!-- Componente del menú de navegación -->
    <MenuPages />

    <!-- Contenedor principal del contenido -->
    <main class="flex-1 p-6 animate-fade-in">
      <!-- Título de la página -->
      <h1 class="text-3xl font-bold text-gray-800">Configuración</h1>
      <p class="mt-2 text-gray-600">Ajusta la configuración de tu cuenta.</p>

      <!-- Contenedor de las opciones de configuración -->
      <div class="mt-6 bg-white shadow-md p-6 rounded-lg max-w-lg mx-auto">
        
        <!-- Opción: Activar o desactivar notificaciones -->
        <div class="flex items-center justify-between">
          <label class="text-lg font-semibold text-gray-800">Notificaciones</label>
          <input type="checkbox" class="w-5 h-5 accent-blue-500" v-model="notificaciones" />
        </div>

        <!-- Opción: Activar o desactivar modo oscuro -->
        <div class="flex items-center justify-between mt-4">
          <label class="text-lg font-semibold text-gray-800">Modo Oscuro</label>
          <input type="checkbox" class="w-5 h-5 accent-gray-700" v-model="modoOscuro" />
        </div>

        <!-- Botón para guardar los cambios de configuración -->
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
import MenuPages from '../components/MenuPages.vue';

// Variables reactivas para almacenar la configuración
const notificaciones = ref(true); // Estado de las notificaciones (activadas por defecto)
const modoOscuro = ref(false); // Estado del modo oscuro (desactivado por defecto)

// Función para guardar la configuración del usuario
const guardarConfiguracion = () => {
  alert("Configuración guardada correctamente.");
};

// Hook que se ejecuta cuando el componente se monta
onMounted(() => {
  console.log("Configuración cargada.");
});
</script>
