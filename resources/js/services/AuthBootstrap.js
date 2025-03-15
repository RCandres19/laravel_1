import AuthService from "./AuthService";

// Asignar AuthService a la ventana global
window.AuthService = AuthService;
console.log("AuthService cargado:", window.AuthService);

// Intentar refrescar el token al cargar la aplicación
window.AuthService.refreshToken()
    .then((newToken) => {
        console.log("✅ Token recibido:", newToken);
    })
    .catch((error) => {
        console.error("❌ Error al refrescar el token:", error);
    });
