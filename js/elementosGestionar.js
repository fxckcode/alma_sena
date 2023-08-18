new DataTable("#tableInventario")

// window.setTimeout(function () {
//     $(".alert")
//         .fadeTo(2500, 0)
//         .slideDown(1000, function () {
//             $(this).remove();
//         });
// }, 2000); //2 segundos y desaparece
// $(document).ready(function () {
//     $("#listaCat").val(1);
//     recargarLista();

//     $("#listaCat").change(function () {
//         recargarLista();
//     });
// });
// function eliminar() {
//     var confirmar = confirm(
//         "Está apunto de eliminar un registro, esta acción no se puede deshacer. Está seguro?"
//     );
//     return respuesta;
// }
// Modal para confirmar que se quiere crear una nueva categoria
$("#formAddCategoria").submit(function (event) {
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

$("#nombreCategoria").keypress(function (event) {
    if (event.which == 13) { // Verifica si se presionó Enter
        event.preventDefault(); // Evita que el formulario se envíe automáticamente
        $("#formAddCategoria").submit(); // Envía el formulario manualmente
    }
});

// Modal para confirmar que se quiere crear una nuevo elemento
$("#formAddElement").submit(function (event) {
    event.preventDefault(); // Evita que el formulario se envíe automáticamente
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres crear un nuevo elemento?",
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
                url: "../controllers/addElements.controller.php",
                data: {
                    listaCat: $("#listaCat1 option:selected").val(),
                    nombre_elemento: $("#nombre_elemento").val(),
                    talla: $("#talla option:selected").val(),
                    marca: $("#marca").val(),
                    color: $("#color").val(),
                    listaCant: $("#cantidad").val(),
                    nota: $("#notaCreate").val()
                },
                success: () => {
                    Swal.fire(
                        'Elemento Creado',
                        'El elemento ha sido creado exitosamente!!',
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
});