<?php
include '../crud/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

    //AQUI TOMAMOS LOS DATOS DEL FORMULARIO DE REGISTRO
    $usuario = $con->real_escape_string(htmlentities($_POST['usuario']));
    $email = $con->real_escape_string(htmlentities($_POST['email']));
    $pass = $con->real_escape_string(htmlentities($_POST['pass']));

    //ESTO ES PARA LA IMAGEN
    $extension = '';
    $ruta = 'http://localhost/snippets/api/loginRegistro/foto_perfil'; // donde se guardara
    $archivo = $_FILES['foto']['tmp_name']; // informacion temporal
    $nombrearchivo = $_FILES['foto']['name']; // nombre del archivo
    $info = pathinfo($nombrearchivo); // informacion del archivo

    if ($archivo != '') {
        $extension = $info['extension'];
        
        if ($extension == 'png' || $extension == 'PNG' || $extension == 'jpg' || $extension == 'JPG') {
            $nombreFile = $usuario.rand(0000,9999).'.'.$extension;
            move_uploaded_file($archivo,'foto_perfil/'.$nombreFile);
            $ruta = $ruta.'/'.$nombreFile;
        } else {
            echo 'fail';
            exit;
        }
        
    } else {
        $ruta = 'http://localhost/snippets/api/loginRegistro/foto_perfil/perfil.png';
    }

    $passEncriptada = password_hash($pass, PASSWORD_BCRYPT);
    $sql = $con->query("INSERT INTO usuarios VALUES(default, '$usuario', '$email', '$passEncriptada', '$ruta', null)");

    if ($sql) {
        echo "success";
    } else {
        echo "fail";
    }
    
    
} else {
    header('location: ../../index.php');
}


?>