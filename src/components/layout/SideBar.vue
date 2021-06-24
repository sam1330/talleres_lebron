<template>
  <div class="side-bar">
    <nav>
      <div class="boton dropdown">
        <button
          class="dropdown-toggle"
          id="dropdownMenuLink"
          aria-expanded="false"
          data-bs-toggle="dropdown"
        >
          <i class="fas fa-shopping-cart"></i><span>Facturacion</span>
        </button>
        <ul
          class="dropdown-menu"
          style="z-index=99"
          aria-labelledby="dropdownMenuLink"
        >
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </div>
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
          class="dropdown-menu"
          style="z-index=99"
          aria-labelledby="dropdownMenuLink"
        >
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </div>
      <div class="boton dropdown">
        <button
          class="dropdown-toggle"
          id="dropdownMenuLink"
          aria-expanded="false"
          data-bs-toggle="dropdown"
        >
          <i class="fas fa-user-friends"></i><span>Personas</span>
        </button>
        <ul
          class="dropdown-menu"
          style="z-index=99"
          aria-labelledby="dropdownMenuLink"
        >
          <li><router-link class="dropdown-item" to="/clients">Clientes</router-link></li>
          <li><router-link class="dropdown-item" to="/users">Usuarios</router-link></li>
          <li><a class="dropdown-item" href="#">Empleados</a></li>
        </ul>
      </div>
      <div class="boton dropdown">
        <button
          class="dropdown-toggle"
          id="dropdownMenuLink"
          aria-expanded="false"
          data-bs-toggle="dropdown"
        >
          <i class="fas fa-file-invoice-dollar"></i><span>Cuentas</span>
        </button>
        <ul
          class="dropdown-menu"
          style="z-index=99"
          aria-labelledby="dropdownMenuLink"
        >
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </div>
    </nav>
  </div>
</template>
<script>
export default {
  setup() {},
};
</script>
<style scoped>
body {
  overflow: hidden;
}
.side-bar {
  background-color: #7879f1;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
  position: fixed;
  left: 0;
  top: 0;
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
ul li {
  padding: 5px;
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