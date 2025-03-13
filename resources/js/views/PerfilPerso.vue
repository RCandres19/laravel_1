<template>
    <div class="flex flex-col h-screen bg-gray-100">
      <MenuPages />
      <main class="flex-1 p-6 animate-fade-in">
        <h1 class="text-3xl font-bold text-gray-800">Perfil Personal</h1>
        <p class="mt-2 text-gray-600">Consulta y actualiza tu información personal.</p>
  
        <div class="mt-6 bg-white shadow-md p-6 rounded-lg max-w-md mx-auto">
          <p class="text-lg font-semibold">Nombre: <span class="text-gray-700">{{ user.name }}</span></p>
          <p class="mt-2 text-gray-600">Correo: <span class="text-gray-700">{{ user.email }}</span></p>
          <button 
            class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
            @click="editarPerfil">
            Editar Perfil
          </button>
        </div>
      </main>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import MenuPages from '@/components/MenuPages.vue';
  
  const user = ref({ name: "Juan Pérez", email: "juanperez@example.com" });
  
  const editarPerfil = () => {
    alert("Función de edición en desarrollo.");
  };
  
  onMounted(() => {
    console.log("Perfil cargado correctamente.");
  });
  </script>
  