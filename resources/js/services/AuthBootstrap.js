import AuthService from "./AuthService";

// Asignar AuthService a la ventana global
window.AuthService = AuthService;
console.log("AuthService cargado:", window.AuthService);

let attempts = 0;
const maxAttempts = 5; // Máximo número de intentos
const retryInterval = 5000; // 5 segundos entre intentos

function attemptRefreshToken() {
    if (attempts >= maxAttempts) {
        console.error(" Se alcanzó el máximo de intentos para refrescar el token.");
        return;
    }

    attempts++;
    console.log(`🔄 Intento ${attempts} de ${maxAttempts} para refrescar el token...`);

    window.AuthService.refreshToken()
        .then((newToken) => {
            console.log(" Token recibido:", newToken);
        })
        .catch((error) => {
            console.error(" Error al refrescar el token:", error);
            setTimeout(attemptRefreshToken, retryInterval); // Reintentar después del intervalo
        });
}

// Intentar refrescar el token al cargar la aplicación
attemptRefreshToken();
