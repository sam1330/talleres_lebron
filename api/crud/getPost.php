<?php include 'conexion.php';
$temporal = array();
$resultado = array();

//esto es para traer los codigos
$sql = $con->query("SELECT * FROM snippets ORDER BY id DESC");

while ($a = $sql->fetch_assoc()){
    $temporal = $a;
    array_push($resultado, $temporal);
}

echo json_encode($resultado);//tenemos que pasar esto a JSON para que el axios lo reciba

$sql->close();//cerramos la conexion y consulta porque es lo correcto de hacer
$con->close();
?>