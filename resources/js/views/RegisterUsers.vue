<template>
  <div class="relative h-screen flex justify-center items-center overflow-hidden">
    <!-- Imagen de fondo desenfocada -->
    <div 
      class="absolute inset-0 bg-cover bg-center blur-sm" 
      :style="{ backgroundImage: `url(${backgroundImage})` }"
    ></div>

    <!-- Contenedor del formulario -->
    <div class="relative bg-white bg-opacity-20 backdrop-blur-md p-6 rounded-lg shadow-lg w-80 text-center">
      <h2 class="text-2xl font-bold text-gray-800">Registro de Usuario</h2>

      <!-- Formulario -->
      <form @submit.prevent="registerUser">
        <!-- Selección del tipo de documento -->
        <select 
          v-model="type_document"
          id="type_document"
          name="type_document" 
          class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500"
          required
        >
          <option value="" disabled>Selecciona un tipo de documento</option>
          <option value="CC">Cédula Colombiana</option>
          <option value="CE">Cédula Extranjería</option>
          <option value="PPT">Permiso de Protección Temporal</option>
          <option value="PEP">Permiso Especial de Permanencia</option>
          <option value="PP">Pasaporte</option>
          <option value="TI">Tarjeta de Identidad</option>
        </select>

        <!-- Campos de entrada para el usuario -->
        <input 
          v-model="name"
          id="name"
          name="name" 
          placeholder="Nombre" 
          class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500" 
          required
        />
        <input 
          v-model="document" 
          id="document"
          name="document"
          placeholder="Documento" 
          class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500" 
          required
        />
        <input 
          v-model="email" 
          id="email"
          name="email"
          placeholder="Correo (opcional)" 
          autocomplete="username"
          class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500" 
        />
        
        <!-- Contraseña -->
        <input 
          type="password"
          v-model="password"
          id="password"
          name="password"
          placeholder="Contraseña"
          autocomplete="new-password" 
          class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500" 
          required
        />
        
        <!-- Confirmar contraseña -->
        <input 
          type="password"
          v-model="confirmPassword"
          id="confirmPassword"
          name="confirmPassword"
          placeholder="Confirmar Contraseña"
          autocomplete="new-password" 
          class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500" 
          required
        />

        <!-- Botón de registro -->
        <button 
          type="submit" 
          :disabled="loading"
          class="w-full bg-blue-600 text-white py-2 rounded mt-4 hover:bg-blue-700 transition disabled:bg-gray-400"
        >
          {{ loading ? "Registrando..." : "Registrarse" }}
        </button>
      </form>

      <!-- Mensaje de error -->
      <p v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</p>

      <!-- Enlace de inicio de sesión -->
      <p class="mt-4 text-sm text-gray-800">
        ¿Ya tienes cuenta? 
        <router-link to="/login" class="text-blue-700 font-bold hover:underline">
          Inicia sesión aquí
        </router-link>
      </p>
    </div>
  </div>
</template>


<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../store/AuthStore'; // Usa Pinia para manejar autenticación
import axios from 'axios';
import Swal from 'sweetalert2';

// Imagen de fondo
import backgroundImage from '../assets/img/cultivasena.png';

const router = useRouter();
const authStore = useAuthStore(); // Instancia de Pinia para manejar estado

// Variables reactivas
const name = ref('');
const type_document = ref('');
const document = ref('');
const email = ref('');
const password = ref('');
const confirmPassword = ref('');
const errorMessage = ref('');
const loading = ref(false);

// Función para registrar un usuario
const registerUser = async () => {
  // Validaciones previas
  if (!name.value || !type_document.value || !document.value || !email.value || !password.value || !confirmPassword.value) {
    errorMessage.value = 'Por favor completa todos los campos obligatorios.';
    return;
  }

  if (password.value !== confirmPassword.value) {
    errorMessage.value = 'Las contraseñas no coinciden.';
    return;
  }

  loading.value = true;
  errorMessage.value = '';

  try {
    const response = await axios.post('http://127.0.0.1:8000/api/register', {
      name: name.value.trim(),
      type_document: type_document.value.trim(),
      document: document.value.trim(),
      email: email.value.trim(),
      password: password.value.trim(),
      password_confirmation: confirmPassword.value.trim(),
    });

    // Si se recibe el token correctamente
    if (response.data.access_token) {
      authStore.setTokens(response.data.access_token);

      Swal.fire({
        title: 'Registro Exitoso',
        text: `Bienvenido, ${name.value}! Revisa tu correo para confirmar tu cuenta.`,
        icon: 'success',
        confirmButtonColor: '#1d4ed8',
      });

      router.push('/welcome'); // Redirigir a la página de bienvenida
    } else {
      throw new Error('No se recibió un token en la respuesta.');
    }
  } catch (error) {
    console.error('Error en el registro:', error.response?.data || error.message);

    if (error.response && error.response.data.errors) {
      const errors = error.response.data.errors;
      errorMessage.value = '';

      if (errors.document) {
        errorMessage.value += `Documento: ${errors.document[0]} `;
      }
      if (errors.email) {
        errorMessage.value += `Correo: ${errors.email[0]} `;
      }
      if (errors.password) {
        errorMessage.value += `Contraseña: ${errors.password[0]} `;
      }
    } else {
      errorMessage.value = 'Error en el registro. Intenta de nuevo.';
    }
  } finally {
    loading.value = false;
  }
};
</script>
