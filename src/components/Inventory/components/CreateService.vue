<template>
  <form
    class="border p-2 rounded shadow-sm"
    id="create"
    @submit.prevent="createService()"
    v-show="toggleShow"
  >
    <h2>Agregar Servicio</h2>
    <div class="row">
      <div class="col col-lg-4">
        <div class="form-floating">
          <input
            type="text"
            name="detalle"
            class="form-control"
            id="detalle"
            placeholder="Detalle"
            v-model="createForm.detalle"
            required
          />
          <label for="detalle">Detalle</label>
        </div>
      </div>
      <div class="col col-lg-2">
        <div class="form-floating">
          <input
            type="number"
            name="precio"
            class="form-control"
            id="precio"
            placeholder="Precio"
            required
            v-model="createForm.precio"
          />
          <label for="precio">Precio</label>
        </div>
      </div>
      <div class="col col-lg-2">
        <div class="form-floating">
          <select
            class="form-select"
            v-model="createForm.dificultad"
            name="dificultad"
          >
            <option value="facil" selected>Facil</option>
            <option value="medio">Medio</option>
            <option value="dificil">Dificil</option>
          </select>
          <label for="floatingSelect">Dificultad:</label>
        </div>
      </div>
      <div class="col col-lg-2 align-self-center">
        <button type="submit" class="btn btn-primary pe-4 px-4 pt-2 pb-2">
          <i class="fas fa-save me-2 fs-5"></i>Crear
        </button>
      </div>
    </div>
  </form>
</template>
<script>
import { ref, computed } from "vue";
import Swal from "sweetalert2";
import axios from "axios";
import { baseUrl } from "../../../model/main";
export default {
  props: {
    showCreate: {
      type: Boolean,
      default: false,
    },
  },
  setup(props, { emit }) {
    const toggleShow = computed(() => props.showCreate);
    const createForm = ref({
      detalle: "",
      precio: "",
      dificultad: "facil",
    });

    const createService = () => {
      const queryUrl = `${baseUrl}crud/services/createService.php`;
      const frm = document.getElementById("create");
      axios
        .post(queryUrl, new FormData(frm))
        .then((res) => {
          if (res.data == "success") {
            Swal.fire({
              title: "Hurra!!",
              text: "Servicio creado",
              icon: "success",
            });
            clearCreateForm();
            emit("created");
          } else {
            Swal.fire({
              title: "Error!!",
              text: "Servicio no creado",
              icon: "error",
            });
          }
        })
        .catch((e) => console.log(e));
    };
    const clearCreateForm = () => {
      createForm.value.detalle = "";
      createForm.value.precio = 0;
      createForm.value.dificultad = "facil";
    };
    return {
      toggleShow,
      createForm,
      createService,
    };
  },
};
</script>
<style lang="">
</style>