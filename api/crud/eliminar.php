<?php
    include 'conexion.php';

    $id = htmlentities($_GET['id']);

    $sql = $con->prepare("DELETE FROM snippets WHERE id=?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    
    $sql->close();
    $con->close();
?>