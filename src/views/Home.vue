<template>
    <SideBar />
    <div class="b">
        <h1 class="text-muted">Bienvenido/a</h1>
    </div>
</template>
<script>
import SideBar from "../components/layout/SideBar.vue"
export default {
    name: "Home",
    components: {
        SideBar
    }
}
</script>
<style scoped>
h1{
    /* font-size: 8rem; */
}
.b{
    width: 150px;
    height: 250px;
    position: relative;
    top: 10%;
    left: 30%;
    transform: translate(-50%, 50%);
}
</style>