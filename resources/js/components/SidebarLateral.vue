<template>
  <div class="sidebar">
    <ul>
      <li v-for="(item, index) in iconos" :key="index" @click="irAPagina(item)">
        <font-awesome-icon :icon="item.icon" />
        <span>{{ item.texto }}</span>
      </li>
    </ul>
  </div>
</template>

<script>
import { useRouter } from 'vue-router';

export default {
  setup() {
    const router = useRouter();

    const iconos = [
      { icon: 'seedling', texto: 'Información sobre Cultivos', ruta: 'cultivos' },
      { icon: 'newspaper', texto: 'Últimas Noticias', ruta: 'noticias' },
      { icon: 'sun', texto: 'Condiciones Climáticas', ruta: 'clima' },
      { icon: 'tag', texto: 'Precios del Mercado', ruta: 'mercado' },
      { icon: 'house-chimney', texto: 'Información de la Finca', ruta: 'finca' }
    ];

    const irAPagina = (item) => {
      const tipo = localStorage.getItem('tipo') || 'mora'; // Detecta si es mora o café
      router.push(`/${tipo}/${item.ruta}`);
    };

    return { iconos, irAPagina };
  }
};
</script>

<style scoped>
.sidebar {
  width: 250px;
  background-color: #222;
  color: white;
  padding: 20px;
}

ul {
  list-style: none;
  padding: 0;
}

li {
  cursor: pointer;
  padding: 10px;
  display: flex;
  align-items: center;
}

li:hover {
  background-color: #444;
}
</style>
