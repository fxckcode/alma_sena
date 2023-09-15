<?php

include("dbConection.php");

if (isset($_GET['id']) && !isset($_GET['fecha'])) {
    $id = intval($_GET['id']);
    $elementos = [];
    $datasql = $conexion->query("SELECT m.id, m.cantidad, m.fecha, m.observacion, e.elemento, e.marca, t.tallas FROM movimiento as m 
                     JOIN elementos as e ON m.elemento=e.id
                     JOIN tallas as t ON e.fk_talla=t.id WHERE m.tomador=".$id);

    while ($element = $datasql->fetch_assoc()) {
        $elementos[] = $element;
    }

    echo json_encode($elementos);
}


if (isset($_GET['fecha'])  && !isset($_GET['id'])) {
    $fecha = $_GET['fecha'];
    $elementos = [];
    $datasql = $conexion->query("SELECT m.id, m.cantidad, m.fecha, m.observacion, e.elemento, e.marca, t.tallas, u.*, m.ficha, m.tipo_movimiento FROM movimiento as m 
                     JOIN elementos as e ON m.elemento=e.id
                     JOIN tallas as t ON e.fk_talla=t.id 
                     JOIN usuarios as u ON u.id = m.tomador
                     WHERE m.fecha='".$fecha."'");
    while ($element = $datasql->fetch_assoc()) {
        $elementos[] = $element;
    }

    echo json_encode($elementos);              
}

if (isset($_GET['id']) && isset($_GET['fecha']) && isset($_GET['ficha'])) {
    $fecha = $_GET['fecha'];
    $id = intval($_GET['id']);
    $ficha = intval($_GET['ficha']);
    $elementos = [];
    $sql = $conexion->query("SELECT e.marca, m.*, t.tallas as talla, e.elemento as elemento, c.nombre, e.fk_categoria FROM movimiento as m
                            JOIN elementos as e ON m.elemento = e.id 
                            JOIN tallas as t ON e.fk_talla=t.id
                            JOIN categorias as c ON e.fk_categoria = c.id
                            WHERE m.tomador=".$id." AND m.fecha='".$fecha."' AND m.ficha=".$ficha);
    while ($element = $sql->fetch_assoc()) {
        $elementos[] = $element;
    }
    echo json_encode($elementos);
}