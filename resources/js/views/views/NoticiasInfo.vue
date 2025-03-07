<template>
    <div class="content">
      <h1>Últimas Noticias sobre {{ tipo }}</h1>
      <p>Aquí verás noticias relevantes para los productores de {{ tipo }}.</p>
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
  