<?php include 'conexion.php';
    foreach ($_POST as $campo => $valor) {
        // Esto sirve para traer nombrar las variables en la tabla, esto es para no estar poniendo $user = $_POST['user']; y asi tener que asignar manualmente una variable a los campos que nos mandan de un post
        $var = "$".$campo."='".$valor."';"; 
        eval($var); //La funcion eval sirve para que tomemos literalmente todo como si no estuviera en comillas y poder hacer valida la variable. Very nice no?
    }

    //aqui tomamos los datos de la variable sesion, que son los que ya habiamos iniciado sesion y no tener que hacer consulta para mandar a llamar el usuario y la foto
    $id = null;
    $sel = $con->query("SELECT usuario, foto FROM usuarios WHERE token='$token'");
    if ($f = $sel->fetch_assoc()) {
        $user = $f['usuario'];
        $foto = $f['foto'];
    }
    //aqui prepararemos la consulta
    $sql = $con->prepare("INSERT INTO snippets VALUES (?,?,?,?,?,?,?)");
    $sql->bind_param("issssss", $id, $user, $foto, $titulo, $codigo, $descripcion, $categoria);

    if ($sql->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    $sql->close();
    $con->close();
?>