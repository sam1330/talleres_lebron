<template>
  <div class="side-bar">
    <nav>
      <DropDown class="boton">
        <template #button>

        <button
          class="dropdown-toggle"
          data-bs-toggle="dropdown"
        >
          <i class="fas fa-shopping-cart"></i><span>Facturacion</span>
        </button>
        </template>
          <li><a class="dropdown-item" href="#">Facturacion</a></li>
          <li><a class="dropdown-item" href="#">Cuadre</a></li>
          <li><a class="dropdown-item" href="#">Devoluciones</a></li>
      </DropDown>
      <div class="boton dropdown">
        <button
          class="dropdown-toggle"
          id="dropdownMenuLink"
          aria-expanded="false"
          data-bs-toggle="dropdown"
        >
          <i class="fas fa-dolly-flatbed"></i><span>Inventario</span>
        </button>
        <ul
          class="dropdown-menu dropdown-menu-end"
          style="z-index=99"
          aria-labelledby="dropdownMenuLink"
        >
          <li><router-link to="/pieces" class="dropdown-item">Piezas</router-link></li>
          <li><router-link to="/services" class="dropdown-item">Servicios</router-link></li>
          <li><a class="dropdown-item" href="#">Algo mas ahi</a></li>
        </ul>
      </div>
      <DropDown class="boton">
        <template #button>
          <button
          class="dropdown-toggle"
          id="dropdownMenuLink"
          aria-expanded="false"
          data-bs-toggle="dropdown"
        >
          <i class="fas fa-user-friends"></i><span>Personas</span>
        </button>
        </template>
          <li><router-link to="/clients" class="dropdown-item" href="#">Clientes</router-link></li>
          <li><router-link to="/" class="dropdown-item" href="#">Empleados</router-link></li>
          <li><router-link to="/users" class="dropdown-item" href="#">Usuarios</router-link></li>
      </DropDown>
      <DropDown class="boton">
        <template #button>
        <button
          class="dropdown-toggle"
          id="dropdownMenuLink"
          aria-expanded="false"
          data-bs-toggle="dropdown"
        >
          <i class="fas fa-file-invoice-dollar"></i><span>Cuentas</span>
        </button>
        </template>
          <li><a class="dropdown-item" href="#">Cuentas por cobrar</a></li>
          <li><a class="dropdown-item" href="#">Cuentas por pagar</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
      </DropDown>
      

    </nav>
  </div>
</template>
<script>
import DropDown from "../layout/DropDown.vue";
export default {
  components: {
    DropDown
  },
  setup() {},
};
</script>
<style scoped>
body {
  overflow: hidden;
}
.side-bar {
  background-color: #7879f1;
  max-height: 10vh;
  min-height: 10vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
}
i {
  font-size: 2rem;
  padding-top: 5px;
}
nav {
  width: 100%;
  color: #fff;
}
.boton {
  background-color: #7879f1;
  height: 70px;
  width: 100%;
  color: #fff;
  margin-bottom: 5px;
  position: relative;
}

button {
  background: none;
  border: hidden;
  width: 100%;
  height: 100%;
  color: #fff;
  transition: all 0.5s ease;
  padding-bottom: 5px;
}
button:hover {
  background-color: #5858ac;
}
span {
  padding: 15px;
  font-size: 1.13rem;
}


.sub-facturacion {
  position: absolute;
  background: #7879f1;
  z-index: 1;
  width: 100%;
  margin: 0;
  right: -100%;
  top: 20px;
  display: none;
}
</style>