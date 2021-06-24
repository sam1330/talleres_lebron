<template>
  <div class="container">
    <div class="gap mt-3"></div>
    <div class="row">
      <div class="col col-lg-6 mb-1">
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
      <div class="col col-lg-5 mb-1">
        <div class="form-floating">
          <select
            class="form-select"
            id="floatingSelect"
            aria-label="Floating label select example"
          >
            <option value="Cliente" selected>Nombre</option>
            <option value="identificacion">Identificacion</option>
            <option value="rol">Telefono</option>
            <option value="nombre">Email</option>
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
      @submit.prevent=""
      v-if="showCreate"
    >
      <h2>Crear Cliente</h2>
      <div class="row">
        <div class="col col-lg-3">
          <div class="form-floating">
            <input
              type="text"
              name="name"
              class="form-control"
              id="name"
              placeholder="Nombre"
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
              placeholder="Identificacion"
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
              placeholder="Telefono"
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
              placeholder="Direccion"
            />
            <label for="direccion">Direccion</label>
          </div>
        </div>
        <div class="col col-lg-4">
          <div class="form-floating">
            <select
              class="form-select"
              id="floatingSelect"
              aria-label="Floating label select example"
            >
              <option value="empleado" selected>Persona</option>
              <option value="administrator">Empresa</option>
            </select>
            <label for="floatingSelect">Tipo</label>
          </div>
        </div>
        <div class="col col-lg-4 align-self-center">
          <button
            class="btn btn-primary pe-4 px-4 pt-2 pb-2"
            @click="createClient"
          >
            Crear
          </button>
        </div>
      </div>
    </form>

    <div
      id="t-header"
      class="row border-bottom shadow-sm mt-5 mb-4 rounded p-1"
    >
      <div class="col col-lg-4">
        <h4>Nombre</h4>
      </div>
      <div class="col col-lg-3">
        <h4>Cliente</h4>
      </div>
      <div class="col col-lg-3">
        <h4>Rol</h4>
      </div>
      <div class="col col-lg-2">
        <h4>Acciones</h4>
      </div>
    </div>
    <div class="gap"></div>
    <div
      class="row t-clients border-bottom shadow-sm my-3 rounded"
      v-for="client in clients"
      :key="client.name"
    >
      <div class="col col-lg-4 align-self-center">
        <h5>{{ client.name }}</h5>
      </div>
      <div class="col col-lg-3 align-self-center">
        <h5>{{ client.client }}</h5>
      </div>
      <div class="col col-lg-3 align-self-center">
        <h5>{{ client.role }}</h5>
      </div>
      <div class="col col-lg-2 pb-1">
        <span class="me-5"
          ><i
            class="far fa-edit fs-3 text-info"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
          ></i></span
        ><span
          ><i class="far fa-trash-alt fs-3 text-danger" @click="deleteClient"></i
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
            <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
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
                    name="name"
                    class="form-control"
                    id="name"
                    placeholder="Nombre"
                  />
                  <label for="buscar">Nombre</label>
                </div>
              </div>
              <div class="col col-lg-6">
                <div class="form-floating">
                  <input
                    type="text"
                    name="client"
                    class="form-control"
                    id="client"
                    placeholder="Cliente"
                  />
                  <label for="buscar">Cliente</label>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col col-lg-5">
                <div class="form-floating">
                  <select
                    class="form-select"
                    id="floatingSelect"
                    aria-label="Floating label select example"
                  >
                    <option value="empleado" selected>Empleado Comun</option>
                    <option value="administrator">Administrador</option>
                  </select>
                  <label for="floatingSelect">Rol</label>
                </div>
              </div>
              <div class="col col-lg-5 align-self-end">
                <div class="form-check form-switch">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    @click="allowChangePassword = !allowChangePassword"
                    v-model="allowChangePassword"
                  />
                  <label class="form-check-label" for="flexSwitchCheckDefault"
                    >Cambiar contraseña</label
                  >
                </div>
              </div>
            </div>
            <div class="row mt-3" v-if="allowChangePassword">
              <div class="col col-lg-5">
                <div class="form-floating">
                  <input
                    type="password"
                    name="password"
                    class="form-control"
                    id="password"
                    placeholder="Contraseña"
                  />
                  <label for="buscar">Contraseña</label>
                </div>
              </div>
              <div class="col col-lg-5">
                <div class="form-floating">
                  <input
                    type="password"
                    class="form-control"
                    id="c_password"
                    placeholder="Confirmar contraseña"
                  />
                  <label for="buscar">Confirmar contraseña</label>
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
export default {
  name: "clients",
  components: {},
  setup() {
    const allowChangePassword = ref(false);
    const showCreate = ref(false);
    const clients = ref([
      {
        name: "Samuel Martinez",
        client: "Sammy1301",
        role: "Administrador",
      },
      {
        name: "Mariana Rodriguez",
        client: "mariRdz30",
        role: "Administrador",
      },
    ]);
    const toggleCreate = () => {
      showCreate.value = !showCreate.value;
    };
    const createClient = () => {
      Swal.fire({
        title: "Hurra!!",
        text: "Cliente creado",
        icon: "success",
      });
    };
    const updateClient = () => {
      Swal.fire({
        title: "Hurra!!",
        text: "Cliente Actualizado",
        icon: "success",
      });
    };
    const deleteClient = () => {
      Swal.fire({
        title: "¿Eliminar Cliente?",
        text: "Esta accion no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (!result.isDismissed) {
          alert("Cliente Eliminado");
        }
      });
    };
    const searchClient = () => {};
    return {
      showCreate,
      toggleCreate,
      clients,
      deleteClient,
      updateClient,
      createClient,
      searchClient,
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
.t-clients{
  background-color: rgba(218, 218, 218, 0.76);
}
h5, h4{
  margin-bottom: 0;
}
</style>