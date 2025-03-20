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
        <!-- Campo de nombre -->
        <input 
          v-model.trim="name"
          id="name"
          name="name" 
          placeholder="Nombre" 
          class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-green-500" 
          required
        />
        
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
import { useAuthStore } from "../store/AuthStore"; // Importando Pinia Store
import backgroundImage from "../assets/img/cultivasena.png";

const router = useRouter();
const authStore = useAuthStore(); // Instancia de Pinia para manejar autenticación

// Variables reactivas para almacenar los datos del formulario
const name = ref(""); // Nombre del usuario
const document = ref(""); // Documento del usuario
const password = ref(""); // Contraseña del usuario
const errorMessage = ref(""); // Mensaje de error en caso de fallo en el login
const loading = ref(false); // Estado de carga para evitar múltiples envíos

/**
 * Función para manejar el inicio de sesión del usuario
 * - Verifica que los campos no estén vacíos
 * - Realiza la solicitud de autenticación a través de Pinia
 * - Si el login es exitoso, almacena el token y redirige al usuario
 */
const login = async () => {
  // Validar que todos los campos estén completos
  if (!name.value || !document.value || !password.value) {
    errorMessage.value = "Por favor ingrese todos los campos.";
    return;
  }

  loading.value = true; // Activar estado de carga
  errorMessage.value = ""; // Limpiar mensaje de error previo

  try {
    // Llamada al login con los datos ingresados
    await authStore.login({
      name: name.value.trim(),
      document: document.value.trim(),
      password: password.value.trim(),
    });

    // Mostrar alerta de éxito
    Swal.fire({
      title: "Ingreso Exitoso",
      text: `Bienvenido, ${name.value}!`,
      icon: "success",
      confirmButtonColor: "#38af3e",
    });

    // Redirigir al usuario a la página de bienvenida
    router.push("/welcome");
  } catch (error) {
    console.log("Auth Store:", authStore); // Verifica si el AuthStore se está utilizando correctamente
    
    // Manejo de error si las credenciales son incorrectas o si la cuenta no está verificada
    errorMessage.value = error.response?.data?.message || "Credenciales incorrectas o cuenta no verificada.";
    console.error("Error en el login:", error.response?.data || error.message);
  } finally {
    loading.value = false; // Desactivar estado de carga
  }
};
</script>
