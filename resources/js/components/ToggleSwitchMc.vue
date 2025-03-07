<template>
    <div class="toggle-container">
      <label class="switch">
        <input type="checkbox" v-model="activo" @change="cambiarEstado" />
        <span class="slider"></span>
      </label>
      <span class="toggle-label">{{ activo ? 'Café' : 'Mora' }}</span>
    </div>
  </template>
  
  <script>
  import { defineComponent, ref } from "vue";
  
  export default defineComponent({
    setup(_, { emit }) {
      const activo = ref(false);
      
      const cambiarEstado = () => {
        emit("toggle-cambiado", activo.value ? "Café" : "Mora");
      };
      
      return { activo, cambiarEstado };
    },
  });
  </script>
  
  <style scoped>
  .toggle-container {
    display: flex;
    align-items:center;
    gap: 10px;
  }
  
  .switch {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 20px;
  }
  
  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }
  
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 20px;
  }
  
  .slider:before {
    position: absolute;
    content: "";
    height: 14px;
    width: 15px;
    left: 3px;
    bottom: 3px;
    background-color: rgb(255, 255, 255);
    transition: .4s;
    border-radius: 50%;
  }
  
  input:checked + .slider {
    background-color: #4CAF50;
  }
  
  input:checked + .slider:before {
    transform: translateX(20px);
  }
  </style>
  