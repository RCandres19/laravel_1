<script setup>
import AuthService from "@/services/AuthService";
import { ref, onMounted } from "vue";
import { useUserStore } from "@/store/userStore";

// Instancia del store de usuario (para obtener el token)
const userStore = useUserStore();
const token = userStore.token;

const usuarios = ref([]); // Almacena la lista de usuarios
const errorMensaje = ref(""); // Para manejar errores

// Función para obtener los usuarios
const obtenerUsuarios = async () => {
  try {
    const respuesta = await AuthService.api.get("/users", {
      headers: {
        Authorization: `Bearer ${token}`, // Envía el token en los headers
      },
    });

    usuarios.value = respuesta.data; // Asigna los usuarios correctamente
    console.log("Usuarios obtenidos:", usuarios.value);
  } catch (error) {
    errorMensaje.value = error.response?.data?.message || "Error al obtener los usuarios.";
    console.error("Error al obtener usuarios:", error);
  }
};

// Cargar usuarios cuando el componente se monte
onMounted(obtenerUsuarios);
</script>

<template>
  <div class="p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4 text-purple-700">Lista de Usuarios</h1>

    <!-- Mensaje de error -->
    <div v-if="errorMensaje" class="text-red-500 font-semibold">
      {{ errorMensaje }}
    </div>

    <!-- Lista de usuarios -->
    <ul v-else-if="usuarios.length" class="divide-y divide-gray-300">
      <li v-for="usuario in usuarios" :key="usuario.id" class="py-2">
        <span class="font-semibold text-gray-700">{{ usuario.name }}</span> - 
        <span class="text-gray-500">{{ usuario.email || "Sin correo" }}</span>
      </li>
    </ul>

    <!-- Mensaje si no hay usuarios -->
    <p v-else class="text-gray-500">No hay usuarios registrados.</p>
  </div>
</template>
