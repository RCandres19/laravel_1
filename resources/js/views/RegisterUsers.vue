<template>
  <div class="register">
    <!-- Contenedor del formulario de registro -->
    <div class="form-container">
      <h2>Registro</h2>

      <!-- Selección del tipo de documento -->
      <select v-model="type_document">
        <option value="" disabled selected>Selecciona un tipo de documento</option>
        <option value="PPT">Permiso de Protección Temporal</option>
        <option value="PEP">Permiso Especial de Permanencia</option>
        <option value="CC">Cedula Colombiana</option>
        <option value="TI">Tarjeta de Identidad</option>
        <option value="Pasaporte">Pasaporte</option>
      </select>
      
      <!-- Campo de entrada para el nombre del usuario -->
      <input v-model="name" placeholder="Nombre" />

      <!-- Campo de entrada para el número de documento -->
      <input v-model="document" placeholder="Documento" />

      <!-- Campo de entrada para el correo electrónico (opcional) -->
      <input v-model="email" placeholder="Correo (opcional)" />

      <!-- Botón para registrar al usuario -->
      <button @click="register">Registrar</button>

      <!-- Mensaje de error en caso de fallo -->
      <p class="error">{{ errorMessage }}</p>

      <!-- Enlace para redirigir a la página de inicio de sesión -->
      <p class="login-link">
        ¿Ya tienes cuenta? <router-link to="/login">Inicia sesión aquí</router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'; // Importamos ref para manejar variables reactivas
import { useRouter } from 'vue-router'; // Importamos el enrutador para la navegación
import axios from 'axios'; // Importamos axios para hacer peticiones HTTP
import Swal from 'sweetalert2'; // Importamos SweetAlert2 para mostrar mensajes bonitos

const router = useRouter(); // Inicializamos el enrutador

// Variables reactivas para almacenar los datos del formulario
const name = ref('');
const type_document = ref('');
const document = ref('');
const email = ref('');
const errorMessage = ref('');

// Función asincrónica para registrar un usuario
const register = async () => {
  try {
    // Enviamos una solicitud POST a la API para registrar al usuario
    await axios.post('http://127.0.0.1:8000/api/register', {
      name: name.value,
      type_document: type_document.value,
      document: document.value,
      email: email.value
    });

    // Mostramos una alerta de éxito con SweetAlert2
    Swal.fire({
      title: 'Registro Exitoso',
      text: `Bienvenido, ${name.value}!`,
      icon: 'success',
      confirmButtonColor: '#38af3e'
    });

    // Redirigimos al usuario a la página de bienvenida con su nombre
    router.push(`/welcome/${name.value}`);
  } catch (error) {
    // Capturamos errores y mostramos un mensaje de error
    errorMessage.value = 'Error en la conexión con la API';
  }
};
</script>


<style scoped>
:root {
  --blur-amount: 8px;
}

.register {
  position: relative;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
}

.register::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('@/assets/img/cultivasena.png') no-repeat center center;
  background-size: cover;
  filter: blur(var(--blur-amount, 3px));
  z-index: -1;
}

.form-container {
  background: rgba(189, 181, 181, 0.144);
  padding: 25px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  text-align: center;
  backdrop-filter: blur(10px);
  width: 300px;
}

input, select {
  display: block;
  width: 100%;
  margin: 10px 0;
  padding: 10px;
  border-radius: 5px;
  border: none;
  background: rgba(255, 255, 255, 0.3);
  backdrop-filter: blur(5px);
}

button {
  background-color: #38af3e;
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
  transition: 0.3s;
  border-radius: 5px;
  width: 100%;
}

button:hover {
  background-color: #239713;
}

.error {
  color: red;
  margin-top: 10px;
}

.login-link {
  margin-top: 15px;
  font-size: 14px;
  color: #000;
}

.login-link a {
  color: #239713;
  text-decoration: none;
  font-weight: bold;
}

.login-link a:hover {
  text-decoration: underline;
}
</style>



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

