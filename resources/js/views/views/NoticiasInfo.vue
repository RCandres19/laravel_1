<template>
  <div class="p-5">
    <!-- Título de la sección de noticias -->
    <h1 class="text-2xl font-bold text-green-700">
      Últimas Noticias sobre {{ tipo }}
    </h1>

    <!-- Descripción de la sección -->
    <p class="text-gray-700 mt-2">
      Aquí verás noticias relevantes para los productores de {{ tipo }}.
    </p>
  </div>
</template>

<script setup>
/**
 * Importamos `useRoute` de Vue Router para acceder a los parámetros de la URL.
 */
import { useRoute } from 'vue-router';

/**
 * Obtenemos la ruta actual usando `useRoute()`
 */
const route = useRoute();

/**
 * Extraemos el parámetro `tipo` de la URL para determinar 
 * si se muestran noticias de Mora o Café.
 */
const tipo = route.params.tipo;
</script>


  