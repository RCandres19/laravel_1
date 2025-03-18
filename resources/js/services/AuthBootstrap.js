import { useAuthStore } from "../store/AuthStore";

export default function initializeAuth() {
  const authStore = useAuthStore();

  let attempts = 0;
  const maxAttempts = 5;
  const retryInterval = 5000; // 5 segundos

  async function attemptRefreshToken() {
    if (attempts >= maxAttempts) {
      console.error("❌ Se alcanzó el máximo de intentos para refrescar el token.");
      return;
    }

    attempts++;

    try {
      const newToken = await authStore.refreshToken();
      console.log("✅ Token actualizado:", newToken);
    } catch (error) {
      console.error("❌ Error al refrescar el token:", error);
      setTimeout(attemptRefreshToken, retryInterval);
    }
  }

  // Intentar refrescar el token al cargar la aplicación
  attemptRefreshToken();
}
