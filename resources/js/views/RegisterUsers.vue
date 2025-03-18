<!--<template> // 14/03/25
  <div class="relative h-screen flex justify-center items-center overflow-hidden">
    <!-- Imagen de fondo desenfocada 
    <div 
      class="absolute inset-0 bg-cover bg-center blur-sm" 
      :style="{ backgroundImage: `url(${backgroundImage})` }"
    ></div>

    <!-- Contenedor del formulario 
    <div class="relative bg-white bg-opacity-20 backdrop-blur-md p-6 rounded-lg shadow-lg w-80 text-center">
      <h2 class="text-2xl font-bold text-gray-800">Registro de Usuario</h2>

      <!-- Selección del tipo de documento 
      <select 
        v-model="type_document" 
        class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500"
      >
        <option value="" disabled selected>Selecciona un tipo de documento</option>
        <option value="PPT">Permiso de Protección Temporal</option>
        <option value="PEP">Permiso Especial de Permanencia</option>
        <option value="CC">Cédula Colombiana</option>
        <option value="TI">Tarjeta de Identidad</option>
        <option value="Pasaporte">Pasaporte</option>
      </select>

      <!-- Campos de entrada para el usuario 
      <input 
        v-model="name" 
        placeholder="Nombre" 
        class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500" 
      />
      <input 
        v-model="document" 
        placeholder="Documento" 
        class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500" 
      />
      <input 
        v-model="email" 
        placeholder="Correo (opcional)" 
        class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500" 
      />

      <!-- Botón de registro 
      <button 
        @click="registerUser" 
        class="w-full bg-blue-600 text-white py-2 rounded mt-4 hover:bg-blue-700 transition"
      >
        Registrarse
      </button>

      <!-- Mensaje de error 
      <p v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</p>

      <!-- Enlace de inicio de sesión 
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
/**
 * Importamos las herramientas necesarias:
 * - `ref` para manejar variables reactivas.
 * - `useRouter` para la navegación en Vue Router.
 * - `axios` para hacer peticiones HTTP a la API.
 * - `Swal` (SweetAlert2) para mostrar alertas estilizadas.
 */
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import Swal from 'sweetalert2';

// Importa la imagen correctamente
import backgroundImage from '@/assets/img/cultivasena.png';

const router = useRouter();

/**
 * Variables reactivas para almacenar los datos del usuario.
 */
const name = ref('');
const type_document = ref('');
const document = ref('');
const email = ref('');
const errorMessage = ref('');

const registerUser = async () => {
  try {
    await axios.post('http://127.0.0.1:8000/api/registerUser', {
      name: name.value,
      type_document: type_document.value,
      document: document.value,
      email: email.value
    });

    // Alerta de éxito con SweetAlert2
    Swal.fire({
      title: 'Registro Exitoso',
      text: `Bienvenido, ${name.value}!`,
      icon: 'success',
      confirmButtonColor: '#1d4ed8'
    });

    router.push(`/dashboard/${name.value}`);
  } catch (error) {
    // Captura errores y muestra un mensaje en caso de fallo
    errorMessage.value = 'Error en la conexión con la API';
  }
};
</script> -->

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

      <!-- Selección del tipo de documento -->
      <select 
        v-model="type_document" 
        class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500"
      >
        <option value="" disabled>Selecciona un tipo de documento</option>
        <option value="PPT">Permiso de Protección Temporal</option>
        <option value="PEP">Permiso Especial de Permanencia</option>
        <option value="CC">Cédula Colombiana</option>
        <option value="TI">Tarjeta de Identidad</option>
        <option value="PP">Pasaporte</option>
      </select>

      <!-- Campos de entrada para el usuario -->
      <input 
        v-model="name" 
        placeholder="Nombre" 
        class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500" 
        required
      />
      <input 
        v-model="document" 
        placeholder="Documento" 
        class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500" 
        required
      />
      <input 
        v-model="email" 
        placeholder="Correo (opcional)" 
        class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500" 
      />
      <!-- Contraseña -->
      <input 
        type="password"
        v-model="password"
        placeholder="Contraseña" 
        class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500" 
        required
      />
      <!-- Confirmar contraseña -->
      <input 
        type="password"
        v-model="confirmPassword"
        placeholder="Confirmar Contraseña" 
        class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-blue-500" 
        required
      />

      <!-- Botón de registro -->
      <button 
        @click="registerUser" 
        :disabled="loading"
        class="w-full bg-blue-600 text-white py-2 rounded mt-4 hover:bg-blue-700 transition disabled:bg-gray-400"
      >
        {{ loading ? "Registrando..." : "Registrarse" }}
      </button>

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
import { useAuthStore } from '@/stores/authStore'; // Usa Pinia para manejar autenticación
import axios from 'axios';
import Swal from 'sweetalert2';

// Imagen de fondo
import backgroundImage from '@/assets/img/cultivasena.png';

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
  if (!name.value || !type_document.value || !document.value || !password.value || !confirmPassword.value) {
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
      type_document: type_document.value,
      document: document.value.trim(),
      email: email.value.trim(),
      password: password.value.trim(),  // Agregamos la contraseña
    });

    if (response.data.access_token) {
      // Guardar token en Pinia en lugar de localStorage
      authStore.setToken(response.data.access_token);

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
    errorMessage.value = error.response?.data?.message || 'Error en el registro. Intenta de nuevo.';
    console.error('❌ Error en el registro:', error.response?.data || error.message);
  } finally {
    loading.value = false;
  }
};
</script>