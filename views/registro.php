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

<body class="d-flex justify-content-center align-items-center vh-100 bg-image" style="background-image: url('../assets/userBackGround2.jpg'); height: 100vh">
    <div class="formCont p-4 rounded text-secondary shadow" style="width: 32rem">
        <!-- inicio formulario -->
        <form action="" method="post">
            <div class="text-center title fs-1 fw-bold mb-2">Registrar Usuario</div>
            <?php
            include("../controllers/dbConection.php");
            include("../controllers/register.php");
            ?>
            <div class="mb-2 row">
                <div class="col">
                    <label for="uname" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nameInput" name="uname" placeholder="Nombres y Apellidos" required>
                </div>
                <div class="col">
                    <label for="dni" class="form-label">Identificacion</label>
                    <input type="number" class="form-control" id="dniInput" name="dni" placeholder="Identificación" required>
                </div>
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Correo SENA</label>
                <input type="email" class="form-control" id="mailInput" name="email" placeholder="Correo SENA" required>
            </div>

            <div class="mb-2 row">
                <div class="col">
                    <label for="pass" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
                </div>
                <div class="col">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="passConf" placeholder="Confirmar Contraseña" required>
                </div>
            </div>
            <!-- <div class="mb-2">
            </div> -->
            <div class="mb-2">
                <input name="dataSend" class="btn bttn  text-white w-100 mt-2 fw-semibold shadow-sm" type="submit" value="REGISTRAR USUARIO">
            </div>
        </form>
        <!-- fin de formulario -->

        <!-- Volver al inicio - Go home -->
        <div>
            <a href="../index.php" class="text-decoration-none text-success fw-semibold go-back">Volver al inicio</a>
        </div>
    </div>

    <!-- Script para borrar los alerts -->
    <script>
        //AutoCierre
        window.setTimeout(function() {
            $(".alert").fadeTo(2500, 0).slideDown(1000, function() {
                $(this).remove();
            });
        }, 1000); //1 segundo y desaparece
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>