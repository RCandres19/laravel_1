<template>
  <!-- Contenedor principal del menú lateral -->
  <div class="w-64 bg-gray-900 text-white p-5 h-screen fixed">
    <ul class="space-y-4">
      <!-- Itera sobre los elementos del menú -->
      <li 
        v-for="(item, index) in menuItems" 
        :key="index" 
        @click="navigateTo(item.ruta)" 
        class="flex items-center space-x-3 p-3 rounded-lg cursor-pointer transition-all"
        :class="{ 
          'bg-gray-700 text-yellow-400': rutaActiva === item.ruta, 
          'hover:bg-gray-700': rutaActiva !== item.ruta 
        }"
      >
        <!-- Renderiza el icono del menú dinámicamente -->
        <component 
          :is="item.icon" 
          class="h-6 w-6 transition-all"
        />
        <!-- Texto del menú -->
        <span class="text-lg">{{ item.texto }}</span>
      </li>
    </ul>
  </div>
</template>

<script setup>
/**
 * Importamos las funciones necesarias de Vue y Vue Router.
 * - `computed` permite calcular valores reactivos basados en otros valores reactivos.
 * - `useRouter` nos permite manejar la navegación programática en Vue Router.
 * - `useRoute` nos proporciona información sobre la ruta actual.
 */
import { computed } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { HomeIcon, NewspaperIcon, SunIcon, TagIcon, ChartBarIcon } from '@heroicons/vue/24/outline';

/**
 * `router` maneja la navegación dentro de la aplicación.
 * `route` almacena la información de la ruta actual.
 */
const router = useRouter();
const route = useRoute();

/**
 * Computed property que almacena la ruta activa en la navegación.
 * Se actualiza automáticamente cuando la ruta cambia.
 */
const rutaActiva = computed(() => route.path);

/**
 * Lista de elementos del menú.
 * Cada objeto contiene:
 * - `icon`: Componente de Heroicons para el ícono del menú.
 * - `texto`: Texto que se muestra en la opción del menú.
 * - `ruta`: Ruta a la que redirige al hacer clic.
 */
const menuItems = [
  { icon: HomeIcon, texto: 'Información de la Finca', ruta: '/finca' },
  { icon: ChartBarIcon, texto: 'Información sobre Cultivos', ruta: '/cultivos' },
  { icon: NewspaperIcon, texto: 'Últimas Noticias', ruta: '/noticias' },
  { icon: SunIcon, texto: 'Condiciones Climáticas', ruta: '/clima' },
  { icon: TagIcon, texto: 'Precios del Mercado', ruta: '/mercado' }
];

/**
 * Función que maneja la navegación programática al hacer clic en un elemento del menú.
 * - Evita redireccionar si la ruta ya está activa.
 * - Usa `router.push()` para cambiar de ruta.
 * - `console.log()` muestra la ruta a la que se está navegando.
 */
const navigateTo = (ruta) => {
  if (ruta !== rutaActiva.value) {
    console.log("Navegando a:", ruta);
    router.push(ruta);
  }
};
</script>
