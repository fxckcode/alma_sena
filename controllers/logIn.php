<?php
session_start();
    if (!empty($_POST["dataSend"])) {
        if (empty($_POST["email"]) 
         || empty($_POST["password"]))
          { 
        echo '<div class="alert alert-danger text-center role="alert" id="empty" alert-dismissible">Debe rellenar <strong>TODOS</strong> los campos
        </div>';
        } else {
                $inputMail=               $_POST['email'];
                $inputPass=           md5($_POST['password']);
    
                $sql=$conexion->query("SELECT * FROM usuarios WHERE email= '$inputMail' AND password= '$inputPass'");
                if ($userData= $sql->fetch_object()) {
                    $_SESSION["id"]=$userData->id;
                    $_SESSION["nombre"]=$userData->user;
                    $_SESSION ['rol'] = $userData->rol;
                     header("Location:./controllers/panel.php");
                } else {
                    echo '<div class="alert alert-danger text-center role="alert"  alert-dismissible"><strong>Acceso denegado</strong></div>';
                }
                

                
            
        }
        
    }
