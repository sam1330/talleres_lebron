<?php include 'conexion.php';
    foreach ($_POST as $campo => $valor) {
        // Esto sirve para traer nombrar las variables en la tabla, esto es para no estar poniendo $user = $_POST['user']; y asi tener que asignar manualmente una variable a los campos que nos mandan de un post
        $var = "$".$campo."='".$valor."';"; 
        eval($var); //La funcion eval sirve para que tomemos literalmente todo como si no estuviera en comillas y poder hacer valida la variable. Very nice no?
    }

    //aqui prepararemos la consulta
    $sql = $con->prepare("UPDATE snippets SET titulo=?, codigo=?, descripcion=?, categoria=? WHERE id=?");
    $sql->bind_param("ssssi", $titulo, $codigo, $descripcion, $categoria, $id);

    if ($sql->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    $sql->close();
    $con->close();
?>