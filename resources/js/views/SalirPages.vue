<template>
    <!-- Contenedor principal con diseño centrado vertical y horizontalmente -->
    <div class="flex flex-col items-center justify-center h-screen text-center">
      <!-- Componente del menú de navegación -->
      <MenuPages />
      <!-- Mensaje de cierre de sesión -->
      <h1 class="text-2xl font-bold mb-4">Cerrando sesión...</h1>
      <!-- Indicador de carga (animación de carga tipo spinner) -->
      <div class="w-10 h-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
    </div>
  </template>
  
  <script setup>
  /**
   * Importaciones necesarias
   */
  import { onMounted, onUnmounted } from "vue";
  import { useRouter } from "vue-router";
  import MenuPages from "@/components/MenuPages.vue";
  
  /**
   * Instancia del enrutador de Vue
   */
  const router = useRouter();
  
  /**
   * Variable para almacenar el ID del temporizador
   */
  let timeoutId;
  
  /**
   * Hook que se ejecuta cuando el componente se monta
   * - Inicia un temporizador de 2 segundos
   * - Redirige a la página principal ("/") después del tiempo establecido
   * - Verifica si la ruta actual no es "/" antes de redirigir
   */
  onMounted(() => {
    timeoutId = setTimeout(() => {
      if (router.currentRoute.value.path !== "/") {
        router.push("/");
      }
    }, 2000);
  });
  
  /**
   * Hook que se ejecuta cuando el componente se desmonta
   * - Limpia el temporizador para evitar errores si el usuario cambia de vista antes de la redirección
   */
  onUnmounted(() => {
    clearTimeout(timeoutId);
  });
  </script>
  