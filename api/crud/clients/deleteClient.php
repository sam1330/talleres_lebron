<?php  include "../../main/conexion.php";

    $id = htmlentities($_GET['id']);

    $query = $con->prepare("DELETE FROM clientes WHERE id=?");
    $query->bind_param("i", $id);

    if ($query->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    
    $query->close();
    $con->close();
?>