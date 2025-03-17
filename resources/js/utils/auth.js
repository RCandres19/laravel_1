export const isAuthenticated = () => {
    const token = localStorage.getItem("token");
    return !!token; // Devuelve true si hay un token válido
  };
  