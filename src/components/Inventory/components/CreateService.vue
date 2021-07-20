<template>
  <form
    class="border p-2 rounded shadow-sm"
    action=""
    @submit.prevent=""
    v-if="toggleShow"
  >
    <h2>Agregar Servicio</h2>
    <div class="row">
      <div class="col col-lg-6">
        <div class="form-floating">
          <input
            type="text"
            name="description"
            class="form-control"
            id="description"
            placeholder="Descripcion"
          />
          <label for="description">Descripcion</label>
        </div>
      </div>
      <div class="col col-lg-4">
        <div class="form-floating">
          <input
            type="number"
            name="price"
            class="form-control"
            id="price"
            placeholder="Price"
          />
          <label for="price">Precio</label>
        </div>
      </div>
      <div class="col col-lg-2 align-self-center">
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