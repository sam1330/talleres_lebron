<template>
    <div class="container">
        <div class="gap mt-3"></div>
        <div class="row">
            <div class="col col-lg-6 mb-1">
                <div class="form-floating">
                    <input type="text" class="form-control" id="buscar" placeholder="Buscar">
                    <label for="buscar">Buscar</label>
                </div>
            </div>
            <div class="col col-lg-5 mb-1 ">
               <div class="form-floating">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option valur="usuario" selected>Usuario</option>
                        <option value="nombre">Nombre</option>
                        <option value="identificacion">Identificacion</option>
                        <option value="tipo">Tipo</option>
                    </select>
                    <label for="floatingSelect">Filtrar Por:</label>
                </div>
            </div>
        </div>
        <div class="toggle-crear my-3">
            <button class="btn btn-primary" @click="toggleCreate"><i class="fas fa-plus me-2"></i>Añadir Usuario</button>
        </div>
        <div class="gap mt-3"></div>
        <form class="border p-2 rounded shadow-sm" action="" @submit.prevent="" v-if="showCreate">
        <h2>Crear Usuario</h2>
            <div class="row">
                <div class="col col-lg-4">
                    <div class="form-floating">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nombre">
                        <label for="buscar">Nombre</label>
                    </div>
                </div>
                <div class="col col-lg-4">
                    <div class="form-floating">
                        <input type="text" name="user" class="form-control" id="user" placeholder="Usuario">
                        <label for="buscar">Usuario</label>
                    </div>
                </div>
                <div class="col col-lg-4">
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option valur="empleado" selected>Empleado Comun</option>
                        <option value="administrator">Administrador</option>
                        </select>
                        <label for="floatingSelect">Rol</label>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col col-lg-4">
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="name" placeholder="Contraseña">
                        <label for="buscar">Contraseña</label>
                    </div>
                </div>
                <div class="col col-lg-4">
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" placeholder="Confirmar contraseña">
                        <label for="buscar">Confirmar contraseña</label>
                    </div>
                </div>
                <div class="col col-lg-4 align-self-center">
                    <button class="btn btn-primary pe-4 px-4 pt-2 pb-2" @click="createUser">Crear</button>
                </div>
            </div>
        </form>

        <div id="t-header" class="row border-bottom shadow-sm mt-5 mb-4 rounded p-1">
            <div class="col col-lg-4">
                <h4>Nombre</h4>
            </div>
            <div class="col col-lg-3">
                <h4>Usuario</h4>
            </div>
            <div class="col col-lg-3">
                <h4>Rol</h4>
            </div>
            <div class="col col-lg-2">
                <h4>Acciones</h4>
            </div>
        </div>
        <div class="gap"></div>
        <div class="row border-bottom shadow-sm my-3 rounded p-1" v-for="user in users" :key="user.name">
            <div class="col col-lg-4">
                <h5>{{ user.name }}</h5>
            </div>
            <div class="col col-lg-3">
                <h5>{{ user.user }}</h5>
            </div>
            <div class="col col-lg-3">
                <h5>{{ user.role }}</h5>
            </div>
            <div class="col col-lg-2 pb-1">
                <span class="me-5"><i class="far fa-edit fs-3 text-info" data-bs-toggle="modal" data-bs-target="#exampleModal"></i></span><span><i class="far fa-trash-alt fs-3 text-danger" @click="deleteUser"></i></span>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col col-lg-6">
                        <div class="form-floating">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nombre">
                            <label for="buscar">Nombre</label>
                        </div>
                    </div>
                    <div class="col col-lg-6">
                        <div class="form-floating">
                            <input type="text" name="user" class="form-control" id="user" placeholder="Usuario">
                            <label for="buscar">Usuario</label>
                        </div>
                    </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col col-lg-5">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                    <option valur="empleado" selected>Empleado Comun</option>
                                    <option value="administrator">Administrador</option>
                                    </select>
                                    <label for="floatingSelect">Rol</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col col-lg-5">
                                <div class="form-floating">
                                    <input type="password" name="password" class="form-control" id="name" placeholder="Contraseña">
                                    <label for="buscar">Contraseña</label>
                                </div>
                            </div>
                            <div class="col col-lg-5">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" placeholder="Confirmar contraseña">
                                    <label for="buscar">Confirmar contraseña</label>
                                </div>
                            </div>
                        </div>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
import { ref } from "vue";
import Swal from "sweetalert2";
export default {
    name:"Users",
    components: {

    },
    setup(){
        const showCreate = ref(false); 
        const users = ref([{
            name: "Samuel Martinez",
            user: "Sammy1301",
            role: "Administrador",
        },
        {
            name: "Mariana Rodriguez",
            user: "mariRdz30",
            role: "Administrador",
        }
        ])
        const toggleCreate = () => {
            showCreate.value = !showCreate.value;
        };
        const createUser = () => {
            Swal.fire({
                title: "Hurra!!",
                text: "Usuario creado",
                icon: "success",
            });
        };
        const updateUser = () => {
            Swal.fire({
                title: "Hurra!!",
                text: "Usuario Actualizado",
                icon: "success",
            });
        };
        const deleteUser = () => {
            Swal.fire({
                title: "¿Eliminar usuario?",
                text: "Esta accion no se puede deshacer",
                icon: "warning",
                showCancelButton: true
            }).then( (result) => {
                if(!result.isDismissed){
                    alert("Usuario Eliminado");
                }
            });
        };
        const searchUser = () => {
            
        };
        return {
            showCreate,
            toggleCreate,
            users,
            deleteUser,
            updateUser,
            createUser,
            searchUser
        }
    }
}
</script>
<style>
#t-header{
    background-color: rgb(177, 177, 177);
}
span > i {
    cursor: pointer;
}
</style>