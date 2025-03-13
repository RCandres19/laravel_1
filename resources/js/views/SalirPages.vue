<template>
    <div class="flex flex-col items-center justify-center h-screen text-center">
        <MenuPages />
        <h1 class="text-2xl font-bold mb-4">Cerrando sesión...</h1>
        <div
            class="w-10 h-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"
        ></div>
    </div>
</template>

<script setup>
import { onMounted, onUnmounted } from "vue";
import { useRouter } from "vue-router";
import MenuPages from "@/components/MenuPages.vue";

const router = useRouter();
let timeoutId; // Variable para almacenar el ID del temporizador

onMounted(() => {
    timeoutId = setTimeout(() => {
        if (router.currentRoute.value.path !== "/") {
            router.push("/");
        }
    }, 2000);
});

onUnmounted(() => {
    clearTimeout(timeoutId); // Limpia el temporizador si el componente se desmonta antes de la redirección
});
</script>
