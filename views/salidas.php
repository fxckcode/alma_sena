<?php session_start();
if (empty($_SESSION['id'])) {
    header("Location:../index.php");
}
if ($_SESSION['rol'] == 'user') {
    header("Location: ./home.php");
}
include("../controllers/dbConection.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/senaGreen.png" type="image/x-icon" />
    <!-- BootStrap -->
    <link rel="stylesheet" href="../csss/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../csss/DataTables/Responsive-2.5.0/css/responsive.dataTables.min.css">
    <title>Salidas</title>
    <script src="../utils/jquery/jquery-3.7.0.min.js"></script>
    <link href="../csss/DataTables/datatables.min.css" rel="stylesheet">
    <script src="../utils/package/dist/sweetalert2.all.min.js"></script>
    <script src="../utils/package/dist/sweetalert2.min.css"></script>
    <link rel="stylesheet" href="../csss/generalStyles.css">
</head>

<body class="vh-100 d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-light bg-success-subtle p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <?php
                echo "Hola, ";
                echo $_SESSION["nombre"];
                ?>
            </a>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link mx-2" aria-current="page" href="./entradas.php">Entradas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 active" href="salidas.php">Salidas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="cambios.php">Cambios</a>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="container-fluid row p-4">
        <div class="col-lg-4 col mb-4">
            <div class="d-flex gap-2 mb-3 align-items-center">
                <h4 class="text-success">Crear salida de elementos</h4>
                <a class="fw-bold pointer text-info pe-auto" data-bs-toggle="modal" data-bs-target="#historialMovimientos">Historial</a>
            </div>
            <form method="POST" id="salidaForm">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-success-subtle border-primary" id="">Seleccionar Cliente</span>
                    <select class="listaCat form-select pe-5 border-primary" id="listaUsers" name="listUsers" required>
                        <option value="">Seleccionar...</option>
                        <?php
                        $sqlElm = $conexion->query("SELECT * FROM usuarios WHERE rol='user'");
                        while ($tableData = $sqlElm->fetch_object()) { ?>
                            <option value="<?= $tableData->id ?>"><?= $tableData->user ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Talla</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Interacción</th>
                            </tr>
                        </thead>
                        <tbody id="bodyCar">
                            <?php
                            $sqlElm = $conexion->query("SELECT c.id, e.elemento, t.tallas, e.marca, e.idElemento, e.existencias FROM carrito as c 
                                                        JOIN elementos as e ON c.fkElemento = e.idElemento
                                                        JOIN tallas as t ON e.fkTalla = t.idTalla");
                            while ($tableData = $sqlElm->fetch_object()) { ?>
                                <tr>
                                    <td><?= $tableData->id ?></td>
                                    <td><?= $tableData->elemento ?> - <?= $tableData->marca ?></td>
                                    <td><?= $tableData->tallas ?></td>
                                    <td><input type="number" value="1" class="w-50" min="1" max="<?= $tableData->existencias ?>"></td>
                                    <td>
                                        <a href="" class="btn btn-danger btnDel" data-id="<?= $tableData->idElemento ?>">Eliminar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="w-full d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary btn-sm" type="submit">Crear Salida</button>
                </div>
            </form>
        </div>
        <div class="col-lg-8 col">
            <table id="tableSalidas" class="table table-striped table-bordered table-responsive table-hover nowrap table-sm" style="width: 100%;">
                <thead class="formColumn">
                    <tr>
                        <th scope="col">Categoría</th>
                        <th scope="col">Elemento</th>
                        <th scope="col">Talla</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Color</th>
                        <th scope="col">Existencias</th>
                        <th scope="col">Interacción</th>
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
                            <td>
                                <a class="btn btn-success btnAdd" data-id="<?= $tableData->idElemento ?>">Agregar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade modal-xl" id="historialMovimientos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Historial de movimientos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped table-hover" id="tableHistorial" style="width: 100%;">
                        <thead>
                            <th scope="col">id</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Elemento</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Fecha Salida</th>
                        </thead>
                        <tbody>
                            <?php
                            $sqlElm = $conexion->query("SELECT m.idMovimiento, m.cantidad, m.fecha, u.user, u.telefono, t.tallas, e.elemento FROM movimiento as m 
                                                        JOIN usuarios as u ON m.tomador = u.id
                                                        JOIN elementos as e ON m.elemento = e.idElemento 
                                                        JOIN tallas as t ON e.fkTalla = t.idTalla WHERE m.tipo_movimiento='salida'");
                            while ($tableData = $sqlElm->fetch_object()) { ?>
                                <tr>
                                    <td><?= $tableData->idMovimiento ?></td>
                                    <td><strong>Nombre: </strong> <?= $tableData->user ?> <br> <strong>Telefono: </strong> <?= $tableData->telefono ?></td>
                                    <td> <strong><?= $tableData->elemento ?></strong> <br> <strong>Talla: </strong> <?= $tableData->tallas ?> </td>
                                    <td> - <?= $tableData->cantidad ?></td>
                                    <td><?= $tableData->fecha ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../csss/DataTables/datatables.min.js"></script>
<script src="../csss/bootstrap/js/bootstrap.min.js"></script>
<script src="../csss/DataTables/Responsive-2.5.0/js/responsive.dataTables.js"></script>
<script>
    new DataTable("#tableSalidas", {
        responsive: true,
    })
    new DataTable("#tableHistorial", {
        responsive: true
    })
</script>
<script src="../js/salidas.js"></script>

</html>