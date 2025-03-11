<template>
  <div class="w-64 bg-gray-900 text-white p-5 h-screen fixed">
    <ul class="space-y-4">
      <li v-for="(item, index) in menuItems" :key="index" @click="navigateTo(item.ruta)"
          class="flex items-center space-x-3 p-3 rounded-lg cursor-pointer hover:bg-gray-700 transition-all">
        <component :is="item.icon" class="h-6 w-6 text-white" />
        <span class="text-lg">{{ item.texto }}</span>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import { HomeIcon, NewspaperIcon, SunIcon, TagIcon, ChartBarIcon } from '@heroicons/vue/24/outline';

const router = useRouter();

const menuItems = [
  { icon: HomeIcon, texto: 'Información de la Finca', ruta: '/finca' },
  { icon: ChartBarIcon, texto: 'Información sobre Cultivos', ruta: '/cultivos' },
  { icon: NewspaperIcon, texto: 'Últimas Noticias', ruta: '/noticias' },
  { icon: SunIcon, texto: 'Condiciones Climáticas', ruta: '/clima' },
  { icon: TagIcon, texto: 'Precios del Mercado', ruta: '/mercado' }
];

const navigateTo = (ruta) => {
  router.push(ruta);
};
</script>
