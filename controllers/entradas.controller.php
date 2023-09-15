<?php
include("dbConection.php");
session_start();
$cantidad = intval($_POST['cantidad']);
$id = intval($_POST['id']);
$nota = $_POST['nota'];
$cantidadOld = $conexion->query("SELECT existencias FROM elementos WHERE id=" . $id)->fetch_column();
$newExistencias = intval($cantidadOld) + $cantidad;
if (!empty($nota)) {
  $conexion->query("UPDATE elementos SET existencias = $newExistencias, observacion = '$nota' WHERE id = $id");
} else {
  $conexion->query("UPDATE elementos SET existencias = $newExistencias WHERE id = $id");
}

$clienteId = intval($_SESSION['id']);
$fecha = date('Y-m-d');
$tipo = 2;



$stmt = $conexion->prepare("INSERT INTO movimiento(tipo_movimiento, tomador, elemento, cantidad, fecha) VALUES (?, ?, ?, ?, ?)");

$stmt->bind_param("iiiis", $tipo, $clienteId, $id, $cantidad, $fecha);

if ($stmt->execute()) {
  echo "Registro insertado exitosamente";
} else {
  echo "Error: " . $stmt->error;
}

// Cerrar sentencia
$stmt->close();