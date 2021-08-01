<template>
  <SideBar />
  <Providers />
</template>

<script>
import Providers from "@/components/Providers/Providers";
import SideBar from "../../components/layout/SideBar.vue";
export default {
  name: "UsersCrud",
  components: {
    Providers,
    SideBar,
  },
};
</script>

<style scoped>
body {
  overflow: hidden;
}
</style>