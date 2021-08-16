<template>
  <div class="container-lg">
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
            @input="searchEmployee()"
            v-model="searchBox"
          />
          <label for="buscar">Buscar</label>
        </div>
      </div>
      <div class="col col-lg-5 mb-1">
        <div class="form-floating">
          <select
            class="form-select"
            id="filterSelect"
            aria-label="Floating label select example"
            name="filter"
            v-model="filterSelected"
          >
            <option value="nombre" selected>Nombre</option>
            <option value="identificacion">Identificacion</option>
            <option value="telefono">Telefono</option>
            <option value="email">Email</option>
          </select>
          <label for="filterSelect">Filtrar Por:</label>
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
      @submit.prevent="createEmployee()"
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
            <select
              name="puesto"
              class="form-select"
              id="puesto"
              v-model="createForm.puesto"
              aria-label="Floating label select example"
            >
              <option value="Administrador" selected>Administrador</option>
              <option value="Mecanico">Mecanico</option>
              <option value="Secretaria">Secretaria</option>
              <option value="Supervisor">Supervisor</option>
            </select>
            <label for="puesto">puesto</label>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col col-lg-2">
          <div class="form-floating">
            <input
              type="number"
              name="salario"
              class="form-control"
              id="salario"
              v-model="createForm.salario"
              placeholder="Salario"
              required
            />
            <label for="salario">Salario</label>
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
      </div>
      <div class="row mt-3">
        <div class="col col-lg-2 align-self-center">
          <input type="hidden" name="fecha_entrada" :value="formatDate" />
          <button
            type="submit"
            value="Crear"
            class="btn btn-primary pe-4 px-4 pt-2 pb-2"
          >
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
        <h6>Telefono</h6>
      </div>
      <div class="col col-lg-2">
        <h6>Puesto</h6>
      </div>
      <div class="col col-lg-1">
        <h6>Salario</h6>
      </div>
      <div class="col col-lg-2">
        <h6>Fecha Entrada</h6>
      </div>
    </div>
    <div class="gap"></div>
    <div
      class="row t-employees border-bottom shadow-sm my-3 rounded"
      v-for="employee in employees"
      :key="employee.id"
    >
      <div class="col col-lg-1 align-self-center">
        {{ employee.nombre }} {{ employee.apellido
        }}<span
          ><i
            class="fas fa-external-link-alt cursor-pointer"
            @click="employeeAditionalData(employee.id)"
            data-bs-toggle="modal"
            data-bs-target="#adicionalData"
          ></i
        ></span>
      </div>
      <div class="col col-lg-2 align-self-center">
        {{ employee.identificacion }}
      </div>
      <div class="col col-lg-2 align-self-center">
        {{ employee.telefono }}
      </div>
      <div class="col col-lg-2 overflow-auto align-self-center">
        {{ employee.puesto }}
      </div>
      <div class="col col-lg-1 align-self-center">
        {{ currencyFormatter(employee.salario) }}
      </div>
      <div class="col col-lg-2 align-self-center">
        {{ employee.fecha_entrada }}
      </div>
      <div class="col col-lg-2 pb-1 align-self-center">
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
                <div class="col col-lg-4">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="nombre"
                      class="form-control"
                      id="e_name"
                      :value="employeeToEdit.nombre"
                      placeholder="Nombre"
                      required
                    />
                    <label for="e_name">Nombre</label>
                  </div>
                </div>
                <div class="col col-lg-4">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="apellido"
                      class="form-control"
                      id="e_apellido"
                      v-model="employeeToEdit.apellido"
                      placeholder="Apellido"
                      required
                    />
                    <label for="e_apellido">Apellido</label>
                  </div>
                </div>
                <div class="col col-lg-4">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="identificacion"
                      class="form-control"
                      id="e_identificacion"
                      :value="employeeToEdit.identificacion"
                      placeholder="Identificacion"
                      required
                    />
                    <label for="e_identificacion">Identificacion</label>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col col-lg-4">
                  <div class="form-floating">
                    <select
                      name="puesto"
                      class="form-select"
                      id="e_puesto"
                      v-model="employeeToEdit.puesto"
                    >
                      <option value="Administrador" selected>
                        Administrador
                      </option>
                      <option value="Mecanico">Mecanico</option>
                      <option value="Secretaria">Secretaria</option>
                      <option value="Supervisor">Supervisor</option>
                    </select>
                    <label for="e_puesto">puesto</label>
                  </div>
                </div>
                <div class="col col-lg-4">
                  <div class="form-floating">
                    <input
                      type="number"
                      name="salario"
                      class="form-control"
                      id="e_salario"
                      :value="employeeToEdit.salario"
                      placeholder="Salario"
                      required
                    />
                    <label for="e_salario">Salario</label>
                  </div>
                </div>
                <div class="col col-lg-4">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="telefono"
                      class="form-control"
                      id="e_telefono"
                      :value="employeeToEdit.telefono"
                      placeholder="Telefono"
                      required
                    />
                    <label for="e_telefono">Telefono</label>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col col-lg-4">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="email"
                      class="form-control"
                      id="e_email"
                      :value="employeeToEdit.email"
                      placeholder="Email"
                    />
                    <label for="e_email">Email</label>
                  </div>
                </div>
                <div class="col col-lg-4">
                  <div class="form-floating">
                    <input
                      type="direccion"
                      name="direccion"
                      class="form-control"
                      id="e_direccion"
                      :value="employeeToEdit.direccion"
                      placeholder="Direccion"
                    />
                    <label for="e_direccion">Direccion</label>
                  </div>
                </div>
              </div>
              <input type="hidden" :value="employeeToEdit.id" name="id" />
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
    <div
      class="modal fade"
      id="adicionalData"
      tabindex="-1"
      aria-labelledby="adicionalData"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">
              Informacion del Empleado
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="row mt-3">
              <div class="col col-lg-6">
                <h5>Nombre completo</h5>
                <span class="text-muted"
                  >{{ aditionalData.nombre }} {{ aditionalData.apellido }}</span
                >
              </div>
              <div class="col col-lg-6">
                <h5>Identificacion</h5>
                <span class="text-muted">{{
                  aditionalData.identificacion
                }}</span>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col col-lg-6">
                <h5>Puesto</h5>
                <span class="text-muted">{{ aditionalData.puesto }}</span>
              </div>
              <div class="col col-lg-6">
                <h5>Salario</h5>
                <span class="text-muted">{{ aditionalData.salario }}</span>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col col-lg-6">
                <h5>Direccion</h5>
                <span class="text-muted">{{ aditionalData.direccion }}</span>
              </div>
              <div class="col col-lg-6">
                <h5>Telefono</h5>
                <span class="text-muted">{{ aditionalData.telefono }}</span>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col col-lg-6">
                <h5>Email</h5>
                <span class="text-muted">{{ aditionalData.email }}</span>
              </div>
              <div class="col col-lg-6">
                <h5>Fecha de Entrada</h5>
                <span class="text-muted">{{
                  aditionalData.fecha_entrada
                }}</span>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col col-lg-6">
                <h5>Fecha de Salida</h5>
                <span class="text-muted">{{ aditionalData.fecha_salida }}</span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              <i class="fas fa-times-circle me-2"></i>Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { ref, computed, onMounted } from "vue";
