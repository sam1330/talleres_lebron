<?php include "../../main/conexion.php"; 

$temporal = array();
$resultado = array();

$query = $con->query("SELECT id_empleado, usuario, rol FROM usuarios");

while ($a = $query->fetch_assoc()){
    $temporal = $a;
    array_push($resultado, $temporal);
}

echo json_encode($resultado);

$query->close();
$con->close();

?>