<template>
      <SideBar />
      <Categories />
</template>
<script>
import Categories from "@/components/categories/Categories.vue";
import SideBar from "../../components/layout/SideBar.vue";
export default {
  components: {
    Categories,
    SideBar,
  },
};
</script>
<style lang="">
</style>