import Swal from "sweetalert2";
import axios from "axios";
import { baseUrl, currencyFormatter } from "../../model/main";
export default {
  name: "employees",
  setup() {
    const employeeToEdit = ref({});
    const employees = ref([]);
    const aditionalData = ref({});
    const showCreate = ref(false);
    const searchBox = ref("");
    const filterSelected = ref("nombre");
    const createForm = ref({
      nombre: "",
      apellido: "",
      identificacion: "",
      puesto: "Mecanico",
      salario: "",
      telefono: "",
      email: "",
      direccion: "",
    });
    //METHODS
    const toggleCreate = () => {
      showCreate.value = !showCreate.value;
    };
    const employeeAditionalData = (id) => {
      employees.value.filter((employee) => {
        if (employee.id === id) {
          aditionalData.value = employee;
        }
      });
    };

    const createEmployee = () => {
      const queryUrl = `${baseUrl}crud/employee/createEmployee.php`;
      const frm = document.getElementById("create");
      axios
        .post(queryUrl, new FormData(frm))
        .then((res) => {
          if (res.data == "success") {
            console.log(res.data);
            Swal.fire({
              title: "Hurra!!",
              text: "Empleado creado",
              icon: "success",
            });
            clearCreateForm();
            fetchEmployees();
          }
        })
        .catch((e) => console.log(e));
    };
    const updateEmployee = () => {
      const form = document.getElementById("editForm");
      const queryUrl = `${baseUrl}crud/employee/updateEmployee.php`;
      axios.post(queryUrl, new FormData(form)).then((res) => {
        if (res.data === "success") {
          Swal.fire({
            title: "Hurra!!",
            text: "Empleado Actualizado",
            icon: "success",
          });
          fetchEmployees();
        } else {
          Swal.fire({
            title: "Ups!!",
            text: "Empleado no pudo ser Actualizado",
            icon: "error",
          });
        }
      });
    };
    const deleteEmployee = (id) => {
      const queryUrl = `${baseUrl}crud/employee/deleteEmployee.php?id=${id}`;
      Swal.fire({
        title: "¿Eliminar Empleado?",
        text: "Esta accion no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (!result.isDismissed) {
          axios.get(queryUrl).then((res) => {
            if (res.data === "success") {
              employees.value = [];
              fetchEmployees();
              Swal.fire({
                title: "Empleado eliminado",
                text: "El empleado ha sido eliminado con exito",
                icon: "success",
              });
            }
          });
        }
      });
    };
    const fetchEmployees = () => {
      const queryUrl = `${baseUrl}crud/employee/fetchEmployee.php`;
      axios
        .get(queryUrl)
        .then((res) => {
          if (res.data) {
            employees.value = [];
            res.data.forEach((element) => {
              employees.value.push(element);
            });
          }
        })
        .catch((e) => console.log(e));
    };
    const searchEmployee = () => {
      const queryUrl = `${baseUrl}crud/employee/searchEmployee.php?${filterSelected.value}=${searchBox.value}`;
      axios.get(queryUrl).then((res) => {
        employees.value = res.data;
      });
    };
    const selectEmployeeToEdit = (id) => {
      employees.value.filter((employee) => {
        if (employee.id === id) {
          employeeToEdit.value = employee;
        }
      });
    };

    const formatDate = computed(() => {
      var todayDate = new Date().toISOString().slice(0, 10);
      return todayDate;
    });
    const clearCreateForm = () => {
      createForm.value.nombre = "";
      createForm.value.apellido = "";
      createForm.value.identificacion = "";
      createForm.value.telefono = "";
      createForm.value.email = "";
      createForm.value.direccion = "";
      createForm.value.puesto = "Mecanico";
      createForm.value.salario = 0;
    };
    onMounted(() => {
      fetchEmployees();
    });
    return {
      employeeToEdit,
      employees,
      showCreate,
      aditionalData,
      formatDate,
      filterSelected,
      createForm,
      searchBox,
      currencyFormatter,
      employeeAditionalData,
      toggleCreate,
      createEmployee,
      updateEmployee,
      deleteEmployee,
      clearCreateForm,
      fetchEmployees,
      searchEmployee,
      selectEmployeeToEdit,
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
.t-employees {
  background-color: rgba(218, 218, 218, 0.76);
}
h5,
h4 {
  margin-bottom: 0;
}
</style>