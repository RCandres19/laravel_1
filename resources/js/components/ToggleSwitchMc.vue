<template>
  <div class="flex items-center space-x-3">
    <!-- Interruptor con etiqueta para accesibilidad -->
    <label class="relative inline-flex items-center cursor-pointer">
      <!-- Input oculto para accesibilidad -->
      <input type="checkbox" v-model="activo" @change="cambiarEstado" class="sr-only peer">
      
      <!-- Contenedor del interruptor (fondo) -->
      <div class="w-12 h-6 bg-gray-300 rounded-full peer-checked:bg-green-500 relative transition-all">
        <!-- Indicador deslizante -->
        <div class="w-5 h-5 bg-white rounded-full absolute top-0.5 left-1 transition-transform peer-checked:translate-x-6"></div>
      </div>
    </label>

    <!-- Texto que indica el estado actual -->
    <span class="text-lg font-semibold">{{ activo ? 'Café' : 'Mora' }}</span>
  </div>
</template>

<script setup>
/**
 * Importamos `ref` para manejar el estado reactivo del interruptor
 * y `defineEmits` para emitir eventos al componente padre.
 */
import { ref } from "vue";

/**
 * Estado del interruptor:
 * - `false` → Modo Mora 
 * - `true` → Modo Café ☕
 */
const activo = ref(false);

/**
 * Emitimos un evento personalizado `"toggle-cambiado"`
 * cada vez que el usuario cambia el interruptor.
 * Usamos `defineEmits` directamente, sin importarlo
 */
const emit = defineEmits(["toggle-cambiado"]);

/**
 * Función que se ejecuta cuando el interruptor cambia de estado.
 * Emite el valor actualizado ("Mora" o "Café") al componente padre.
 */
const cambiarEstado = () => {
  emit("toggle-cambiado", activo.value ? "Café" : "Mora");
};
</script>
