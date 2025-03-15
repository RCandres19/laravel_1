<script setup>
import AuthService from "@/services/AuthService"; // Importamos el servicio de autenticacion
import { ref, onMounted } from "vue";

const usuarios = ref([]);

const obtenerUsuarios = async () => {
  try {
    const respuesta = await AuthService.api.get("/users") // Usamos el axios configurado de AuthService
    obtenerUsuarios.value = respuesta.data;
    console.log(" Usuarios obtenidos: ", obtenerUsuarios.value);
  } catch (error) {
    console.error(" Error al obtener usuarios: ", error.response?.data || error.message);
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
