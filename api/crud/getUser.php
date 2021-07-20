<?php
include '../crud/conexion.php';

$token = $con->real_escape_string(htmlentities($_GET['token']));
$sel = $con->query("SELECT usuario FROM usuarios WHERE token='$token'");
if ($f = $sel->fetch_assoc()) {
    $user = $f['usuario'];
}
echo $user;
?>