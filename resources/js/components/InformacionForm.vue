<template>
    <form @submit.prevent="submit">
      <input v-model="titulo" type="text" placeholder="Título" required class="border p-2 w-full" />
      <textarea v-model="contenido" placeholder="Contenido" required class="border p-2 w-full mt-2"></textarea>
      <button type="submit" class="bg-blue-500 text-white p-2 mt-2 rounded">Guardar</button>
    </form>
  </template>
  
  <script setup>
  import { ref, defineEmits } from "vue";
  
  const titulo = ref("");
  const contenido = ref("");
  const emit = defineEmits(["submit"]);
  
  const submit = () => {
    emit("submit", { titulo: titulo.value, contenido: contenido.value });
    titulo.value = "";
    contenido.value = "";
  };
  </script>
  