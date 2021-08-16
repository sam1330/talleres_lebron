<template>
  <div class="container-lg">
    <h2 class="text-muted my-4"><i class="fas fa-cubes me-2"></i>Categorias</h2>
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
            @input="searchCategory()"
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
            <option value="id_cat" selected>ID Categoria</option>
            <option value="descripcion">Descripcion</option>
          </select>
          <label for="floatingSelect">Filtrar Por:</label>
        </div>
      </div>
    </div>
    <div class="toggle-crear my-3">
      <button class="btn btn-primary" @click="toggleCreate()">
        <i class="fas fa-plus me-2"></i>Añadir Categoria
      </button>
    </div>
    <div class="gap mt-3"></div>

    <!-- FORM CREAR -->

    <form
      class="border p-2 rounded shadow-sm"
      id="create"
      @submit.prevent="createCategory()"
      v-show="showCreate"
    >
      <h2>Agregar Categoria</h2>
      <div class="row">
        <div class="col col-lg-4">
          <div class="form-floating">
            <input
              type="text"
              name="descripcion"
              class="form-control text-capitalize"
              id="descripcion"
              placeholder="Descripcion"
              v-model="createForm.descripcion"
              required
            />
            <label for="descripcion">Descripcion</label>
          </div>
        </div>
        <div class="col col-lg-2">
          <div class="form-floating">
            <input
              type="number"
              name="porc_gan"
              class="form-control"
              id="porc_gan"
              placeholder="porc_gan"
              required
              v-model="createForm.porc_gan"
            />
            <label for="porc_gan">% Ganancia</label>
          </div>
        </div>
        <div class="col col-lg-2">
          <div class="form-floating">
            <input
              type="number"
              name="porc_desc"
              class="form-control"
              placeholder="% Descuento"
              v-model="createForm.porc_desc"
            />
            <label>% Descuento</label>
          </div>
        </div>
        <div class="col col-lg-2 align-self-center">
          <button type="submit" class="btn btn-primary pe-4 px-4 pt-2 pb-2">
            <i class="fas fa-save me-2 fs-5"></i>Crear
          </button>
        </div>
      </div>
    </form>

    <!-- END FORM CREAR -->
    <div class="table-responsive ">
      <table class="table table-hover table-bordered mt-5 mb-4">
        <thead class="table-dark">
          <tr>
            <td>ID Categoria</td>
            <td>Descripcion</td>
            <td>% Ganancia</td>
            <td>% Descuento</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories" :key="category.id_cat">
            <td>{{ category.id_cat }}</td>
            <td>{{ category.descripcion }}</td>
            <td>{{ category.porc_gan }}</td>
            <td>{{ category.porc_desc }}</td>
            <td>
              <span class="me-2"
                ><i
                  class="far fa-edit fs-3 text-info"
                  data-bs-toggle="modal"
                  data-bs-target="#exampleModal"
                  @click="selectCategoryToEdit(category.id_cat)"
                ></i></span
              ><span
                ><i
                  class="far fa-trash-alt fs-3 text-danger"
                  @click="deleteCategory(category.id_cat)"
                ></i
              ></span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- <div
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
        <h6>ID Categoria</h6>
      </div>
      <div class="col col-lg-3">
        <h6>Descripcion</h6>
      </div>
      <div class="col col-lg-3">
        <h6>% Ganancia</h6>
      </div>
      <div class="col col-lg-2">
        <h6>% Descuento</h6>
      </div>
    </div>
    <div class="gap"></div>
    <div
      class="
        row
        t-categories
        border-bottom
        shadow-sm
        my-3
        align-items-center
        rounded
      "
      v-for="category in categories"
      :key="category.id_cat"
    >
      <div class="col col-lg-2">
        <h6>{{ category.id_cat }}</h6>
      </div>
      <div class="col col-lg-3">
        <h6>{{ category.descripcion }}</h6>
      </div>
      <div class="col col-lg-3">
        <h6>{{ category.porc_desc }}</h6>
      </div>
      <div class="col col-lg-2">
        <h6>{{ currencyFormatter(category.porc_gan) }}</h6>
      </div>
      <div class="col col-lg-2">
        <span class="me-2"
          ><i
            class="far fa-edit fs-3 text-info"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
            @click="selectCategoryToEdit(category.id_cat)"
          ></i></span
        ><span
          ><i
            class="far fa-trash-alt fs-3 text-danger"
            @click="deleteCategory(category.id_cat)"
          ></i
        ></span>
      </div>
    </div> -->
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
            <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="updateCategory()" id="editForm">
              <div class="row">
                <div class="col col-lg-12">
                  <div class="form-floating">
                    <input
                      type="text"
                      name="descripcion"
                      class="form-control"
                      id="e_descripcion"
                      placeholder="Descripcion"
                      v-model="categoryToEdit.descripcion"
                    />
                    <label for="descripcion">Descripcion</label>
                  </div>
                </div>
              </div>
              <div class="row my-3">
                <div class="col col-lg-5">
                  <div class="form-floating">
                    <input
                      type="number"
                      name="porc_gan"
                      class="form-control"
                      id="e_porc_gan"
                      placeholder="porc_gan"
                      v-model="categoryToEdit.porc_gan"
                    />
                    <label for="porc_gan">% Ganancia</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col col-lg-5">
                  <div class="form-floating">
                    <input
                      type="number"
                      name="porc_desc"
                      class="form-control"
                      id="e_porc_desc"
                      placeholder="porc_desc"
                      v-model="categoryToEdit.porc_desc"
                    />
                    <label>% Descuento</label>
                  </div>
                </div>
                <input
                  type="hidden"
                  name="id_cat"
                  v-model="categoryToEdit.id_cat"
                />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button @click="updateCategory()" class="btn btn-primary">
              Save changes
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
import { baseUrl, currencyFormatter } from "../../model/main";
export default {
  name: "categories",
  setup() {
    const showCreate = ref(false);
    const filterSelected = ref("id_cat");
    const categories = ref([]);
    const searchBox = ref("");
    const categoryToEdit = ref({
      id_cat: null,
      descripcion: "",
      porc_gan: 0,
      porc_desc: 0,
    });
    const createForm = ref({
      descripcion: "",
      porc_gan: 0,
      porc_desc: 0,
    });

    const toggleCreate = () => {
      showCreate.value = !showCreate.value;
    };

    const createCategory = () => {
      const queryUrl = `${baseUrl}crud/categories/createCategory.php`;
      const frm = document.getElementById("create");
      axios
        .post(queryUrl, new FormData(frm))
        .then((res) => {
          if (res.data == "success") {
            Swal.fire({
              title: "Hurra!!",
              text: "Categoria creada",
              icon: "success",
            });
            clearCreateForm();
            fetchCategories();
          } else {
            Swal.fire({
              title: "Error!!",
              text: "Categoria no creada",
              icon: "error",
            });
          }
        })
        .catch((e) => console.log(e));
    };

    const clearCreateForm = () => {
      createForm.value.descripcion = "";
      createForm.value.porc_desc = 0;
      createForm.value.porc_gan = 0;
    };

    const updateCategory = () => {
      const form = document.getElementById("editForm");
      const queryUrl = `${baseUrl}crud/categories/updateCategory.php`;
      axios.post(queryUrl, new FormData(form)).then((res) => {
        if (res.data === "success") {
          Swal.fire({
            title: "Hurra!!",
            text: "Categoria Actualizado",
            icon: "success",
          });
          fetchCategories();
        } else {
          Swal.fire({
            title: "Ups!!",
            text: "Categoria no pudo ser Actualizado",
            icon: "error",
          });
        }
      });
    };
    const deleteCategory = (id) => {
      Swal.fire({
        title: "¿Eliminar Categoria?",
        text: "Esta accion no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (!result.isDismissed) {
          const queryUrl = `${baseUrl}crud/categories/deleteCategory.php?id_cat=${id}`;
          axios.get(queryUrl).then((res) => {
            if (res.data === "success") {
              Swal.fire({
                title: "Categoria Eliminada",
                icon: "success",
              });
              fetchCategories();
            } else {
              Swal.fire({
                title: "No se ha podido eliminar el Categoria",
                icon: "error",
              });
            }
          });
        }
      });
    };
    const searchCategory = () => {
      const queryUrl = `${baseUrl}crud/categories/searchCategory.php?${filterSelected.value}=${searchBox.value}`;
      axios.get(queryUrl).then((res) => {
        categories.value = res.data;
      });
    };

    const fetchCategories = () => {
      const queryUrl = `${baseUrl}crud/categories/fetchCategories.php`;
      axios
        .get(queryUrl)
        .then((res) => {
          if (res.data) {
            categories.value = [];
            res.data.forEach((element) => {
              categories.value.push(element);
            });
          }
        })
        .catch((e) => console.log(e));
    };

    const selectCategoryToEdit = (id) => {
      categories.value.filter((category) => {
        if (category.id_cat === id) {
          categoryToEdit.value.id_cat = category.id_cat;
          categoryToEdit.value.descripcion = category.descripcion;
          categoryToEdit.value.porc_gan = category.porc_gan;
          categoryToEdit.value.porc_desc = category.porc_desc;
        }
      });
    };
    onMounted(() => {
      fetchCategories();
    });
    return {
      showCreate,
      filterSelected,
      categories,
      searchBox,
      createForm,
      categoryToEdit,
      deleteCategory,
      toggleCreate,
      selectCategoryToEdit,
      fetchCategories,
      updateCategory,
      currencyFormatter,
      createCategory,
      searchCategory,
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
.t-categories {
  background-color: rgba(218, 218, 218, 0.76);
}
h5,
h4 {
  margin-bottom: 0;
}
</style>
