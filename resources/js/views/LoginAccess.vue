<template>
  <div class="relative w-screen h-screen flex justify-center items-center overflow-hidden">
    <!-- Imagen de fondo desenfocada -->
    <div 
      class="absolute inset-0 bg-cover bg-center blur-md"
      :style="{ backgroundImage: `url(${backgroundImage})` }"
    ></div>

    <!-- Contenedor del formulario de inicio de sesión -->
    <div class="relative bg-white bg-opacity-20 backdrop-blur-md p-6 rounded-lg shadow-lg w-80 text-center">
      <h2 class="text-2xl font-bold text-gray-800">Login</h2>

      <form @submit.prevent="login">
        <!-- Campos de entrada -->
        <input 
          v-model.trim="name" 
          placeholder="Nombre" 
          class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-green-500" 
          required
        />
        <input 
          v-model.trim="document" 
          placeholder="Documento" 
          class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-green-500" 
          required
        />
        <!-- Campo para la contraseña -->
        <input 
          type="password"
          v-model.trim="password"
          placeholder="Contraseña"
          class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-green-500"
          required
        />

        <!-- Botón de inicio de sesión -->
        <button 
          type="submit"
          class="w-full bg-green-600 text-white py-2 rounded mt-4 hover:bg-green-700 transition"
          :disabled="loading"
        >
          {{ loading ? "Ingresando..." : "Ingresar" }}
        </button>
      </form>

      <!-- Mensaje de error -->
      <p v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</p>

      <!-- Enlace para registrarse -->
      <p class="mt-4 text-sm text-gray-800">
        ¿No tienes cuenta? 
        <router-link to="/register" class="text-green-700 font-bold hover:underline">
          Regístrate aquí
        </router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import Swal from "sweetalert2";
import { useAuthStore } from "@/stores/AuthStore"; // Importando Pinia Store
import backgroundImage from "@/assets/img/cultivasena.png";

const router = useRouter();
const authStore = useAuthStore(); // Instancia de Pinia

// Variables reactivas
const name = ref("");
const document = ref("");
const password = ref(""); // Contraseña del usuario
const errorMessage = ref("");
const loading = ref(false);

const login = async () => {
  if (!name.value || !document.value || !password.value) {
    errorMessage.value = "Por favor ingrese todos los campos.";
    return;
  }

  loading.value = true;
  errorMessage.value = "";

  try {
    // Llamada al login con nombre, documento y contraseña
    await authStore.login({
      name: name.value.trim(),
      document: document.value.trim(),
      password: password.value.trim(),
    });

    // Alerta de éxito
    Swal.fire({
      title: "Ingreso Exitoso",
      text: `Bienvenido, ${name.value}!`,
      icon: "success",
      confirmButtonColor: "#38af3e",
    });

    // Redirigir a la página de bienvenida
    router.push("/welcome");
  } catch (error) {
    // Manejo de error si las credenciales son incorrectas o si el correo no está verificado
    errorMessage.value = error.response?.data?.message || "Credenciales incorrectas o cuenta no verificada.";
    console.error("❌ Error en el login:", error.response?.data || error.message);
  } finally {
    loading.value = false;
  }
};
</script>
