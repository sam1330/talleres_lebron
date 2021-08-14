<template>
  <div class="container-lg">
    <h2 class="text-muted my-4">
      <i class="fas fa-user-tie me-2"></i>Clientes
    </h2>
    <div class="gap mt-3"></div>
    <div class="row">
      <div class="col col-lg-6 mb-1">
        <div class="form-floating">
          <input
            type="text"
            class="form-control"
            id="buscar"
            placeholder="Buscar"
            name="search"
            @input="searchClient()"
            v-model="searchBox"
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
            <option value="nombre" selected>Nombre</option>
            <option value="identificacion">Identificacion</option>
            <option value="telefono">Telefono</option>
            <option value="email">Email</option>
          </select>
          <label for="floatingSelect">Filtrar Por:</label>
        </div>
      </div>
    </div>
    <div class="toggle-crear my-3">
      <button class="btn btn-primary" @click="toggleCreate">
        <i class="fas fa-plus me-2"></i>Añadir Cliente
      </button>
    </div>
    <div class="gap mt-3"></div>
    <form
      class="border p-2 rounded shadow-sm"
      action=""
      @submit.prevent="createClient()"
      v-if="showCreate"
      id="create"
    >
      <h2>Crear Cliente</h2>
      <div class="row">
        <div class="col col-lg-3">
          <div class="form-floating">
            <input
              type="text"
              name="nombre"
              class="form-control"
              id="name"
              v-model="createForm.nombre"
              placeholder="Nombre"
              required
            />
            <label for="name">Nombre</label>
          </div>
        </div>
        <div class="col col-lg-3">
          <div class="form-floating">
            <input
              type="text"
              name="identificacion"
              class="form-control"
              id="identificacion"
              v-model="createForm.identificacion"
              placeholder="Identificacion"
              required
            />
            <label for="identificacion">Identificacion</label>
          </div>
        </div>
        <div class="col col-lg-3">
          <div class="form-floating">
            <input
              type="text"
              name="telefono"
              class="form-control"
              id="telefono"
              v-model="createForm.telefono"
              placeholder="Telefono"
              required
            />
            <label for="telefono">Telefono</label>
          </div>
        </div>
        <div class="col col-lg-3">
          <div class="form-floating">
            <input
              type="text"
              name="email"
              class="form-control"
              id="email"
              v-model="createForm.email"
              placeholder="Email"
            />
            <label for="email">Email</label>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col col-lg-4">
          <div class="form-floating">
            <input
              type="direccion"
              name="direccion"
              class="form-control"
              id="direccion"
              v-model="createForm.direccion"
              placeholder="Direccion"
            />
            <label for="direccion">Direccion</label>
          </div>
        </div>
        <div class="col col-lg-4">
          <div class="form-floating">
            <select
              name="tipo"
              class="form-select"
              id="floatingSelect"
              v-model="createForm.tipo"
              aria-label="Floating label select example"
            >
              <option value="Persona" selected>Persona</option>
              <option value="Empresa">Empresa</option>
            </select>
            <label for="floatingSelect">Tipo</label>
          </div>
        </div>
        <div class="col col-lg-4 align-self-center">
          <input type="hidden" name="fecha_creacion" :value="formatDate" />
          <button type="submit" value="Crear" class="btn btn-primary pe-4 px-4 pt-2 pb-2">
            <i class="fas fa-save me-2 fs-5"></i>
            Crear
          </button>
        </div>
      </div>
    </form>

    <div
      id="t-header"
      class="row border-bottom overflow-auto shadow-sm mt-5 mb-4 rounded p-1"
    >
      <div class="col col-lg-2">
        <h6>Nombre</h6>
      </div>
      <div class="col col-lg-2">
        <h6>Identificacion</h6>
      </div>
      <div class="col col-lg-2">
        <h6>telefono</h6>
      </div>
      <div class="col col-lg-3">
        <h6>Email</h6>
      </div>
      <div class="col col-lg-1">
        <h6>Tipo</h6>
      </div>
      <div class="col col-lg-1">
        <h6>Fecha Creacion</h6>
      </div>
    </div>
    <div class="gap"></div>
    <div
      class="row t-clients border-bottom shadow-sm my-3 rounded"
      v-for="client in clients"
      :key="client.id"
    >
      <div class="col col-lg-2 align-self-center">
        {{ client.nombre }}
      </div>
      <div class="col col-lg-2 align-self-center">
        {{ client.identificacion }}
      </div>
      <div class="col col-lg-2 align-self-center">
        {{ client.telefono }}
      </div>
      <div class="col col-lg-3 overflow-auto align-self-center">
        {{ client.email }}
      </div>
      <div class="col col-lg-1 align-self-center">
        {{ client.tipo }}
      </div>
      <div class="col col-lg-1 align-self-center">
        {{ client.fecha_creacion }}
      </div>
      <div class="col col-lg-1 pb-1 align-self-center">
        <span class="me-2"
          ><i
            class="far fa-edit fs-3 text-info"
            data-bs-toggle="modal"
            data-bs-target="#editModal"
            @click="selectClientToEdit(client.id)"
          ></i></span
        ><span
          ><i
            class="far fa-trash-alt fs-3 text-danger"
            @click="deleteClient(client.id)"
          ></i
        ></span>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="editModal"
      tabindex="-1"
      aria-labelledby="editModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Editar Cliente</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="updateClient()" id="editForm">
              <div class="row">
                <div class="col col-lg-6">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="nombre"
                      class="form-control"
                      id="name"
                      :value="clientToEdit.nombre"
                      placeholder="Nombre"
                      required
                    />
                    <label for="name">Nombre</label>
                  </div>
                </div>
                <div class="col col-lg-6">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="identificacion"
                      class="form-control"
                      id="identificacion"
                      :value="clientToEdit.identificacion"
                      placeholder="Identificacion"
                      required
                    />
                    <label for="identificacion">Identificacion</label>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col col-lg-6">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="telefono"
                      class="form-control"
                      id="telefono"
                      :value="clientToEdit.telefono"
                      placeholder="Telefono"
                      required
                    />
                    <label for="telefono">Telefono</label>
                  </div>
                </div>
                <div class="col col-lg-6">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="email"
                      class="form-control"
                      id="email"
                      :value="clientToEdit.email"
                      placeholder="Email"
                    />
                    <label for="email">Email</label>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col col-lg-6">
                  <div class="form-floating">
                    <input
                      type="direccion"
                      name="direccion"
                      class="form-control"
                      id="direccion"
                      :value="clientToEdit.direccion"
                      placeholder="Direccion"
                    />
                    <label for="direccion">Direccion</label>
                  </div>
                </div>
                <div class="col col-lg-6">
                  <div class="form-floating">
                    <select
                      name="tipo"
                      class="form-select"
                      id="floatingSelect"
                      :value="clientToEdit.tipo"
                      aria-label="Floating label select example"
                      required
                    >
                      <option value="Persona" selected>Persona</option>
                      <option value="Empresa">Empresa</option>
                    </select>
                    <label for="floatingSelect">Tipo</label>
                  </div>
                </div>
              </div>
              <input type="hidden" :value="clientToEdit.id" name="id" />
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
              @click="updateClient()"
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
import { onMounted, ref, computed } from "vue";
import Swal from "sweetalert2";
import axios from "axios";
import { baseUrl } from "../../model/main";
export default {
  name: "clients",
  components: {},
  setup() {
    const allowChangePassword = ref(false);
    const showCreate = ref(false);
    const clients = ref([]);
    const clientToEdit = ref({});
    const filterSelected = ref("nombre");
    const createForm = ref({
      nombre: "",
      identificacion: "",
      telefono: "",
      email: "",
      direccion: "",
      tipo: "Persona",
    });
    const searchBox = ref("");
    //METHODS
    const toggleCreate = () => {
      showCreate.value = !showCreate.value;
    };
    const createClient = () => {
      const queryUrl = `${baseUrl}crud/clients/createClient.php`;
      const frm = document.getElementById("create");
      axios
        .post(queryUrl, new FormData(frm))
        .then((res) => {
          if (res.data == "success") {
            console.log(res.data);
            Swal.fire({
              title: "Hurra!!",
              text: "Cliente creado",
              icon: "success",
            });
            clearCreateForm();
            fetchClients();
          } else {
            Swal.fire({
              title: "Error!!",
              text: "Cliente no creado",
              icon: "error",
            });
          }
        })
        .catch((e) => console.log(e));
    };
    const updateClient = () => {
      const form = document.getElementById("editForm");
      const queryUrl = `${baseUrl}crud/clients/updateClient.php`;
      axios.post(queryUrl, new FormData(form)).then((res) => {
        if (res.data === "success") {
          Swal.fire({
            title: "Hurra!!",
            text: "Cliente Actualizado",
            icon: "success",
          });
          fetchClients();
        } else {
          Swal.fire({
            title: "Ups!!",
            text: "Cliente no pudo ser Actualizado",
            icon: "error",
          });
        }
      });
    };
    const deleteClient = (id) => {
      const queryUrl = `${baseUrl}crud/clients/deleteClient.php?id=${id}`;
      Swal.fire({
        title: "¿Eliminar Cliente?",
        text: "Esta accion no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (!result.isDismissed) {
          axios.get(queryUrl).then((res) => {
            if (res.data === "success") {
              clients.value = [];
              fetchClients();
              Swal.fire({
                title: "Cliente eliminado",
                text: "El cliente ha sido eliminado con exito",
                icon: "success",
              });
            }
          });
        }
      });
    };
    const searchClient = () => {
      const queryUrl = `${baseUrl}crud/clients/searchClients.php?${filterSelected.value}=${searchBox.value}`;
      axios.get(queryUrl).then((res) => {
        clients.value = res.data;
      });
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
    const selectClientToEdit = (id) => {
      clients.value.filter((client) => {
        if (client.id === id) {
          clientToEdit.value.id = client.id;
          clientToEdit.value.nombre = client.nombre;
          clientToEdit.value.identificacion = client.identificacion;
          clientToEdit.value.telefono = client.telefono;
          clientToEdit.value.email = client.email;
          clientToEdit.value.direccion = client.direccion;
          clientToEdit.value.tipo = client.tipo;
          clientToEdit.value.fecha_creacion = client.fecha_creacion;
        }
      });
      console.log(clientToEdit.value);
    };
    const formatDate = computed(() => {
      var todayDate = new Date().toISOString().slice(0, 10);
      return todayDate;
    });
    const clearCreateForm = () => {
      createForm.value.nombre = "";
      createForm.value.identificacion = "";
      createForm.value.telefono = "";
      createForm.value.email = "";
      createForm.value.direccion = "";
      createForm.value.tipo = "Persona";
    };
    onMounted(() => {
      fetchClients();
    });
    return {
      formatDate,
      selectClientToEdit,
      showCreate,
      toggleCreate,
      clients,
      deleteClient,
      updateClient,
      createClient,
      searchClient,
      allowChangePassword,
      clientToEdit,
      searchBox,
      filterSelected,
      createForm,
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
.t-clients {
  background-color: rgba(218, 218, 218, 0.76);
}
h5,
h4 {
  margin-bottom: 0;
}
</style>