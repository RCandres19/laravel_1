<template>
  <div class="w-64 bg-gray-900 text-white p-5 h-screen fixed">
    <ul class="space-y-4">
      <li v-for="(item, index) in iconos" :key="index"
          class="flex items-center space-x-3 p-3 rounded-lg cursor-default">
        <span class="text-xl">{{ item.icon }}</span>
        <span class="text-lg">{{ item.texto }}</span>
      </li>
    </ul>
  </div>
</template>

<script setup>
const iconos = [
  { icon: '🌱', texto: 'Información sobre Cultivos' },
  { icon: '📰', texto: 'Últimas Noticias' },
  { icon: '☀️', texto: 'Condiciones Climáticas' },
  { icon: '💰', texto: 'Precios del Mercado' },
  { icon: '🏡', texto: 'Información de la Finca' }
];
</script>
