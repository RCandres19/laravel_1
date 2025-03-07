<template>
    <header class="navbar">
      <div class="logo"></div>
      <button class="menu-btn" @click="toggleMenu">
        <font-awesome-icon :icon="['fas', 'bars']" class="menu-icon" />
      </button>
      <div v-if="menuAbierto" class="menu-popover">
        <ul>
          <li v-for="(opcion, index) in opcionesMenu" :key="index" @click="seleccionarOpcion(opcion)">
            {{ opcion }}
          </li>
        </ul>
      </div>
    </header>
  </template>
  
  <script>
  import { defineComponent, ref } from "vue";
  import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
  
  export default defineComponent({
    components: { FontAwesomeIcon },
    setup(_, { emit }) {
      const menuAbierto = ref(false);
      const opcionesMenu = ["Inicio", "Perfil", "Configuración", "Salir"];
  
      const toggleMenu = () => {
        menuAbierto.value = !menuAbierto.value;
      };
  
      const seleccionarOpcion = (opcion) => {
        emit("menu-seleccionado", opcion);
        menuAbierto.value = false;
      };
  
      return { menuAbierto, opcionesMenu, toggleMenu, seleccionarOpcion };
    },
  });
  </script>
  
  <style scoped>
  .navbar {
    display: flex;
    justify-content:right;
    align-items: center;
    background: rgba(77, 20, 131, 0.7);
    padding: 50px 1px;
    color: rgb(255, 255, 255);
    top: 0;
    width: 100%;
  }
  
  .menu-btn {
    background: none;
    border: none;
    cursor: pointer;
  }
  
  .menu-icon {
    color: rgb(255, 255, 255);
    font-size: 25px;
  }
  
  .menu-popover {
    position:absolute;
    right: 5px;
    top: 100px;
    background: rgba(120, 34, 146, 0.8);
    border-radius: 10px;
    padding: 10px;
  }
  
  .menu-popover ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  .menu-popover li {
    padding: 10px;
    cursor: pointer;
    color: white;
  }
  
  .menu-popover li:hover {
    background: rgba(255, 255, 255, 0.2);
  }
  </style>
  