<template>
        <SideBar />
        <Clients />
</template>

<script>
import Clients from "@/components/Clients/Clients.vue";
import SideBar from "../../components/layout/SideBar.vue";
export default {
    name: "UsersCrud",
    components:{
        Clients,
        SideBar
    }
}
</script>

<style scoped>
body{
    overflow: hidden;
}
</style>