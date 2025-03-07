<template>
    <div class="content">
      <h1>Precios del Mercado para {{ tipo }}</h1>
      <p>Aquí están los precios actuales de {{ tipo }} en el mercado.</p>
    </div>
  </template>
  
  <script>
  import { useRoute } from 'vue-router';
  
  export default {
    setup() {
      const route = useRoute();
      return { tipo: route.params.tipo };
    },
  };
  </script>
  
  <style scoped>
  .content {
    padding: 20px;
  }
  </style>
  