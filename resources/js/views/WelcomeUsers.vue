<!--<script setup>
import { defineProps } from 'vue';

const props = defineProps(['name']);
</script>

<template>
  <div class="container">
    <h1>Bienvenido, {{ props.name }}!</h1>
    <p>"El éxito no es definitivo, el fracaso no es fatal: lo que cuenta es el coraje de seguir adelante."</p>
    <p>"Cada día es una nueva oportunidad para cambiar tu vida."</p>
    <p>"No cuentes los días, haz que los días cuenten."</p>
    <p>"El único límite a tu éxito es tu propia mentalidad."</p>
  </div>
</template>

<style scoped>
.container {
  background-color: #f8f9fa;
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  padding: 20px;
}
</style>  -->

<!--<template>
  <div class="welcome-container">
    <h1>Bienvenido, {{ user.name }}!</h1>
    <p>El éxito es la suma de pequeños esfuerzos repetidos día tras día.</p>
    <p>No importa cuán lento vayas, siempre y cuando no te detengas.</p>
    <p>Los sueños no funcionan a menos que tú trabajes por ellos.</p>
    <p>La disciplina es el puente entre metas y logros.</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {}
    };
  },
  created() {
    // Obtener usuario desde localStorage
    this.user = JSON.parse(localStorage.getItem('user')) || { name: '{id}' };
  }
};
</script>-->

<!--<template>
   Contenedor principal con una clase para aplicar estilos 
  <div class="welcome-container">
     Mensaje de bienvenida con el nombre del usuario 
    <h1>Bienvenido, {{ user.name }}!</h1>
     Frases motivacionales 
    <p>El éxito es la suma de pequeños esfuerzos repetidos día tras día.</p>
    <p>No importa cuán lento vayas, siempre y cuando no te detengas.</p>
    <p>Los sueños no funcionan a menos que tú trabajes por ellos.</p>
    <p>La disciplina es el puente entre metas y logros.</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      // Definimos el usuario con un nombre por defecto
      user: { name: "Usuario" } 
    };
  },
  created() {
    // Al crearse el componente, intenta obtener el usuario desde localStorage
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
      // Si hay datos en localStorage, los parseamos y asignamos al usuario
      this.user = JSON.parse(storedUser);
    }
  }
};
</script>

<style scoped>
/* Estilos aplicados solo a este componente */
.welcome-container {
  text-align: center; /* Centra el contenido */
  padding: 50px; /* Espaciado alrededor del contenido */
}
</style>  -->

<!--<template>
  <BackgroundImage :tipo="tipoSeleccionado">
    <NavegaBarra @menu-seleccionado="accionMenu" />
    <SidebarLateral @icono-seleccionado="mostrarInformacion" />
    <ToggleSwitchMc @toggle-cambiado="cambiarTipo" />
    
    <div class="contenido">
      <h1>Bienvenido, Usuario</h1>
      <p>{{ informacion }}</p>
    </div>
  </BackgroundImage>
</template>

<script>
import { defineComponent, ref } from "vue";
import BackgroundImage from "@/components/BackgroundImage.vue";
import NavegaBarra from "@/components/NavegaBarra.vue";
import SidebarLateral from "@/components/SidebarLateral.vue";
import ToggleSwitchMc from "@/components/ToggleSwitchMc.vue";

export default defineComponent({
  components: {
    BackgroundImage,
    NavegaBarra,
    SidebarLateral,
    ToggleSwitchMc,
  },
  setup() {
    const tipoSeleccionado = ref("Mora");
    const informacion = ref("Seleccione una opción");

    const cambiarTipo = (nuevoTipo) => {
      tipoSeleccionado.value = nuevoTipo;
      informacion.value = `Vista de ${nuevoTipo}`;
    };

    const mostrarInformacion = (info) => {
      informacion.value = info;
    };

    return { tipoSeleccionado, informacion, cambiarTipo, mostrarInformacion };
  },
});
</script>

<style scoped>
.contenido {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: rgba(255, 255, 255, 0.8);
  padding: 20px;
  border-radius: 10px;
  text-align: center;
}
</style>  -->

<template>
  <!-- Contenedor principal que usa una imagen de fondo dinámica según el tipo seleccionado -->
  <BackgroundImage :tipo="tipoSeleccionado">
    <!-- Barra de navegación superior con menú desplegable -->
    <MenuPages @menu-seleccionado="accionMenu" />
    
    <!-- Barra lateral con iconos de navegación -->
    <SidebarLateral @icon-clicked="mostrarInformacion" />
    
    <!-- Toggle para cambiar entre "Mora" y "Café" -->
    <ToggleSwitchMc @toggle-cambiado="cambiarTipo" />

    <!-- Cuadro central con mensaje de bienvenida y la información seleccionada -->
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white bg-opacity-80 p-6 rounded-lg shadow-lg text-center">
      <h1 class="text-2xl font-bold">Bienvenido, {{ nombre }}</h1>
      <p class="text-gray-700 mt-2">{{ informacion }}</p>
      <div class="contenido">
        <router-view/>
      </div>
    </div>
  </BackgroundImage>
</template>

<script setup>
/**
 * Importamos las herramientas y componentes necesarios:
 * - `ref` para manejar estados reactivos.
 * - `useToggleStore` de Pinia para gestionar el estado global.
 * - `storeToRefs` para acceder a propiedades reactivas del store.
 */
import { ref } from "vue";
import { useToggleStore } from "@/store/toggleStore";
import { storeToRefs } from "pinia";
import BackgroundImage from "@/components/BackgroundImage.vue";
import MenuPages from "@/components/MenuPages.vue";
import SidebarLateral from "@/components/SidebarLateral.vue";
import ToggleSwitchMc from "@/components/ToggleSwitchMc.vue";

/**
 * Obtenemos el estado global de Pinia para manejar el tipo de vista (Mora/Café) y el nombre del usuario.
 */
const toggleStore = useToggleStore();
const { nombre, tipoSeleccionado } = storeToRefs(toggleStore);

/**
 * Variable reactiva para mostrar información dinámica según la selección del usuario.
 */
const informacion = ref("Seleccione una opción");

/**
 * Maneja la selección en el menú de navegación.
 * @param {string} opcion - Opción seleccionada en el menú.
 */
const accionMenu = (opcion) => {
  console.log("Menú seleccionado:", opcion);
  informacion.value = `Seleccionaste: ${opcion}`;
};

/**
 * Cambia entre Mora y Café al activar el interruptor (toggle).
 * También actualiza el mensaje mostrado en pantalla.
 */
const cambiarTipo = () => {
  toggleStore.toggle(); // Alterna entre Mora y Café
  informacion.value = `Vista de ${tipoSeleccionado.value}`;
};

/**
 * Maneja los clics en los iconos de la barra lateral y actualiza el mensaje mostrado.
 * @param {string} info - Información del icono seleccionado.
 */
const mostrarInformacion = (info) => {
  console.log("Icono seleccionado:", info);
  informacion.value = info;
};
</script>
