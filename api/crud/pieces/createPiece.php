<?php include "../../main/conexion.php";
    foreach ($_POST as $campo => $valor) {
        // Esto sirve para traer nombrar las variables en la tabla, esto es para no estar poniendo $user = $_POST['user']; y asi tener que asignar manualmente una variable a los campos que nos mandan de un post
        $var = "$".$campo."='".$valor."';"; 
        eval($var); //La funcion eval sirve para que tomemos literalmente todo como si no estuviera en comillas y poder hacer valida la variable. Very nice no?
    }
    $query = $con->prepare("INSERT INTO repuesto (detalle, existencia, reorden, id_cat, prec_com, precio, id_prov, id_alm) VALUES (?,?,?,?,?,?,?,?)");
    $query->bind_param("siiiiiii", $detalle, $existencia, $reorden, $id_cat, $prec_com, $precio, $id_prov, $id_alm);

    if ($query->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    $query->close();
    $con->close();
?>