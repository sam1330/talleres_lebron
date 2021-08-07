<?php include "../../main/conexion.php";
    foreach ($_POST as $campo => $valor) {
        // Esto sirve para traer nombrar las variables en la tabla, esto es para no estar poniendo $user = $_POST['user']; y asi tener que asignar manualmente una variable a los campos que nos mandan de un post
        $var = "$".$campo."='".$valor."';"; 
        eval($var); //La funcion eval sirve para que tomemos literalmente todo como si no estuviera en comillas y poder hacer valida la variable. Very nice no?
    }
    if ($pass) {
        $query = $con->prepare("UPDATE usuarios SET usuario=?, pass=md5(?), rol=? WHERE id_usu=?");
        $query->bind_param("sssi", $usuario, $pass, $rol, $id_usu);
    } else {
        $query = $con->prepare("UPDATE usuarios SET usuario=?, rol=? WHERE id_usu=?");
        $query->bind_param("ssi", $usuario, $rol, $id_usu);
    }

    if ($query->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    $query->close();
    $con->close();
?>