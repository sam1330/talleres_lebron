<?php include "../../main/conexion.php"; 

foreach ($_GET as $campo => $valor) {
    // Esto sirve para traer nombrar las variables en la tabla, esto es para no estar poniendo $user = $_POST['user']; y asi tener que asignar manualmente una variable a los campos que nos mandan de un post
    $var = "$".$campo."='".$valor."';"; 
    eval($var); //La funcion eval sirve para que tomemos literalmente todo como si no estuviera en comillas y poder hacer valida la variable. Very nice no?
}
if(isset($detalle)){
    $query = $con->query("SELECT * FROM servicio WHERE detalle LIKE '%$detalle%'");
}else if(isset($id_ser)){
    $query = $con->query("SELECT * FROM servicio WHERE id_ser LIKE '%$id_ser%'");
}else if(isset($precio)){
    $query = $con->query("SELECT * FROM servicio WHERE precio LIKE '%$precio%'");
}else if(isset($dificultad)){
    $query = $con->query("SELECT * FROM servicio WHERE dificultad LIKE '%$dificultad%'");
} else {
    $query = $con->query("SELECT * FROM servicio");
}


$temporal = array();
$resultado = array();


while ($a = $query->fetch_assoc()){
    $temporal = $a;
    array_push($resultado, $temporal);
}

echo json_encode($resultado);

$query->close();
$con->close();

?>