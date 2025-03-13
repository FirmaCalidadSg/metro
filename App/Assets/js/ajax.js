function Cargar(url, controlador, data) {
    urls = window.location.origin + '/Metro/App/' + controlador + '/' + url;
    $.ajax({
        url: urls,
        type: 'GET',
        data: data,
        success: function (response) {
            $('#index').html(response);
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

function eliminar(controlador,funcion,id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡Esta acción no se puede deshacer!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0b7c3e',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, eliminar!',
        cancelButtonText: 'Cancelar',
        customClass: { popup: 'mi-clase-modal' }
    }).then(result => {
        if (result.isConfirmed) {
            $.ajax({
                url: window.location.origin + '/Metro/App/' + controlador+'/'+ funcion +'/' + id,
                type: 'POST',
                contentType: 'application/json',
                data: {
                    id: id
                },
                success: function (response) {
                    console.log(response.status);
                    if (response.status != 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.msn,
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            location.reload(); // Recargar la página
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un error al eliminar la definición',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                },
                error: () => Swal.fire({
                    title: 'Error',
                    text: 'Ocurrió un error al procesar la solicitud.',
                    icon: 'error',
                    customClass: { popup: 'mi-clase-modal' }
                })
            });
        }
    });
}


function Registrar(controlador, funcion, data) {
    // alert("funcion de registrar")
    //e.preventDefault();
    

    var form = document.getElementById(data);
    var formData = new FormData(form);
    $.ajax({
        url: window.location.origin + '/Metro/App/' +controlador+'/'+funcion+'',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {

            if (response.status == 'success') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: response.msn,
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                   // $('#table').DataTable().ajax.reload();
                    location.reload(); // Agregado para recargar la página
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al guardar la planta',
                    confirmButtonText: 'Aceptar'
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error en el servidor: ' + error,
                confirmButtonText: 'Aceptar'
            });
        }
    });
}


function RegistrarRed(controlador, funcion, data, url) {
    e.preventDefault();
    let formData = new FormData(data);
    $.ajax({
        url: window.location.origin + '/Metro/App/' + controlador+'/'+funcion+'',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {

            if (response.status == 'success') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: response.msn,
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    $('#table').DataTable().ajax.reload();
                    window.location.href = url;
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al guardar la planta',
                    confirmButtonText: 'Aceptar'
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error en el servidor: ' + error,
                confirmButtonText: 'Aceptar'
            });
        }
    });
}

