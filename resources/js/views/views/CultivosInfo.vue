<template>
    <div class="content">
      <h1>Información sobre Cultivos de {{ tipo }}</h1>
      <p>Aquí encontrarás información detallada sobre el cultivo de {{ tipo }}.</p>
    </div>
  </template>
  
  <script>
  import { useRoute } from 'vue-router';
  
  export default {
    setup() {
      const route = useRoute();
      return { tipo: route.params.tipo }; // Detecta si es "mora" o "cafe"
    },
  };
  </script>
  
  <style scoped>
  .content {
    padding: 20px;
  }
  </style>
  