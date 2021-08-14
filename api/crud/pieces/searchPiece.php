<?php include "../../main/conexion.php"; 

foreach ($_GET as $campo => $valor) {
    // Esto sirve para traer nombrar las variables en la tabla, esto es para no estar poniendo $user = $_POST['user']; y asi tener que asignar manualmente una variable a los campos que nos mandan de un post
    $var = "$".$campo."='".$valor."';"; 
    eval($var); //La funcion eval sirve para que tomemos literalmente todo como si no estuviera en comillas y poder hacer valida la variable. Very nice no?
}
if(isset($detalle)){
    $query = $con->query("SELECT repuesto.cod_rep, repuesto.detalle, repuesto.existencia, repuesto.reorden, repuesto.id_cat, repuesto.id_prov, repuesto.id_alm, repuesto.prec_com, repuesto.prec_ven, proveedor.nombre, categoria.descripcion as cat_desc, almacen.descripcion AS alm_desc FROM repuesto LEFT JOIN proveedor on repuesto.id_prov=proveedor.id_prov LEFT JOIN categoria ON categoria.id_cat=repuesto.id_cat LEFT JOIN almacen ON almacen.id_alm=repuesto.id_alm WHERE repuesto.detalle LIKE '%$detalle%'");
}else if(isset($cod_rep)){
    $query = $con->query("SELECT repuesto.cod_rep, repuesto.detalle, repuesto.existencia, repuesto.reorden, repuesto.id_cat, repuesto.id_prov, repuesto.id_alm, repuesto.prec_com, repuesto.prec_ven, proveedor.nombre, categoria.descripcion as cat_desc, almacen.descripcion AS alm_desc FROM repuesto LEFT JOIN proveedor on repuesto.id_prov=proveedor.id_prov LEFT JOIN categoria ON categoria.id_cat=repuesto.id_cat LEFT JOIN almacen ON almacen.id_alm=repuesto.id_alm WHERE repuesto.cod_rep LIKE '%$cod_rep%'");
}else if(isset($proveedor)){
    $query = $con->query("SELECT repuesto.cod_rep, repuesto.detalle, repuesto.existencia, repuesto.reorden, repuesto.id_cat, repuesto.id_prov, repuesto.id_alm, repuesto.prec_com, repuesto.prec_ven, proveedor.nombre, categoria.descripcion as cat_desc, almacen.descripcion AS alm_desc FROM repuesto LEFT JOIN proveedor on repuesto.id_prov=proveedor.id_prov LEFT JOIN categoria ON categoria.id_cat=repuesto.id_cat LEFT JOIN almacen ON almacen.id_alm=repuesto.id_alm WHERE proveedor.nombre LIKE '%$proveedor%'");
}else if(isset($id_alm)){
    $query = $con->query("SELECT * FROM repuesto WHERE id_alm LIKE '%$id_alm%'");
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