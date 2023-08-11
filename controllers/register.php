<?php

if (!empty($_POST["dataSend"])) {
    // 
    if (empty($_POST["uname"]) 
     || empty($_POST["dni"]) 
     || empty($_POST["email"]) 
     || empty($_POST["pass"])) { 
    echo '<div class="alert alert-danger text-center role="alert" id="empty" alert-dismissible">
    Debe rellenar <strong>TODOS</strong> los campos
    </div>';
    
    
    } else {
        if ($_POST['pass'] != $_POST['passConf']) {
            echo '<div class="alert alert-danger text-center" id="match">Las contraseñas no coinciden!</div>';
        }else {

            $usrName=               $_POST['uname'];
            $usrId=                 $_POST['dni'];
            $usrMail=               $_POST['email'];
            $usrPass=           md5($_POST['pass']);

            $query= "INSERT INTO usuarios (id, user, password, email, rol) 
            VALUES ('$usrId', '$usrName', '$usrPass', '$usrMail', 'user')";

            mysqli_query($conexion, $query);
            echo '<div class="alert alert-success text-center">Se registró el usuario.</div>';
    
        }
    }
    
}
    
?>