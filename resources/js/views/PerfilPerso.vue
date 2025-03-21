<template>
  <div class="flex flex-col h-screen bg-gray-100">
    <MenuPages />

    <main class="flex-1 p-6 animate-fade-in">
      <h1 class="text-3xl font-bold text-gray-800">Perfil Personal</h1>
      <p class="mt-2 text-gray-600">Consulta y actualiza tu información personal.</p>

      <div v-if="cargando" class="text-gray-500 mt-6 text-center">
        Cargando perfil...
      </div>

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

// Variables reactivas
const user = ref({});
const cargando = ref(true);
const errorMensaje = ref("");

const cargarPerfil = async () => {
  try {
    console.log("Cargando perfil...");
    const respuesta = await AuthService.getUserData();
    console.log("Perfil recibido:", respuesta);
    user.value = respuesta;
  } catch (error) {
    console.error("Error al cargar el perfil:", error.response?.data || error.message);
    errorMensaje.value = "Error al cargar el perfil.";
  } finally {
    cargando.value = false;
  }
};

const editarPerfil = () => {
  alert("Función de edición en desarrollo.");
};

onMounted(() => {
  cargarPerfil();
});
</script>

