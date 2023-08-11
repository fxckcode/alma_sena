<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/senaGreen.png" type="image/x-icon">
    <link rel="stylesheet" href="../csss/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../csss/generalStyles.css">
    <title>Registro</title>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-image"
style="background-image: url('../assets/userBackGround2.jpg'); height: 100vh">
    <div class="formCont p-5 rounded-5 text-secondary shadow" style="width: 40rem">
        <div class="d-flex justify-content-center">
            <img src="../assets/login-icon.svg" alt="login-icon" style="height: 4rem" />
        </div>

        

        <!-- inicio formulario -->
        <form action="" method="post">

        <div class="text-center text-white fs-1 fw-bold">Crear Usuarios Cliente</div>

        <?php
        include("../controllers/dbConection.php");
        include("../controllers/user.Create.controller.php");
        ?>
            <div class="form-floating input-group mt-4">
                <div class="input-group-text">
                    <img src="../assets/username-icon.svg" alt="username-icon" style="height: 1rem" />
                </div>
                <input class=" form-control bg-light" name="uname" type="text" id="nameInput" placeholder="" />
                <label for="mailInput" class="form-label px-5">Nombre y Apellido</label>
            </div>
            <div class="form-floating input-group mt-2">
                <div class="input-group-text ">
                    <img src="../assets/username-icon.svg" alt="username-icon" style="height: 1rem" />
                </div>
                <input class=" form-control bg-light" name="dni" type="number" id="dniInput" placeholder="" />
                <label for="mailInput" class="form-label px-5">Identificación</label>
            </div>
            <div class="form-floating input-group mt-2">
                <div class="input-group-text">
                    <img src="../assets/username-icon.svg" alt="username-icon" style="height: 1rem" />
                </div>
                <input class=" form-control bg-light" name="email" type="email" id="mailInput" placeholder="" />
                <label for="mailInput" class="form-label px-5">Correo SENA</label>
            </div>

            <div class="form-floating input-group mt-2">
                <div class="input-group-text">
                    <img src="../assets/password-icon.svg" alt="password-icon" style="height: 1rem" />
                </div>
                <input class="form-control bg-light" name="pass" type="password" placeholder="" />
                <label for="exampleInputPassword1" class="form-label px-5">Contraseña</label>
            </div>
            <div class="form-floating input-group mt-2">
                <div class="input-group-text">
                    <img src="../assets/password-icon.svg" alt="password-icon" style="height: 1rem" />
                </div>
                <input class="form-control bg-light" name="passConf" type="password" placeholder="" />
                <label for="exampleInputPassword1" class="form-label px-5">Confirmar Contraseña</label>
            </div>
            <div>
                <input name="dataSend" class="btn text-white w-100 mt-2 fw-semibold shadow-sm" 
                type="submit" value="REGISTRAR USUARIO">
            </div>
        </form>
        <!-- fin de formulario -->

        <!-- Volver al inicio - Go home -->
        <div>
            <a href="salidas.php" class="text-decoration-none text-success fw-semibold">Ir a salidas</a>
        </div>
    </div>

    <!-- Script para borrar los alerts -->
    <script>
    //AutoCierre
   window.setTimeout(function() {
    $(".alert").fadeTo(2500, 0).slideDown(1000, function(){
        $(this).remove(); 
    });
   }, 1000); //1 segundo y desaparece
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>