<template>
  <!-- Contenedor principal del perfil -->
  <div class="flex flex-col h-screen bg-gray-100">
    <!-- Menú de navegación -->
    <MenuPages />

    <!-- Contenido principal -->
    <main class="flex-1 p-6 animate-fade-in">
      <!-- Título de la página -->
      <h1 class="text-3xl font-bold text-gray-800">Perfil Personal</h1>
      <p class="mt-2 text-gray-600">Consulta y actualiza tu información personal.</p>

      <!-- Mostrar mensaje de carga mientras se obtiene la información -->
      <div v-if="cargando" class="text-gray-500 mt-6 text-center">
        Cargando perfil...
      </div>

      <!-- Tarjeta de perfil del usuario con su información -->
      <div v-else class="mt-6 bg-white shadow-md p-6 rounded-lg max-w-md mx-auto">
        <p class="text-lg font-semibold">
          Nombre: <span class="text-gray-700">{{ user.name }}</span>
        </p>
        <p class="mt-2 text-gray-600">
          Correo: <span class="text-gray-700">{{ user.email }}</span>
        </p>
        <!-- Botón para editar el perfil -->
        <button 
          class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
          @click="editarPerfil">
          Editar Perfil
        </button>
      </div>

      <!-- Mostrar mensaje de error si la carga del perfil falla -->
      <div v-if="errorMensaje" class="text-red-500 font-semibold text-center mt-4">
        {{ errorMensaje }}
      </div>
    </main>
  </div>
</template>

<script setup>
import { storeToRefs } from 'pinia';
import { ref, onMounted } from 'vue';
import MenuPages from '../components/MenuPages.vue';
import AuthService from '../services/AuthService';
import { useAuthStore } from '../store/AuthStore';

// Variables reactivas para almacenar el estado del usuario, carga y errores
const user = ref({}); // Almacena los datos del usuario
const cargando = ref(true); // Indica si los datos están cargando
const errorMensaje = ref(""); // Almacena cualquier mensaje de error

/**
 * Función para cargar el perfil del usuario desde la API
 * - Realiza una solicitud GET a la API para obtener la información del usuario.
 * - Almacena los datos en la variable `user`.
 * - Maneja errores en caso de que la solicitud falle.
 */
const cargarPerfil = async () => {
  try {
    const respuesta = await AuthService.api.get('/perfil'); // Ajusta la URL según tu API
    user.value = respuesta.data; // Almacena los datos obtenidos
  } catch (error) {
    errorMensaje.value = "Error al cargar el perfil.";
    console.error("Error en perfil:", error.response?.data || error.message);
  } finally {
    cargando.value = false; // Oculta el mensaje de carga
  }
};

const { role } = storeToRefs(useAuthStore()); // Extraer role u otros datos
console.log(role.value);

/**
 * Función para manejar la edición del perfil.
 * - Actualmente solo muestra una alerta.
 * - En el futuro se puede implementar la navegación a un formulario de edición.
 */
const editarPerfil = () => {
  alert("Función de edición en desarrollo.");
};

// Cargar perfil cuando se monta el componente
onMounted(() => {
  cargarPerfil();
});
</script>
