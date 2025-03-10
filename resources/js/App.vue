<!--<template>
  <img alt="Vue logo" src="./assets/logo.png">
  <HelloWorld msg="Welcome to Your Vue.js App"/>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'

export default {
  name: 'App',
  components: {
    HelloWorld
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
-->

<!--<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const message = ref('');

onMounted(async () => {
  try {
    const response = await axios.get(import.meta.env.VITE_API_URL + '/test');
    message.value = response.data.message;
  } catch (error) {
    console.error('Error al conectar con la API:', error);
  }
});
</script>

<template>
  <div>
    <h1>{{ message }}</h1>
  </div>
</template>-->

<template>
  <!-- Contenedor principal que ocupa toda la pantalla -->
  <div class="min-h-screen bg-gray-100">
    <!-- router-view es un componente dinámico que muestra la página actual según la ruta -->
    <router-view />
  </div>
</template>

<script setup>
/**
 * Este es el componente raíz de la aplicación Vue.js.
 * 
 * - `router-view` se encarga de renderizar dinámicamente el componente correspondiente a la ruta activa.
 * - La clase `min-h-screen` garantiza que el fondo cubra toda la altura de la pantalla.
 * - `bg-gray-100` da un fondo gris claro para una mejor estética.
 * 
 * Nota: `script setup` se usa para simplificar el código y mejorar el rendimiento.
 */
</script>
