<template>
  <div class="container">
    <h2 class="text-muted my-4"><i class="fas fa-cogs me-2"></i>Repuesto</h2>

    <div class="gap mt-3"></div>
    <div class="row">
      <div class="col col-lg-5 mb-1">
        <div class="form-floating">
          <input
            type="text"
            class="form-control"
            id="buscar"
            placeholder="Buscar"
            v-model="searchBox"
            @input="searchPiece()"
          />
          <label for="buscar">Buscar</label>
        </div>
      </div>
      <div class="col col-lg-5 mb-1">
        <div class="form-floating">
          <select
            class="form-select"
            id="floatingSelect"
            aria-label="Floating label select example"
            name="filter"
            v-model="filterSelected"
          >
            <option value="cod_rep">Codigo de Repuesto</option>
            <option value="detalle" selected>Detalle</option>
            <option value="proveedor">Nombre de Proveedor</option>
          </select>
          <label for="floatingSelect">Filtrar Por:</label>
        </div>
      </div>
    </div>
    <div class="toggle-crear my-3">
      <button class="btn btn-primary" @click="toggleCreate">
        <i class="fas fa-plus me-2"></i>Añadir Repuesto
      </button>
    </div>

    <CreatePiece :showCreate="showCreate" @created="fetchPieces()" />

    <div class="gap mt-3"></div>

    <div
      id="t-header"
      class="row border-bottom shadow-sm mt-5 mb-4 rounded p-1"
    >
      <div class="col col-lg-1">
        <h6>Codigo</h6>
      </div>
      <div class="col col-lg-2">
        <h6>Detalle</h6>
      </div>
      <div class="col me-2 col-lg-1">
        <h6>Existencia</h6>
      </div>
      <div class="col col-lg-1">
        <h6>Precio Venta</h6>
      </div>
      <div class="col col-lg-2">
        <h6>Categoria</h6>
      </div>
      <div class="col col-lg-2">
        <h6>Almacen</h6>
      </div>
    </div>
    <div class="gap"></div>
    <div
      class="row t-pieces border-bottom shadow-sm my-3 rounded"
      v-for="piece in pieces"
      :key="piece.cod_rep"
    >
      <div class="col col-lg-1 align-self-center">
        <p>{{ piece.cod_rep }}</p>
      </div>
      <div class="col col-lg-2 align-self-center">
        <p>{{ piece.detalle }}</p>
      </div>
      <div class="col me-2 col-lg-1 align-self-center">
        <p>{{ piece.existencia }}</p>
      </div>
      <div class="col col-lg-1 align-self-center">
        <p>{{ currencyFormatter(piece.precio) }}</p>
      </div>
      <div class="col col-lg-2 align-self-center">
        <p>
          {{ piece.cat_desc
          }}<span
            ><i
              class="fas fa-external-link-alt cursor-pointer"
              @click="pieceAditionalData(piece.cod_rep)"
              data-bs-toggle="modal"
              data-bs-target="#adicionalData"
            ></i
          ></span>
        </p>
      </div>
      <div class="col col-lg-2 align-self-center">
        <p>{{ piece.alm_desc }}</p>
      </div>
      <div class="col col-lg-2 pb-1">
        <span class="me-2"
          ><i
            class="far fa-edit fs-3 text-info"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
            @click="selectPieceToEdit(piece.cod_rep)"
          ></i></span
        ><span
          ><i
            class="far fa-trash-alt fs-3 text-danger"
            @click="deletePiece(piece.cod_rep)"
          ></i
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
            <form @submit.prevent="updatePiece()" id="editForm">
              <div class="row">
                <div class="col col-lg-3">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="detalle"
                      class="form-control"
                      id="Detalle"
                      placeholder="Detalle"
                      v-model="piecesToEdit.detalle"
                    />
                    <label for="Detalle">Detalle</label>
                  </div>
                </div>
                <div class="col col-lg-3">
                  <div class="form-floating">
                    <select
                      class="form-select"
                      id="proveedor"
                      name="id_prov"
                      v-model="piecesToEdit.id_prov"
                    >
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
                      v-model="piecesToEdit.prec_com"
                    />
                    <label>Precio Compra</label>
                  </div>
                </div>
                <div class="col col-lg-3">
                  <div class="form-floating">
                    <input
                      type="number"
                      name="precio"
                      class="form-control"
                      placeholder="Precio Venta"
                      v-model="piecesToEdit.precio"
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
                      v-model="piecesToEdit.existencia"
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
                      v-model="piecesToEdit.reorden"
                    />
                    <label for="reorder">Reorden</label>
                  </div>
                </div>
                <div class="col col-lg-3">
                  <div class="form-floating">
                    <select
                      class="form-select"
                      name="id_cat"
                      v-model="piecesToEdit.id_cat"
                    >
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
                    <select
                      class="form-select"
                      name="id_alm"
                      v-model="piecesToEdit.id_alm"
                    >
                      <option value="1">Para ventas</option>
                    </select>
                    <label>Almacen</label>
                  </div>
                </div>
                <input
                  type="hidden"
                  name="cod_rep"
                  v-model="piecesToEdit.cod_rep"
                />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              <i class="fas fa-times-circle me-2"></i>Cerrar
            </button>
            <button
              type="button"
              @click="updatePiece()"
              class="btn btn-primary"
            >
              <i class="fas fa-save me-2"></i>Guardar
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="adicionalData"
      tabindex="-1"
      aria-labelledby="adicionalData"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Data Adicional</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="row mt-3">
              <div class="col col-lg-6">
                <h5>Detalle</h5>
                <span class="text-muted">{{ aditionalData.detalle }}</span>
              </div>
              <div class="col col-lg-6">
                <h5>Existencia</h5>
                <span class="text-muted">{{ aditionalData.existencia }}</span>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col col-lg-6">
                <h5>Reorden</h5>
                <span class="text-muted">{{ aditionalData.reorden }}</span>
              </div>
              <div class="col col-lg-6">
                <h5>Precio de Compra</h5>
                <span class="text-muted">{{ aditionalData.prec_com }}</span>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col col-lg-6">
                <h5>Precio de venta</h5>
                <span class="text-muted">{{ aditionalData.precio }}</span>
              </div>
              <div class="col col-lg-6">
                <h5>Proveedor</h5>
                <span class="text-muted">{{ aditionalData.nombre }}</span>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col col-lg-6">
                <h5>Categoria</h5>
                <span class="text-muted">{{ aditionalData.cat_desc }}</span>
              </div>
              <div class="col col-lg-6">
                <h5>Almacen</h5>
                <span class="text-muted">{{ aditionalData.alm_desc }}</span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              <i class="fas fa-times-circle me-2"></i>Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { onMounted, ref } from "vue";
