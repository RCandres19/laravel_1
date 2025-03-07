<template>
    <div class="content">
      <h1>Información de la Finca sobre {{ tipo }}</h1>
      <p>Datos específicos de la finca para la producción de {{ tipo }}.</p>
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
  