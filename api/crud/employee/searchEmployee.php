<?php include "../../main/conexion.php"; 

foreach ($_GET as $campo => $valor) {
    // Esto sirve para traer nombrar las variables en la tabla, esto es para no estar poniendo $user = $_POST['user']; y asi tener que asignar manualmente una variable a los campos que nos mandan de un post
    $var = "$".$campo."='".$valor."';"; 
    eval($var); //La funcion eval sirve para que tomemos literalmente todo como si no estuviera en comillas y poder hacer valida la variable. Very nice no?
}
if(isset($nombre)){
    $query = $con->query("SELECT * FROM empleados WHERE nombre LIKE '%$nombre%'");
}else if(isset($identificacion)){
    $query = $con->query("SELECT * FROM empleados WHERE identificacion LIKE '%$identificacion%'");
}else if(isset($telefono)){
    $query = $con->query("SELECT * FROM empleados WHERE telefono LIKE '%$telefono%'");
}else if(isset($puesto)){
    $query = $con->query("SELECT * FROM empleados WHERE puesto LIKE '%$puesto%'");
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