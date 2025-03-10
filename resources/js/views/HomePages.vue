<script setup>
/**
 * Importamos `useRouter` de Vue Router para manejar la navegación en la aplicación.
 */
import { useRouter } from 'vue-router';

/**
 * Inicializamos `router` para permitir la redirección entre páginas.
 */
const router = useRouter();

/**
 * Función que redirige a la página de inicio de sesión cuando se hace clic en el botón.
 */
const goToLogin = () => {
  router.push('/login');
};
</script>

<template>
  <div
    class="w-screen h-screen bg-cover bg-center bg-no-repeat flex justify-end items-start p-5"
    style="background-image: url('@/assets/img/cultivasena.png');"
  >
    <!-- Botón de inicio de sesión -->
    <button
      @click="goToLogin"
      class="px-6 py-3 bg-green-700 text-white font-bold text-lg rounded-lg transition duration-300 hover:bg-blue-900"
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



