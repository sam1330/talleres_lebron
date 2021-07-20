<?php include 'conexion.php';
//esto es para pasar los valores a la pagina EDITAR
$id = $con->real_escape_string(htmlentities($_GET['id']));
$temporal = array();
$resultado = array();


$sql = $con->query("SELECT * FROM snippets WHERE id='$id' ");

if ($a = $sql->fetch_assoc()){
    $temporal = $a;
    array_push($resultado, $temporal);
}

echo json_encode($resultado[0]);

$sql->close();
$con->close();
?>