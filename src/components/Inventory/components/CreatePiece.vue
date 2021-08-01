<template>
  <form
    class="border p-2 rounded shadow-sm"
    action=""
    @submit.prevent=""
    v-if="toggleShow"
  >
    <h2>Agregar Repuesto</h2>
    <div class="row">
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="text"
            name="descripcion"
            class="form-control"
            id="descripcion"
            placeholder="Detalle"
          />
          <label for="Detalle">Detalle</label>
        </div>
      </div>
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="text"
            name="id_prov"
            class="form-control"
            id="proveedor"
            placeholder="Proveedor"
          />
          <label for="proveedor">Proveedor</label>
        </div>
      </div>
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="number"
            name="pre_com"
            class="form-control"
            id="pre_com"
            placeholder="Precio Compra"
          />
          <label for="pre_com">Precio Compra</label>
        </div>
      </div>
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="number"
            name="pre_ven"
            class="form-control"
            id="pre_ven"
            placeholder="Precio Venta"
          />
          <label for="pre_ven">Precio Venta</label>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="number"
            name="existencia"
            class="form-control"
            id="existencia"
            placeholder="Existencia"
          />
          <label for="existencia">Existencia</label>
        </div>
      </div>
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="number"
            name="reorder"
            class="form-control"
            id="reorder"
            placeholder="Reorden"
          />
          <label for="reorder">Reorden</label>
        </div>
      </div>
      <div class="col col-lg-3">
        <div class="form-floating">
          <select
            class="form-select"
            id="floatingSelect"
            aria-label="Floating label select example"
          >
            <option value="motor_de_arranque" selected>
              Motor de arranque
            </option>
            <option value="alternator">alternador</option>
            <option value="bujia">Bujia</option>
            <option value="bateria">Bateria</option>
          </select>
          <label for="floatingSelect">Categoria</label>
        </div>
      </div>
      <div class="col col-lg-3 align-self-center">
        <button
          class="btn btn-primary pe-4 px-4 pt-2 pb-2"
          @click="createArticle"
        >
          Crear
        </button>
      </div>
    </div>
  </form>
</template>
<script>
import { computed } from "vue";
export default {
  props: {
    showCreate: {
      type: Boolean,
      default: false,
    },
  },
  setup(props) {
    const toggleShow = computed(() => props.showCreate);

    return {
      toggleShow,
    };
  },
};
</script>
<style lang="">
</style>