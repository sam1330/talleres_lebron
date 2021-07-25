<?php  include "../../main/conexion.php";

    $id_empleado = htmlentities($_GET['id_empleado']);

    $query = $con->prepare("DELETE FROM usuarios WHERE id_empleado=?");
    $query->bind_param("i", $id_empleado);

    if ($query->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    
    $query->close();
    $con->close();
?>