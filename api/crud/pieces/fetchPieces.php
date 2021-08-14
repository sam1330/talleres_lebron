<?php include "../../main/conexion.php"; 

$temporal = array();
$resultado = array();

$query = $con->query("SELECT repuesto.cod_rep, repuesto.detalle, repuesto.existencia, repuesto.reorden, repuesto.id_cat, repuesto.id_prov, repuesto.id_alm, repuesto.prec_com, repuesto.prec_ven, proveedor.nombre, categoria.descripcion as cat_desc, almacen.descripcion AS alm_desc FROM repuesto LEFT JOIN proveedor on repuesto.id_prov=proveedor.id_prov LEFT JOIN categoria ON categoria.id_cat=repuesto.id_cat LEFT JOIN almacen ON almacen.id_alm=repuesto.id_alm");

while ($a = $query->fetch_assoc()){
    $temporal = $a;
    array_push($resultado, $temporal);
}

echo json_encode($resultado);

$query->close();
$con->close();

?>