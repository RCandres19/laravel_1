// Importamos el store de autenticación desde Pinia
import { useAuthStore } from "../store/AuthStore";

/**
 * Función para inicializar la autenticación y manejar la renovación automática del token de acceso.
 * 
 * - Intenta refrescar el token cuando se carga la aplicación.
 * - Si falla, reintenta hasta un máximo de 5 veces con un intervalo de 5 segundos.
 */
export default function initializeAuth() {
  const authStore = useAuthStore(); // Instanciamos el store de autenticación

  let attempts = 0; // Contador de intentos
  const maxAttempts = 5; // Máximo de intentos permitidos
  const retryInterval = 5000; // Tiempo de espera entre intentos (5 segundos)

  /**
   * Intenta renovar el token de acceso llamando a `refreshToken()` en `AuthStore`.
   * Si falla, reintenta después de un intervalo de tiempo hasta alcanzar el máximo de intentos.
   */
  async function attemptRefreshToken() {
    if (attempts >= maxAttempts) {
      console.error("❌ Se alcanzó el máximo de intentos para refrescar el token.");
      return;
    }

    attempts++; // Incrementamos el contador de intentos

    try {
      const newToken = await authStore.refreshToken(); // Intenta renovar el token
      console.log("✅ Token actualizado con éxito:", newToken);
    } catch (error) {
      console.error(`❌ Error al refrescar el token (Intento ${attempts}/${maxAttempts}):`, error);
      setTimeout(attemptRefreshToken, retryInterval); // Reintento después del intervalo definido
    }
  }

  // Ejecutar el intento de renovación del token al cargar la aplicación
  attemptRefreshToken();
}
