<template>
  <div class="flex items-center space-x-3">
    <!-- Interruptor -->
    <label class="relative inline-flex items-center cursor-pointer">
      <!-- Input oculto para accesibilidad -->
      <input type="checkbox" v-model="activo" @change="cambiarEstado" class="sr-only peer">
      <!-- Contenedor del interruptor -->
      <div class="w-12 h-6 bg-gray-300 rounded-full peer-checked:bg-green-500 relative transition-all">
        <!-- Indicador deslizante -->
        <div class="w-5 h-5 bg-white rounded-full absolute top-0.5 left-1 transition-transform peer-checked:translate-x-6"></div>
      </div>
    </label>
    <!-- Texto que indica el estado -->
    <span class="text-lg font-semibold">{{ activo ? 'Café' : 'Mora' }}</span>
  </div>
</template>

<script setup>
import { ref, defineEmits } from "vue";

// Estado del interruptor (false = Mora, true = Café)
const activo = ref(false);

// Emisor de eventos para comunicar el cambio al componente padre
const emit = defineEmits(["toggle-cambiado"]);

// Función que se ejecuta cuando el interruptor cambia
const cambiarEstado = () => {
  emit("toggle-cambiado", activo.value ? "Café" : "Mora");
};
</script>
