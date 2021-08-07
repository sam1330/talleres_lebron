<template>
  <div class="container-lg">
    <h2 class="text-muted my-4"><i class="fas fa-wrench me-2"></i>Servicios</h2>
    <div class="gap mt-3"></div>
    <div class="row">
      <div class="col col-lg-7 mb-1">
        <div class="form-floating">
          <input
            type="text"
            class="form-control"
            id="buscar"
            placeholder="Buscar"
            v-model="searchBox"
            @input="searchService()"
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
            <option value="id_ser" selected>ID Servicio</option>
            <option value="detalle">Detalle</option>
            <option value="dificultad">Dificultad</option>
            <option value="precio">Precio</option>
          </select>
          <label for="floatingSelect">Filtrar Por:</label>
        </div>
      </div>
    </div>
    <div class="toggle-crear my-3">
      <button class="btn btn-primary" @click="toggleCreate">
        <i class="fas fa-plus me-2"></i>Añadir Servicio
      </button>
    </div>
    <div class="gap mt-3"></div>
    <CreateService :showCreate="showCreate" @created="fetchServices()" />

    <div
      id="t-header"
      class="
        row
        border-bottom
        shadow-sm
        mt-5
        mb-4
        rounded
        p-1
        align-items-center
      "
    >
      <div class="col col-lg-2">
        <h6>ID Servicio</h6>
      </div>
      <div class="col col-lg-3">
        <h6>Detalle</h6>
      </div>
      <div class="col col-lg-3">
        <h6>Dificultad</h6>
      </div>
      <div class="col col-lg-2">
        <h6>Precio</h6>
      </div>
    </div>
    <div class="gap"></div>
    <div
      class="
        row
        t-service
        border-bottom
        shadow-sm
        my-3
        align-items-center
        rounded
      "
      v-for="service in services"
      :key="service.id_ser"
    >
      <div class="col col-lg-2">
        <h6>{{ service.id_ser }}</h6>
      </div>
      <div class="col col-lg-3">
        <h6>{{ service.detalle }}</h6>
      </div>
      <div class="col col-lg-3">
        <h6>{{ service.dificultad }}</h6>
      </div>
      <div class="col col-lg-2">
        <h6>{{ currencyFormatter(service.precio) }}</h6>
      </div>
      <div class="col col-lg-2">
        <span class="me-2"
          ><i
            class="far fa-edit fs-3 text-info"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
            @click="selectServiceToEdit(service.id_ser)"
          ></i></span
        ><span
          ><i
            class="far fa-trash-alt fs-3 text-danger"
            @click="deleteService(service.id_ser)"
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
      <div class="modal-dialog modal-md">
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
            <form @submit.prevent="updateService()" id="editForm">
              <div class="row">
                <div class="col col-lg-12">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="detalle"
                      class="form-control"
                      id="e_detalle"
                      placeholder="Descripcion"
                      v-model="serviceToEdit.detalle"
                    />
                    <label for="detalle">Detalle</label>
                  </div>
                </div>
              </div>
              <div class="row my-3">
                <div class="col col-lg-5">
                  <div class="form-floating">
                    <input
                      type="number"
                      name="precio"
                      class="form-control"
                      id="e_precio"
                      placeholder="Precio"
                      v-model="serviceToEdit.precio"
                    />
                    <label for="precio">Precio</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col col-lg-5">
                  <div class="form-floating">
                    <select
                      class="form-select"
                      v-model="serviceToEdit.dificultad"
                      name="dificultad"
                    >
                      <option value="facil" selected>Facil</option>
                      <option value="medio">Medio</option>
                      <option value="dificil">Dificil</option>
                    </select>
                    <label for="floatingSelect">Dificultad:</label>
                  </div>
                </div>
                <input type="hidden" name="id_ser" v-model="serviceToEdit.id_ser">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button @click="updateService()" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import CreateService from "./components/CreateService.vue";
import { ref, onMounted } from "vue";
import Swal from "sweetalert2";
import axios from "axios";
import { baseUrl, currencyFormatter } from "../../model/main";
export default {
  name: "services",
  components: { CreateService },
  setup() {
    const showCreate = ref(false);
    const filterSelected = ref("id_ser");
    const services = ref([]);
    const searchBox = ref("");
    const serviceToEdit = ref({
      id_ser: null,
      detalle: "",
      precio: 0,
      dificultad: "facil",
    });
    const toggleCreate = () => {
      showCreate.value = !showCreate.value;
    };

    const createService = () => {
      Swal.fire({
        title: "Hurra!!",
        text: "Servicio creado",
        icon: "success",
      });
    };
    const updateService = () => {
      const form = document.getElementById("editForm");
      const queryUrl = `${baseUrl}crud/services/updateService.php`;
      axios.post(queryUrl, new FormData(form)).then((res) => {
        if (res.data === "success") {
          Swal.fire({
            title: "Hurra!!",
            text: "Servicio Actualizado",
            icon: "success",
          });
          fetchServices();
        } else {
          Swal.fire({
            title: "Ups!!",
            text: "Servicio no pudo ser Actualizado",
            icon: "error",
          });
        }
      });
    };
    const deleteService = (id) => {
      Swal.fire({
        title: "¿Eliminar Servicio?",
        text: "Esta accion no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (!result.isDismissed) {
          const queryUrl = `${baseUrl}crud/services/deleteService.php?id_ser=${id}`;
          axios.get(queryUrl).then((res) => {
            if (res.data === "success") {
              Swal.fire({
                title: "Servicio Eliminado",
                icon: "success",
              });
              fetchServices();
            } else {
              Swal.fire({
                title: "No se ha podido eliminar el Servicio",
                icon: "error",
              });
            }
          });
        }
      });
    };
    const searchService = () => {
      const queryUrl = `${baseUrl}crud/services/searchService.php?${filterSelected.value}=${searchBox.value}`;
      axios.get(queryUrl).then((res) => {
        services.value = res.data;
      });
    };

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

    const selectServiceToEdit = (id) => {
      services.value.filter((service) => {
        if (service.id_ser === id) {
          serviceToEdit.value.id_ser = service.id_ser;
          serviceToEdit.value.detalle = service.detalle;
          serviceToEdit.value.precio = service.precio;
          serviceToEdit.value.dificultad = service.dificultad;
        }
      });
    };
    onMounted(() => {
      fetchServices();
    });
    return {
      showCreate,
      filterSelected,
      services,
      searchBox,
      serviceToEdit,
      deleteService,
      toggleCreate,
      selectServiceToEdit,
      fetchServices,
      updateService,
      currencyFormatter,
      createService,
      searchService,
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
.t-services {
  background-color: rgba(218, 218, 218, 0.76);
}
h5,
h4 {
  margin-bottom: 0;
}
</style>
