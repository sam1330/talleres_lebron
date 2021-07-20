<template>
  <div class="container-fluid justify-content-center align-items-center row">
    <div class="login-body animate__animated animate__fadeInUp">
      <div class="img">
        <img src="../assets/Login/login.jpg" alt="" />
      </div>
      <div class="form">
        <h2>Login</h2>
        <form @submit.prevent="Login()" id="login">
          <div class="form-floating mb-3 mt-5">
            <input
              name="user"
              type="text"
              class="form-control"
              id="user"
              placeholder="Usuario"
            />
            <label for="user">Usuario</label>
          </div>
          <div class="form-floating mb-3">
            <input
              type="password"
              name="password"
              class="form-control"
              id="password"
              placeholder="Contraseña"
            />
            <label for="password">Contraseña</label>
          </div>
          <div class="d-grid gap-2 mt-5">
            <input type="submit" value="Entrar" class="btn btn-outline-light" />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { baseUrl } from "../model/main";
import { useRouter } from "vue-router";
import  Swal  from "sweetalert2";
export default {
  name: "Login",
  setup() {
    const router = useRouter();

    const Login = () => {
      const urlQuery = `${baseUrl}/loginRegistro/login.php`;
      const form = document.getElementById("login");
      axios.post(urlQuery, new FormData(form)).then((res) => {
        if(res.data.res == "success"){
          router.push("/home");
        }else{
          Swal.fire({
            title: "Ups!!",
            text: "Usuario o Contraseña Incorrectos",
            icon: "warning",
          });
        }
      });
    };
    return {
      Login,
    };
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
* {
  overflow: hidden;
}
.login-body {
  background-color: #7879f1;
  height: 25em;
  width: 45em;
  display: flex;
  padding: 0;
  margin: 0;
  border-radius: 10px;
  box-shadow: black 0px 0px 7px;
}
.container-fluid {
  height: 100vh;
}
.img {
  height: 100%;
  width: 350px;
}
img {
  width: 100%;
  height: 100%;
  border-radius: 10px 0px 0px 10px;
}
.form {
  width: 370px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 10px;
}
h2 {
  color: #fff;
  font-weight: 400;
  font-size: 2.5rem;
}
</style>
