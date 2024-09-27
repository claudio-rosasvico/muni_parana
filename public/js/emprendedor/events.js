$(document).ready( function () {
    let productos = [];
    $('#arrayProductos').val() && (productos = JSON.parse($('#arrayProductos').val()));
    
    

    $('#productos').on('change', function (e) {
        e.preventDefault();
        let idProducto = parseInt($(this).val());
        if (productos.length < 3 & !verificaProducto(idProducto, productos)) {
            var nombreProducto = $(this).find('option:selected').text();
            productos.push(idProducto)
            $('#arrayProductos').val(JSON.stringify(productos));
            console.log(nombreProducto + '-> id: ' + idProducto)
            let badgeProducto = `<p class='badge text-bg-secondary eliminar_producto me-1' data-id='${idProducto}'>${nombreProducto} <span class="eliminar_producto" data-id='${idProducto}' style="cursor: pointer"><i class="fa-regular fa-circle-xmark"></i></span></p>`
            $('#productos_seleccionados').append(badgeProducto);
            console.log(productos);
        } else if (productos.length >= 3) {
            toastr["warning"]("El emprendimiento ya tiene el máximo de 3 productos", "Listado completo");
        } else {
            toastr["warning"]("El producto ya fue registrado en el emprendimiento", "Producto repetido");
        }
        $('#productos').prop('selectedIndex', 0);
    });

    $('#productos_seleccionados').on('click', '.eliminar_producto', function (e) {
        e.preventDefault();
        let idProducto = $(this).data('id');
        let idEmprendimiento = $('#idEmprendimiento').val()
        console.log(`idProducto: ${idProducto} -> idEmprendimiento: ${idEmprendimiento}`)
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
                console.log(productos);
            }
        });
    });

    $('#tabla_emprendedores').on('click', '.eliminar_emprendedor', function (e) {
        e.preventDefault();
        let idEmprendedor = $(this).data('id');
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



    //Buscador/////////////////////////////////////////////////////

    $('#search').on('keyup', function (e) {
        e.preventDefault();
        let search = $(this).val();
        CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        console.log(`serach: ${search}`)
        $.ajax({
            type: "GET",
            url: `/searchEmprendedor`,
            data: {
                search: search,
                '_token': CSRF_TOKEN
            },
            success: function (response) {
                tablaEmprendedores(response);
            }
        });
    });
});
