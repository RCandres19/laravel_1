<template>
    <div class="p-6 text-center">
      <h1 class="text-2xl font-bold">Cerrando sesión...</h1>
    </div>
  </template>
  
  <script setup>
  import { onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  
  const router = useRouter();
  
  onMounted(() => {
    setTimeout(() => {
      router.push('/'); // Redirige a HomePages.vue
    }, 2000);
  });
  </script>