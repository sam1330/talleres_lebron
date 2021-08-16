<?php  include "../../main/conexion.php";

    $id_ser = htmlentities($_GET['id_ser']);

    $query = $con->prepare("DELETE FROM servicio WHERE id_ser=?");
    $query->bind_param("i", $id_ser);

    if ($query->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    
    $query->close();
    $con->close();
?>