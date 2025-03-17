import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
  state: () => ({
    userName: "",
  }),
  actions: {
    setUserName(name) {
      if (name && typeof name === "string") {
        this.userName = name.trim();
      }
    },
  },
});
