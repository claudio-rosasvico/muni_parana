$(document).ready(function () {
    type = $('#typeToast').val();
    title = $('#titleToast').val();
    message = $('#messageToast').val();

    if(type != ''){
        toastr[type](message, title)
    }

});