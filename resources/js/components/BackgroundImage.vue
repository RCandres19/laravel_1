<template>
  <div class="background" :style="{ backgroundImage: `url(${imagenFondo})` }">
    <slot></slot>
  </div>
</template>

<script>
import { computed, defineComponent } from "vue";

export default defineComponent({
  props: {
    tipo: {
      type: String,
      required: true,
      validator: (value) => ["Mora", "Café"].includes(value),
    },
  },
  setup(props) {
    const imagenFondo = computed(() =>
      props.tipo === "Mora"
        ? new URL("@/assets/img/caja.jpg", import.meta.url).href
        : new URL("@/assets/img/formas.jpg", import.meta.url).href
    );

    return { imagenFondo };
  },
});
</script>

<style scoped>
.background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  z-index: -100;
}
</style>
