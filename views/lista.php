<?php
session_start();
if (empty($_SESSION['id'])) {
  header("Location:salidasPage2.php");
}else{
  if (!empty($_POST["cantSol"])) {
    $id= $_GET['id'];
    $cant= $_POST['cantSol'];
}else {
  header("Location:salidasPage2.php");
}
}
?>