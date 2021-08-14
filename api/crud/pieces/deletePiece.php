<?php  include "../../main/conexion.php";

    $cod_rep = htmlentities($_GET['cod_rep']);

    $query = $con->prepare("DELETE FROM repuesto WHERE cod_rep=?");
    $query->bind_param("i", $cod_rep);

    if ($query->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    
    $query->close();
    $con->close();
?>