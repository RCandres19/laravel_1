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
import { useToggleStore } from "../store/toggleStore";
import { useUserStore } from "../store/userStore";
import { storeToRefs } from "pinia";

// Importación de componentes
import BackgroundImage from "@/components/BackgroundImage.vue";
import MenuPages from "@/components/MenuPages.vue";
import SidebarLateral from "@/components/SidebarLateral.vue";
import ToggleSwitchMc from "@/components/ToggleSwitchMc.vue";

// Inicialización de las stores de Pinia
const toggleStore = useToggleStore();
const userStore = useUserStore();

// Obtención de estados reactivos desde las stores
const { tipoSeleccionado } = storeToRefs(toggleStore);
const { userName } = storeToRefs(userStore);

// Variable reactiva para mostrar información dinámica en la pantalla
const informacion = ref("Seleccione una opción");

// Cargar el usuario almacenado al montar el componente
onMounted(() => {
  userStore.loadUserFromStorage();
});

/**
 * Maneja la selección de una opción en el menú y actualiza el mensaje en pantalla.
 * @param {string} opcion - La opción seleccionada en el menú.
 */
const accionMenu = (opcion) => {
  informacion.value = `Seleccionaste: ${opcion}`;
};

/**
 * Alterna entre los tipos "Mora" y "Café", actualizando el estado en Pinia y mostrando el cambio en pantalla.
 */
const cambiarTipo = async () => {
  toggleStore.toggle(); // Cambia el estado en la store
  await nextTick(); // Espera a que Vue actualice el DOM
  informacion.value = `Vista de ${tipoSeleccionado.value}`;
};

/**
 * Muestra información en pantalla cuando un icono de la barra lateral es presionado.
 * @param {string} info - Información a mostrar en pantalla.
 */
const mostrarInformacion = (info) => {
  informacion.value = info;
};
</script>
