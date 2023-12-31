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

function eliminar(id) { // Evita que el formulario se envíe automáticamente
    Swal.fire({
        title: '¿Estás seguro que quieres eliminar este elemento?',
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
                url: "../controllers/delete.controller.php",
                data: {
                    id: id
                },
                success: () => {
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
}

$("#formAddCant").submit(function (event) {
    event.preventDefault();
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
                    id: $("#lista2 option:selected").val(),
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


$("#editElements").on("show.bs.modal", (event) => {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var form = $("#editForm")
    
    $.ajax({
        url: '../controllers/getElementById.controller.php',
        type: 'GET',
        data: { id: id },
        dataType: 'json',
        success: function (data) {
            form.html(`
            <input type="hidden" id="id" name="inputId" value="${data.id}">
            <input type="hidden" id="inputTalla" name="inputTalla" value="${data.fk_talla}">
            <input type="hidden" id="inputCat" name="inputCat" value="${data.fk_categoria}">
              <div class="input-group mb-3">
              <span class="input-group-text bg-success-subtle " id="">Categoría</span>
              <select class="listaCat form-select pe-5 " id="catSelect" name="categoria">
                </select>
              </div>

              <div class="input-group mb-3">
                  <span class="input-group-text bg-success-subtle " id="">Nombre</span>
                  <input class="inputName pe-5 form-control " id="inputName" name="inputName" value="${data.elemento}">
              </div>

              <div class="input-group mb-3">
                  <span class="input-group-text bg-success-subtle ">Talla</span>
                  <select class="listaCat form-select pe-5 " id="tallaSelect" name="talla">
                </select>
              </div>

              <div class="input-group mb-3">
                  <span class="input-group-text bg-success-subtle ">Marca</span>
                  <input type="text" class="inputMarca form-control " id="inputMarca" name="inputMarca" value="${data.marca}">
              </div>

              <div class="input-group mb-3">
                  <span class="input-group-text bg-success-subtle " id="">Color</span>
                  <input select class="inputColor pe-5 form-control " id="inputColor" name="inputColor" value="${data.color}">
              </div>

              <div class="input-group mb-3">
                  <span class="input-group-text bg-success-subtle " id="">Existencias</span>
                  <input select class="inputExists pe-5 form-control " id="inputExists" name="inputExists" value="${parseInt(data.existencias)}">
              </div>
              <div class="input-group">
                  <span class="input-group-text bg-success-subtle ">Nota:</span>
                  <input class="inputNota form-control form-control " id="inputNota" name="inputNota" value="${data.observacion}">
              </div>

              <div>
                  <input class="btn btn-warning text-white w-100 mt-2 fw-semibold shadow-sm mb-1" name="btnUpd" type="submit" value="Actualizar">
              </div>
          `)
            var tallaId = parseInt($("#inputTalla").val())
            var categoriaId = parseInt($("#inputCat").val())
            $.ajax({
                url: '../controllers/getCategorias.controller.php',
                type: 'GET',
                data: { categorias: true },
                dataType: 'json',
                success: function (data) {
                    $("#catSelect").html(
                        data.map((d) => `<option value="${d.id}" ${categoriaId === parseInt(d.id) ? 'selected' : ''}>${d.nombre}</option>`)
                    );
                }
            });
            $.ajax({
                url: '../controllers/getTallas.controller.php',
                type: 'GET',
                data: { tallas: true },
                dataType: 'json',
                success: function (data) {
                    $("#tallaSelect").html(
                        data.map((d) => `<option value="${d.id}" ${tallaId === parseInt(d.id) ? 'selected' : ''}>${d.tallas}</option>`)
                    );
                }
            });
        }
    });
})

$("#editForm").submit(function (event) {
    event.preventDefault(); // Evita que el formulario se envíe automáticamente
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres actualizar este elemento?",
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
                    url: '../controllers/updElements.controller.php',
                    data: {
                        inputId: $("#id").val(),
                        categoria: $("#catSelect option:selected").val(),
                        inputName: $("#inputName").val(),
                        talla: $("#tallaSelect option:selected").val(),
                        inputMarca: $("#inputMarca").val(),
                        inputColor: $("#inputColor").val(),
                        inputExists: $("#inputExists").val(),
                        inputNota: $("#inputNota").val()
                    },
                    success: () => {
                        Swal.fire(
                            'Elemento actualizado',
                            'El elemento ha sido actualizado exitosamente!!',
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





