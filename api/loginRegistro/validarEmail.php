<?php 
    include '../crud/conexion.php';
    $correo = $con->real_escape_string(htmlentities($_POST['correo']));
    $sel = $con->query("SELECT email FROM usuarios where email='$correo'");
    $num = mysqli_num_rows($sel);
    if ($num == 0) {
        echo 'success';
    } else {
        echo 'fail';
    }
    
?>