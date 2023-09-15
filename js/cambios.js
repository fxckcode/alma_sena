$("#historyEdit").on("show.bs.modal", (event) => {
    var button = $(event.relatedTarget);
    var userId = button.data('user');
    var fecha = button.data('fecha');
    var ficha = button.data('ficha');
    var tbody = $("#bodyHistoryEdit")
    console.log(userId, fecha);

    $.ajax({
        url: "../controllers/getMovimiento.controller.php",
        type: 'GET',
        data: {
            id: userId,
            fecha: fecha,
            ficha: ficha,
        },
        success: (response) => {
            var data = JSON.parse(response)
            console.log("Respuesta", data);
            var rowsHtml = data.map(element => `
                <tr>
                    <td>
                        <input type="hidden" value="${element.fk_categoria}" /> 
                        <select class="form-select">
                            <option>
                                ${element.nombre}
                            </option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select">
                            <option>
                                ${element.elemento}
                            </option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" value="${element.marca}" />
                    </td>
                    <td>
                        <select class="form-select">
                            <option>
                                ${element.talla}
                            </option>
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control" value="${element.cantidad}" />
                    </td>
                </tr>
            `).join('');
            tbody.html(rowsHtml);
        }
    })
})