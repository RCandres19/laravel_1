// Importa el store de autenticación desde Pinia
import { useAuthStore } from "../store/AuthStore";

/**
 * Función que verifica si el usuario está autenticado.
 * 
 * @returns {boolean} - Devuelve `true` si hay un token en el estado de Pinia, lo que indica que el usuario está autenticado.
 */
export const isAuthenticated = () => {
  // Obtiene la instancia del store de autenticación
  const authStore = useAuthStore();
  
  // Verifica si hay un token almacenado en el estado global de Pinia
  return !!authStore.token; // Retorna true si el token existe, de lo contrario, false
};
