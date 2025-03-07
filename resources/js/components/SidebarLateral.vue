<template>
  <div class="sidebar">
    <button v-for="(icono, index) in iconos" :key="index" @click="emitirEvento(icono.texto)">
      <font-awesome-icon :icon="icono.icon" class="icon" />
    </button>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faSeedling, faNewspaper, faSun, faTag, faHouseChimney } from "@fortawesome/free-solid-svg-icons";

export default defineComponent({
  components: { FontAwesomeIcon },
  data() {
    return {
      iconos: [
        { icon: faSeedling, texto: "Información sobre Cultivos" },
        { icon: faNewspaper, texto: "Últimas Noticias" },
        { icon: faSun, texto: "Condiciones Climáticas" },
        { icon: faTag, texto: "Precios del Mercado" },
        { icon: faHouseChimney, texto: "Información de la Finca" },
      ],
    };
  },
  methods: {
    emitirEvento(texto) {
      console.log("Icono clickeado:", texto); // Para verificar si el evento se emite
      this.$emit("icon-clicked", texto); // Se alineó con WelcomeUser.vue
    },
  },
});
</script>

<style scoped>
.sidebar {
  position: fixed;
  left: 85%;
  top: 14%;
  transform: translateY(-50%);
  background: rgba(122, 34, 139, 0.7);
  padding: 3px;
  border-radius: 0 10px 10px 0;
  display: flex;
  flex-direction:row;
  gap: 8px;
}

button {
  background: transparent;
  border: none;
  cursor: pointer;
}

.icon {
  color: rgb(255, 255, 255);
  font-size: 24px;
}
</style>
