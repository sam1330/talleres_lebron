<template>
      <SideBar />
      <Facturacion />
</template>
<script>
import Facturacion from "../../components/Facturation/facturar/Facturacion.vue";
import SideBar from "../../components/layout/SideBar.vue";
export default {
  components: {
    Facturacion,
    SideBar,
  },
};
</script>
<style lang="">
</style>