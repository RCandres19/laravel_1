<template>
  <div class="p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold text-blue-700">Condiciones Climáticas para {{ tipo }}</h1>
    <p class="mt-2 text-gray-700">Consulta el clima para optimizar el cultivo de {{ tipo }}.</p>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router';

const route = useRoute();
const tipo = route.params.tipo; // Detecta si es "mora" o "cafe"
</script>
