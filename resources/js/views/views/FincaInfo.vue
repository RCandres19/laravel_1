<template>
  <div class="p-5">
    <h1 class="text-2xl font-bold text-green-700">Información de la Finca sobre {{ tipo }}</h1>
    <p class="text-gray-700 mt-2">Datos específicos de la finca para la producción de {{ tipo }}.</p>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router';

const route = useRoute();
const tipo = route.params.tipo;
</script>
