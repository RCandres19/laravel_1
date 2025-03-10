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
import { defineProps } from "vue";

/**
 * 📌 Definir las propiedades del componente
 *    - `tipo`: Indica el tipo de cultivo ("Mora" o "Café").
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
const imagenFondo = computed(() =>
  props.tipo === "Mora"
    ? new URL("@/assets/img/caja.jpg", import.meta.url).href
    : new URL("@/assets/img/formas.jpg", import.meta.url).href
);
</script>
