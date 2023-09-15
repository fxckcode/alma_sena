<?php
header('Content-Type: application/json');
function getElements($id) {
    include("dbConection.php");
    $data = $conexion->query("SELECT * FROM elementos as e, categorias as c, tallas as t where e.fk_categoria=c.id AND e.fk_talla=t.id AND id= '$id'");
    return json_encode($data->fetch_object());
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    echo getElements($id);
}