<template>
  <form
    class="border p-2 rounded shadow-sm"
    action=""
    @submit.prevent=""
    v-if="toggleShow"
  >
    <h2>Agregar Pieza</h2>
    <div class="row">
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="text"
            name="detalle"
            class="form-control"
            id="detalle"
            placeholder="Detalle"
          />
          <label for="Detalle">Detalle</label>
        </div>
      </div>
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="text"
            name="fabricante"
            class="form-control"
            id="fabricante"
            placeholder="Fabricante"
          />
          <label for="fabricante">Fabricante</label>
        </div>
      </div>
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="number"
            name="buy_price"
            class="form-control"
            id="buy_price"
            placeholder="Precio Compra"
          />
          <label for="type">Precio Compra</label>
        </div>
      </div>
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="number"
            name="sell_price"
            class="form-control"
            id="sell_price"
            placeholder="Precio Venta"
          />
          <label for="type">Precio Venta</label>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col col-lg-3">
        <div class="form-floating">
          <input
            type="number"
            name="existence"
            class="form-control"
            id="existence"
            placeholder="Existencia"
          />
          <label for="existence">Existencia</label>
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
            <option value="alternator">Bujia</option>
            <option value="alternator">Bateria</option>
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