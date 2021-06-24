<template>
    <div class="row">
    <div class="col col-lg-2">
        <SideBar />
    </div>
    <div class="col col-lg-10">
    <Clients />
    </div>
    </div>
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