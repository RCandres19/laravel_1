<template>
  <div class="w-64 bg-gray-900 text-white p-5 h-screen fixed">
    <ul class="space-y-4">
      <li 
        v-for="(item, index) in menuItems" 
        :key="index" 
        @click="navigateTo(item.ruta)"
        class="flex items-center space-x-3 p-3 rounded-lg cursor-pointer transition-all"
        :class="{ 'bg-gray-700': rutaActiva === item.ruta, 'hover:bg-gray-700': rutaActiva !== item.ruta }"
      >
        <component :is="item.icon" class="h-6 w-6" :class="{ 'text-yellow-400': rutaActiva === item.ruta, 'text-white': rutaActiva !== item.ruta }" />
        <span class="text-lg">{{ item.texto }}</span>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { HomeIcon, NewspaperIcon, SunIcon, TagIcon, ChartBarIcon } from '@heroicons/vue/24/outline';


const router = useRouter();
const route = useRoute();
const rutaActiva = ref(route.path); // Guarda la ruta actual

console.log(router.getRoutes());

const menuItems = [
  { icon: HomeIcon, texto: 'Información de la Finca', ruta: '/finca' },
  { icon: ChartBarIcon, texto: 'Información sobre Cultivos', ruta: '/cultivos' },
  { icon: NewspaperIcon, texto: 'Últimas Noticias', ruta: '/noticias' },
  { icon: SunIcon, texto: 'Condiciones Climáticas', ruta: '/clima' },
  { icon: TagIcon, texto: 'Precios del Mercado', ruta: '/mercado' }
];

const navigateTo = (ruta) => {
  if (ruta !== rutaActiva.value) {
    console.log("Navegando a:", ruta);
    router.push(ruta);
    rutaActiva.value = ruta;
  }
};

// Observa los cambios en la ruta activa
watch(route, () => {
  rutaActiva.value = route.path;
});
</script>

