$(document).ready(function () {
    let productos = [];
    $('#arrayProductos').val() && (productos = JSON.parse($('#arrayProductos').val()));

    let table = new DataTable('#tabla_emprendedores', {
        language: {
            url: '/datatable/lang.json'
        },
        layout: {
            bottomEnd: {
                paging: {
                    firstLast: false
                }
            }
        },
        columnDefs: [{ 
            "className": "dt-center", 
            "targets": "_all" 
        } 
    ]
    });

    $('#productos_seleccionados').on('click', '.eliminar_producto', function (e) {
        e.preventDefault();
        let idProducto = $(this).data('id');
        let idEmprendimiento = $('#idEmprendimiento').val()
        $('body').css('cursor', 'wait');
        CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "DELETE",
            url: "/deleteProdDelEmprendimiento",
            data: {
                'producto_id': idProducto,
                'emprendimiento_id': idEmprendimiento,
                '_token': CSRF_TOKEN
            },
            success: function (response) {
                console.log('idProduto: ' + idProducto)
                let indice = productos.indexOf(idProducto);
                console.log('indice: ' + indice);
                productos.splice(indice, 1);
                $('#arrayProductos').val(JSON.stringify(productos));
                $(`p[data-id="${idProducto}"]`).addClass('d-none');
                $('body').css('cursor', 'default');
            }
        });
    });

    $('#tabla_emprendedores').on('click', '.eliminar_emprendedor', function (e) {
        e.preventDefault();
        let idEmprendedor = $(this).data('id');
        $('body').css('cursor', 'wait');
        CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "DELETE",
            url: `/emprendedor/delete/${idEmprendedor}`,
            data: {
                'idEmprendedor': idEmprendedor,
                '_token': CSRF_TOKEN
            },
            success: function (response) {
                tablaEmprendedores(response);
                $('body').css('cursor', 'default');
            }
        });
    });


    // Chequeo de campos completados
    let email = $('#email').val()
    let expediente = $('#nro_expediente').val()

    $('#nro_expediente, #email').on('blur', function () {
        let valor = $(this).val();
        let campo = $(this).attr('name');
        if (valor !== '' && valor != email && valor != expediente) {
            $.ajax({
                url: '/emprendedor/validacion/campo',
                method: 'GET',
                data: { valor: valor, campo: campo },
                success: function (response) {
                    if (response) {
                        $(`#${campo}`).attr('style', 'border-color: red');
                        toastr["warning"]("Ya existe un emprendedor con ese valor", `${$(`label[for="${campo}"]`).text()} incorrecto`);
                        $(`#${campo}`).focus();
                    } else {
                        $(`#${campo}`).removeAttr('style');
                    }
                },
                error: function (xhr) {
                    console.log('Error en la solicitud:', xhr);
                }
            });
        } else {
            $(`#${campo}`).removeAttr('style');
        }
    });

    /////// IMPORTAR EXPORTAR ///////

    
});
