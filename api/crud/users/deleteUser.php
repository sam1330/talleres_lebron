<?php  include "../../main/conexion.php";

    $id_usu = htmlentities($_GET['id_usu']);

    $query = $con->prepare("DELETE FROM usuarios WHERE id_usu=?");
    $query->bind_param("i", $id_usu);

    if ($query->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    
    $query->close();
    $con->close();
?>