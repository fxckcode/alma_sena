<?php
session_start();
if (empty($_SESSION['id'])) {
  header("Location:../index.php");
}
?>

<?php
		include ("../controllers/dbConection.php");
		 ?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="../assets/senaGreen.png"
      type="image/x-icon"
    />
    <!-- BootStrap -->
    <link rel="stylesheet" href="../csss/bootstrap/css/bootstrap.min.css" />
    <title>Movimientos</title>
    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"
    ></script>
  </head>

  <body class="vh-100">
    <!-- Tabs-Pestañas  -->
    <div class="container-fluid">
      <div class="row">
        <div class="btn border-info bg-success text-white mt-4 shadow-sm col-2">
          <a class="nav-link border-primary-subtle" href="usuariosCrear.php"
            >Agregar un nuevo Usuario</a
          >
        </div>
        <div class="col-9 justify-content-center">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a
                class="nav-link border-primary-subtle bg-info-subtle"
                href="entradas.php"
                >Entradas</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link border-primary-subtle bg-info-subtle"
                href="salidas.php"
                >Salidas</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link border-primary-subtle bg-info-subtle"
                href="cambios.php"
                >Cambios</a
              >
            </li>
            <li class="nav-item">
              <p class="nav-link active">Gestionar Usuarios Cliente</p>
            </li>
          </ul>
        </div>
        <!-- Salir-LogOut -->
        <div class="col-1">
          <div>
            <button class="btn btn-danger w-100 mt-4 shadow-sm">
              <a
                class="text-decoration-none text-white"
                href="../controllers/logout.php"
                >Salir</a
              >
            </button>
            <i class="bi bi-box-arrow-left"></i>
          </div>
        </div>
      </div>
    </div>
    <hr />

    <!-- ------------------------------------------------------------------------------------------------------ -->

    <div class="container-fluid row">
      <!-- Formulario de adición -->
      <div class="col-4">
        <!-- Título-Title -->
        <div
          class="w-100 d-flex justify-content-center align-items-center border-primary mb-3"
        >
          <span class="bg-danger rounded p-1 text-white">
            Agregar Usuario para nueva entrega.</span
          >
        </div>

        <?php 
include ("../controllers/clientesCreateController.php");
?>

        <form action="" method="post">
          <div class="input-group mb-3">
            <span
              class="input-group-text bg-success-subtle border-primary"
              id="">Identificación
            </span>
            <input
            type="text"
              class="uDni form-control border-primary"
              name="uDni"
            />
          </div>

          <div class="input-group mb-3">
            <span class="input-group-text bg-success-subtle border-primary"
              >Nombre</span
            >
            <input
              type="text"
              class="uName form-control border-primary"
              name="uName"
            />
          </div>

          <div class="input-group mb-3">
            <span
              class="input-group-text bg-success-subtle border-primary"
              id="">Teléfono
            </span>
            <input
            type="text"
              class="uTel form-control border-primary"
              name="uTel"
            />
          </div>

          <div class="input-group mb-3">
            <span class="input-group-text bg-success-subtle border-primary"
              >Correo</span
            >
            <input
              type="text"
              class="uMail form-control border-primary"
              name="uMail"
            />
          </div>

          <div>
            <input
              class="btn btn-success text-white w-100 mt-2 fw-semibold shadow-sm mb-1"
              name="btnAdd"
              type="submit"
              value="Agregar"
            />
          </div>
        </form>
      </div>
      <!-- Listado de elementos -->
      <div class="col-8">
        <table class="table table-bordered border-primary">
          <thead class="bg-info">
            <tr>
              <th scope="col">Identificacion</th>
              <th scope="col">Nombre</th>
              <th>teléfono</th>
              <th scope="col">Correo</th>
              <th scope="col">Editar/Borrar</th>
            </tr>
          </thead>
          <tbody>
            <?php
		$sqlElm= $conexion->query("SELECT * FROM `usuarios` WHERE rol='cliente'");
            while($tableData= $sqlElm->fetch_object()) { ?>
            <tr>
              <td><?= $tableData->id?></td>
              <td><?= $tableData->user?></td>
              <td><?= $tableData->telefono?></td>
              <td><?= $tableData->email?></td>
              <td>
                <!-- Botón editar -->
                <a
                  class="btn btn-small btn-warning"
                  href="usuariosEditar.php?id=<?= $tableData->id?>"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-pencil-square"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
                    />
                    <path
                      fill-rule="evenodd"
                      d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"
                    />
                  </svg>
                </a>
                <!-- Botón eliminar -->
                <a
                  onclick="return eliminar()"
                  class="btn btn-small btn-danger"
                  href="usuariosGestionar.php?usrId=<?= $tableData->id?>"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-trash"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"
                    />
                    <path
                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"
                    />
                  </svg>
                </a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

    <hr />
    <!-- fin de formulario -->

    <!-- Script para borrar los alerts -->
    <script>
      //AutoCierre
      window.setTimeout(function () {
        $(".alert")
          .fadeTo(2500, 0)
          .slideDown(1000, function () {
            $(this).remove();
          });
      }, 2000); //2 segundos y desaparece
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    

    <!-- ↓Script para confirmar eliminar elemento -->
    <script>
      function eliminar() {
        var confirmar = confirm(
          "Está apunto de eliminar un registro, esta acción no se puede deshacer. Está seguro?"
        );
        return respuesta;
      }
    </script>
  </body>
</html>
