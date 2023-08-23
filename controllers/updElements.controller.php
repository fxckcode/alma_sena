<?php

if (!empty($_POST['inputId'])) {
  include("dbConection.php");
  echo "Funciona";
  $Id = intval($_POST['inputId']);  // ←llama el ide que recogió el input oculto en la vista
  $Cat = intval($_POST['categoria']);
  $Name = $_POST['inputName'];
  $Talla = intval($_POST['talla']);
  $Marca = $_POST['inputMarca'];
  $Color = $_POST['inputColor'];
  $Exists = intval($_POST['inputExists']);
  $Nota = $_POST['inputNota'];

  $query = "UPDATE elementos SET fkCategoria=" . $Cat . ", fkTalla=" . $Talla . ", elemento='" . $Name . "', marca='" . $Marca . "', color='" . $Color . "', existencias=" . $Exists . ", observacion='" . $Nota . "' WHERE idElemento=" . $Id;

  mysqli_query($conexion, $query);
}
