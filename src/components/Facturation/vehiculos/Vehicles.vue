<template>
  <div class="container-lg">
    <h2 class="text-muted my-4"><i class="fas fa-car me-2"></i>Vehiculos</h2>

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
            @input="searchVehicle()"
          />
          <label for="buscar">Buscar</label>
        </div>
      </div>
      <div class="col col-lg-5 mb-1">
        <div class="form-floating">
          <select class="form-select" name="filter" v-model="filterSelected">
            <option value="placa">Placa</option>
            <option value="nombre">Cliente</option>
            <option value="marca">Marca</option>
            <option value="modelo">Modelo</option>
          </select>
          <label>Filtrar Por:</label>
        </div>
      </div>
    </div>
    <div class="toggle-crear my-3">
      <button class="btn btn-primary" @click="toggleCreate">
        <i class="fas fa-plus me-2"></i>Añadir Vehiculo
      </button>
    </div>

    <form
      class="border p-2 rounded shadow-sm"
      id="create"
      @submit.prevent="createVehicle()"
      v-show="showCreate"
    >
      <h2>Agregar Vehiculo</h2>
      <div class="row">
        <div class="col col-lg-3">
          <div class="form-floating">
            <select
              class="form-select"
              name="id_cli"
              v-model="createForm.id_cli"
            >
              <option
                v-for="client in clients"
                :key="client.id"
                :value="client.id"
              >
                {{ client.nombre }}
              </option>
            </select>
            <label>Cliente</label>
          </div>
        </div>
        <div class="col col-lg-3">
          <div class="form-floating">
            <input
              type="text"
              name="marca"
              class="form-control text-capitalize"
              placeholder="Marca"
              v-model="createForm.marca"
              required
            />
            <label>Marca</label>
          </div>
        </div>
        <div class="col col-lg-3">
          <div class="form-floating">
            <input
              type="text"
              name="modelo"
              class="form-control text-capitalize"
              id="modelo"
              placeholder="Modelo"
              v-model="createForm.modelo"
            />
            <label for="modelo">Modelo</label>
          </div>
        </div>
        <div class="col col-lg-2">
          <div class="form-floating">
            <input
              type="number"
              min="1930"
              max="2099"
              name="anio"
              class="form-control"
              id="Año"
              placeholder="Año"
              v-model="createForm.anio"
            />
            <label for="Año">Año</label>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col col-lg-3">
          <div class="form-floating">
            <input
              type="text"
              name="placa"
              class="form-control text-uppercase"
              placeholder="Placa"
              v-model="createForm.placa"
            />
            <label>Placa</label>
          </div>
        </div>
        <input type="hidden" name="estatus" value="1" />
        <div class="col col-lg-2 align-self-center">
          <button type="submit" class="btn btn-primary pe-4 px-4 pt-2 pb-2">
            <i class="fas fa-save me-2 fs-5"></i>Crear
          </button>
        </div>
      </div>
    </form>

    <!-- END FORM CREAR -->
    <div class="table-responsive">
      <table class="table table-hover table-bordered mt-5 mb-4">
        <thead class="table-dark">
          <tr>
            <td>Cliente</td>
            <td>Marca</td>
            <td>Modelo</td>
            <td>Año</td>
            <td>Placa</td>
            <td>Status</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="vehicle in vehicles" :key="vehicle.placa">
            <td>{{ vehicle.nombre }}</td>
            <td>{{ vehicle.marca }}</td>
            <td>{{ vehicle.modelo }}</td>
            <td>{{ vehicle.anio }}</td>
            <td>{{ vehicle.placa }}</td>
            <td>{{ vehicle.estatus }}</td>
            <td>
              <span class="me-2"
                ><i
                  class="far fa-edit fs-3 text-info"
                  data-bs-toggle="modal"
                  data-bs-target="#exampleModal"
                  @click="selectVehicleToEdit(vehicle.placa)"
                ></i></span
              ><span
                ><i
                  class="far fa-trash-alt fs-3 text-danger"
                  @click="deleteVehicle(vehicle.placa)"
                ></i
              ></span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="gap mt-3"></div>

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
            <form @submit.prevent="updateVehicle()" id="editForm">
              <div class="row">
                <div class="col col-lg-3">
                  <div class="form-floating">
                    <select
                      class="form-select"
                      name="id_cli"
                      v-model="vehiclesToEdit.id_cli"
                    >
                      <option
                        v-for="client in clients"
                        :key="client.id"
                        :value="client.id"
                      >
                        {{ client.nombre }}
                      </option>
                    </select>
                    <label>Cliente</label>
                  </div>
                </div>
                <div class="col col-lg-3">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="marca"
                      class="form-control text-capitalize"
                      placeholder="Marca"
                      v-model="vehiclesToEdit.marca"
                      required
                    />
                    <label>Marca</label>
                  </div>
                </div>
                <div class="col col-lg-3">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="modelo"
                      class="form-control text-capitalize"
                      id="e_modelo"
                      placeholder="Modelo"
                      v-model="vehiclesToEdit.modelo"
                    />
                    <label for="modelo">Modelo</label>
                  </div>
                </div>
                <div class="col col-lg-2">
                  <div class="form-floating">
                    <input
                      type="number"
                      min="1930"
                      max="2099"
                      name="anio"
                      class="form-control"
                      id="e_año"
                      placeholder="Año"
                      v-model="vehiclesToEdit.anio"
                    />
                    <label for="Año">Año</label>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col col-lg-3">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="placa"
                      class="form-control text-uppercase"
                      placeholder="Placa"
                      v-model="vehiclesToEdit.placa"
                    />
                    <label>Placa</label>
                  </div>
                </div>
                <input
                  type="hidden"
                  name="prev_placa"
                  :value="vehiclesToEdit.prev_placa"
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
              @click="updateVehicle()"
              class="btn btn-primary"
            >
              <i class="fas fa-save me-2"></i>Guardar
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
import { baseUrl, currencyFormatter } from "../../../model/main";
export default {
  name: "vehicles",
  setup() {
    const showCreate = ref(false);
    const vehicles = ref([]);
    const filterSelected = ref("placa");
    const searchBox = ref("");
    const clients = ref([]);
    const vehiclesToEdit = ref({});
    const aditionalData = ref({});
    const createForm = ref({
      id_cli: 7,
      marca: "",
      modelo: "",
      anio: new Date().getFullYear(),
      placa: "",
      estatus: null,
    });

    const toggleCreate = () => {
      showCreate.value = !showCreate.value;
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

    const vehicleAditionalData = (cod_rep) => {
      vehicles.value.filter((vehicle) => {
        if (vehicle.cod_rep === cod_rep) {
          aditionalData.value = vehicle;
        }
      });
    };

    const createVehicle = () => {
      const queryUrl = `${baseUrl}crud/vehicles/createVehicle.php`;
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
            fetchVehicles();
          }
        })
        .catch((e) => console.log(e));
    };

    const updateVehicle = () => {
      const form = document.getElementById("editForm");
      const queryUrl = `${baseUrl}crud/vehicles/updateVehicle.php`;
      axios.post(queryUrl, new FormData(form)).then((res) => {
        if (res.data === "success") {
          Swal.fire({
            title: "Hurra!!",
            text: "Vehiculo Actualizado",
            icon: "success",
          });
          fetchVehicles();
        } else {
          Swal.fire({
            title: "Ups!!",
            text: "Vehiculo no pudo ser Actualizado",
            icon: "error",
          });
        }
      });
    };

    const fetchVehicles = () => {
      const queryUrl = `${baseUrl}crud/vehicles/fetchVehicles.php`;
      axios
        .get(queryUrl)
        .then((res) => {
          if (res.data) {
            vehicles.value = [];
            res.data.forEach((element) => {
              vehicles.value.push(element);
            });
          }
          console.log(vehicles.value);
        })
        .catch((e) => console.log(e));
    };

    const deleteVehicle = (cod_rep) => {
      const queryUrl = `${baseUrl}crud/vehicles/deleteVehicle.php?cod_rep=${cod_rep}`;
      Swal.fire({
        title: "¿Eliminar Vehiculo?",
        text: "Esta accion no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (!result.isDismissed) {
          axios.get(queryUrl).then((res) => {
            if (res.data === "success") {
              fetchVehicles();
              Swal.fire({
                title: "Vehiculo eliminado",
                text: "El Vehiculo ha sido eliminado con exito",
                icon: "success",
              });
            }
          });
        }
      });
    };
    const selectVehicleToEdit = (placa) => {
      vehicles.value.filter((vehicle) => {
        if (vehicle.placa === placa) {
          vehiclesToEdit.value.placa = vehicle.placa;
          vehiclesToEdit.value.prev_placa = vehicle.placa;
          vehiclesToEdit.value.id_cli = vehicle.id_cli;
          vehiclesToEdit.value.marca = vehicle.marca;
          vehiclesToEdit.value.modelo = vehicle.modelo;
          vehiclesToEdit.value.anio = vehicle.anio;
          vehiclesToEdit.value.nombre = vehicle.nombre;
        }
      });
    };

    const clearCreateForm = () => {
      createForm.value.placa = "";
      createForm.value.id_cli = 7;
      createForm.value.marca = "";
      createForm.value.modelo = null;
      createForm.value.anio = new Date().getFullYear();
      createForm.value.estatus = null;
    };

    const searchVehicle = () => {
      const queryUrl = `${baseUrl}crud/vehicles/searchVehicle.php?${filterSelected.value}=${searchBox.value}`;
      axios.get(queryUrl).then((res) => {
        vehicles.value = res.data;
      });
    };

    onMounted(() => {
      fetchVehicles();
      fetchClients();
    });
    return {
      showCreate,
      vehicles,
      aditionalData,
      createForm,
      vehiclesToEdit,
      filterSelected,
      clients,
      searchBox,
      toggleCreate,
      fetchClients,
      createVehicle,
      vehicleAditionalData,
      selectVehicleToEdit,
      deleteVehicle,
      updateVehicle,
      searchVehicle,
      currencyFormatter,
      fetchVehicles,
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
.t-vehicles {
  background-color: rgba(218, 218, 218, 0.76);
}
h5,
h4 {
  margin-bottom: 0;
}
</style>
