<template>
  <div class="w-64 bg-gray-900 text-white p-5 h-screen fixed">
    <ul class="space-y-4">
      <li v-for="(item, index) in iconos" :key="index" @click="irAPagina(item)" 
          class="flex items-center space-x-3 p-3 rounded-lg cursor-pointer hover:bg-gray-700 transition-all">
        <font-awesome-icon :icon="item.icon" class="text-xl" />
        <span class="text-lg">{{ item.texto }}</span>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';

const router = useRouter();

const iconos = [
  { icon: 'seedling', texto: 'Información sobre Cultivos', ruta: 'cultivos' },
  { icon: 'newspaper', texto: 'Últimas Noticias', ruta: 'noticias' },
  { icon: 'sun', texto: 'Condiciones Climáticas', ruta: 'clima' },
  { icon: 'tag', texto: 'Precios del Mercado', ruta: 'mercado' },
  { icon: 'house-chimney', texto: 'Información de la Finca', ruta: 'finca' }
];

const irAPagina = (item) => {
  const tipo = localStorage.getItem('tipo') || 'mora'; // Detecta si es mora o café
  router.push(`/${tipo}/${item.ruta}`);
};
</script>
