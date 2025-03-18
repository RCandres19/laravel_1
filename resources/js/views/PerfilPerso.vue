<template>
  <!-- Contenedor principal del perfil -->
  <div class="flex flex-col h-screen bg-gray-100">
    <!-- Menú de navegación -->
    <MenuPages />

    <!-- Contenido principal -->
    <main class="flex-1 p-6 animate-fade-in">
      <!-- Título -->
      <h1 class="text-3xl font-bold text-gray-800">Perfil Personal</h1>
      <p class="mt-2 text-gray-600">Consulta y actualiza tu información personal.</p>

      <!-- Mostrar mensaje de carga -->
      <div v-if="cargando" class="text-gray-500 mt-6 text-center">
        Cargando perfil...
      </div>

      <!-- Tarjeta de perfil del usuario -->
      <div v-else class="mt-6 bg-white shadow-md p-6 rounded-lg max-w-md mx-auto">
        <p class="text-lg font-semibold">
          Nombre: <span class="text-gray-700">{{ user.name }}</span>
        </p>
        <p class="mt-2 text-gray-600">
          Correo: <span class="text-gray-700">{{ user.email }}</span>
        </p>
        <button 
          class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
          @click="editarPerfil">
          Editar Perfil
        </button>
      </div>

      <!-- Mensaje de error -->
      <div v-if="errorMensaje" class="text-red-500 font-semibold text-center mt-4">
        {{ errorMensaje }}
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import MenuPages from '../components/MenuPages.vue';
import AuthService from '../services/AuthService';

// Estado reactivo
const user = ref({});
const cargando = ref(true);
const errorMensaje = ref("");

/**
 * Función para cargar el perfil del usuario desde la API
 */
const cargarPerfil = async () => {
  try {
    const respuesta = await AuthService.api.get('/perfil'); // Ajusta la URL según tu API
    user.value = respuesta.data;
  } catch (error) {
    errorMensaje.value = "Error al cargar el perfil.";
    console.error("Error en perfil:", error.response?.data || error.message);
  } finally {
    cargando.value = false;
  }
};

/**
 * Función para manejar la edición del perfil
 */
const editarPerfil = () => {
  alert("Función de edición en desarrollo.");
};

// Cargar perfil cuando se monta el componente
onMounted(() => {
  cargarPerfil();
});
</script>
