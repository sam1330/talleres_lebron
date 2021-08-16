<?php  include "../../main/conexion.php";

    $placa = htmlentities($_GET['placa']);

    $query = $con->prepare("DELETE FROM vehiculos WHERE placa=?");
    $query->bind_param("s", $placa);

    if ($query->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    
    $query->close();
    $con->close();
?>