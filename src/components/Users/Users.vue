<template>
  <div class="container">
    <h2 class="text-muted my-4">
      <i class="fas fa-users-cog me-2"></i>Usuarios
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
            <option value="usuario" selected>Usuario</option>
            <option value="nombre">Nombre</option>
            <option value="identificacion">Identificacion</option>
            <option value="rol">Rol</option>
          </select>
          <label for="floatingSelect">Filtrar Por:</label>
        </div>
      </div>
    </div>
    <div class="toggle-crear my-3">
      <button class="btn btn-primary" @click="toggleCreate">
        <i class="fas fa-plus me-2"></i>Añadir Usuario
      </button>
    </div>
    <div class="gap mt-3"></div>
    <!-- ----------------------------------INICIO FORM CREAR------------------------------------------------------- -->
    <form
      class="border p-2 rounded shadow-sm"
      @submit.prevent="createUser"
      v-if="showCreate"
    >
      <h2>Crear Usuario</h2>
      <div class="row">
        <div class="col col-lg-4">
          <div class="form-floating">
            <input
              type="number"
              name="id_empleado"
              class="form-control"
              id="id_empleado"
              placeholder="ID Empleado"
              required
            />
            <label for="id_empleado">ID Empleado</label>
          </div>
        </div>
        <div class="col col-lg-4">
          <div class="form-floating">
            <input
              type="text"
              name="usuario"
              class="form-control"
              id="user"
              placeholder="Usuario"
              required
            />
            <label for="user">Usuario</label>
          </div>
        </div>
        
        <div class="col col-lg-4">
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
      </div>
      <div class="row mt-3">
        <div class="col col-lg-4">
          <div class="form-floating">
            <input
              type="password"
              name="pass"
              class="form-control"
              id="password"
              placeholder="Contraseña"
              required
            />
            <label for="password">Contraseña</label>
          </div>
        </div>
        <div class="col col-lg-4">
          <div class="form-floating">
            <input
              type="password"
              class="form-control"
              id="confirm_password"
              placeholder="Confirmar contraseña"
              required
            />
            <label for="confirm_password">Confirmar contraseña</label>
          </div>
        </div>
         
        <div class="col col-lg-4 align-self-center">
         
          <button
            class="btn btn-primary pe-4 px-4 pt-2 pb-2"
            @click="createUser"
          >
            <i class="fas fa-save me-2 fs-5"></i>Crear
          </button>
        </div>
      </div>
    </form>
    <!-- ------------------------------------FINAL FORM------------------------------------------------------------- -->
    <div
      id="t-header"
      class="row border-bottom shadow-sm mt-5 mb-4 rounded p-1"
    >
      <div class="col col-lg-4">
        <h4>ID Empleado</h4>
      </div>
      <div class="col col-lg-3">
        <h4>Usuario</h4>
      </div>
      <div class="col col-lg-3">
        <h4>Rol</h4>
      </div>
    </div>
    <div class="gap"></div>
    <div
      class="row t-users border-bottom shadow-sm my-3 rounded"
      v-for="user in users"
      :key="user.name"
    >
      <div class="col col-lg-4 align-self-center">
        <h5>{{ user.id }}</h5>
      </div>
      <div class="col col-lg-3 align-self-center">
        <h5>{{ user.user }}</h5>
      </div>
      <div class="col col-lg-3 align-self-center">
        <h5>{{ user.roles }}</h5>
      </div>
      <div class="col col-lg- 2 pb-1">
        <span class="me-5"
          ><i
            class="far fa-edit fs-3 text-info"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
          ></i></span
        ><span
          ><i class="far fa-trash-alt fs-3 text-danger" @click="deleteUser"></i
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
            <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <!------------------------------------- INICIO FORM EDIT ----------------------------------->
            <form>
              <div class="row">
                <div class="col col-lg-6">
                  <div class="form-floating">
                    <input
                      type="number"
                      name="id_empleado"
                      class="form-control"
                      id="id_empleado"
                      placeholder="Nombre"
                    />
                    <label for="id_empleado">Nombre</label>
                  </div>
                </div>
                <div class="col col-lg-6">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="user"
                      class="form-control"
                      id="user"
                      placeholder="Usuario"
                    />
                    <label for="user">Usuario</label>
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
            </form>
            <!-- FIN FORM EDIT -->
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
  name: "Users",
  components: {},
  setup() {
    const allowChangePassword = ref(false);
    const showCreate = ref(false);
    const users = ref([
      {
        id: "Samuel Martinez",
        user: "Sammy1301",
        role: "Administrador",
      },
      {
        id: "Mariana Rodriguez",
        user: "mariRdz30",
        role: "Administrador",
      },
    ]);
    const toggleCreate = () => {
      showCreate.value = !showCreate.value;
    };
    const createUser = () => {};
    const updateUser = () => {
      Swal.fire({
        title: "Hurra!!",
        text: "Usuario Actualizado",
        icon: "success",
      });
    };
    const deleteUser = () => {
      Swal.fire({
        title: "¿Eliminar usuario?",
        text: "Esta accion no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (!result.isDismissed) {
          alert("Usuario Eliminado");
        }
      });
    };
    const searchUser = () => {};
    return {
      showCreate,
      toggleCreate,
      users,
      deleteUser,
      updateUser,
      createUser,
      searchUser,
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
.t-users {
  background-color: rgba(218, 218, 218, 0.76);
}
h5,
h4 {
  margin-bottom: 0;
}
</style>
