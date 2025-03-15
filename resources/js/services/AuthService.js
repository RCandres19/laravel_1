import axios from "axios";

const API_URL = import.meta.env.VITE_API_URL; // Se obtiene la URL desde .env

const AuthService = {
  // Configuración de Axios con credenciales habilitadas para manejar cookies
  api: axios.create({
    baseURL: API_URL,
    headers: {
      "Content-Type": "application/json",
    },
    withCredentials: true, // Permite enviar cookies (para el refresh token)
  }),

  // Función para iniciar sesión
  async login(credentials) {
    try {
      const response = await this.api.post("/login", credentials);
      const { access_token } = response.data;
      localStorage.setItem("token", access_token); // Guardamos el token en localStorage
      return response.data;
    } catch (error) {
      console.error("Error en login:", error);
      throw error;
    }
  },

  // Función para cerrar sesión
  async logout() {
    try {
      await this.api.post("/logout");
      localStorage.removeItem("token"); // Eliminamos el token del almacenamiento
    } catch (error) {
      console.error("Error en logout:", error);
      throw error;
    }
  },

  // Función para refrescar el token
  async refreshToken() {
    try {
      const response = await this.api.post("/refresh-token");
      const { access_token } = response.data;
      localStorage.setItem("token", access_token); // Actualizamos el token en localStorage
      return access_token;
    } catch (error) {
      console.error("Error al refrescar el token:", error);
      throw error;
    }
  },
};

const obtenerUsuarios = async () => {
  try {
    const respuesta = await AuthService.api.get("/users") // Usamos el axios configurado de AuthService
    obtenerUsuarios.value = respuesta.data;
    console.log(" Usuarios obtenidos: ", obtenerUsuarios.value);
  } catch (error) {
    console.error(" Error al obtener usuarios: ", error.response?.data || error.message);
  }
};

// **Interceptores para manejar el token automáticamente**
AuthService.api.interceptors.request.use(
  async (config) => {
    let token = localStorage.getItem("token");

    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

// **Interceptores para manejar la expiración del token**
AuthService.api.interceptors.response.use(
  (response) => response, // Si la respuesta es correcta, la retorna sin cambios
  async (error) => {
    const originalRequest = error.config;

    // Si el error es por token expirado y no hemos intentado refrescarlo antes
    if (error.response?.status === 401 && !originalRequest._retry) {
      originalRequest._retry = true; // Evita bucles infinitos de intentos

      try {
        const newToken = await AuthService.refreshToken(); // Intenta refrescar el token
        originalRequest.headers.Authorization = `Bearer ${newToken}`; // Asigna el nuevo token
        return AuthService.api(originalRequest); // Reintenta la petición original
      } catch (refreshError) {
        console.error("No se pudo refrescar el token:", refreshError);
        return Promise.reject(refreshError); // Si falla el refresh, rechaza la petición
      }
    }
    return Promise.reject(error); // Si el error no es por token expirado, lo maneja normal
  }
);

export default AuthService;
