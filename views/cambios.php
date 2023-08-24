<?php
session_start();
if (empty($_SESSION['id'])) {
  header("Location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../assets/senaGreen.png" type="image/x-icon">
  <link rel="stylesheet" href="../csss/bootstrap/css/bootstrap.min.css">
  <title>Movimientos</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-success-subtle p-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
      <?php
        echo "Hola, ";
        echo $_SESSION["nombre"];
        ?>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto ">
          <li class="nav-item">
            <a class="nav-link mx-2" href="entradas.php">Entradas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="salidas.php">Salidas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 active" aria-current="page" href="#">Cambios</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto d-none d-lg-inline-flex">
          <li class="nav-item mx-2">
            <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-google-plus-square"></i></a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-twitter"></i></a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-facebook-square"></i></a>
          </li>
        </ul>
      </div>
      <div>
        <button class="btn btn-danger shadow-sm">
          <a class="text-decoration-none text-white" href="../controllers/logout.php">Cerrar Sesión</a>
        </button>
        <i class="bi bi-box-arrow-left"></i>
      </div>
    </div>
  </nav>
  <hr>
  <div class="container-fluid d-flex justify-content-center align-items-center input-group mb-3">
    <div class="mb-3 input-group-prepend">
      <span class="bg-danger text-white p-2 rounded" for="selectr" type="text">Para comenzar seleccione una categoría de
        Elemento a ingresar.</span>

      <!-- size="3" para tipo scroll bar-->
      <select class="form-select" name="elements" id="selectr">
        <option value="1">Cabeza</option>
        <option value="2">Ojos</option>
        <option value="3">Oidos</option>
        <option value="4">Respiratorio</option>
        <option value="5">cuerpo</option>
        <option value="6">Manos</option>
        <option value="7">Pies</option>
      </select>
    </div>
  </div>



  <div class="d-flex justify-content-center align-items-center vh-100">
    <div class=" p-5 rounded-5 text-secondary shadow" style="width: 50rem">

      <!-- inicio formulario -->
      <form action="#" method="post">
        <div class="form-floating input-group mt-4">
          <input class=" form-control bg-light" name="elmCode" type="text" id="codeInput" placeholder="" />
          <label for="codeInput" class="form-label px-5">Código de Elemento</label>
        </div>

        <div class="form-floating input-group mt-4">
          <select class="form-select" name="elements" id="selectr">
            <option value="1">Nombre de elemnto</option>
            <option value="2">Botas Puntera</option>
            <option value="3">Tapa</option>
            <option value="4">Oidos</option>
            <option value="5">Respiratorio</option>
            <option value="6">cuerpo</option>
            <option value="7">Manos</option>
            <option value="8">Pies</option>
          </select>
          <!-- <label for="mailInput" class="form-label px-5">Nombre</label> -->
        </div>

        <div class="form-floating input-group mt-4">
          <select class="form-select bg-light" name="elements" id="selectr">
            <option value="1">Marca</option>
            <option value="2">Cabeza</option>
            <option value="3">Ojos</option>
            <option value="4">Oidos</option>
            <option value="5">Respiratorio</option>
            <option value="6">cuerpo</option>
            <option value="7">Manos</option>
            <option value="8">Pies</option>
          </select>
        </div>

        <div class="form-floating input-group mt-4">
          <select class="form-select" name="elements" id="selectr">
            <option value="1">Talla</option>
            <option value="2">Cabeza</option>
            <option value="3">Ojos</option>
            <option value="4">Oidos</option>
            <option value="5">Respiratorio</option>
            <option value="6">cuerpo</option>
            <option value="7">Manos</option>
            <option value="8">Pies</option>
          </select>
        </div>

        <div class="form-floating input-group mt-4">
          <select class="form-select bg-light" name="elements" id="selectr">
            <option value="1">Color</option>
            <option value="2">Cabeza</option>
            <option value="3">Ojos</option>
            <option value="4">Oidos</option>
            <option value="5">Respiratorio</option>
            <option value="6">cuerpo</option>
            <option value="7">Manos</option>
            <option value="8">Pies</option>
          </select>
        </div>

        <div class="form-floating input-group mt-4">
          <input class=" form-control" name="cantidad" type="number" id="amount" placeholder="" />
          <label for="amount" class="form-label px-5">Cantidad</label>
        </div>

        <div class="form-floating input-group mt-4">
          <textarea class=" form-control bg-light" name="obsrvn" type="text" id="obsrvn" placeholder=""></textarea>
          <label for="obsrvn" class="form-label px-5">Observaciones</label>
        </div>

        <div>
          <button class="btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm" type="submit">Agregar a
            inventario</button>
        </div>

      </form>
      <!-- fin de formulario -->
    </div>
    <script src="../csss/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>