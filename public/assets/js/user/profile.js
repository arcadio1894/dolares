$(document).ready(function () {

    $("#btn_front_image").on('click', submitFrontImage);
    $("#btn_reverse_image").on('click', submitReverseImage);

});

var $modalImage;

function submitFrontImage() {
    event.preventDefault();
    var button = $(this);
    button.attr('disabled', true);

    var fileInput = $('#front_image')[0].files[0];
    var formData = new FormData();

    formData.append('image_front', fileInput);

    $.ajax({
        url: button.data('url'),
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: formData,
        processData:false,
        contentType:false,
        success: function (data) {
            console.log(data);
            Swal.fire({
                text: data.message,
                icon: "success",
                buttonsStyling: !1,
                confirmButtonText: "Ok, entendido!",
                customClass: {confirmButton: "btn btn-primary"}
            }).then((function (e) {
                button.attr('disabled', false);
                button.parent().parent().parent().prev().removeClass('gray-image');
                button.parent().parent().parent().prev().removeClass('red-image');
                button.parent().parent().parent().prev().addClass('yellow-image');
                button.parent().parent().parent().parent().parent().removeClass('bg-secondary');
                button.parent().parent().parent().parent().parent().removeClass('border-secondary');
                button.parent().parent().parent().parent().parent().removeClass('bg-light-danger');
                button.parent().parent().parent().parent().parent().removeClass('border-danger');
                button.parent().parent().parent().parent().parent().addClass('bg-light-warning');
                button.parent().parent().parent().parent().parent().addClass('border-warning');
                button.parent().parent().parent().prev().after('<label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>');
                button.parent().parent().parent().remove();
            }))

        },
        error: function (data) {
            if( data.responseJSON.message && !data.responseJSON.errors )
            {
                toastr.error(data.responseJSON.message, 'Error',
                    {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
            }
            for ( var property in data.responseJSON.errors ) {
                toastr.error(data.responseJSON.errors[property], 'Error',
                    {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
            }
            button.attr('disabled', false);
        },
    });
}

function submitReverseImage() {
    var button = $(this);
    button.attr('disabled', true);

    var fileInput = $('#reverse_image')[0].files[0];
    var formData = new FormData();

    formData.append('image_reverse', fileInput);

    $.ajax({
        url: button.data('url'),
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: formData,
        processData:false,
        contentType:false,
        success: function (data) {
            console.log(data);
            Swal.fire({
                text: data.message,
                icon: "success",
                buttonsStyling: !1,
                confirmButtonText: "Ok, entendido!",
                customClass: {confirmButton: "btn btn-primary"}
            }).then((function (e) {
                button.attr('disabled', false);
                button.parent().parent().parent().prev().removeClass('gray-image');
                button.parent().parent().parent().prev().removeClass('red-image');
                button.parent().parent().parent().prev().addClass('yellow-image');
                button.parent().parent().parent().parent().parent().removeClass('bg-secondary');
                button.parent().parent().parent().parent().parent().removeClass('border-secondary');
                button.parent().parent().parent().parent().parent().removeClass('bg-light-danger');
                button.parent().parent().parent().parent().parent().removeClass('border-danger');
                button.parent().parent().parent().parent().parent().addClass('bg-light-warning');
                button.parent().parent().parent().parent().parent().addClass('border-warning');
                button.parent().parent().parent().prev().after('<label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>');
                button.parent().parent().parent().remove();
            }))

        },
        error: function (data) {
            if( data.responseJSON.message && !data.responseJSON.errors )
            {
                toastr.error(data.responseJSON.message, 'Error',
                    {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
            }
            for ( var property in data.responseJSON.errors ) {
                toastr.error(data.responseJSON.errors[property], 'Error',
                    {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
            }
            button.attr('disabled', false);
        },
    });
}
