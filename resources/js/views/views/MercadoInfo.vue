<template>
  <div class="p-5">
    <h1 class="text-2xl font-bold text-green-700">Precios del Mercado para {{ tipo }}</h1>
    <p class="text-gray-700 mt-2">Aquí están los precios actuales de {{ tipo }} en el mercado.</p>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router';

const route = useRoute();
const tipo = route.params.tipo;
</script>
