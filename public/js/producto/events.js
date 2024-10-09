$(document).ready(function () {

    let table = new DataTable('#tabla-productos', {
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

    $('#tabla-productos').on('click', '.deleteProducto', function (e) {
        e.preventDefault();
        CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let idProducto = $(this).data('id');
        $('body').css('cursor', 'wait');
        $.ajax({
            type: "DELETE",
            url: `/parametros/productos/delete/${idProducto}`,
            data: {
                '_token': CSRF_TOKEN
            },
            success: function (response) {
                // ACA CUENTO LOS PRODUCTOS Y LOS GUARDO DE ACUERDO A SU ID
                const conteoProductos = {};
                response.productosEmprendimientos.forEach(elem => {
                    conteoProductos[elem.producto_id] = (conteoProductos[elem.producto_id] || 0) + 1;
                });
                
                $('#tabla-productos tbody').empty();

                response.productos.forEach(producto => {
                    let count = 1
                    const countProductos = conteoProductos[producto.id] || 0; 
                    let fila = `
                        <tr>
                            <th scope="row">${count}</th>
                            <td>${producto.nombre}</td>
                            <td>${(producto.observaciones) ? producto.observaciones : ''}</td>
                            <td>${countProductos}</td>
                            <td>
                                <a class="deleteProducto" data-id="${producto.id}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    `;
                    $('#tabla-productos tbody').append(fila);
                })
                $('body').css('cursor', 'default');
            }
        });
    });

});
