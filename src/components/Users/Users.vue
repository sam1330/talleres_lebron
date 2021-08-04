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
            v-model="searchBox"
            @input="searchUser()"
          />
          <label for="buscar">Buscar</label>
        </div>
      </div>
      <div class="col col-lg-5 mb-1">
        <div class="form-floating">
          <select
            class="form-select"
            aria-label="Floating label select example"
            v-model="filterSelected"
          >
            <option value="usuario" selected>Usuario</option>
            <option value="id_usu">ID Usuario</option>
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
      @submit.prevent="createUser()"
      v-show="showCreate"
      id="create"
    >
      <h2>Crear Usuario</h2>
      <div class="row">
        <!-- <div class="col col-lg-4">
          <div class="form-floating">
            <input
              type="number"
              name="id_usu"
              class="form-control"
              id="id_usu"
              placeholder="ID Usuario"
              required
            />
            <label for="id_usu">ID Usuario</label>
          </div>
        </div> -->
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
              aria-label="Floating label select example"
              name="rol"
            >
              <option value="Empleado" selected>Empleado Comun</option>
              <option value="Administrador">Administrador</option>
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
              placeholder="Contraseña"
              v-model="pass"
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
              placeholder="Confirmar contraseña"
              v-model="conf_pass"
              required
            />
            <label for="confirm_password">Confirmar contraseña</label>
          </div>
        </div>

        <div class="col col-lg-4 align-self-center">
          <button
            type="submit"
            class="btn btn-primary"
          ><i class="fas fa-save me-2 fs-5"></i>Crear</button>
        </div>
      </div>
    </form>
    <!-- ------------------------------------FINAL FORM------------------------------------------------------------- -->
    <div
      id="t-header"
      class="row border-bottom shadow-sm mt-5 mb-4 rounded p-1"
    >
      <div class="col col-lg-4">
        <h6>ID Usuario</h6>
      </div>
      <div class="col col-lg-3">
        <h6>Usuario</h6>
      </div>
      <div class="col col-lg-3">
        <h6>Rol</h6>
      </div>
    </div>
    <div class="gap"></div>
    <div
      class="row t-users border-bottom shadow-sm my-3 rounded"
      v-for="(user, index) in users"
      :key="index"
    >
      <div class="col col-lg-4 align-self-center">
        <h5>{{ user.id_usu }}</h5>
      </div>
      <div class="col col-lg-3 align-self-center">
        <h5>{{ user.usuario }}</h5>
      </div>
      <div class="col col-lg-3 align-self-center">
        <h5>{{ user.rol }}</h5>
      </div>
      <div class="col col-lg- 2 pb-1">
        <span class="me-5" @click="selectUserToEdit(user.id_usu)"
          ><i
            class="far fa-edit fs-3 text-info"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
          ></i></span
        ><span
          ><i
            class="far fa-trash-alt fs-3 text-danger"
            @click="deleteUser(user.id_usu)"
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
            <form @submit.prevent="updateUser()" id="edit">
              <div class="row">
                <div class="col col-lg-6">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="usuario"
                      class="form-control"
                      placeholder="Usuario"
                      v-model="userToEdit.usuario"
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
                      id="rolEdit"
                      name="rol"
                      v-model="userToEdit.rol"
                    >
                      <option value="Empleado" selected>Empleado Comun</option>
                      <option value="Administrador">Administrador</option>
                    </select>
                    <label for="rolEdit">Rol</label>
                  </div>
                </div>
                <div class="col col-lg-5 align-self-end">
                  <div class="form-check form-switch">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      name="allowChangePassword"
                      @click="allowChangePassword = !allowChangePassword"
                      v-model="allowChangePassword"
                    />
                    <label class="form-check-label" for="flexSwitchCheckDefault"
                      >Cambiar contraseña</label
                    >
                  </div>
                </div>
              </div>
              <div class="row mt-3" v-show="allowChangePassword">
                <div class="col col-lg-5">
                  <div class="form-floating">
                    <input
                      type="password"
                      name="pass"
                      class="form-control"
                      id="password"
                      placeholder="Contraseña"
                      v-model="pass"
                    />
                    <label for="buscar">Contraseña</label>
                  </div>
                </div>
                <div class="col col-lg-5">
                  <div class="form-floating">
                    <input
                      type="password"
                      name="c_pass"
                      class="form-control"
                      id="c_password"
                      placeholder="Confirmar contraseña"
                      v-model="conf_pass"
                    />
                    <label for="buscar">Confirmar contraseña</label>
                  </div>
                </div>
                <input type="hidden" name="id_usu" v-model="userToEdit.id_usu">
              </div>
            </form>
            <!-- FIN FORM EDITAR -->
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              class="btn btn-primary"
              @click="updateUser()"
            >
              Guardar Cambios
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { ref, onMounted } from "vue";
import Swal from "sweetalert2";
import axios from "axios";
import { baseUrl } from "../../model/main";

