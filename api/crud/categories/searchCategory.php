<?php include "../../main/conexion.php"; 

foreach ($_GET as $campo => $valor) {
    // Esto sirve para traer nombrar las variables en la tabla, esto es para no estar poniendo $user = $_POST['user']; y asi tener que asignar manualmente una variable a los campos que nos mandan de un post
    $var = "$".$campo."='".$valor."';"; 
    eval($var); //La funcion eval sirve para que tomemos literalmente todo como si no estuviera en comillas y poder hacer valida la variable. Very nice no?
}
if(isset($descripcion)){
    $query = $con->query("SELECT * FROM categoria WHERE descripcion LIKE '%$descripcion%'");
}else if(isset($id_cat)){
    $query = $con->query("SELECT * FROM categoria WHERE id_cat LIKE '%$id_cat%'");
} else {
    $query = $con->query("SELECT * FROM categoria");
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