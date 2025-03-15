<template>
  <!-- Contenedor principal del perfil con diseño flexible y fondo gris -->
  <div class="flex flex-col h-screen bg-gray-100">
    <!-- Componente del menú de navegación -->
    <MenuPages />
    
    <!-- Contenido principal -->
    <main class="flex-1 p-6 animate-fade-in">
      <!-- Título de la sección -->
      <h1 class="text-3xl font-bold text-gray-800">Perfil Personal</h1>
      <!-- Descripción -->
      <p class="mt-2 text-gray-600">Consulta y actualiza tu información personal.</p>

      <!-- Tarjeta de perfil del usuario -->
      <div class="mt-6 bg-white shadow-md p-6 rounded-lg max-w-md mx-auto">
        <!-- Nombre del usuario -->
        <p class="text-lg font-semibold">
          Nombre: <span class="text-gray-700">{{ user.name }}</span>
        </p>
        <!-- Correo del usuario -->
        <p class="mt-2 text-gray-600">
          Correo: <span class="text-gray-700">{{ user.email }}</span>
        </p>
        <!-- Botón para editar perfil -->
        <button 
          class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
          @click="editarPerfil">
          Editar Perfil
        </button>
      </div>
    </main>
  </div>
</template>

<script setup>
/**
 * Importaciones necesarias
 */
import { ref, onMounted } from 'vue';
import MenuPages from '@/components/MenuPages.vue';

/**
 * Estado reactivo para almacenar los datos del usuario
 */
const user = ref({ 
  name: "Juan Pérez", 
  email: "juanperez@example.com" 
});

/**
 * Función para manejar la edición del perfil
 */
const editarPerfil = () => {
  alert("Función de edición en desarrollo.");
};

/**
 * Hook que se ejecuta cuando el componente es montado
 */
onMounted(() => {
  console.log("Perfil cargado correctamente.");
});
</script>
