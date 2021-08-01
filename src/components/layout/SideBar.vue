<template>
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <a class="navbar-brand text-primary m-lg-2" href="#">Talleres Lebron</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a
                class="nav-link m-lg-2 dropdown-toggle"
                href="#"
                id="facturacion"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Facturacion
              </a>
              <ul class="dropdown-menu" aria-labelledby="facturacion">
                <li><a class="dropdown-item" href="#">Facturacion</a></li>
                <li><a class="dropdown-item" href="#">Consulta</a></li>
                <li>
                  <a class="dropdown-item" href="#">Cuadre</a>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link m-lg-2 dropdown-toggle"
                href="#"
                id="inventario"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Inventario
              </a>
              <ul class="dropdown-menu" aria-labelledby="inventario">
                <li><router-link to="/pieces" class="dropdown-item">Piezas</router-link></li>
                <li><router-link to="/services" class="dropdown-item">Servicios</router-link></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link m-lg-2 dropdown-toggle"
                href="#"
                id="personas"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Personas
              </a>
              <ul class="dropdown-menu" aria-labelledby="personas">
                <li><router-link to="/clients" class="dropdown-item">Clientes</router-link></li>
                <li><router-link to="/users" class="dropdown-item">Usuarios</router-link></li>
                <li>
                  <router-link to="/employees" class="dropdown-item">Empleados</router-link>
                </li>
                <li><router-link to="/providers" class="dropdown-item">Proveedores</router-link></li>
              </ul>
            </li>
            <li class="nav-item">
              <a
                class="nav-link disabled"
                href="#"
                tabindex="-1"
                aria-disabled="true"
                >Disabled</a
              >
            </li>
          </ul>
          <form class="d-flex">
            <h5 class="m-2">Samuel Martinez</h5>
            <button class="btn btn-outline-danger" type="submit">
              <i class="fas fa-power-off me-2"></i>Salir
            </button>
          </form>
        </div>
      </div>
    </nav>
</template>
<script>
export default {
  setup() {},
};
</script>
<style scoped>
nav{
  background-color: #E8E9F3;
}
li{

  transition: ease 0.5s all;
}
</style>