<template>
  <!-- Contenedor principal con diseño centrado vertical y horizontalmente -->
  <div class="flex flex-col items-center justify-center h-screen text-center">
    <!-- Mensaje de cierre de sesión -->
    <h1 class="text-2xl font-bold mb-4">Cerrando sesión...</h1>
    <!-- Indicador de carga (animación tipo spinner) -->
    <div class="w-10 h-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { useRouter } from "vue-router";

/**
 * Instancia del enrutador de Vue
 */
const router = useRouter();
const timeoutId = ref(null); // Variable reactiva para almacenar el temporizador

/**
 * Hook que se ejecuta cuando el componente se monta
 * - Solo inicia el temporizador si no estamos en "/"
 */
onMounted(() => {
  if (router.currentRoute.value.path !== "/") {
    timeoutId.value = setTimeout(() => {
      router.push("/");
    }, 2000);
  }
});

/**
 * Hook que se ejecuta cuando el componente se desmonta
 * - Limpia el temporizador si existe
 */
onUnmounted(() => {
  if (timeoutId.value) {
    clearTimeout(timeoutId.value);
  }
});
</script>
