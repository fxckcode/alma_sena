<?php
    session_start();
    
    if($_SESSION['rol'] == "user") {
        header("Location:../views/entradas.php");
    }else if ($_SESSION['rol'] == "admin") {
        header("Location:../views/administracion.php");
    }
    

    

?>