import Swal from "sweetalert2";
import axios from "axios";
import { baseUrl, currencyFormatter } from "../../model/main";
import CreatePiece from "./components/CreatePiece.vue";
export default {
  name: "pieces",
  components: { CreatePiece },
  setup() {
    const allowChangePassword = ref(false);
    const showCreate = ref(false);
    const typeSelected = ref("pieza");
    const pieces = ref([]);
    const categories = ref([]);
    const filterSelected = ref("cod_rep");
    const searchBox = ref("");
    const piecesToEdit = ref({});
    const providers = ref([]);
    const aditionalData = ref({});

    const toggleCreate = () => {
      showCreate.value = !showCreate.value;
    };

    const pieceAditionalData = (cod_rep) => {
      pieces.value.filter((piece) => {
        if (piece.cod_rep === cod_rep) {
          aditionalData.value = piece;
        }
      });
    };

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

    const updatePiece = () => {
      const form = document.getElementById("editForm");
      const queryUrl = `${baseUrl}crud/pieces/updatePiece.php`;
      axios.post(queryUrl, new FormData(form)).then((res) => {
        if (res.data === "success") {
          Swal.fire({
            title: "Hurra!!",
            text: "Empleado Actualizado",
            icon: "success",
          });
          fetchPieces();
        } else {
          Swal.fire({
            title: "Ups!!",
            text: "Empleado no pudo ser Actualizado",
            icon: "error",
          });
        }
      });
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
          console.log(pieces.value);
        })
        .catch((e) => console.log(e));
    };

    const deletePiece = (cod_rep) => {
      const queryUrl = `${baseUrl}crud/pieces/deletePiece.php?cod_rep=${cod_rep}`;
      Swal.fire({
        title: "¿Eliminar Repuesto?",
        text: "Esta accion no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (!result.isDismissed) {
          axios.get(queryUrl).then((res) => {
            if (res.data === "success") {
              fetchPieces();
              Swal.fire({
                title: "Repuesto eliminado",
                text: "El repuesto ha sido eliminado con exito",
                icon: "success",
              });
            }
          });
        }
      });
    };
    const selectPieceToEdit = (cod_rep) => {
      pieces.value.filter((piece) => {
        if (piece.cod_rep === cod_rep) {
          piecesToEdit.value.cod_rep = piece.cod_rep;
          piecesToEdit.value.alm_desc = piece.alm_desc;
          piecesToEdit.value.cat_desc = piece.cat_desc;
          piecesToEdit.value.detalle = piece.detalle;
          piecesToEdit.value.existencia = piece.existencia;
          piecesToEdit.value.nombre = piece.nombre;
          piecesToEdit.value.prec_com = piece.prec_com;
          piecesToEdit.value.precio = piece.precio;
          piecesToEdit.value.reorden = piece.reorden;
          piecesToEdit.value.id_prov = piece.id_prov;
          piecesToEdit.value.id_alm = piece.id_alm;
          piecesToEdit.value.id_cat = piece.id_cat;
        }
      });
    };

    const searchPiece = () => {
      const queryUrl = `${baseUrl}crud/pieces/searchPiece.php?${filterSelected.value}=${searchBox.value}`;
      axios.get(queryUrl).then((res) => {
        pieces.value = res.data;
      });
    };

    onMounted(() => {
      fetchPieces();
      fetchProviders();
      fetchCategories();
    });
    return {
      showCreate,
      pieces,
      aditionalData,
      allowChangePassword,
      typeSelected,
      piecesToEdit,
      categories,
      filterSelected,
      searchBox,
      providers,
      toggleCreate,
      pieceAditionalData,
      selectPieceToEdit,
      deletePiece,
      updatePiece,
      searchPiece,
      currencyFormatter,
      fetchPieces,
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
.t-pieces {
  background-color: rgba(218, 218, 218, 0.76);
}
h5,
h4 {
  margin-bottom: 0;
}
</style>
