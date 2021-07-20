<?php 
    include '../main/conexion.php';

    $usuario = $con->real_escape_string(htmlentities($_POST['user']));
    $pass = $con->real_escape_string(htmlentities($_POST['password']));

    $sel = $con->query("SELECT id_empleado, usuario, pass, rol FROM usuarios WHERE usuario='$usuario' ");

    if($f = $sel-> fetch_assoc()){
        $password = $f['pass'];
        $user = $f['usuario'];
        $id = $f['id_empleado'];
        $rol = $f['rol'];
    }
    if($f){
        if ($user == $usuario && md5($pass) == $password) {
            $token = md5(rand(0000,9999));
            $up = $con -> query("UPDATE usuarios SET token = '$token' WHERE id_empleado='$id'");
            if($up){
                $respuesta = array('token' => $token, 'res' => 'success', 'rol' => $rol);//mandando el token y la respuesta a vue
                echo json_encode($respuesta);//te siene que mandar en json el array para que funcione
            }
            
        } else {
            $respuesta = array('token' => '', 'res' => 'fail');
            echo json_encode($respuesta);
        }
    }else{
        $respuesta = array('token' => '', 'res' => 'fail');
        echo json_encode($respuesta);
    }
    
?>