<?php
session_start();
if (isset($_POST['inputId'])) {
  include_once("dbConection.php");
  $Id = intval($_POST['inputId']);
    $Name = $_POST['inputNam'];
    $Tel = $_POST['inputTel'];
    $Mail = $_POST['inputMail'];

    // Uso de consultas preparadas para prevenir inyección SQL
    $stmt = $conexion->prepare("UPDATE usuarios SET user=?, telefono=?, email=? WHERE id=?");
    $stmt->bind_param("sssi", $Name, $Tel, $Mail, $Id);
    if ($stmt->execute()) {
      $_SESSION['nombre'] = $Name;
    }
    echo "Funciono";
}
