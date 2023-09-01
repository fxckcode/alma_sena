$("#editProfile").submit(function (event) {
    event.preventDefault();

    var nombre = $("#nombre").val();
    var telefono = $("#telefono").val();
    var correo = $("#email").val();
    var id = $("#idProfile").val();

    console.log(id)

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