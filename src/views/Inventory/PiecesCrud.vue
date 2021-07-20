<template>

      <SideBar />
      <PiecesInventory />
</template>
<script>
import PiecesInventory from "@/components/Inventory/PiecesInventory.vue";
import SideBar from "../../components/layout/SideBar.vue";
// import Inventory from '../../components/Inventory/Inventory.vue'
export default {
  components: {
    PiecesInventory,
    SideBar,
  },
};
</script>
<style lang="">
</style>