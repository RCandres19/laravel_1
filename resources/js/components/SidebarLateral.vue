<template>
  <!-- Barra lateral fija -->
  <div class="w-64 bg-gray-900 text-white p-5 h-screen fixed">
    <ul class="space-y-4">
      <li v-for="(item, index) in iconos" :key="index" @click="irAPagina(item)"
          class="flex items-center space-x-3 p-3 rounded-lg cursor-pointer hover:bg-gray-700 transition-all">
        <!-- Icono de cada opción -->
        <font-awesome-icon :icon="item.icon" class="text-xl" />
        <span class="text-lg">{{ item.texto }}</span>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';

// Inicializa el enrutador de Vue
const router = useRouter();

/**
 * Menú de la barra lateral con iconos y rutas asociadas.
 */
const iconos = [
  { icon: 'seedling', texto: 'Información sobre Cultivos', ruta: 'cultivos' },
  { icon: 'newspaper', texto: 'Últimas Noticias', ruta: 'noticias' },
  { icon: 'sun', texto: 'Condiciones Climáticas', ruta: 'clima' },
  { icon: 'tag', texto: 'Precios del Mercado', ruta: 'mercado' },
  { icon: 'house-chimney', texto: 'Información de la Finca', ruta: 'finca' }
];

/**
 * Redirige a la página correspondiente según el tipo de cultivo seleccionado.
 * - `tipo`: Se obtiene de `localStorage`, por defecto "mora".
 * - `ruta`: Depende del elemento seleccionado en el menú.
 */
const irAPagina = (item) => {
  const tipo = localStorage.getItem('tipo') || 'mora'; // "mora" por defecto
  router.push(`/${tipo}/${item.ruta}`);
};
</script>
