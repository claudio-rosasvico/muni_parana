$(document).ready(function () {
    type = $('#typeToast').val();
    title = $('#titleToast').val();
    message = $('#messageToast').val();
    console.log(type);
    console.log(title);
    console.log(message);

    if(typeToast != ''){
        toastr[type](message, title)
    }

});