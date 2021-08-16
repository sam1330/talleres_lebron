<?php include "../../main/conexion.php"; 

foreach ($_GET as $campo => $valor) {
    // Esto sirve para traer nombrar las variables en la tabla, esto es para no estar poniendo $user = $_POST['user']; y asi tener que asignar manualmente una variable a los campos que nos mandan de un post
    $var = "$".$campo."='".$valor."';"; 
    eval($var); //La funcion eval sirve para que tomemos literalmente todo como si no estuviera en comillas y poder hacer valida la variable. Very nice no?
}
if(isset($placa)){
    $query = $con->query("SELECT vehiculos.*, clientes.nombre FROM vehiculos LEFT JOIN clientes on vehiculos.id_cli=clientes.id WHERE vehiculos.placa LIKE '%$placa%'");
}else if(isset($nombre)){
    $query = $con->query("SELECT vehiculos.*, clientes.nombre FROM vehiculos LEFT JOIN clientes on vehiculos.id_cli=clientes.id WHERE clientes.nombre LIKE '%$nombre%'");
}else if(isset($marca)){
    $query = $con->query("SELECT vehiculos.*, clientes.nombre FROM vehiculos LEFT JOIN clientes on vehiculos.id_cli=clientes.id WHERE vehiculos.marca LIKE '%$marca%'");
}else if(isset($modelo)){
    $query = $con->query("SELECT vehiculos.*, clientes.nombre FROM vehiculos LEFT JOIN clientes on vehiculos.id_cli=clientes.id WHERE vehiculos.modelo LIKE '%$modelo%'");
} else {
    $query = $con->query("SELECT vehiculos.*, clientes.nombre FROM vehiculos LEFT JOIN clientes on vehiculos.id_cli=clientes.id");
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