export default {
  name: "Users",
  components: {},
  setup() {
    const allowChangePassword = ref(false);
    const showCreate = ref(false);
    const users = ref([]);
    const userToEdit = ref({});
    const pass = ref("");
    const conf_pass = ref("");
    const toggleCreate = () => {
      showCreate.value = !showCreate.value;
    };
    const filterSelected = ref("usuario");
    const searchBox = ref("");

    const createUser = () => {
      if (pass.value != conf_pass.value) {
        Swal.fire({
          title: "Error",
          text: "Contraseñas no coinciden",
          icon: "error",
        });
        return;
      }
      const queryUrl = `${baseUrl}crud/users/createUser.php`;
      const frm = document.getElementById("create");
      axios
        .post(queryUrl, new FormData(frm))
        .then((res) => {
          if (res.data === "success") {
            Swal.fire({
              title: "Hurra!!",
              text: "Usuario creado con exito",
              icon: "success",
            });
            fetchUsers();
          }
        })
        .catch((e) => console.log(e));
        pass.value = "";
        conf_pass.value = "";
    };
    const updateUser = () => {
      if (pass.value != conf_pass.value) {
        Swal.fire({
          title: "Error",
          text: "Contraseñas no coinciden",
          icon: "error",
        });
        return;
      }
      const queryUrl = `${baseUrl}crud/users/updateUser.php`;
      const frm = document.getElementById("edit");
      axios
        .post(queryUrl, new FormData(frm))
        .then((res) => {
          if (res.data === "success") {
            Swal.fire({
              title: "Hurra!!",
              text: "Usuario creado con exito",
              icon: "success",
            });
            fetchUsers();
          }
        })
        .catch((e) => console.log(e));
    };
    const deleteUser = (id) => {
      const queryUrl = `${baseUrl}crud/users/deleteUser.php?id_usu=${id}`;
      Swal.fire({
        title: "¿Eliminar usuario?",
        text: "Esta accion no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (!result.isDismissed) {
          axios.get(queryUrl).then((res) => {
            if (res.data === "success") {
              Swal.fire({
                title: "Usuario Eliminado",
                icon: "warning",
              });
            fetchUsers();
            }
          });
        }
      });
    };
    const selectUserToEdit = (id) => {
      users.value.filter((user) => {
        if (user.id_usu === id) {
          userToEdit.value = user;
        }
      });
    };
    const fetchUsers = () => {
      const queryUrl = `${baseUrl}crud/users/fetchUsers.php`;
      axios
        .get(queryUrl)
        .then((res) => {
          if (res.data) {
            users.value = [];
            res.data.forEach((element) => {
              users.value.push(element);
            });
          }
        })
        .catch((e) => console.log(e));
    };
    const searchUser = () => {
      const queryUrl = `${baseUrl}crud/users/searchUser.php?${filterSelected.value}=${searchBox.value}`;
      axios.get(queryUrl).then((res) => {
        users.value = res.data;
      });
    };

    onMounted(() => {
      fetchUsers();
    });
    return {
      allowChangePassword,
      showCreate,
      searchBox,
      users,
      userToEdit,
      pass,
      conf_pass,
      filterSelected,
      toggleCreate,
      selectUserToEdit,
      fetchUsers,
      deleteUser,
      updateUser,
      createUser,
      searchUser,
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
