<script setup>
import AuthService from "@/services/AuthService";
import { ref, onMounted } from "vue";

const usuarios = ref([]); // Almacena la lista de usuarios
const errorMensaje = ref(""); // Para manejar errores

// Función para obtener los usuarios
const obtenerUsuarios = async () => {
  try {
    const respuesta = await AuthService.api.get("/users"); // Llamada a la API
    usuarios.value = respuesta.data; // Asigna los usuarios correctamente
    console.log("Usuarios obtenidos:", usuarios.value);
  } catch (error) {
    errorMensaje.value = "Error al obtener los usuarios.";
    console.error("Error al obtener usuarios:", error.response?.data || error.message);
  }
};

// Cargar usuarios cuando el componente se monte
onMounted(() => {
  obtenerUsuarios();
});
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Lista de Usuarios</h1>

    <div v-if="errorMensaje" class="text-red-500 font-semibold">
      {{ errorMensaje }}
    </div>

    <ul v-else-if="usuarios.length">
      <li v-for="usuario in usuarios" :key="usuario.id" class="border-b py-2">
        {{ usuario.name }} - {{ usuario.email || "Sin correo" }}
      </li>
    </ul>

    <p v-else class="text-gray-500">No hay usuarios registrados.</p>
  </div>
</template>

