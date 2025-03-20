<template>
    <div class="container mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4">Administrar Boletines</h1>
  
      <BoletinForm @submit="guardarBoletin" />
  
      <div v-if="boletines.length">
        <h2 class="text-xl font-semibold mt-4">Lista de Boletines</h2>
        <ul>
          <li v-for="boletin in boletines" :key="boletin.id" class="bg-gray-100 p-2 my-2">
            <p><strong>{{ boletin.titulo }}</strong></p>
            <p>{{ boletin.descripcion }}</p>
            <button @click="eliminarBoletin(boletin.id)" class="bg-red-500 text-white p-1 rounded">Eliminar</button>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from "vue";
  import { useBoletinStore } from "@/store/boletines";
  import BoletinForm from "@/components/BoletinForm.vue";
  
  const boletinStore = useBoletinStore();
  const boletines = ref([]);
  
  const cargarBoletines = async () => {
    boletines.value = await boletinStore.obtenerBoletines();
  };
  
  const guardarBoletin = async (data) => {
    await boletinStore.agregarBoletin(data);
    cargarBoletines();
  };
  
  const eliminarBoletin = async (id) => {
    await boletinStore.eliminarBoletin(id);
    cargarBoletines();
  };
  
  onMounted(cargarBoletines);
  </script>
  