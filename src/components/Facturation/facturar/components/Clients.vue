<template>
  <div
    class="modal fade"
    id="clientModal"
    ref="clientModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
  >
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">
            <i class="fas fa-user-tie me-2"></i>Buscar Cliente
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
            <div class="col col-lg-5 mb-1">
              <div class="form-floating">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Buscar"
                  v-model="searchBox"
                  @input="searchClient()"
                />
                <label>Buscar</label>
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
                  <option value="nombre">Nombre</option>
                  <option value="identificacion">Identificacion</option>
                  <option value="telefono">Telefono</option>
                </select>
                <label for="floatingSelect">Filtrar Por:</label>
              </div>
            </div>
          </div>
          <div class="my-4"></div>
          <div class="table-responsive">
            <table class="table table-hover table-bordered mt-5 mb-4">
              <thead class="table-dark">
                <tr>
                  <td>Nombre</td>
                  <td>Identificacion</td>
                  <td>Telefono</td>
                  <td></td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="client in clients" :key="client.identificacion">
                  <td>{{ client.nombre }}</td>
                  <td>{{ client.identificacion }}</td>
                  <td>{{ client.telefono }}</td>
                  <td>
                    <span
                      class="me-2 cursor-pointer"
                      @click="selectClient(client)"
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
import { baseUrl } from "@/model/main";
export default {
  setup(props, { emit }) {
    const clients = ref([]);
    const selectedClient = ref({});
    const filterSelected = ref("nombre");
    const searchBox = ref("");

    const selectClient = (client) => {
      emit("selected", client);
    };

    const fetchClients = () => {
      const queryUrl = `${baseUrl}crud/clients/fetchClients.php`;
      axios
        .get(queryUrl)
        .then((res) => {
          if (res.data) {
            clients.value = [];
            res.data.forEach((element) => {
              clients.value.push(element);
            });
          }
        })
        .catch((e) => console.log(e));
    };

    const searchClient = () => {
      const queryUrl = `${baseUrl}crud/clients/searchClients.php?${filterSelected.value}=${searchBox.value}`;
      axios.get(queryUrl).then((res) => {
        clients.value = res.data;
      });
    };

    onMounted(() => {
      fetchClients();
    });
    return {
      selectedClient,
      searchBox,
      filterSelected,
      clients,
      fetchClients,
      selectClient,
      searchClient,
    };
  },
};
</script>
<style scoped>
</style>