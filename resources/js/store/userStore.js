import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
  state: () => ({
    userName: "",
  }),
  actions: {
    setUserName(name) {
      this.userName = name;
      localStorage.setItem("userName", name); // Guarda en localStorage
    },
    loadUserFromStorage() {
      this.userName = localStorage.getItem("userName") || "";
    },
  },
});
