$(document).ready(function () {

    $(document).on('click', '[data-verify_image_front]', verifyImageFront);
    $(document).on('click', '[data-verify_image_reverse]', verifyImageReverse);
    /*$("#btn_reverse_image").on('click', submitReverseImage);*/
    $(document).on('click', '[data-refuse_image_front]', showRefuseImageFront);
    $(document).on('click', '[data-refuse_image_reverse]', showRefuseImageReverse);

    $modalRefuseImageFront = $('#modalRefuseImageFront');
    $modalRefuseImageReverse = $('#modalRefuseImageReverse');

    $btn_refuse_image_front = $('#btn_refuse_image_front');
    $formRefuseImageFront = $('#formRefuseImageFront');
    $modalRefuseImageFrontCancel = $('#modalRefuseImageFrontalCancel');
    $modalRefuseImageFrontSubmit = $('#modalRefuseImageFrontalSubmit');

    $btn_refuse_image_reverse = $('#btn_refuse_image_reverse');
    $formRefuseImageReverse = $('#formRefuseImageReverse');
    $modalRefuseImageReverseCancel = $('#modalRefuseImageReverseCancel');
    $modalRefuseImageReverseSubmit = $('#modalRefuseImageReverseSubmit');

    $modalRefuseImageFrontCancel.on('click', cancelRefuseImageFront);
    $modalRefuseImageReverseCancel.on('click', cancelRefuseImageReverse);

    $modalRefuseImageFrontSubmit.on('click', submitRefuseImageFront);
    $modalRefuseImageReverseSubmit.on('click', submitRefuseImageReverse);
});

var $btn_refuse_image_front;
var $btn_refuse_image_reverse;

var $modalRefuseImageFront;
var $modalRefuseImageReverse;

var $formRefuseImageReverse;
var $modalRefuseImageReverseCancel;
var $modalRefuseImageReverseSubmit;

var $formRefuseImageFront;
var $modalRefuseImageFrontCancel;
var $modalRefuseImageFrontSubmit;

function submitRefuseImageFront() {
    $modalRefuseImageFrontSubmit.attr("data-kt-indicator", "on");
    $modalRefuseImageFrontSubmit.attr('disabled', true);

    var reason = $('#reason_refuse_front').val();

    $.ajax({
        url: $modalRefuseImageFrontSubmit.attr('data-url'),
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({ reason:reason}),
        processData:false,
        contentType:'application/json; charset=utf-8',
        success: function (data) {
            console.log(data);
            Swal.fire({
                text: data.message,
                icon: "success",
                buttonsStyling: !1,
                confirmButtonText: "Ok, entendido!",
                customClass: {confirmButton: "btn btn-primary"}
            }).then((function (e) {
                $modalRefuseImageFrontSubmit.removeAttr("data-kt-indicator");
                $modalRefuseImageFrontSubmit.attr('disabled', false);
                $btn_refuse_image_front.attr('disabled', true);
                $btn_refuse_image_front.removeClass('btn-danger');
                $btn_refuse_image_front.addClass('btn-secondary');
                $modalRefuseImageFront.modal('hide');
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

            $modalRefuseImageFrontSubmit.attr('disabled', false);
            $modalRefuseImageFrontSubmit.removeAttr("data-kt-indicator");
        },
    });

}

function submitRefuseImageReverse() {
    $modalRefuseImageReverseSubmit.attr("data-kt-indicator", "on");
    $modalRefuseImageReverseSubmit.attr('disabled', true);

    var reason = $('#reason_refuse_reverse').val();

    $.ajax({
        url: $modalRefuseImageReverseSubmit.attr('data-url'),
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({ reason:reason}),
        processData:false,
        contentType:'application/json; charset=utf-8',
        success: function (data) {
            console.log(data);
            Swal.fire({
                text: data.message,
                icon: "success",
                buttonsStyling: !1,
                confirmButtonText: "Ok, entendido!",
                customClass: {confirmButton: "btn btn-primary"}
            }).then((function (e) {
                $modalRefuseImageReverseSubmit.removeAttr("data-kt-indicator");
                $modalRefuseImageReverseSubmit.attr('disabled', false);
                $btn_refuse_image_reverse.attr('disabled', true);
                $btn_refuse_image_reverse.removeClass('btn-danger');
                $btn_refuse_image_reverse.addClass('btn-secondary');
                $modalRefuseImageReverse.modal('hide');
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

            $modalRefuseImageReverseSubmit.attr('disabled', false);
            $modalRefuseImageReverseSubmit.removeAttr("data-kt-indicator");
        },
    });
}

function cancelRefuseImageReverse() {
    Swal.fire({
        text: "¿Estás seguro de cancelar?",
        icon: "success",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Si, regresar!",
        cancelButtonText: "No, continuar aquí",
        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
    }).then((function ($modalRefuseImageReverseSubmit) {
        $modalRefuseImageReverseSubmit.value ? ($modalRefuseImageReverse.modal('hide')) : "cancel" === $modalRefuseImageReverseSubmit.dismiss
    }))

}

function cancelRefuseImageFront() {
    Swal.fire({
        text: "¿Estás seguro de cancelar?",
        icon: "success",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Si, regresar!",
        cancelButtonText: "No, continuar aquí",
        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
    }).then((function ($modalRefuseImageFrontSubmit) {
        $modalRefuseImageFrontSubmit.value ? ($modalRefuseImageFront.modal('hide')) : "cancel" === $modalRefuseImageFrontSubmit.dismiss
    }))

}

function showRefuseImageFront() {
    var user_id = $(this).data('refuse_image_front');

    $('#user_id_image_front').val(user_id);

    $('#reason_refuse_front').val('');

    $modalRefuseImageFront.modal('show');
}

function showRefuseImageReverse() {
    var user_id = $(this).data('refuse_image_reverse');

    $('#user_id_image_reverse').val(user_id);

    $('#reason_refuse_reverse').val('');

    $modalRefuseImageReverse.modal('show');
}



function verifyImageFront() {
    var button = $(this);
    button.attr('disabled', true);

    $.ajax({
        url: button.data('url'),
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
                button.attr('disabled', true);
                button.removeClass('btn-primary');
                button.addClass('btn-secondary');
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

function verifyImageReverse() {
    var button = $(this);
    button.attr('disabled', true);

    $.ajax({
        url: button.data('url'),
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
                button.attr('disabled', true);
                button.removeClass('btn-primary');
                button.addClass('btn-secondary');
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

/*function submitFrontImage() {
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
}*/
