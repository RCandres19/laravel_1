import { defineStore } from "pinia";
import axios from "axios";

export const useInformacionStore = defineStore("informacion", {
  state: () => ({
    informaciones: [],
  }),

  actions: {
    async obtenerInformaciones() {
      const res = await axios.get("/api/admin/informacion");
      this.informaciones = res.data;
      return res.data;
    },
    async agregarInformacion(data) {
      await axios.post("/api/admin/informacion", data);
    },
    async eliminarInformacion(id) {
      await axios.delete(`/api/admin/informacion/${id}`);
    },
  },
});
