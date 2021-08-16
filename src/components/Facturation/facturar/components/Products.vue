<template>
  <div
    class="modal fade"
    id="productModal"
    ref="productModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
  >
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">
            <i class="fas fa-boxes me-2"></i>Buscar Productos
          </h2>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col col-lg-4 mb-1">
              <div class="form-floating">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Buscar"
                  v-model="searchBox"
                  @input="search()"
                />
                <label>Buscar</label>
              </div>
            </div>
            <div class="col col-lg-4 mb-1">
              <div class="form-floating" v-show="!piece">
                <select
                  class="form-select"
                  id="floatingSelect"
                  aria-label="Floating label select example"
                  name="filter"
                  v-model="filterSelected"
                >
                  <option value="id_ser" selected>ID Servicio</option>
                  <option value="detalle">Detalle</option>
                  <option value="dificultad">Dificultad</option>
                  <option value="precio">Precio</option>
                </select>
                <label for="floatingSelect">Filtrar Por:</label>
              </div>
              <div class="form-floating" v-show="piece">
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
            <div class="col col-lg-3 mb-1">
              <div class="form-floating">
                <select
                  class="form-select"
                  id="floatingSelect"
                  aria-label="Floating label select example"
                  name="filter"
                  v-model="piece"
                >
                  <option :value="true">Repuestos</option>
                  <option :value="false">Servicios</option>
                </select>
                <label for="floatingSelect">Pieza o Servicio</label>
              </div>
            </div>
          </div>
          <div class="my-4"></div>
          <div class="table-responsive">
            <table
              class="table table-hover table-bordered mt-5 mb-4"
              v-show="piece"
            >
              <thead class="table-dark">
                <tr>
                  <td>Codigo</td>
                  <td>Detalle</td>
                  <td>Existencia</td>
                  <td>Precio Venta</td>
                  <td>Categoria</td>
                  <td>Almacen</td>
                  <td></td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="piece in pieces" :key="piece.placa">
                  <td>{{ piece.cod_rep }}</td>
                  <td>{{ piece.detalle }}</td>
                  <td>{{ piece.existencia }}</td>
                  <td>{{ currencyFormatter(piece.precio) }}</td>
                  <td>{{ piece.cat_desc }}</td>
                  <td>{{ piece.alm_desc }}</td>
                  <td>
                    <span
                      v-if="piece.existencia > 0"
                      class="me-2 cursor-pointer"
                      @click="selectPiece(piece)"
                      data-bs-dismiss="modal"
                      ><i class="fas fa-check-square fs-4 btn text-primary"></i
                    ></span>
                  </td>
                </tr>
              </tbody>
            </table>
            <table
              class="table table-hover table-bordered mt-5 mb-4"
              v-show="!piece"
            >
              <thead class="table-dark">
                <tr>
                  <td>ID Servicio</td>
                  <td>Detalle</td>
                  <td>Dificultad</td>
                  <td>Precio</td>
                  <td></td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="service in services" :key="service.id_ser">
                  <td>{{ service.id_ser }}</td>
                  <td>{{ service.detalle }}</td>
                  <td>{{ service.dificultad }}</td>
                  <td>{{ service.precio }}</td>
                  <td>
                    <span
                      class="me-2 cursor-pointer"
                      @click="selectPiece(service)"
                      data-bs-dismiss="modal"
                      ><i class="fas fa-check-square fs-4 btn text-primary"></i
                    ></span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { onMounted, ref } from "vue";
import axios from "axios";
import { baseUrl, currencyFormatter } from "@/model/main";
export default {
  setup(props, { emit }) {
    const pieces = ref([]);
    const selectedPiece = ref({});
    const services = ref([]);
    const piece = ref(true);
    const filterSelected = ref("");
    const searchBox = ref("");

    const fetchServices = () => {
      const queryUrl = `${baseUrl}crud/services/fetchServices.php`;
      axios
        .get(queryUrl)
        .then((res) => {
          if (res.data) {
            services.value = [];
            res.data.forEach((element) => {
              services.value.push(element);
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

    const selectPiece = (piece) => {
      emit("selected", piece);
    };

    const searchPiece = () => {
      const queryUrl = `${baseUrl}crud/pieces/searchPiece.php?${filterSelected.value}=${searchBox.value}`;
      axios.get(queryUrl).then((res) => {
        pieces.value = res.data;
      });
    };

    const searchService = () => {
      const queryUrl = `${baseUrl}crud/services/searchService.php?${filterSelected.value}=${searchBox.value}`;
      axios.get(queryUrl).then((res) => {
        services.value = res.data;
      });
    };

    const search = () => {
      if (piece.value) {
        searchPiece();
      } else {
        searchService();
      }
    };
    onMounted(() => {
      fetchPieces();
      fetchServices();
    });
    return {
      selectedPiece,
      piece,
      searchBox,
      pieces,
      filterSelected,
      services,
      currencyFormatter,
      fetchPieces,
      search,
      fetchServices,
      selectPiece,
    };
  },
};
</script>
