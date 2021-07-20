<template>
      <SideBar />
      <ServicesInventory />
</template>
<script>
import ServicesInventory from "@/components/Inventory/ServicesInventory.vue";
import SideBar from "../../components/layout/SideBar.vue";
// import Inventory from '../../components/Inventory/Inventory.vue'
export default {
  components: {
    ServicesInventory,
    SideBar,
  },
};
</script>
<style lang="">
</style>