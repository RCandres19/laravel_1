<template>
    <div class="container mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4">Administrar Información</h1>
  
      <InformacionForm @submit="guardarInformacion" />
  
      <div v-if="informaciones.length">
        <h2 class="text-xl font-semibold mt-4">Lista de Informaciones</h2>
        <ul>
          <li v-for="info in informaciones" :key="info.id" class="bg-gray-100 p-2 my-2">
            <p><strong>{{ info.titulo }}</strong></p>
            <p>{{ info.contenido }}</p>
            <button @click="eliminarInformacion(info.id)" class="bg-red-500 text-white p-1 rounded">Eliminar</button>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from "vue";
  import { useInformacionStore } from "@/store/informacion";
  import InformacionForm from "@/components/InformacionForm.vue";
  
  const informacionStore = useInformacionStore();
  const informaciones = ref([]);
  
  const cargarInformaciones = async () => {
    informaciones.value = await informacionStore.obtenerInformaciones();
  };
  
  const guardarInformacion = async (data) => {
    await informacionStore.agregarInformacion(data);
    cargarInformaciones();
  };
  
  const eliminarInformacion = async (id) => {
    await informacionStore.eliminarInformacion(id);
    cargarInformaciones();
  };
  
  onMounted(cargarInformaciones);
  </script>
  