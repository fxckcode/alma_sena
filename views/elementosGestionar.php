<?php
session_start();
if (empty($_SESSION['id'])) {
  header("Location:../index.php");
}
?>

<?php
include("../controllers/dbConection.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/senaGreen.png" type="image/x-icon" />
  <!-- BootStrap -->
  <link rel="stylesheet" href="../csss/bootstrap/css/bootstrap.min.css" />
  <title>Movimientos</title>
  <script src="../utils//jquery/jquery-3.7.0.min.js"></script>
  <script src="../utils/package/dist/sweetalert2.all.min.js"></script>
  <script src="../utils/package/dist/sweetalert2.min.css"></script>
  <link rel="stylesheet" href="../csss/DataTables/datatables.min.css">
</head>

<body class="vh-100">
  <!-- Tabs-Pestañas  -->
  <div class="container-fluid">
    <div class="row">
      <div class="btn border-info bg-success text-white mt-4 shadow-sm col-2">
        <?php
        echo $_SESSION["nombre"]
        ?>
      </div>
      <div class="col-9 justify-content-center">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link border-primary-subtle bg-info-subtle" href="entradas.php">Entradas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link border-primary-subtle bg-info-subtle" href="salidas.php">Salidas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link border-primary-subtle bg-info-subtle" href="cambios.php">Cambios</a>
          </li>
          <li class="nav-item">
            <p class="nav-link active">Agregar elementos al inventario</p>
          </li>
        </ul>
      </div>
      <!-- Salir-LogOut -->
      <div class="col-1">
        <div>
          <button class="btn btn-danger w-100 mt-4 shadow-sm">
            <a class="text-decoration-none text-white" href="../controllers/logout.php">Salir</a>
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
      <!-- <div
          class="w-100 d-flex justify-content-center align-items-center border-primary mb-3"
        >
          <span class="bg-danger rounded p-1 text-white">
            Agregar Usuario para nueva entrega.</span
          >
        </div> -->

      <?php
      include("../controllers/elementosGestionarController.php");
      ?>

      <div class="p-3 shadow rounded">
        <h4 class="text-success fw-bold text-center">Crear un nuevo Elemento</h4>
        <br>
        <form action="../controllers/addElements.controller.php" method="post">
          <div class="input-group mb-3">
            <span class="input-group-text bg-success-subtle border-primary" id="">Categoría</span>
            <select class="listaCat form-select pe-5 border-primary" id="listaCat" name="listaCat">
              <?php 
                $sqlCategorias = $conexion->query("SELECT * FROM categorias WHERE 1");
                while ($categorias = $sqlCategorias->fetch_object()) {
              ?>
                <option value="<?= $categorias->idCategoria ?>"><?= $categorias->nombreCat ?></option>
              <?php } ?>
            </select>
          </div>

          <!-- contenedor para el select nombre -->
          <div class="input-group mb-3" id="select2lista" name="select2lista"></div>
          <div class="input-group mb-3">
            <span class="input-group-text bg-success-subtle border-primary">Nueva Categoría</span>
            <input type="text" class="listaCant form-control border-primary" name="listaCant" />
          </div>

          <!-- contenedor para el select nombre -->
          <div class="input-group mb-3" id="select2lista" name="select2lista"></div>
          <div class="input-group mb-3">
            <span class="input-group-text bg-success-subtle border-primary">Talla</span>
            <input type="text" class="form-control border-primary" name="talla">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text bg-success-subtle border-primary">Marca</span>
            <input type="text" class="form-control border-primary" name="marca">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text bg-success-subtle border-primary">color</span>
            <input type="text" class="form-control border-primary" name="color">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text bg-success-subtle border-primary">Cantidad</span>
            <input type="text" class="listaCant form-control border-primary" name="listaCant" />
          </div>

          <div class="input-group">
            <span class="input-group-text bg-success-subtle border-primary">Nota:</span>
            <textarea class="listaNota form-control border-primary" name="nota" aria-label="With textarea"></textarea>
          </div>

          <div>
            <input class="btn btn-success text-white w-100 mt-2 fw-semibold shadow-sm mb-1" name="btnAdd" type="submit" value="Agregar" />
          </div>
        </form>
      </div>

      <br>
      <div class="p-3 shadow rounded">
        <h4 class="text-uppercarse text-primary fw-bold text-center">Añadir Categorias</h4>
        <br>
        <form id="formAddCategoria" method="post">
          <div class="input-group">
            <span class="input-group-text bg-success-subtle border-primary">Nueva Categoría</span>
            <input type="text" class="form-control border-primary" name="nombre" required id="nombreCategoria" />
          </div>
          <input class="btn btn-success text-white w-100 mt-2 fw-semibold shadow-sm mb-1" name="btnAddCategoria" type="submit" value="Crear Categoría" id="btnAddCategoria" />
        </form>
      </div>
    </div>
    <!-- ------------------------------------------------------------------------------------------------------ -->

    <!-- Listado de elementos -->
    <div class="col-8">
      <table class="table table-striped table-bordered" id="tableInventario">
        <thead class="bg-info">
          <tr>
            <th scope="col">Categoría</th>
            <th scope="col">Elemento</th>
            <th scope="col">Talla</th>
            <th scope="col">Marca</th>
            <th scope="col">Color</th>
            <th scope="col">Existencias</th>
            <th scope="col">Observación</th>
            <th scope="col">Edición</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sqlElm = $conexion->query("SELECT * FROM elementos as e, categorias as c, tallas
            as t where e.fkCategoria=c.idCategoria AND e.fkTalla=t.idTalla");
          while ($tableData = $sqlElm->fetch_object()) { ?>
            <tr>
              <td><?= $tableData->nombreCat ?></td>
              <td><?= $tableData->elemento ?></td>
              <td><?= $tableData->tallas ?></td>
              <td><?= $tableData->marca ?></td>
              <td><?= $tableData->color ?></td>
              <td><?= $tableData->existencias ?></td>
              <td><?= $tableData->observacion ?></td>
              <td class="d-flex flex-row gap-1">
                <!-- Botón editar -->
                <a class="btn btn-small btn-warning" href="modificarElementos.php?id=<?= $tableData->idElemento ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                  </svg>
                </a>
                <!-- Botón eliminar -->
                <a onclick="return eliminar('<?php echo $tableData->idElemento; ?>')" class="btn btn-small btn-danger">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
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
    window.setTimeout(function() {
      $(".alert")
        .fadeTo(2500, 0)
        .slideDown(1000, function() {
          $(this).remove();
        });
    }, 2000); //2 segundos y desaparece
  </script>
  <!-- Script para los elementos select -->
  <script type="text/javascript">
    $(document).ready(function() {
      $("#listaCat").val(1);
      recargarLista();

      $("#listaCat").change(function() {
        recargarLista();
      });
    });
  </script>

  <script type="text/javascript">
    function recargarLista() {
      $.ajax({
        type: "POST",
        url: "../controllers/addElements.controller.php",
        data: "categoria=" + $("#listaCat").val(),
        success: function(r) {
          $("#select2lista").html(r);
        },
      });
    }
  </script>
  <!-- ↓Script para confirmar eliminar elemento -->
  <script>
    function eliminar() {
      var confirmar = confirm(
        "Está apunto de eliminar un registro, esta acción no se puede deshacer. Está seguro?"
      );
      return respuesta;
    }
  </script>
  <!-- Script para confirma la creación de una nueva categoria -->
  <script>
    $("#formAddCategoria").submit(function(event) {
      event.preventDefault(); // Evita que el formulario se envíe automáticamente
      Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres crear una nueva categoría?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: "../controllers/addCategorias.controller.php",
              data: {
                nombre: $("#nombreCategoria").val()
              },
              success: () => {
                Swal.fire(
                  'Categoría Creada',
                  'La categoría ha sido creada correctamente!!!',
                  'success'
                  ).then(() => {
                    location.reload();
                  })
              }
            })
        }
      })
    });

    $("#nombreCategoria").keypress(function(event) {
      if (event.which == 13) { // Verifica si se presionó Enter
        event.preventDefault(); // Evita que el formulario se envíe automáticamente
        $("#formAddCategoria").submit(); // Envía el formulario manualmente
      }
    });
  </script>
  <script src="../csss/DataTables/datatables.min.js"></script>
  <script>
    new DataTable("#tableInventario")
  </script>
</body>

</html>