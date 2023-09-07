<?php

include("dbConection.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $elementos = [];
    $datasql = $conexion->query("SELECT m.idMovimiento, m.cantidad, m.fecha, m.observacion, e.elemento, e.marca, t.tallas FROM movimiento as m 
                     JOIN elementos as e ON m.elemento=e.idElemento
                     JOIN tallas as t ON e.fkTalla=t.idTalla WHERE m.tomador=".$id);

    while ($element = $datasql->fetch_assoc()) {
        $elementos[] = $element;
    }

    echo json_encode($elementos);
}


if (isset($_GET['fecha'])) {
    $fecha = $_GET['fecha'];
    $elementos = [];
    $datasql = $conexion->query("SELECT m.idMovimiento, m.cantidad, m.fecha, m.observacion, e.elemento, e.marca, t.tallas, u.*, m.ficha FROM movimiento as m 
                     JOIN elementos as e ON m.elemento=e.idElemento
                     JOIN tallas as t ON e.fkTalla=t.idTalla 
                     JOIN usuarios as u ON u.id = m.tomador
                     WHERE m.fecha='".$fecha."'");
    while ($element = $datasql->fetch_assoc()) {
        $elementos[] = $element;
    }

    echo json_encode($elementos);              
}