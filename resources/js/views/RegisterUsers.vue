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
        <option value="" disabled selected>Selecciona un tipo de documento</option>
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

      <!-- Botón de registro -->
      <button 
        @click="registerUser" 
        class="w-full bg-blue-600 text-white py-2 rounded mt-4 hover:bg-blue-700 transition"
      >
        Registrarse
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
/**
 * Importaciones necesarias
 */
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import Swal from 'sweetalert2';

// Importa la imagen de fondo
import backgroundImage from '@/assets/img/cultivasena.png';

/**
 * Instancia del enrutador de Vue
 */
const router = useRouter();

/**
 * Variables reactivas para los datos del usuario
 */
const name = ref(''); // Nombre del usuario
const type_document = ref(''); // Tipo de documento
const document = ref(''); // Número de documento
const email = ref(''); // Correo electrónico (opcional)
const errorMessage = ref(''); // Mensaje de error en caso de fallos

/**
 * Función para registrar un usuario en la API
 */
const registerUser = async () => {
  try {
    // Enviar datos al backend
    const response = await axios.post('http://127.0.0.1:8000/api/register', {
      name: name.value,
      type_document: type_document.value,
      document: document.value,
      email: email.value
    });

    // Verifica si el backend devuelve un token de acceso
    if (response.data.access_token) {
      // Guarda el token en localStorage para futuras autenticaciones
      localStorage.setItem('token', response.data.access_token);

      // Muestra una alerta de éxito con SweetAlert2
      Swal.fire({
        title: 'Registro Exitoso',
        text: `Bienvenido, ${name.value}!`,
        icon: 'success',
        confirmButtonColor: '#1d4ed8'
      });

      // Redirigir al usuario a la página de bienvenida
      router.push(`/welcome/${name.value}`);
    } else {
      throw new Error('No se recibió un token en la respuesta.');
    }
  } catch (error) {
    // Captura cualquier error y lo muestra al usuario
    errorMessage.value = 'Error en el registro. Verifica los datos e inténtalo nuevamente.';
    console.error('Error en el registro:', error);
  }
};
</script>




<!--<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();
const name = ref('');
const type_document = ref('');
const document = ref('');
const email = ref('');
const errorMessage = ref('');

const register = async () => {
  try {
    await axios.post('http://127.0.0.1:8000/api/register', {
      name: name.value,
      type_document: type_document.value,
      document: document.value,
      email: email.value
    });

    alert('Registro exitoso');
    router.push('/login');
  } 
      catch (error) {
      console.error(error.response?.data); // Muestra el error exacto en consola
      errorMessage.value = error.response?.data?.message || 'Error al registrar usuario';
    }

};
</script>

<template>
  <div class="container">
    <div class="form-box">
      <h2>Registro</h2>
      <input v-model="name" placeholder="Name" />
      <select v-model="type_document">
        <option value="PPT">PPT</option>
        <option value="PEP">PEP</option>
        <option value="CC">CC</option>
        <option value="TI">TI</option>
        <option value="Pasaporte">Pasaporte</option>
      </select>

      <input v-model="document" placeholder="Document" />
      <input v-model="email" placeholder="Email (opcional)" />
      <button @click="register">Registrar</button>
      <p class="error">{{ errorMessage }}</p>
    </div>
  </div>
</template>

<style scoped>
/* Reutilizamos estilos de Login.vue */
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
</style> -->

<!--<template>
  <div class="register-container">
    <form @submit.prevent="registerUser">
      <h2>Registro</h2>
      <input v-model="user.name" type="text" placeholder="Nombre" required />
      <select v-model="user.type_document" required>
        <option value="" disabled>Seleccione Tipo de Documento</option>
        <option value="DNI">DNI</option>
        <option value="Pasaporte">Pasaporte</option>
      </select>
      <input v-model="user.document" type="text" placeholder="Documento" required />
      <input v-model="user.email" type="email" placeholder="Correo (Opcional)" />
      <button type="submit">Registrarse</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {
        name: '',
        type_document: '',
        document: '',
        email: ''
      }
    };
  },
  methods: {
    async registerUser() {
      try {
        await this.$axios.post('/register', this.user);
        alert('Usuario registrado correctamente');
        this.$router.push('/welcome'); // Redirigir a la página de bienvenida
      } catch (error) {
        alert('Error en el registro: ' + error.response.data.message);
      }
    }
  }
};
</script>

<style scoped>
.register-container {
  max-width: 400px;
  margin: auto;
  padding: 20px;
  background: rgba(255, 255, 255, 0.8);
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
input, select, button {
  width: 100%;
  margin-bottom: 10px;
  padding: 10px;
}
button {
  background: blue;
  color: white;
  border: none;
  cursor: pointer;
}
</style> -->

