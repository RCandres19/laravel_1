<template>
  <div class="p-6 bg-white shadow-lg rounded-lg">
    <!-- Título con el tipo de cultivo dinámico (Mora o Café) -->
    <h1 class="text-2xl font-bold text-blue-700">
      Condiciones Climáticas para {{ tipo }}
    </h1>

    <!-- Descripción de la importancia del clima en el cultivo -->
    <p class="mt-2 text-gray-700">
      Consulta el clima para optimizar el cultivo de {{ tipo }}.
    </p>
  </div>
</template>

<script setup>
/**
 * Importamos `useRoute` de Vue Router para acceder a la ruta actual y extraer parámetros dinámicos.
 */
import { useRoute } from 'vue-router';

/**
 * Capturamos la ruta actual y extraemos el parámetro `tipo`, 
 * que nos indica si la información corresponde a "Mora" o "Café".
 */
const route = useRoute();
const tipo = route.params.tipo; // Detecta si es "mora" o "cafe"
</script>
