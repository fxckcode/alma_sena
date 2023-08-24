<?php
    session_start();
    
    
    if ($_SESSION['rol'] == "admin") {
        header("Location:../views/entradas.php");
    } if($_SESSION['rol'] == "user") {
        header("Location:../views/home.php");
    }
    

    

?>