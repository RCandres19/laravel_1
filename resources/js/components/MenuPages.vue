<template>
    <!-- Barra de navegación superior con menú hamburguesa -->
    <header
        class="flex justify-end items-center bg-purple-700 bg-opacity-70 py-5 px-2 w-full relative"
    >
        <!-- Botón del menú hamburguesa -->
        <button
            class="text-white text-2xl focus:outline-none"
            @click="toggleMenu"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="w-6 h-6"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 6h16M4 12h16m-7 6h7"
                />
            </svg>
        </button>
        <button @click="navegar('/perfil')">Ir a Perfil</button>
        <!-- Menú desplegable flotante -->
        <div
            v-if="menuAbierto"
            class="absolute right-2 top-16 bg-purple-800 bg-opacity-80 rounded-lg p-3 shadow-lg w-48 z-50"
        >
            <ul class="text-white">
                <li
                    v-for="(ruta, index) in rutasMenu"
                    :key="index"
                    @click="navegar(ruta.path)"
                    class="px-4 py-2 hover:bg-white hover:bg-opacity-20 cursor-pointer transition-colors duration-200"
                >
                    {{ ruta.nombre }}
                </li>
            </ul>
        </div>
    </header>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";

//  INSTANCIAS Y ESTADOS
const router = useRouter(); // Instancia de Vue Router
const menuAbierto = ref(false); // Estado para controlar el menú

//  DEFINICIÓN DE RUTAS
const rutasMenu = [
    { name: "Inicio", path: "/inicio" },
    { name: "Perfil", path: "/perfil" },
    { name: "Configuración", path: "/configuracion" },
    { name: "Salir", path: "/salir" },
];

/**
 *  Alterna la visibilidad del menú hamburguesa
 */
const toggleMenu = () => {
    console.log(import.meta.env.VITE_API_URL);  //para ver si la URL es correcta. Si imprime undefined, Vue no está leyendo bien la variable
    menuAbierto.value = !menuAbierto.value;
};

/**
 *  Navega a la ruta seleccionada y cierra el menú
 * @param {string} ruta - La ruta de navegación
 */
const navegar = (ruta) => {
    console.log("Navegando a:", ruta); // Esto es solo para depuración. Muestra en la consola la ruta a la que se va a navegar cuando se haga clic en una opción del menú
    menuAbierto.value = false; // Esto cierra el menú hamburguesa después de hacer clic en una opción
    router.push(ruta); //Esto usa Vue Router para cambiar la página a la ruta que se pasó como parámetro
};
</script>
