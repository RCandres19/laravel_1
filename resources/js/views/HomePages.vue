<script setup>
import { useRouter } from 'vue-router';
import cultivaSena from "@/assets/img/cultivasena.png"; // Imagen de fondo

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


<!--<style scoped>
.container {
  background-image: url('@/assets/img/cultivasena.png'); /* Ruta de la imagen */
  background-size: cover; /* Ajusta la imagen sin distorsionarla */
  background-position: center; /* Centra la imagen */
  background-repeat: no-repeat; /* Evita repeticiones */
 
  height: 100vh; /* Ocupa toda la pantalla */
  min-height: 100vh; /* Asegura compatibilidad */
  display: flex;
  justify-content: flex-end; /* Botón alineado a la derecha */
  align-items: start; /* Botón en la parte superior */
  padding: 20px;
}

.login-btn {
  padding: 12px 24px;
  background-color: rgb(28, 138, 52); /* Verde original */
  color: white;
  border: none;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
  border-radius: 10px;
  transition: background-color 0.3s ease;
}

.login-btn:hover {
  background-color: rgb(20, 100, 40); /* Verde más oscuro para el hover */
}
</style>  -->



