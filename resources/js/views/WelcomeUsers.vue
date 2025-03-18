<template>
  <!-- Contenedor principal con imagen de fondo dinámica -->
  <BackgroundImage :tipo="tipoSeleccionado">
    <!-- Barra de navegación superior -->
    <MenuPages @menu-seleccionado="accionMenu" />
    
    <!-- Barra lateral con iconos -->
    <SidebarLateral @icon-clicked="mostrarInformacion" />
    
    <!-- Interruptor para cambiar entre "Mora" y "Café" -->
    <ToggleSwitchMc @toggle-cambiado="cambiarTipo" />

    <!-- Cuadro central con mensaje de bienvenida e información -->
    <div 
      class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
             bg-white bg-opacity-80 p-6 rounded-lg shadow-lg text-center"
    >
      <h1 class="text-2xl font-bold">Bienvenido, {{ userName || 'Invitado' }}</h1>
      <p class="text-gray-700 mt-2">{{ informacion }}</p>
      
      <!-- Vista dinámica según la ruta -->
      <div class="contenido">
        <router-view/>
      </div>
    </div>
  </BackgroundImage>
</template>

<script setup>
import { ref, onMounted, nextTick } from "vue";
import { useToggleStore } from "@/store/toggleStore";
import { useUserStore } from "@/store/userStore";
import { storeToRefs } from "pinia";

// Componentes
import BackgroundImage from "@/components/BackgroundImage.vue";
import MenuPages from "@/components/MenuPages.vue";
import SidebarLateral from "@/components/SidebarLateral.vue";
import ToggleSwitchMc from "@/components/ToggleSwitchMc.vue";

// Stores de Pinia
const toggleStore = useToggleStore();
const userStore = useUserStore();

const { tipoSeleccionado } = storeToRefs(toggleStore);
const { userName } = storeToRefs(userStore);

// Mensaje dinámico en pantalla
const informacion = ref("Seleccione una opción");

// Cargar usuario al montar el componente
onMounted(() => {
  userStore.loadUserFromStorage();
});

// Maneja la selección en el menú
const accionMenu = (opcion) => {
  informacion.value = `Seleccionaste: ${opcion}`;
};

// Cambia entre "Mora" y "Café"
const cambiarTipo = async () => {
  toggleStore.toggle();
  await nextTick(); // Espera la actualización del estado
  informacion.value = `Vista de ${tipoSeleccionado.value}`;
};

// Muestra información al hacer clic en la barra lateral
const mostrarInformacion = (info) => {
  informacion.value = info;
};
</script>
