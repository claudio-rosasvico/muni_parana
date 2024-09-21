$(document).ready(function () {
    CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('select').change(function (e) {
        e.preventDefault();
        let rolUser = $(this).val();
        let idUser = $(this).data('id');
        console.log(`rolUser: ${rolUser} / idUser: ${idUser}`);
        $.ajax({
            type: "POST",
            url: "/user/updateRole",
            data: { idUser: idUser, 
                rolUser: rolUser,
                _token: CSRF_TOKEN},
            success: function (response) {
                toastr["success"](`Usuario ${response.user.name} actualizado`)
            }, error: function (xhr) {
                console.log('Error en la solicitud:', xhr);
            }
        });
    });

})