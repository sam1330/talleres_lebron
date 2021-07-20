<?php
    header('Access-Control-Allow-Origin: *');
    // $con = new mysqli("localhost", "id15911985_root", "M@riana301300", "id15911985_webpack");
    $con = new mysqli("localhost", "root", "", "sistema");
    if ($con->connect_errno) {
        die("La conexion con el servidor no pudo establecerse");
    }
?>