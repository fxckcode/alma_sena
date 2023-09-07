<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/senaGreen.png" type="image/x-icon">
    <link rel="stylesheet" href="./csss/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./csss/generalStyles.css">
    <title>almaSena</title>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-image" style="background-image: url('./assets/inventoryView.webp'); height: 100vh">

    <div>
        <div class="size-5 text-center title fs-2 fw-bold "><strong>Inicio de Sesión</strong></div>
        <div class="logoSena d-flex justify-content-center">
            <img src="./assets/loginIconGreen.svg" alt="login-icon" style="height: 5rem" />
        </div>
        <div class="formCont p-5 rounded-2 text-secondary shadow" style="width: 25rem">
            <?php
            include("controllers/dbConection.php");
            include("controllers/login.php");
            ?>
            <!-- inicio formulario -->
            <form action="" method="post">

                <div class="mb-3">
                    <label for="email" class="form-label">Correo SENA</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo SENA" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                </div>

                <div>
                    <input name="dataSend" class="bttn btn w-100 text-white mt-1 fw-semibold" type="submit" value="Iniciar Sesión">
                </div>

                <div class="d-flex gap-1 justify-content-center mt-1">
                    <div>No está registrado?</div>
                    <a class="text-decoration-none fw-semibold" href="./views/registro.php">Regístrese aquí.</a>
                </div>
            </form>
            <!-- fin de formulario -->
        </div>
    </div>
    </div>

    <script>
        //Autoclose
        window.setTimeout(function() {
            $(".alert").fadeTo(2500, 0).slideDown(1000, function() {
                $(this).remove();
            });
        }, 1000); //1 segundo y desaparece
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>