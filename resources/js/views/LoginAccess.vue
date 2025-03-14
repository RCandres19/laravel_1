<!--<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();
const name = ref('');
const document = ref('');
const errorMessage = ref('');

const login = async () => {
  const payload = {
    name: name.value.trim(), // Elimina espacios en blanco extra
    document: document.value.trim()
  };

  console.log("Enviando datos:", payload); // Depuración en consola

  try {
    const response = await axios.post('http://127.0.0.1:8000/api/login', payload, {
      headers: { 'Content-Type': 'application/json' } // Asegura el formato correcto
    });

    console.log("Respuesta de la API:", response.data); // Depuración

    if (response.data.success) {
      alert(`Ingreso exitoso: ${name.value}`);
      router.push(`/welcome/${name.value}`);
    } else {
      errorMessage.value = response.data.message || 'Usuario no encontrado';
    }
  } catch (error) {
    console.error("Error en login:", error.response?.data || error.message);
    
    if (error.response) {
      // Laravel devuelve errores de validación en error.response.data.errors
      if (error.response.status === 422) {
        errorMessage.value = "Datos inválidos. Verifica los campos.";
      } else {
        errorMessage.value = error.response.data.message || 'Error al procesar la solicitud.';
      }
    } else {
      errorMessage.value = 'Error en la conexión con la API';
    }
  }
};
</script>

<template>
  <div class="container">
    <div class="form-box">
      <h2>Iniciar Sesión</h2>
      <input v-model="name" placeholder="Nombre" />
      <input v-model="document" placeholder="Documento" />
      <button @click="login">Ingresar</button>
      <p class="error">{{ errorMessage }}</p>
      <p>No tienes cuenta? <router-link to="/register">Regístrate aquí</router-link></p>
    </div>
  </div>
</template>

<style scoped>
.container {
  background-image: url('@/assets/img/cultivasena.png');
  background-size: cover;
  background-position: center;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.form-box {
  background: rgba(255, 255, 255, 0.3);
  backdrop-filter: blur(5px);
  padding: 20px;
  border-radius: 10px;
  text-align: center;
}

.error {
  color: red;
}
</style>
-->

<!--<template> 14/03/25
  <div class="relative w-screen h-screen flex justify-center items-center overflow-hidden">
    <!-- Imagen de fondo desenfocada --
    <div 
      class="absolute inset-0 bg-cover bg-center blur-md"
      :style="{ backgroundImage: `url(${backgroundImage})` }"
    ></div>

    <!-- Contenedor del formulario de inicio de sesión --
    <div class="relative bg-white bg-opacity-20 backdrop-blur-md p-6 rounded-lg shadow-lg w-80 text-center">
      <h2 class="text-2xl font-bold text-gray-800">Login</h2>

      <!-- Campos de entrada para el usuario --
      <input 
        v-model="name" 
        placeholder="Nombre" 
        class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-green-500" 
      />
      <input 
        v-model="document" 
        placeholder="Documento" 
        class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-green-500" 
      />

      <!-- Botón de inicio de sesión --
      <button 
        @click="login" 
        class="w-full bg-green-600 text-white py-2 rounded mt-4 hover:bg-green-700 transition"
      >
        Ingresar
      </button>

      <!-- Mensaje de error en caso de fallos 
      <p v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</p>

      <!-- Enlace para ir al registro si no tiene cuenta 
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
import backgroundImage from '@/assets/img/cultivasena.png';
/**
 * Inicializamos el router para manejar la navegación entre páginas.
 */
const router = useRouter();

/**
 * Variables reactivas para capturar la entrada del usuario.
 */
const name = ref('');
const document = ref('');
const errorMessage = ref('');

/**
 * Función para iniciar sesión verificando los datos en la API.
 */
const login = async () => {
  try {
    // Envío de datos al backend en Laravel
    const response = await axios.post('http://127.0.0.1:8000/api/login', {
      name: name.value,
      document: document.value
    });

    // Si la respuesta de la API es exitosa, redirige al usuario
    if (response.data.success) {
      Swal.fire({
        title: 'Ingreso Exitoso',
        text: `Bienvenido, ${name.value}!`,
        icon: 'success',
        confirmButtonColor: '#38af3e'
      });

      // Redirige a la página de bienvenida con el nombre del usuario
      router.push(`/welcome/${name.value}`);
    } else {
      // Si no se encuentra el usuario, muestra un mensaje de error
      errorMessage.value = 'Usuario no encontrado';
    }
  } catch (error) {
    // Captura errores y muestra un mensaje en caso de fallo en la conexión
    errorMessage.value = 'Error en la conexión con la API';
  }
};
</script> -->

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

      <!-- Campos de entrada para el usuario -->
      <input 
        v-model="name" 
        placeholder="Nombre" 
        class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-green-500" 
      />
      <input 
        v-model="document" 
        placeholder="Documento" 
        class="w-full mt-3 p-2 rounded bg-white bg-opacity-50 focus:ring-2 focus:ring-green-500" 
      />

      <!-- Botón de inicio de sesión -->
      <button 
        @click="login" 
        class="w-full bg-green-600 text-white py-2 rounded mt-4 hover:bg-green-700 transition"
      >
        Ingresar
      </button>

      <!-- Mensaje de error en caso de fallos -->
      <p v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</p>

      <!-- Enlace para ir al registro si no tiene cuenta -->
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
import AuthService from "@/services/AuthService";
import backgroundImage from "@/assets/img/cultivasena.png";

const router = useRouter();

// Variables reactivas
const name = ref("");
const document = ref("");
const errorMessage = ref("");

const login = async () => {
  try {
    // Llamamos al servicio de autenticación
    const response = await AuthService.login({
      name: name.value,
      document: document.value,
    });

    // Guarda el token en localStorage
    localStorage.setItem("token", response.access_token);

    // Alerta de éxito
    Swal.fire({
      title: "Ingreso Exitoso",
      text: `Bienvenido, ${name.value}!`,
      icon: "success",
      confirmButtonColor: "#38af3e",
    });

    // Redirigir al WelcomeUsers.vue
    router.push(`/welcome/${name.value}`);
  } catch (error) {
    errorMessage.value = "Credenciales incorrectas. Intenta de nuevo.";
    console.error("Error en el login:", error);
  }
};

</script>
