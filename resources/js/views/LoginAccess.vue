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

<template>
  <div class="login">
    <!-- Contenedor del formulario de inicio de sesión -->
    <div class="form-container">
      <h2>Login</h2>

      <!-- Campo de entrada para el nombre del usuario -->
      <input v-model="name" placeholder="Name" />

      <!-- Campo de entrada para el documento del usuario -->
      <input v-model="document" placeholder="Document" />

      <!-- Botón para iniciar sesión -->
      <button @click="login">Ingresar</button>

      <!-- Mensaje de error en caso de fallo en el inicio de sesión -->
      <p class="error">{{ errorMessage }}</p>

      <!-- Enlace para redirigir a la página de registro -->
      <p class="register-link">
        ¿No tienes cuenta? <router-link to="/register">Regístrate aquí</router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'; // Importamos ref para manejar variables reactivas
import { useRouter } from 'vue-router'; // Importamos useRouter para la navegación
import axios from 'axios'; // Importamos axios para hacer peticiones HTTP
import Swal from 'sweetalert2'; // Importamos SweetAlert2 para mostrar mensajes interactivos

const router = useRouter(); // Inicializamos el enrutador

// Variables reactivas para almacenar los datos del formulario
const name = ref('');
const document = ref('');
const errorMessage = ref('');

// Función asincrónica para iniciar sesión
const login = async () => {
  try {
    // Enviamos una solicitud POST a la API con los datos del usuario
    const response = await axios.post('http://127.0.0.1:8000/api/login', {
      name: name.value,
      document: document.value
    });

    // Verificamos si la API devuelve un inicio de sesión exitoso
    if (response.data.success) {
      // Mostramos una alerta de bienvenida con SweetAlert2
      Swal.fire({
        title: 'Ingreso Exitoso',
        text: `Bienvenido, ${name.value}!`,
        icon: 'success',
        confirmButtonColor: '#38af3e'
      });

      // Redirigimos al usuario a la pantalla de bienvenida con su nombre
      router.push(`/welcome/${name.value}`);
    } 
    
    else {
      // Mostramos un mensaje de error si el usuario no es encontrado
      errorMessage.value = 'Usuario no encontrado';
    }
  } catch (error) {
    // Capturamos errores y mostramos un mensaje de fallo en la conexión con la API
    errorMessage.value = 'Error en la conexión con la API';
  }
};
</script>


<style scoped>
:root {
  --blur-amount: 10px;
}

.login {
  position: fixed;
  width: 100vw; /* Ocupar todo el ancho */
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
}

.login::before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url("@/assets/img/cultivasena.png") no-repeat center center;
  background-size: cover;
  filter: blur(var(--blur-amount, 10px));
  z-index: -1;
}

.form-container {
  background: rgba(255, 255, 255, 0.2);
  padding: 25px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  text-align: center;
  backdrop-filter: blur(10px);
  width: 300px;
}

input {
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

.register-link {
  margin-top: 15px;
  font-size: 14px;
  color: #000;
}

.register-link a {
  color: #239713;
  text-decoration: none;
  font-weight: bold;
}

.register-link a:hover {
  text-decoration: underline;
}
</style>
