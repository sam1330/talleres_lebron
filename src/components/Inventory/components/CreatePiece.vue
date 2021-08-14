<template>
  <form
    class="border p-2 rounded shadow-sm"
    action=""
    id="create"
    @submit.prevent="createPiece()"
    v-if="toggleShow"
  >
    <h2>Agregar Repuesto</h2>
    <div class="row">
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="text"
            name="detalle"
            class="form-control"
            id="Detalle"
            placeholder="Detalle"
          />
          <label for="Detalle">Detalle</label>
        </div>
      </div>
      <div class="col col-lg-3">
        <div class="form-floating">
          <select class="form-select" id="proveedor" name="id_prov">
            <option
              v-for="provider in providers"
              :key="provider.id_prov"
              :value="provider.id_prov"
            >
              {{ provider.nombre }}
            </option>
          </select>
          <label for="proveedor">Proveedor</label>
        </div>
      </div>
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="number"
            name="prec_com"
            class="form-control"
            placeholder="Precio Compra"
          />
          <label>Precio Compra</label>
        </div>
      </div>
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="number"
            name="prec_ven"
            class="form-control"
            placeholder="Precio Venta"
          />
          <label>Precio Venta</label>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="number"
            name="existencia"
            class="form-control"
            id="existencia"
            placeholder="Existencia"
          />
          <label for="existencia">Existencia</label>
        </div>
      </div>
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="number"
            name="reorden"
            class="form-control"
            id="reorder"
            placeholder="Reorden"
          />
          <label for="reorder">Reorden</label>
        </div>
      </div>
      <div class="col col-lg-3">
        <div class="form-floating">
          <select class="form-select" name="id_cat">
            <option
              v-for="category in categories"
              :key="category.id_cat"
              :value="category.id_cat"
            >
              {{ category.descripcion }}
            </option>
          </select>
          <label>Categoria</label>
        </div>
      </div>
      <div class="col col-lg-3">
        <div class="form-floating">
          <select class="form-select" name="id_alm">
            <option value="1" selected>Para ventas</option>
            <option value="2">Almacenados</option>
          </select>
          <label>Almacen</label>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col col-lg-3 align-self-center">
          <button type="submit" class="btn btn-primary pe-4 px-4 pt-2 pb-2">
            <i class="fas fa-save me-2"></i>Crear
          </button>
        </div>
      </div>
    </div>
  </form>
</template>
<script>
import { onMounted, ref, computed } from "vue";
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
    const providers = ref([]);
    const selectedProvider = ref("");
    const categories = ref([]);
    const pieces = ref([]);
    const createForm = ref({
      detalle: "",
      existencia: 0,
      reorden: 10,
      id_cat: null,
      prec_com: 0,
      prec_ven: 0,
      id_prov: null,
      id_alm: null,
    });

    const fetchCategories = () => {
      const queryUrl = `${baseUrl}crud/categories/fetchCategories.php`;
      axios
        .get(queryUrl)
        .then((res) => {
          if (res.data) {
            categories.value = [];
            res.data.forEach((element) => {
              categories.value.push(element);
            });
          }
        })
        .catch((e) => console.log(e));
    };

    const fetchProviders = () => {
      const queryUrl = `${baseUrl}crud/Providers/fetchProviders.php`;
      axios
        .get(queryUrl)
        .then((res) => {
          if (res.data) {
            providers.value = [];
            res.data.forEach((element) => {
              providers.value.push(element);
            });
          }
        })
        .catch((e) => console.log(e));
    };

    const fetchPieces = () => {
      const queryUrl = `${baseUrl}crud/pieces/fetchPieces.php`;
      axios
        .get(queryUrl)
        .then((res) => {
          if (res.data) {
            pieces.value = [];
            res.data.forEach((element) => {
              pieces.value.push(element);
            });
          }
        })
        .catch((e) => console.log(e));
    };

    const createPiece = () => {
      const queryUrl = `${baseUrl}crud/pieces/createPiece.php`;
      const frm = document.getElementById("create");
      axios
        .post(queryUrl, new FormData(frm))
        .then((res) => {
          if (res.data == "success") {
            Swal.fire({
              title: "Hurra!!",
              text: "Proveedor creado",
              icon: "success",
            });
            clearCreateForm();
            emit("created");
          }
        })
        .catch((e) => console.log(e));
    };
    const clearCreateForm = () => {
      createForm.value.detalle = "";
      createForm.value.existencia = 0;
      createForm.value.reorden = 10;
      createForm.value.id_cat = null;
      createForm.value.prec_com = 0;
      createForm.value.prec_ven = 0;
      createForm.value.id_prov = null;
      createForm.value.id_alm = null;
    };
    onMounted(() => {
      fetchProviders();
      fetchCategories();
    });
    return {
      toggleShow,
      providers,
      selectedProvider,
      categories,
      fetchProviders,
      createPiece,
      fetchCategories,
      fetchPieces,
    };
  },
};
</script>
<style lang="">
</style>