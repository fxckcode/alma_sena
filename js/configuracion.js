$("#editProfile").submit(function (event) {
    event.preventDefault();

    var nombre = $("#nombre").val();
    var telefono = $("#telefono").val();
    var correo = $("#email").val();
    var id = $("#idProfile").val();

    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres actualizar el perfil?",
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
                url: "../controllers/usersUpdController.php",
                data: {
                    inputId: id,
                    inputNam: nombre,
                    inputTel: telefono,
                    inputMail: correo
                },
                success: (response) => {
                    console.log(response)
                    Swal.fire(
                        'Elemento Actualizado',
                        'Tu usuario ha sido actualizado con exito',
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

$("#createUsersForm").submit(function (event) {
    event.preventDefault();
    var id = $("#identUser").val();
    var nombre = $("#nombreUser").val();
    var telefono = $("#telefonoUser").val();
    var correo = $("#emailUser").val();
    var password = $("#passUser").val();

    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres crear un nuevo Usuario?",
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
                url: "../controllers/user.Create.controller.php",
                data: {
                    dni: id,
                    uname: nombre,
                    email: correo,
                    pass: password,
                    telefono: telefono
                },
                success: (response) => {
                    console.log(response)
                    Swal.fire(
                        'Elemento Actualizado',
                        'El usuario ha sido actulizado con exito',
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

$("#editUser").on("show.bs.modal", (event) => {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var form = $("#editFormUser");
    console.log(id)

    $.ajax({
        type: 'POST',
        url: '../controllers/getUserById.controller.php',
        data: {
            id: id
        }, success: (response) => {
            var data = JSON.parse(response)
            form.html(`
            <div class="d-flex flex-column gap-1 mb-3">
            <label for="identUser" class="form-label">Número de documento (*)</label>
            <input type="text" class="form-control" name="identUser" placeholder="C.C 1234567890" value="${data.id}" id="identUserEdit" required>
          </div>
          <div class="d-flex flex-column gap-1 mb-3">
            <label for="nombre" class="form-label">Nombre de Usuario (*)</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre de Usuario" value="${data.user}" id="nombreUserEdit" required>
          </div>
          <div class="d-flex flex-column gap-1 mb-3">
            <label for="email" class="form-label">Correo (*)</label>
            <input type="email" class="form-control" name="email" placeholder="Correo Electronico" value="${data.email}" id="emailUserEdit" required>
          </div>
          <div class="d-flex flex-column gap-1 mb-3">
            <label for="telefono" class="form-label">Número de Teléfono</label>
            <input type="text" class="form-control" name="telefono" placeholder="Número de Teléfono" value="${data.telefono}" id="telefonoUserEdit">
          </div>
          <div class="d-flex justify-content-center align-items-center">
            <button type="submit" class="btn btn-success">Crear usuario</button>
          </div>
            `)

            $("#editFormUser").submit(function (event) {
                event.preventDefault();
                var id = $("#identUserEdit").val();
                var nombre = $("#nombreUserEdit").val();
                var email = $("#emailUserEdit").val();
                var telefono = $("#telefonoUserEdit").val();

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Quieres actualizar el usuario?",
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
                            url: '../controllers/usersUpdController.php',
                            data: {
                                inputId: id,
                                inputNam: nombre,
                                inputTel: telefono,
                                inputMail: email
                            },
                            success: (response) => {
                                console.log(response)
                                Swal.fire(
                                    'Elemento Actualizado',
                                    'El usuario ha sido actualizado con exito',
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
        }
    })

})


$("#createCategory").submit(function (event) {
    event.preventDefault()
    var nombre = $("#category").val()


    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres crear una nueva categoria?",
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
                    nombre: nombre
                },
                success: (response) => {
                    console.log(response)
                    Swal.fire(
                        'Elemento Creado',
                        'La categoria ha sido creada con exito',
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


$("#createTallasForm").submit(function (event) {
    event.preventDefault();

    var nombre = $("#tallasModal").val()

    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres crear una nueva talla?",
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
                url: "../controllers/addTallas.controller.php",
                data: {
                    nombre: nombre
                },
                success: (response) => {
                    console.log(response)
                    Swal.fire(
                        'Elemento Creado',
                        'La talla ha sido creada con exito',
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