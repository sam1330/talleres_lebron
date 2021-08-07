<template>
  <div class="container-lg">
    <h2 class="text-muted my-4">
      <i class="fas fa-boxes me-2"></i>Proveedores
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
            @input="searchProvider()"
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
        <i class="fas fa-plus me-2"></i>Añadir Proveedor
      </button>
    </div>
    <div class="gap mt-3"></div>
    <form
      class="border p-2 rounded shadow-sm"
      @submit.prevent="createProvider"
      v-if="showCreate"
      id="create"
    >
      <h2>Crear Proveedor</h2>
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
              type="tel"
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
        <div class="col col-lg-2">
          <div class="form-floating">
            <select
              name="tipo"
              class="form-select"
              id="floatingSelect"
              v-model="createForm.tipo"
              aria-label="Floating label select example"
            >
              <option value="Formal" selected>Formal</option>
              <option value="Informal">Informal</option>
            </select>
            <label for="floatingSelect">Tipo</label>
          </div>
        </div>
        <div class="col col-lg-3">
          <div class="form-floating">
            <textarea
              type=""
              name="descripcion"
              class="form-control"
              id="descripcion"
              v-model="createForm.descripcion"
              placeholder="Descripcion"
              style="max-height: 100px; min-height: 58px"
            />
            <label for="descripcion">Descripcion</label>
          </div>
        </div>
        <div class="col col-lg-2 align-self-center">
          <input type="hidden" name="fecha" :value="formatDate" />
          <button type="submit" class="btn btn-primary pe-4 px-4 pt-2 pb-2">
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
      <div class="col col-lg-1">
        <h6>Nombre</h6>
      </div>
      <div class="col col-lg-2">
        <h6>Identificacion</h6>
      </div>
      <div class="col col-lg-2">
        <h6>telefono</h6>
      </div>
      <div class="col col-lg-2">
        <h6>Email</h6>
      </div>
      <div class="col col-lg-1">
        <h6>Tipo</h6>
      </div>
      <div class="col col-lg-1">
        <h6>Descripcion</h6>
      </div>
    </div>
    <div class="gap"></div>
    <div
      class="row t-Providers border-bottom shadow-sm my-3 rounded"
      v-for="provider in providers"
      :key="provider.id_prov"
    >
      <div class="col col-lg-1 align-self-center">
        {{ provider.nombre }}
      </div>
      <div class="col col-lg-2 align-self-center">
        {{ provider.identificacion }}
      </div>
      <div class="col col-lg-2 align-self-center">
        {{ provider.telefono }}
      </div>
      <div class="col col-lg-2 overflow-auto align-self-center">
        {{ provider.email }}
      </div>
      <div class="col col-lg-1 align-self-center">
        {{ provider.tipo }}
      </div>
      <div class="col col-lg-2 align-self-center">
        {{ provider.descripcion }}
      </div>
      <div class="col col-lg-2 pb-1 align-self-center">
        <span class="me-2"
          ><i
            class="far fa-edit fs-3 text-info"
            data-bs-toggle="modal"
            data-bs-target="#editModal"
            @click="selectProviderToEdit(provider.id_prov)"
          ></i></span
        ><span
          ><i
            class="far fa-trash-alt fs-3 text-danger"
            @click="deleteProvider(provider.id_prov)"
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
            <h5 class="modal-title" id="editModalLabel">Editar Proveedor</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="updateProvider()" id="editForm">
              <div class="row">
                <div class="col col-lg-6">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="nombre"
                      class="form-control"
                      id="name"
                      :value="providerToEdit.nombre"
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
                      :value="providerToEdit.identificacion"
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
                      :value="providerToEdit.telefono"
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
                      :value="providerToEdit.email"
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
                      :value="providerToEdit.direccion"
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
                      :value="providerToEdit.tipo"
                      aria-label="Floating label select example"
                      required
                    >
                      <option value="Formal" selected>Formal</option>
                      <option value="Informal">Informal</option>
                    </select>
                    <label for="floatingSelect">Tipo</label>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col col-lg-6">
                  <div class="form-floating">
                    <textarea
                      type=""
                      name="descripcion"
                      class="form-control"
                      id="descripcion"
                      :value="providerToEdit.descripcion"
                      placeholder="Descripcion"
                      style="max-height: 100px; min-height: 58px"
                    />
                    <label for="descripcion">Descripcion</label>
                  </div>
                </div>
              </div>
              <input type="hidden" :value="providerToEdit.id_prov" name="id" />
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
              type="submit"
              @click="updateProvider()"
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
  name: "providers",
  components: {},
  setup() {
    const allowChangePassword = ref(false);
    const showCreate = ref(false);
    const providers = ref([]);
    const providerToEdit = ref({});
    const filterSelected = ref("nombre");
    const createForm = ref({
      nombre: "",
      identificacion: "",
      telefono: "",
      email: "",
      direccion: "",
      tipo: "Formal",
    });
    const searchBox = ref("");
    //METHODS
    const toggleCreate = () => {
      showCreate.value = !showCreate.value;
    };

    const createProvider = () => {
      const queryUrl = `${baseUrl}crud/Providers/createProvider.php`;
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
            fetchProviders();
          }
        })
        .catch((e) => console.log(e));
    };

    const updateProvider = () => {
      const form = document.getElementById("editForm");
      const queryUrl = `${baseUrl}crud/Providers/updateProvider.php`;
      axios.post(queryUrl, new FormData(form)).then((res) => {
        if (res.data === "success") {
          Swal.fire({
            title: "Hurra!!",
            text: "Proveedor Actualizado",
            icon: "success",
          });
          fetchProviders();
        } else {
          Swal.fire({
            title: "Ups!!",
            text: "Proveedor no pudo ser Actualizado",
            icon: "error",
          });
        }
      });
    };

    const deleteProvider = (id) => {
      const queryUrl = `${baseUrl}crud/Providers/deleteProvider.php?id=${id}`;
      Swal.fire({
        title: "¿Eliminar Proveedor?",
        text: "Esta accion no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (!result.isDismissed) {
          axios.get(queryUrl).then((res) => {
            if (res.data === "success") {
              providers.value = [];
              fetchProviders();
              Swal.fire({
                title: "Proveedor eliminado",
                text: "El Proveedor ha sido eliminado con exito",
                icon: "success",
              });
            }
          });
        }
      });
    };

    const searchProvider = () => {
      const queryUrl = `${baseUrl}crud/Providers/searchProvider.php?${filterSelected.value}=${searchBox.value}`;
      axios.get(queryUrl).then((res) => {
        providers.value = res.data;
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

    const selectProviderToEdit = (id) => {
      providers.value.filter((provider) => {
        if (provider.id_prov === id) {
          providerToEdit.value = provider;
        }
      });
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
      createForm.value.tipo = "Formal";
    };

    onMounted(() => {
      fetchProviders();
    });
    return {
      formatDate,
      selectProviderToEdit,
      showCreate,
      toggleCreate,
      providers,
      deleteProvider,
      updateProvider,
      createProvider,
      searchProvider,
      allowChangePassword,
      providerToEdit,
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
.t-Providers {
  background-color: rgba(218, 218, 218, 0.76);
}
h5,
h4 {
  margin-bottom: 0;
}
</style>