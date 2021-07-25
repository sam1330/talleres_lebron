<template>
        <SideBar />
        <Employee />
</template>

<script>
import Employee from "@/components/Employees/Employee.vue";
import SideBar from "../../components/layout/SideBar.vue";
export default {
    name: "EmployeeCrud",
    components:{
        Employee,
        SideBar
    }
}
</script>

<style scoped>
body{
    overflow: hidden;
}
</style>