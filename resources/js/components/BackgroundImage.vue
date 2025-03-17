<template>
  <!-- Contenedor de la imagen de fondo -->
  <div
    class="fixed inset-0 bg-cover bg-center bg-no-repeat -z-50"
    :style="{ backgroundImage: `url(${imagenFondo})` }"
  >
    <!-- Slot para contenido dinámico -->
    <slot></slot>
  </div>
</template>

<script setup>
import { computed } from "vue";

/**
 * 📌 Definir las propiedades del componente
 */
const props = defineProps({
  tipo: {
    type: String,
    required: true,
    validator: (value) => ["Mora", "Café"].includes(value),
  },
});

/**
 * 📌 Computed property para obtener la imagen de fondo según el tipo de cultivo.
 */
const imagenFondo = computed(() => {
  const images = {
    Mora: "/src/assets/img/caja.jpg",
    Café: "/src/assets/img/formas.jpg",
  };
  return images[props.tipo] || images["Mora"]; // Valor por defecto
});
</script>
