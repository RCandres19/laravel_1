<template>
  <div class="flex items-center space-x-3">
    <!-- Interruptor con etiqueta accesible -->
    <label 
      class="relative inline-flex items-center cursor-pointer"
      role="switch"
      :aria-checked="activo"
      aria-label="Cambiar entre Mora y Café"
    >
      <!-- Input oculto para accesibilidad -->
      <input 
        type="checkbox" 
        v-model="activo" 
        @change="cambiarEstado" 
        class="sr-only peer"
      />

      <!-- Contenedor del interruptor (fondo) -->
      <div class="w-12 h-6 bg-gray-300 rounded-full peer-checked:bg-green-500 relative transition-all">
        <!-- Indicador deslizante -->
        <div class="w-5 h-5 bg-white rounded-full absolute top-0.5 left-1 peer-checked:left-6 transition-all"></div>
      </div>
    </label>

    <!-- Texto que indica el estado actual -->
    <span class="text-lg font-semibold">
      {{ activo ? "Café" : "Mora" }}
    </span>
  </div>
</template>

<script setup>
import { ref, defineProps, defineEmits } from "vue";

/**
 * Propiedad para recibir el estado inicial desde el padre.
 */
const props = defineProps({
  modelo: {
    type: Boolean,
    default: false, // Estado inicial por defecto
  },
});

/**
 * Estado del interruptor basado en la prop `modelo`
 */
const activo = ref(props.modelo);

/**
 * Emitimos un evento `"toggle-cambiado"` con el nuevo valor
 */
const emit = defineEmits(["toggle-cambiado"]);

const cambiarEstado = () => {
  emit("toggle-cambiado", activo.value ? "Café" : "Mora");
};
</script>
