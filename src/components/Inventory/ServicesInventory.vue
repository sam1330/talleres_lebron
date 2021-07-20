<template>
  <div class="container px-0">
    <div class="gap mt-3"></div>
    <div class="row">
      <div class="col col-lg-7 mb-1">
        <div class="form-floating">
          <input
            type="text"
            class="form-control"
            id="buscar"
            placeholder="Buscar"
          />
          <label for="buscar">Buscar</label>
        </div>
      </div>
    </div>
  </div>
  <div class="toggle-crear my-3">
    <button class="btn btn-primary" @click="toggleCreate">
      <i class="fas fa-plus me-2"></i>Añadir Servicio
    </button>
  </div>
  <div class="gap mt-3"></div>
  <CreateService :showCreate="showCreate"/>

  <div id="t-header" class="row border-bottom shadow-sm mt-5 mb-4 rounded p-1">
    <div class="col col-lg-6">
      <h4>Descripcion</h4>
    </div>
    <div class="col col-lg-3">
      <h4>Precio</h4>
    </div>
    <div class="col col-lg-3">
      <h4>Acciones</h4>
    </div>
  </div>
  <div class="gap"></div>
  <div
    class="row t-inventory border-bottom shadow-sm my-3 rounded"
    v-for="Article in inventory"
    :key="Article.name"
  >
    <div class="col col-lg-4 align-self-center">
      <h5>{{ Article.name }}</h5>
    </div>
    <div class="col col-lg-3 align-self-center">
      <h5>{{ Article.Article }}</h5>
    </div>
    <div class="col col-lg-3 align-self-center">
      <h5>{{ Article.role }}</h5>
    </div>
    <div class="col col-lg-2 pb-1">
      <span class="me-5"
        ><i
          class="far fa-edit fs-3 text-info"
          data-bs-toggle="modal"
          data-bs-target="#exampleModal"
        ></i></span
      ><span
        ><i class="far fa-trash-alt fs-3 text-danger" @click="deleteArticle"></i
      ></span>
    </div>
  </div>
  <!-- Modal -->
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Servicio</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col col-lg-6">
              <div class="form-floating">
                <input
                  type="text"
                  name="description"
                  class="form-control"
                  id="description"
                  placeholder="Descripcion"
                />
                <label for="description">Descripcion</label>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="form-floating">
                <input
                  type="number"
                  name="price"
                  class="form-control"
                  id="price"
                  placeholder="Price"
                />
                <label for="price">Precio</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Close
          </button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import CreateService from "./components/CreateService.vue"
import { ref } from "vue";
import Swal from "sweetalert2";
export default {
  name: "inventory",
  components: {CreateService},
  setup() {
    const allowChangePassword = ref(false);
    const showCreate = ref(false);
    const typeSelected = ref("pieza");
    const articles = ref([
      {
        detail: "Motor de arranque",
        brand: "Toyota",
        model: "Corolla 2008-2012",
        quantity: 50,
        sell_price: 4000,
        buy_price: 3000,
      },
      {
        detail: "Alternador",
        brand: "Honda",
        model: "Accord 2013-2018",
        quantity: 40,
        sell_price: 6000,
        buy_price: 4000,
      },
    ]);
    const handWork = ref([
      {
        detail: "Desmontar motor de arranque",
        brand: "Ford",
        vehicle_type: "Carro",
        dificult: "Fuerte",
        price: 2000,
      },
      {
        detail: "Chequear alternador",
        brand: "Generico",
        vehicle_type: "Generico",
        dificult: "Facil",
        price: 500,
      },
    ]);
    const toggleCreate = () => {
      showCreate.value = !showCreate.value;
    };
    const createArticle = () => {
      Swal.fire({
        title: "Hurra!!",
        text: "Inventario creado",
        icon: "success",
      });
    };
    const updateArticle = () => {
      Swal.fire({
        title: "Hurra!!",
        text: "Inventario Actualizado",
        icon: "success",
      });
    };
    const deleteArticle = () => {
      Swal.fire({
        title: "¿Eliminar Inventario?",
        text: "Esta accion no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (!result.isDismissed) {
          alert("Inventario Eliminado");
        }
      });
    };
    const searchArticle = () => {};
    return {
      showCreate,
      toggleCreate,
      articles,
      handWork,
      typeSelected,
      deleteArticle,
      updateArticle,
      createArticle,
      searchArticle,
      allowChangePassword,
    };
  },
};
</script>
<style>
#t-header {
  background-color: rgba(189, 189, 189, 0.842);
}
span > i {
  cursor: pointer;
}
.t-inventory {
  background-color: rgba(218, 218, 218, 0.76);
}
h5,
h4 {
  margin-bottom: 0;
}
</style>
