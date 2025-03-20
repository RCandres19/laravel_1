import { defineStore } from "pinia";
import axios from "axios";

export const useBoletinStore = defineStore("boletines", {
  state: () => ({
    boletines: [],
  }),

  actions: {
    async obtenerBoletines() {
      const res = await axios.get("/api/admin/boletines");
      this.boletines = res.data;
      return res.data;
    },
    async agregarBoletin(data) {
      await axios.post("/api/admin/boletines", data);
    },
    async eliminarBoletin(id) {
      await axios.delete(`/api/admin/boletines/${id}`);
    },
  },
});
