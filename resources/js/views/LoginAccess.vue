<template>
  <!-- Contenedor principal del login -->
  <div class="relative w-screen h-screen flex justify-center items-center overflow-hidden">
    <!-- Imagen de fondo desenfocada -->
    <div 
      class="absolute inset-0 bg-cover bg-center blur-md"
      :style="{ backgroundImage: `url(${backgroundImage})` }"
    ></div>

    <!-- Contenedor del formulario de inicio de sesión -->
    <div class="relative bg-white bg-opacity-20 backdrop-blur-md p-6 rounded-lg shadow-lg w-80 text-center">
      <h2 class="text-2xl font-bold text-gray-800">Login</h2>

      <!-- Formulario de inicio de sesión -->
      <form @submit.prevent="login">
        <!-- Campo de documento -->
        <input 
          v-model.trim="document"
          id="document"
          name="document" 
          placeholder="Documento"
          autocomplete="username" 
          class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-green-500" 
          required
        />

        <!-- Campo de contraseña -->
        <input 
          type="password"
          v-model.trim="password"
          id="password"
          name="password"
          placeholder="Contraseña"
          autocomplete="new-password"
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

      <!-- Mensaje de error en caso de fallo en la autenticación -->
      <p v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</p>

      <!-- Enlace para registrarse si no tiene cuenta -->
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
import { useAuthStore } from "../store/AuthStore";
import backgroundImage from "../assets/img/cultivasena.png";

const router = useRouter();
const authStore = useAuthStore();

const document = ref("");
const password = ref("");
const errorMessage = ref("");
const loading = ref(false);

const login = async () => {
  if (!document.value || !password.value) {
    errorMessage.value = "Por favor ingrese todos los campos.";
    return;
  }

  loading.value = true;
  errorMessage.value = "";

  try {
    // Realiza el login y obtiene los tokens
    await authStore.login({
      document: document.value.trim(),
      password: password.value.trim(),
    });

    // Ahora obtenemos el rol del usuario desde la API
    const userData = await authStore.getUserData(); // Asegúrate de que este método esté en AuthService
    const role = userData.role; // Obtiene el rol desde la respuesta de la API
    const userName = userData.name; // Ahora sí, obtener el nombre real

    if (!role) {
      throw new Error("No se pudo obtener el rol del usuario.");
    }

    authStore.setUserRole(role); // Guardamos el rol en Pinia

    // Mostramos mensaje de éxito
    Swal.fire({
      title: "Ingreso Exitoso",
      text: `Bienvenido, ${userName}!`,
      icon: "success",
      confirmButtonColor: "#38af3e",
    });

    // Redirigir según el rol
    router.push(role === "admin" ? "/admin/informacion" : "/welcome");
  } catch (error) {
    errorMessage.value = error?.response?.data?.message ?? "Error en la autenticación.";
    console.error("Error en el login:", error);
  } finally {
    loading.value = false;
  }
};
</script>
