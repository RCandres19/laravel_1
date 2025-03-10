<template>
  <div class="p-5">
    <!-- Título con el tipo de cultivo seleccionado (Mora o Café) -->
    <h1 class="text-2xl font-bold text-green-700">
      Información de la Finca sobre {{ tipo }}
    </h1>

    <!-- Descripción de la sección -->
    <p class="text-gray-700 mt-2">
      Datos específicos de la finca para la producción de {{ tipo }}.
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
 * si se muestra información sobre fincas de Mora o Café.
 */
const tipo = route.params.tipo;
</script>
