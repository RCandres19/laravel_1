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
  <div class="min-h-screen bg-gray-100">
    <router-view />
  </div>
</template>

<script setup>
</script>
