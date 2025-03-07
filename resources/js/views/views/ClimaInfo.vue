<template>
    <div class="content">
      <h1>Condiciones Climáticas para {{ tipo }}</h1>
      <p>Consulta el clima para optimizar el cultivo de {{ tipo }}.</p>
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
  