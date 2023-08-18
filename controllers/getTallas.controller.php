<?php
header('Content-Type: application/json');
function getTallas() {
    include("dbConection.php");
    $data = $conexion->query("SELECT * FROM tallas");
    $tallas = [];
    while ($row = $data->fetch_object()) {
        $tallas[] = $row;
    }
    
    return json_encode($tallas);
}

if (isset($_GET['tallas'])) {
    echo getTallas();
}