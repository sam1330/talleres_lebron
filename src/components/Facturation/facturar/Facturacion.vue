<template>
  <div class="container-lg">
    <h2 class="text-muted my-4">
      <i class="fas fa-cash-register me-2"></i>Facturacion
    </h2>
    <div class="gap mt-3"></div>
    <div class="row">
      <div class="col col-lg-2">
        <div class="d-grid">
          <button class="btn btn-primary">
            <i class="fas fa-clipboard-list me-2"></i>Pre Factura
          </button>
        </div>
      </div>
      <div class="col col-lg-2 d-block">
        <div class="d-grid">
          <button class="btn btn-primary">
            <i class="fas fa-clipboard-check me-2"></i>Factura
          </button>
        </div>
      </div>
    </div>
    <div class="my-3"></div>
    <PreFactura />
  </div>
</template>
<script>
import PreFactura from "./components/PreFactura.vue"
export default {
  name: "facturacion",
  components: { PreFactura },
};
</script>
<style lang="">
</style>