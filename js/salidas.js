$(document).ready(function () {
    $("#ficha").on("change", function () {
        let ficha = $(this).val();
        localStorage.setItem("ficha", ficha);
    });

    $("#ficha").val(localStorage.getItem("ficha"));

    $("#listaUsers").on("change", function () {
        let ficha = $(this).val();
        localStorage.setItem("listaUsers", ficha);
    });

    $("#listaUsers").val(localStorage.getItem("listaUsers"));
})

// Al cargar la página, verificamos cada botón para ver si fue clickeado previamente.
$("a.btnAdd").each(function () {
    var id = $(this).attr("data-id");
    if (localStorage.getItem('clicked-' + id)) {
        $(this).removeClass('btn-success');
        $(this).attr('data-clicked', 'true');
    }
    if (localStorage.getItem('clicked-' + id) == "false") {
        $(this).addClass('btn-success');
        $(this).attr('data-clicked', 'false');
    }
});

$("a.btnAdd").on("click", function (e) {
    e.preventDefault();
    var idElemento = $(this).attr("data-id");

    if ($(this).attr('data-clicked') == 'true') {
        return;
    }

    console.log(idElemento)
    $.ajax({
        url: "../controllers/carrito.controller.php",
        type: "POST",
        data: { idElemento: idElemento },
        success: (response) => {
            $(this).removeClass('btn-success');
            localStorage.setItem('clicked-' + idElemento, true);
            location.reload();
        },
        error: (error) => {
            console.error(error)
        }
    })

    $(this).attr('data-clicked', 'true');
});


$("a.btnDel").on("click", function (e) {
    e.preventDefault();
    var idElemento = $(this).attr("data-id");
    console.log(idElemento)
    Swal.fire({
        title: '¿Estás seguro que quieres eliminar este elemento de este formulario?',
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
                url: "../controllers/carrito.controller.php",
                data: {
                    btnDel: idElemento
                },
                success: () => {
                    localStorage.setItem('clicked-' + idElemento, false);
                    Swal.fire(
                        'Elemento Eliminado',
                        'El elemento seleccionado ha sido eliminado exitosamente',
                        'success'
                    ).then(() => {
                        location.reload();
                    })

                }, catch: (error) => {
                    console.error(error)
                }
            })
        }
    })

})

$("#salidaForm").on("submit", function (e) {
    e.preventDefault();
    var clienteSeleccionado = $("#listaUsers").val();
    var ficha = $('#ficha').val();
    var observacion = $("#observacion").val();
    if (!clienteSeleccionado) {
        alert("Por favor, selecciona un cliente.");
        return;
    }

    let totalRows = $("#bodyCar tr").length;
    let processedRows = 0;

    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres crear la salida?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            $("#bodyCar tr").each(function () {
                var idElemento = $(this).find(".btnDel").attr("data-id");
                var cantidad = $(this).find("input[type='number']").val();

                console.log(idElemento, cantidad, clienteSeleccionado)

                $.ajax({
                    url: "../controllers/carrito.controller.php",
                    type: "POST",
                    data: {
                        clienteId: clienteSeleccionado,
                        elementoId: idElemento,
                        cantidad: cantidad,
                        ficha: ficha,
                        observacion: observacion
                    },
                    success: function (response) {
                        console.log("Elemento " + idElemento + " procesado exitosamente.");
                        console.log(response)
                        processedRows++;

                        if (processedRows === totalRows) {
                            Swal.fire('', 'Salida generada con éxito', 'success').then(() => {
                                localStorage.setItem("listaUsers", "")
                                localStorage.setItem("ficha", "")
                                location.reload();
                            });
                        }
                    },
                    error: function (error) {
                        console.error("Error procesando el elemento " + idElemento);
                    }
                });
            });
        }
    })
})

$("#historialByUsuario").on("show.bs.modal", (event) => {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var tbody = $("#bodyHistorialByUsers")
    console.log(id)

    $.ajax({
        url: "../controllers/getMovimiento.controller.php",
        type: 'GET',
        data: {
            id: id
        },
        success: (response) => {
            var data = JSON.parse(response)
            var rowsHtml = data.map(element => `
                <tr>
                    <td>${element.idMovimiento}</td>
                    <td>${element.elemento}</td>
                    <td>${element.marca}</td>
                    <td>${element.cantidad}</td>
                    <td>${element.observacion}</td>
                    <td>${element.fecha}</td>
                </tr>
            `).join('');
            tbody.html(rowsHtml);
        }
    })
})

$("#historialMovimientosByDay").on("show.bs.modal", (event) => {
    const hoy = new Date();
    const anioActual = hoy.getFullYear();
    const mesActual = (hoy.getMonth() + 1).toString().padStart(2, '0');
    const diaActual = hoy.getDate().toString().padStart(2, '0');

    const fechaActual = anioActual + '-' + mesActual + '-' + diaActual;
    var tbody = $("#bodyHistorialByDia")


    $.ajax({
        url: "../controllers/getMovimiento.controller.php",
        type: 'GET',
        data: {
            fecha: fechaActual
        },
        success: (response) => {
            var data = JSON.parse(response)
            console.log(data);
            var rowsHtml = data.map(element => `
                <tr>
                    <td>${element.idMovimiento}</td>
                    <td>${element.user}</td>
                    <td>${element.ficha}</td>
                    <td>${element.elemento} - ${element.tallas}</td>
                    <td>${element.cantidad}</td>
                    <td>${element.observacion}</td>
                    <td>${element.fecha}</td>
                </tr>
            `).join('');
            tbody.html(rowsHtml);   
        }
    })
})