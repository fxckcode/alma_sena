<?php
include("dbConection.php");

if (isset($_POST['id'])) {

    $id = intval($_POST['id']);

    $sql = $conexion->query("INSERT INTO carrito(fk_elemento) VALUES (" . $id . ")");
    echo $sql;
}

if (isset($_POST['btnDel'])) {
    $id = intval($_POST['btnDel']);

    $sql = $conexion->query("DELETE FROM carrito WHERE carrito.fk_elemento=" . $id);
    echo $sql;
}

if (isset($_POST['clienteId'])) {
    $clienteId = intval($_POST['clienteId']);
    $elemento = intval($_POST['elementoId']);
    $cantidad = intval($_POST['cantidad']);
    $ficha = intval($_POST['ficha']);
    $observacion = $_POST['observacion'];
    $fecha = date('Y-m-d');
    $tipo = 1;



    $stmt = $conexion->prepare("INSERT INTO movimiento(tipo_movimiento, tomador, elemento, ficha, cantidad, observacion, fecha) VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("iiiiiss", $tipo, $clienteId, $elemento, $ficha, $cantidad, $observacion, $fecha);

    if ($stmt->execute()) {
        echo "Registro insertado exitosamente";
        $updateStmt = $conexion->prepare("UPDATE elementos SET existencias = existencias - ? WHERE id = ?");
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
