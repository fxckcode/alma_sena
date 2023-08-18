<?php
header('Content-Type: application/json');
function getCategorias() {
    include("dbConection.php");
    $data = $conexion->query("SELECT * FROM categorias");
    $categorias = [];
    while ($row = $data->fetch_object()) {
        $categorias[] = $row;
    }
    
    return json_encode($categorias);
}

if (isset($_GET['categorias'])) {
    echo getCategorias();
}