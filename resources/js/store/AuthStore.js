import { defineStore } from "pinia";
import AuthService from "../services/AuthService"; //  Importamos la versión corregida

export const useAuthStore = defineStore("auth", {
  state: () => ({
    accessToken: sessionStorage.getItem("accessToken") || null,
    refreshToken: sessionStorage.getItem("refreshToken") || null,
  }),

  actions: {
    setTokens(accessToken, refreshToken) {
      this.accessToken = accessToken;
      this.refreshToken = refreshToken;

      sessionStorage.setItem("accessToken", accessToken);
      sessionStorage.setItem("refreshToken", refreshToken);
    },

    clearTokens() {
      this.accessToken = null;
      this.refreshToken = null;
      sessionStorage.removeItem("accessToken");
      sessionStorage.removeItem("refreshToken");
    },

    async login(credentials) {
      try {
        const { access_token, refresh_token } = await AuthService.login(credentials);
        this.setTokens(access_token, refresh_token);
        return true;
      } catch (error) {
        throw error;
      }
    },

    async refreshToken() {
      try {
        if (!this.refreshToken) throw new Error("No hay refresh token disponible.");
        const newAccessToken = await AuthService.refreshToken(this.refreshToken);
        this.setTokens(newAccessToken, this.refreshToken);
        return newAccessToken;
      } catch (error) {
        this.clearTokens();
        throw error;
      }
    },

    async logout() {
      try {
        if (!this.refreshToken) return;
        await AuthService.logout(this.refreshToken);
        this.clearTokens();
      } catch (error) {
        console.error("Error al cerrar sesión:", error);
      }
    },
  },
});
