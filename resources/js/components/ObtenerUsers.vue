<script setup>
import AuthService from "@/services/AuthService"; // Importamos el servicio de autenticacion
import { ref, onMounted } from "vue";

const usuarios = ref([]);

const obtenerUsuarios = async () => {
  try {
    const respuesta = await axios.get("/users"); // Ajusta la ruta según tu API
    usuarios.value = respuesta.data;
    console.log("Usuarios obtenidos:", usuarios.value);
  } catch (error) {
    console.error("Error al obtener usuarios:", error.response?.data || error.message);
  }
};

onMounted(() => {
  obtenerUsuarios();
});
</script>

<template>
  <div>
    <h1>Lista de Usuarios</h1>
    <ul>
      <li v-for="usuario in usuarios" :key="usuario.id">
        {{ usuario.name }} - {{ usuario.email || "Sin correo" }}
      </li>
    </ul>
  </div>
</template>
