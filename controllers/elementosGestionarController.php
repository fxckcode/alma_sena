<?php

if (!empty($_POST["btnAdd"])) {
    // 
    if ( empty($_POST["uDni"]) 
     ||empty($_POST["uName"]) 
     || empty($_POST["uMail"])) { 
    echo '<div class="alert alert-danger text-center role="alert" id="empty" alert-dismissible">
    Debe rellenar <strong>TODOS</strong> los campos
    </div>';
    
    
    } else {
        

            $usrId=                 $_POST['uDni'];
            $usrName=               $_POST['uName'];
            $usrMail=               $_POST['uMail'];

            $query= "INSERT INTO usuarios (id, user, email, rol) 
            VALUES ('$usrId', '$usrName', '$usrMail', 'cliente')";

            mysqli_query($conexion, $query);
            header ("Location:../views/usuariosGestionar.php");
            echo '<div class="alert alert-success text-center">Se registró el usuario.</div>';
    
        }
    }

if (isset($_POST['estado'])) {
    include("./dbConection.php");
    $id = intval($_POST['id']);
    $estado = $_POST['estado'];
    if ($estado == "desactivar") {
        $conexion->query("UPDATE elementos SET estado=2 WHERE idElemento=".$id);
        echo "Elemento desactivado";
    } else if ($estado == "activar") {
        $conexion->query("UPDATE elementos SET estado=1 WHERE idElemento=".$id);
        echo "Elemento activado";
    }
}

    
?>