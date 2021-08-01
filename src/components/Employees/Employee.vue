<template>
  <div class="container">
    <h2 class="text-muted my-4">
      <i class="fas fa-user-tie me-2"></i>Empleados
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
            @input="searchEmpleado()"
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
        <i class="fas fa-plus me-2"></i>Añadir Empleado
      </button>
    </div>
    <div class="gap mt-3"></div>
    <form
      class="border p-2 rounded shadow-sm"
      action=""
      @submit.prevent="createEmpleado()"
      v-show="showCreate"
      id="create"
    >
      <h2>Crear Empleado</h2>
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
              name="apellido"
              class="form-control"
              id="apellido"
              v-model="createForm.apellido"
              placeholder="Apellido"
              required
            />
            <label for="name">Apellido</label>
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
        </div>
        <div class="row mt-3">
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
        <div class="col col-lg-3">
          <div class="form-floating">
            <select
              name="puesto"
              class="form-select"
              id="floatingSelect"
              v-model="createForm.puesto"
              aria-label="Floating label select example"
            >
              <option value="Administrador" selected>Administrador</option>
              <option value="Mecanico">Mecanico</option>
              <option value="Secretaria">Secretaria</option>
              <option value="Supervisor">Supervisor</option>
            </select>
            <label for="floatingSelect">puesto</label>
          </div>
        </div>
        <div class="col col-lg-2 align-self-center">
          <input type="hidden" name="fecha" :value="formatDate" />
          <button value="Crear" class="btn btn-primary pe-4 px-4 pt-2 pb-2">
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
      <div class="col col-lg-1">
        <h6>Identificacion</h6>
      </div>
      <div class="col col-lg-1">
        <h6>telefono</h6>
      </div>
      <div class="col col-lg-2">
        <h6>Email</h6>
      </div>
      <div class="col col-lg-2">
        <h6>Direccion</h6>
      </div>
      <div class="col col-lg-1">
        <h6>Puesto</h6>
      </div>
      <div class="col col-lg-1">
        <h6>Salario</h6>
      </div>
      <div class="col col-lg-2">
        <h6>Fecha Creacion</h6>
      </div>
    </div>
    <div class="gap"></div>
    <div
      class="row t-clients border-bottom shadow-sm my-3 rounded"
      v-for="employee in employees"
      :key="employee.id"
    >
      <div class="col col-lg-2 align-self-center">
        {{ employee.nombre }}
      </div>
      <div class="col col-lg-2 align-self-center">
        {{ employee.identificacion }}
      </div>
      <div class="col col-lg-2 align-self-center">
        {{ employee.telefono }}
      </div>
      <div class="col col-lg-2 overflow-auto align-self-center">
        {{ employee.email }}
      </div>
      <div class="col col-lg-1 align-self-center">
        {{ employee.puesto }}
      </div>
      <div class="col col-lg-2 align-self-center">
        {{ employee.fecha_creacion }}
      </div>
      <div class="col col-lg-1 pb-1">
        <span class="me-2"
          ><i
            class="far fa-edit fs-3 text-info"
            data-bs-toggle="modal"
            data-bs-target="#editModal"
            @click="selectEmployeeToEdit(employee.id)"
          ></i></span
        ><span
          ><i
            class="far fa-trash-alt fs-3 text-danger"
            @click="deleteEmployee(employee.id)"
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
            <h5 class="modal-title" id="editModalLabel">Editar Empleado</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="updateEmployee()" id="editForm">
              <div class="row">
                <div class="col col-lg-6">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="nombre"
                      class="form-control"
                      id="name"
                      :value="EmployeeToEdit.nombre"
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
                      :value="EmployeeToEdit.identificacion"
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
                      :value="EmployeeToEdit.telefono"
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
                      :value="EmployeeToEdit.email"
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
                      :value="EmployeeToEdit.direccion"
                      placeholder="Direccion"
                    />
                    <label for="direccion">Direccion</label>
                  </div>
                </div>
                <div class="col col-lg-6">
                  <div class="form-floating">
                    <select
                      name="puesto"
                      class="form-select"
                      id="floatingSelect"
                      :value="EmployeeToEdit.puesto"
                      aria-label="Floating label select example"
                      required
                    >
                      <option value="persona" selected>Persona</option>
                      <option value="empresa">Empresa</option>
                    </select>
                    <label for="floatingSelect">puesto</label>
                  </div>
                </div>
              </div>
              <input type="hidden" :value="EmployeeToEdit.id" name="id" />
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
              @click="updateEmployee()"
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
import { ref } from "vue";
// import Swal from "sweetalert2";
// import axios from "axios";
// import { baseUrl } from "../../model/main";
export default {
  name: "employees",
  setup() {
    const EmployeeToEdit = ref({});
    const showCreate = ref(false);
    const searchBox = ref("");
    const filterSelected = ref("nombre");
    const createForm = ref({
      nombre: "",
      identificacion: "",
      telefono: "",
      email: "",
      direccion: "",
      puesto: "Administrador",
    });
    //METHODS
    const toggleCreate = () => {
      showCreate.value = !showCreate.value;
    };
    return {
      EmployeeToEdit,
      showCreate,
      filterSelected,
      createForm,
      searchBox,
      toggleCreate,
    };
  },
};
</script>