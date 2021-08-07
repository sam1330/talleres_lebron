<?php include "../../main/conexion.php";
    foreach ($_POST as $campo => $valor) {
        // Esto sirve para traer nombrar las variables en la tabla, esto es para no estar poniendo $user = $_POST['user']; y asi tener que asignar manualmente una variable a los campos que nos mandan de un post
        $var = "$".$campo."='".$valor."';"; 
        eval($var); //La funcion eval sirve para que tomemos literalmente todo como si no estuviera en comillas y poder hacer valida la variable. Very nice no?
    }
    $query = $con->prepare("UPDATE servicio SET detalle=?, dificultad=?, precio=? WHERE id_ser=?");
    $query->bind_param("ssii", $detalle, $dificultad, $precio, $id_ser);
    

    if ($query->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    $query->close();
    $con->close();
?>