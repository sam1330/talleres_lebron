<template>
    <div class="row">
    <div class="col col-lg-2">
        <SideBar />
    </div>
    <div class="col col-lg-10">
    <Users />
    </div>
    </div>
</template>

<script>
import Users from "@/components/Users/Users"
import SideBar from "../../components/layout/SideBar.vue";
export default {
    name: "UsersCrud",
    components:{
        Users,
        SideBar
    }
}
</script>

<style scoped>
body{
    overflow: hidden;
}
</style>