<?php
header('Content-Type: application/json');
function getElements($id) {
    include("dbConection.php");
    $data = $conexion->query("SELECT * FROM elementos as e, categorias as c, tallas as t where e.fkCategoria=c.id AND e.fkTalla=t.idTalla AND idElemento= '$id'");
    return json_encode($data->fetch_object());
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    echo getElements($id);
}