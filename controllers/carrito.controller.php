<?php
include("dbConection.php");

if (isset($_POST['idElemento'])) {

    $idElemento = intval($_POST['idElemento']);

    $sql = $conexion->query("INSERT INTO carrito(fkElemento) VALUES (".$idElemento.")");
    echo $sql;
}

if (isset($_POST['btnDel'])) {
    $idElemento = intval($_POST['btnDel']);

    $sql = $conexion->query("DELETE FROM carrito WHERE carrito.fkElemento=".$idElemento);
    echo $sql;
}

if (isset($_POST['clienteId'])) {
    $clienteId = intval($_POST['clienteId']);
    $elemento = intval($_POST['elementoId']);
    $cantidad = intval($_POST['cantidad']);
    $fecha = date('Y-m-d');

    // Usando sentencias preparadas
    $stmt = $conexion->prepare("INSERT INTO movimiento(tomador, elemento, cantidad, fecha) VALUES (?, ?, ?, ?)");

    // Vincular parámetros
    $stmt->bind_param("iiis", $clienteId, $elemento, $cantidad, $fecha);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Registro insertado exitosamente";
        $updateStmt = $conexion->prepare("UPDATE elementos SET existencias = existencias - ? WHERE idElemento = ?");
        $updateStmt->bind_param("ii", $cantidad, $elemento);

        if ($updateStmt->execute()) {
            echo "\nCantidad actualizada exitosamente";
        } else {
            echo "\nError al actualizar la cantidad: " . $updateStmt->error;
        }

        $updateStmt->close();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar sentencia
    $stmt->close();
}