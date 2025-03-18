import { defineStore } from "pinia";
import api from "../services/AuthService";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    accessToken: null,
    refreshToken: null,
  }),

  actions: {
    setTokens(accessToken, refreshToken) {
      this.accessToken = accessToken;
      this.refreshToken = refreshToken;
    },

    clearTokens() {
      this.accessToken = null;
      this.refreshToken = null;
    },

    async refreshToken() {
      try {
        const response = await api.post("/refresh-token");
        this.setTokens(response.data.accessToken, response.data.refreshToken);
        return response.data.accessToken;
      } catch (error) {
        console.error("❌ Error al refrescar el token:", error);
        this.clearTokens();
        throw error;
      }
    },
  },
});
