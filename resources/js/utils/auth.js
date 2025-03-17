import { useAuthStore } from "@/stores/AuthStore";

export const isAuthenticated = () => {
  const authStore = useAuthStore();
  return !!authStore.token; // Verifica si hay un token en Pinia
};
