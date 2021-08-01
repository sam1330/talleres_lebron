<template>
  <div class="container">
      <h2 class="text-muted my-4">
     <i class="fas fa-cogs me-2"></i>Repuesto
    </h2>

    <div class="gap mt-3"></div>
    <div class="row">
      <div class="col col-lg-5 mb-1">
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
  <div class="toggle-crear my-3">
    <button class="btn btn-primary" @click="toggleCreate">
      <i class="fas fa-plus me-2"></i>Añadir Repuesto
    </button>
  </div>

  <CreatePiece :showCreate="showCreate" />

  <div class="gap mt-3"></div>

  <div id="t-header" class="row border-bottom shadow-sm mt-5 mb-4 rounded p-1">
    <div class="col col-lg-1">
      <h4>Codigo</h4>
    </div>
    <div class="col col-lg-2">
      <h4>descripcion</h4>
    </div>
    <div class="col col-lg-2">
      <h4>Existencia</h4>
    </div>
    <div class="col col-lg-1">
      <h4>reorden</h4>
    </div>
    <div class="col col-lg-1">
      <h4>codigo</h4>
    </div>
    <div class="col col-lg-2">
      <h4>Proveedor</h4>
    </div>
     <div class="col col-lg-1">
      <h4>Compra</h4>
    </div>
     <div class="col col-lg-1">
      <h4>Venta</h4>
    </div>
    <div class="col col-lg-2">
      <h4></h4>
    </div>
  </div>
  <div class="gap"></div>
  <div
    class="row t-articles border-bottom shadow-sm my-3 rounded"
    v-for="Article in articles"
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
          <h5 class="modal-title" id="exampleModalLabel">Editar Pieza</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col col-lg-3">
              <div class="form-floating">
                <input
                  type="text"
                  name="descripcion"
                  class="form-control"
                  id="descripcion"
                  placeholder="Descripcion"
                />
                <label for="decripcion">Descripcion</label>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="form-floating">
                <input
                  type="text"
                  name="marca"
                  class="form-control"
                  id="marca"
                  placeholder="Marca"
                />
                <label for="marca">Marca</label>
              </div>
            </div>
             <div class="col col-lg-2">
              <div class="form-floating">
                <input
                  type="text"
                  name="categoria"
                  class="form-control"
                  id="categoria"
                  placeholder="Categoria"
                />
                <label for="categoria">Categoria</label>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="form-floating">
                <input
                  type="number"
                  name="pre_com"
                  class="form-control"
                  id="pre_com"
                  placeholder="Precio Compra"
                />
                <label for="pre_com">Precio Compra</label>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="form-floating">
                <input
                  type="number"
                  name="pre_ven"
                  class="form-control"
                  id="pre_ven"
                  placeholder="Precio Venta"
                />
                <label for="pre_ven">Precio Venta</label>
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
                <label for="existence">Existencia</label>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="form-floating">
                <input
                  type="number"
                  name="reorder"
                  class="form-control"
                  id="reorder"
                  placeholder="Reorden"
                />
                <label for="reorder">Reorden</label>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="form-floating">
                <select
                  class="form-select"
                  id="floatingSelect"
                  aria-label="Floating label select example"
                >
                  <option value="motor_de_arranque" selected>
                    Motor de arranque
                  </option>
                  <option value="alternator">alternador</option>
                  <option value="bujia">Bujia</option>
                  <option value="bateria">Bateria</option>
                </select>
                <label for="floatingSelect">Categoria</label>
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
  </div>

</template>
<script>
import { ref } from "vue";
import Swal from "sweetalert2";
import CreatePiece from "./components/CreatePiece.vue";
export default {
  name: "pieces",
  components: { CreatePiece },
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
.t-articles {
  background-color: rgba(218, 218, 218, 0.76);
}
h5,
h4 {
  margin-bottom: 0;
}
</style>
