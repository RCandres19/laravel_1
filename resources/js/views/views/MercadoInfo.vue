<template>
  <div class="p-5">
    <!-- Título con el tipo de cultivo (Mora o Café) -->
    <h1 class="text-2xl font-bold text-green-700">
      Precios del Mercado para {{ tipo }}
    </h1>

    <!-- Descripción de la sección -->
    <p class="text-gray-700 mt-2">
      Aquí están los precios actuales de {{ tipo }} en el mercado.
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
 * si se muestran precios de Mora o Café en el mercado.
 */
const tipo = route.params.tipo;
</script>

