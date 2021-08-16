<?php  include "../../main/conexion.php";

    $id_cat = htmlentities($_GET['id_cat']);

    $query = $con->prepare("DELETE FROM categoria WHERE id_cat=?");
    $query->bind_param("i", $id_cat);

    if ($query->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    
    $query->close();
    $con->close();
?>