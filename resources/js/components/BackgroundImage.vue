<template>
  <div
    class="fixed inset-0 bg-cover bg-center bg-no-repeat -z-50"
    :style="{ backgroundImage: `url(${imagenFondo})` }"
  >
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
