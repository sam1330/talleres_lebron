<template>
  <div class="container-fluid">
    <div class="border p-2 rounded shadow-sm">
      <h2>Crear Pre-Factura</h2>
      <div class="row">
        <div class="col col-lg-3">
          <div class="form-floating">
            <input
              type="text"
              name="nombre"
              class="form-control text-capitalize"
              placeholder="Marca"
              v-model="createForm.client.nombre"
              required
              readonly
              data-bs-toggle="modal"
              data-bs-target="#clientModal"
            />
            <label>Cliente</label>
          </div>
        </div>
        <div class="col col-lg-3 border-end border-2">
          <div class="form-floating">
            <input
              type="text"
              name="identificacion"
              class="form-control text-capitalize"
              placeholder="Identificacion"
              v-model="createForm.client.identificacion"
              required
              readonly
            />
            <label>Identificacion</label>
          </div>
        </div>
        <div class="col col-lg-3">
          <div class="form-floating">
            <select class="form-select" v-model="selectedVehicle">
              <option :value="null">Seleccionar</option>
              <option
                v-for="vehicle in vehicles"
                :key="vehicle.placa"
                :value="vehicle.placa"
              >
                {{ vehicle.marca }} {{ vehicle.modelo }}
              </option>
            </select>
            <label>Vehiculo</label>
          </div>
        </div>
        <div class="col col-lg-3">
          <div class="form-floating">
            <input
              type="text"
              v-model="selectedVehicle"
              class="form-control"
              readonly
            />
            <label>Placa</label>
          </div>
        </div>
      </div>
      <div class="row my-3 pb-3 border-bottom border-2">
        <div class="col col-lg-3">
          <div class="form-floating">
            <select class="form-select" name="tipo_fact">
              <option value="Contado" selected>Contado</option>
              <option value="Credito">Credito</option>
            </select>
            <label>Tipo de factura</label>
          </div>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col col-lg-5">
          <div class="form-floating">
            <input
              type="text"
              name="detalle"
              class="form-control text-capitalize"
              placeholder="Detalle"
              :value="productName"
              required
              readonly
              data-bs-toggle="modal"
              data-bs-target="#productModal"
            />
            <label>Detalle</label>
          </div>
        </div>
        <div class="col col-lg-2">
          <div class="form-floating">
            <input
              type="number"
              name="marca"
              min="0"
              class="form-control"
              v-model="createForm.products.cantidad"
              placeholder="Cantidad"
            />
            <label>Cantidad</label>
          </div>
        </div>
        <div class="col col-lg-3">
          <div class="form-floating">
            <input
              type="number"
              name="precio"
              min="0"
              class="form-control"
              placeholder="Precio"
              v-model="createForm.products.precio"
            />
            <label>Precio</label>
          </div>
        </div>
        <div class="col col-lg-2">
          <div class="d-grid">
            <input
              type="button"
              class="btn btn-primary"
              @click="addProduct()"
              value="Agregar"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-10 table-responsive">
        <table class="table table-hover table-bordered mb-4">
          <thead class="table-dark">
            <tr>
              <td>Detalle</td>
              <td>Cantidad</td>
              <td>Precio</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in productsTableData" :key="product.detalle">
              <td>{{ product.cat_desc }} {{ product.detalle }}</td>
              <td>{{ product.cantidad }}</td>
              <td>{{ product.precio }}</td>
              <td>
                <span
                  class="me-2 text-danger"
                  @click="deleteTableProduct(product)"
                  ><i class="fas fa-trash"></i
                ></span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-2">
        <div class="form-floating">
          <input
            type="text"
            v-model="subTotalProducts"
            class="form-control"
            readonly
          />
          <label>Sub Total</label>
        </div>
        <div class="d-grid mt-3">
          <button class="btn btn-success"><i class="fas fa-receipt me-2"></i>Facturar</button>
        </div>
      </div>
    </div>
    <Products @selected="selectedProduct" />
    <Clients @selected="selectedClient" />
  </div>
</template>
<script>
import { computed, ref } from "vue";
import Products from "./Products.vue";
import Clients from "./Clients.vue";
import { baseUrl } from "@/model/main";
import axios from "axios";
import Swal from "sweetalert2";

export default {
  name: "prefactura",
  components: { Products, Clients },
  setup() {
    const createForm = ref({
      client: {},
      vehicle: {},
      products: {},
    });
    const vehicles = ref([]);
    const productsTableData = ref([]);
    const selectedVehicle = ref(null);
    const products = ref([]);
    const subTotalProducts = ref(0);

    const subTotalPlus = () => {
      subTotalProducts.value =
        parseFloat(subTotalProducts.value) +
        (parseFloat(createForm.value.products.precio) * parseFloat(createForm.value.products.cantidad));
    };
    const subTotalMinus = (product) => {
      subTotalProducts.value =
        parseFloat(subTotalProducts.value) -
        (parseFloat(product.precio) * parseFloat(product.cantidad));
    };

    const productName = computed(() => {
      if (!createForm.value.products.cat_desc) {
        return createForm.value.products.detalle;
      }
      return `${createForm.value.products.cat_desc} ${createForm.value.products.detalle}`;
    });

    const deleteTableProduct = (product) => {
      productsTableData.value = productsTableData.value.filter((producto) => {
        if(product === producto) {
          subTotalMinus(producto);
        }
        return producto != product;
      });
    };

    const addProduct = () => {
      // productsTableData.value.forEach(product => {
      //   console.log(product.detalle);
      // });
      // const exist = productsTableData.value.filter((product) => {
      //   if (product.detalle == createForm.value.products.detalle) {
      //     return [true];
      //   }
      //   return false;
      // });
      // if (!exist) {
      //   Swal.fire({
      //     title: "Upps!!",
      //     text: "Producto ya ingresado",
      //     icon: "warning",
      //   });
      //   return;
      // }
      if (
        createForm.value.products.cantidad === "" ||
        createForm.value.products.cantidad === undefined ||
        createForm.value.products.cantidad === null ||
        createForm.value.products.cantidad === 0
      ) {
        Swal.fire({
          title: "Upps!!",
          text: "Elija Cantidad",
          icon: "warning",
        });
        return;
      }
      productsTableData.value.push(createForm.value.products);
      subTotalPlus();
    };
    const selectedClient = (client) => {
      createForm.value.client = client;
      searchVehicle();
    };

    const selectedProduct = (product) => {
      createForm.value.products = product;
      searchVehicle();
    };

    const selectVehicle = (placa) => {
      vehicles.value.filter((vehiculo) => {
        console.log(vehiculo);
      });
      console.log(placa);
    };

    const searchVehicle = () => {
      const queryUrl = `${baseUrl}crud/vehicles/searchVehicle.php?nombre=${createForm.value.client.nombre}`;
      axios.get(queryUrl).then((res) => {
        vehicles.value = res.data;
      });
    };

    

    return {
      createForm,
      productsTableData,
      vehicles,
      selectedVehicle,
      products,
      productName,
      subTotalProducts,
      subTotalPlus,
      selectedProduct,
      addProduct,
      selectedClient,
      searchVehicle,
      selectVehicle,
      deleteTableProduct,
    };
  },
};
</script>
<style scoped>
.modal-content {
  max-height: 500px;
}
</style>