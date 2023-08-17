//AutoCierre
window.setTimeout(function () {
    $(".alert")
        .fadeTo(2500, 0)
        .slideDown(1000, function () {
            $(this).remove();
        });
}, 2000); //2 segundos y desaparece
$(document).ready(function () {
    $("#listaCat").val(1);
    recargarLista();

    $("#listaCat").change(function () {
        recargarLista();
    });
});

function recargarLista() {
    $.ajax({
        type: "POST",
        url: "../controllers/addElements.controller.php",
        data: "categoria=" + $("#listaCat").val(),
        success: function (r) {
            $("#select2lista").html(r);
        },
    });
}
function eliminar(id) {
    var opcion = confirm("Clicka en Aceptar o Cancelar");
    if (opcion == true) {
        alert(id);
    } else {
        alert("Has clickado Cancelar");
    }
}

$("#formAddCant").submit(function (event) {
    event.preventDefault();
    console.log($("#nota").val()) // Evita que el formulario se envíe automáticamente
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
                url: "../controllers/entradas.controller.php",
                data: {
                    idElemento: $("#lista2 option:selected").val(),
                    cantidad: $("#listaCant").val(),
                    nota: $("#nota").val(),
                    btnAdd: true
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
