<template>
  <div class="p-5">
    <h1 class="text-2xl font-bold text-green-700">Últimas Noticias sobre {{ tipo }}</h1>
    <p class="text-gray-700 mt-2">Aquí verás noticias relevantes para los productores de {{ tipo }}.</p>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router';

const route = useRoute();
const tipo = route.params.tipo;
</script>

  