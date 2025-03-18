<script setup>
import { useRouter } from 'vue-router';
import cultivaSena from "../assets/img/cultivasena.png"; // Imagen de fondo

const router = useRouter();

/**
 * Redirige a la página de inicio de sesión.
 */
const goToLogin = () => {
  router.push('/login');
};
</script>

<template>
  <div 
    class="w-full h-screen bg-cover bg-center relative" 
    :style="{ backgroundImage: `url(${cultivaSena})` }"
  >
    <!-- Botón flotante para iniciar sesión -->
    <button 
      @click="goToLogin"
      class="absolute top-10 left-10 px-5 py-2 bg-blue-600 text-white rounded-lg 
             shadow-lg hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-300"
      aria-label="Iniciar sesión"
    >
      Iniciar sesión
    </button>
  </div>
</template>



