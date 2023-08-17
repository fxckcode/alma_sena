<?php
include("dbConection.php");

$cantidad = intval($_POST['cantidad']);
$idElemento = intval($_POST['idElemento']);
$nota = $_POST['nota'];
$cantidadOld = $conexion->query("SELECT existencias FROM elementos WHERE idElemento=" . $idElemento)->fetch_column();
$newExistencias = intval($cantidadOld) + $cantidad;
if (!empty($nota)) {
    $conexion->query("UPDATE elementos SET existencias = $newExistencias, observacion = '$nota' WHERE idElemento = $idElemento");
  } else {
    $conexion->query("UPDATE elementos SET existencias = $newExistencias WHERE idElemento = $idElemento");
  }
  
  
