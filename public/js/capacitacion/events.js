
$(document).ready(function () {
    CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    const selectEmprendedor = new TomSelect(".select-emprendedor",{
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    idCapacitacion = $('#idCapacitacion').val()
    $.ajax({
        type: "GET",
        url: `/capacitacion/obtenerEmprendedores/${idCapacitacion}`,
        success: function (response) {
            tablaEmprendedores(response);
        }
    });
    $('#sumarEmprendedor').click(function (e) { 
        e.preventDefault();
        idEmprendedor = $('.select-emprendedor').val()
        idCapacitacion = $('#idCapacitacion').val()
        $.ajax({
            type: "POST",
            url: `/capacitacion/sumaEmprendedor`,
            data: {
                '_token': CSRF_TOKEN,
                'idEmprendedor': idEmprendedor,
                'idCapacitacion': idCapacitacion
            },
            success: function (response) {
                if(response){
                    tablaEmprendedores(response);
                } else {
                    toastr["error"]("", "Emprendedor ya registrado");
                }
            }
        });
        
        selectEmprendedor.clear();
            
    });

    $('#tabla_emprendedores tbody').on('click', '.eliminar_emprendedor', function (e) {
        e.preventDefault();
        let idEmprendedor = $(this).data('id');
        let idCapacitacion = $('#idCapacitacion').val()
        $('body').css('cursor', 'wait');
        $.ajax({
            type: "DELETE",
            url: `/capacitacion/delete`,
            data: {
                'idEmprendedor': idEmprendedor,
                'idCapacitacion': idCapacitacion,
                '_token': CSRF_TOKEN
            },
            success: function (response) {
                tablaEmprendedores(response);
                $('body').css('cursor', 'default');
            }
        });
    });
});