<?php include "../../main/conexion.php"; 

foreach ($_GET as $campo => $valor) {
    // Esto sirve para traer nombrar las variables en la tabla, esto es para no estar poniendo $user = $_POST['user']; y asi tener que asignar manualmente una variable a los campos que nos mandan de un post
    $var = "$".$campo."='".$valor."';"; 
    eval($var); //La funcion eval sirve para que tomemos literalmente todo como si no estuviera en comillas y poder hacer valida la variable. Very nice no?
}
if(isset($usuario)){
    $query = $con->query("SELECT * FROM usuarios WHERE usuario LIKE '%$usuario%'");
}else if(isset($id_empleado)){
    $query = $con->query("SELECT * FROM usuarios WHERE id_empleado LIKE '%$id_empleado%'");
}else if(isset($rol)){
    $query = $con->query("SELECT * FROM usuarios WHERE rol LIKE '%$rol%'");
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