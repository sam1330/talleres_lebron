<?php include "../../main/conexion.php";
    foreach ($_POST as $campo => $valor) {
        // Esto sirve para traer nombrar las variables en la tabla, esto es para no estar poniendo $user = $_POST['user']; y asi tener que asignar manualmente una variable a los campos que nos mandan de un post
        $var = "$".$campo."='".$valor."';"; 
        eval($var); //La funcion eval sirve para que tomemos literalmente todo como si no estuviera en comillas y poder hacer valida la variable. Very nice no?
    }
    $query = $con->prepare("INSERT INTO detalle_factura (id_comp, id_cli, id_pag, id_emp, tip_fac, placa_vehiculo, total, fecha) VALUES (?,?,?,?,?,?,?,?)");
    $query->bind_param("iiiissis", $id_comp, $id_cli, $id_pag, $id_emp, $tip_fac, $placa_vehiculo, $total, $fecha);

    // foreach($productos as $product) {
    //   $query2 = $con->prepare("INSERT INTO detalle_factura_vs_producto (id_detalle_factura, id_serv, id_rep, cantidad) VALUES (?,?,?,?)");
    //   $query2->bind_param("iiiii", $product->$num_fact, $product->$id_serv, $product->$cod_rep, $product->$cantidad);
    //   $query2->execute();
    // }

    if ($query->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    $query->close();
    $con->close();
?>