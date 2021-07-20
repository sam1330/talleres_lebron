<template>
  <SideBar />
  <Users />
</template>

<script>
import Users from "@/components/Users/Users";
import SideBar from "../../components/layout/SideBar.vue";
export default {
  name: "UsersCrud",
  components: {
    Users,
    SideBar,
  },
};
</script>

<style scoped>
body {
  overflow: hidden;
}
</style>