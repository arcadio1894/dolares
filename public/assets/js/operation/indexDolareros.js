$(document).ready(function () {
    $modalDetail = new bootstrap.Modal(document.querySelector("#kt_modal_operation_details"));
    $(document).on('click', '[data-kt-operation-action="show_details"]', showModalDetails);

    $modalDetail1 = document.querySelector("#kt_modal_operation_details");

    $buttonCancel = $modalDetail1.querySelector("#kt_modal_operation_detail_close");
    $buttonCancel.addEventListener("click", closeModalDetail);
    //$(document).on('click', '[data-kt-account-active]', changeStatusAccount);

    $modalReceipt = new bootstrap.Modal(document.querySelector("#kt_modal_operation_receipt"));
    $(document).on('click', '[data-kt-operation-action="show_receipt"]', showModalReceipt);

    $modalReceipt1 = document.querySelector("#kt_modal_operation_receipt");

    $buttonCancelReceipt = $modalReceipt1.querySelector("#kt_modal_operation_receipt_close");
    $buttonCancelReceipt.addEventListener("click", closeModalReceipt);

    $modalRefused = new bootstrap.Modal(document.querySelector("#kt_modal_operation_refused"));
    $(document).on('click', '[data-kt-operation-action="show_refused"]', showModalRefused);

    $modalRefused1 = document.querySelector("#kt_modal_operation_refused");

    $buttonCancelRefused = $modalRefused1.querySelector("#kt_modal_operation_refused_close");
    $buttonCancelRefused.addEventListener("click", closeModalRefused);

    $modalRegisterRefused = new bootstrap.Modal(document.querySelector("#kt_modal_register_refused"));
    $(document).on('click', '[data-kt-operation-action="refused_operation"]', showModalRegisterRefused);

    $modalRegisterRefused1 = document.querySelector("#kt_modal_register_refused");

    $buttonCancelRegisterRefused = $modalRegisterRefused1.querySelector("#kt_modal_register_refused_close");
    $buttonCancelRegisterRefused.addEventListener("click", closeModalRegisterRefused);
    $buttonSubmitRegisterRefused = $modalRegisterRefused1.querySelector("#kt_modal_register_refused_submit");
    $buttonSubmitRegisterRefused.addEventListener("click", submitRegisterRefused);

    $modalRegisterReceipt = new bootstrap.Modal(document.querySelector("#kt_modal_register_receipt"));
    $(document).on('click', '[data-kt-operation-action="finish_operation"]', showModalRegisterReceipt);

    $modalRegisterReceipt1 = document.querySelector("#kt_modal_register_receipt");

    $buttonCancelRegisterReceipt = $modalRegisterReceipt1.querySelector("#kt_modal_register_receipt_close");
    $buttonCancelRegisterReceipt.addEventListener("click", closeModalRegisterReceipt);
    $buttonSubmitRegisterReceipt = $modalRegisterReceipt1.querySelector("#kt_modal_register_receipt_submit");
    $buttonSubmitRegisterReceipt.addEventListener("click", submitRegisterReceipt);


    $modalEditReceipt = new bootstrap.Modal(document.querySelector("#kt_modal_edit_receipt"));
    $(document).on('click', '[data-kt-operation-action="change_receipt"]', showModalEditReceipt);

    $modalEditReceipt1 = document.querySelector("#kt_modal_edit_receipt");

    $buttonCancelEditReceipt = $modalEditReceipt1.querySelector("#kt_modal_edit_receipt_close");
    $buttonCancelEditReceipt.addEventListener("click", closeModalEditReceipt);
    $buttonSubmitEditReceipt = $modalEditReceipt1.querySelector("#kt_modal_edit_receipt_submit");
    $buttonSubmitEditReceipt.addEventListener("click", submitEditReceipt);

    $(document).on('click', '[data-image_receipt]', showModalImage);

    $modalImage = new bootstrap.Modal(document.querySelector("#kt_modal_image_receipt"));
});

var $modalImage;

var $modalEditReceipt;
var $modalEditReceipt1;
var $buttonCancelEditReceipt;
var $buttonSubmitEditReceipt;

var $modalRegisterReceipt;
var $modalRegisterReceipt1;
var $buttonCancelRegisterReceipt;
var $buttonSubmitRegisterReceipt;

var $modalRegisterRefused;
var $modalRegisterRefused1;
var $buttonCancelRegisterRefused;
var $buttonSubmitRegisterRefused;

var $modalRefused;
var $modalRefused1;
var $buttonCancelRefused;

var $modalReceipt;
var $modalReceipt1;
var $buttonCancelReceipt;

var $formEdit;
var $modalDetail;
var $buttonCancel;
var $modalDetail1;

function showModalImage() {
    $modalReceipt.hide();
    var urlImage = $(this).attr('data-url');
    console.log(urlImage);
    $("#showImageReceipt").attr('src', urlImage);
    $modalImage.show();
}

function submitEditReceipt() {
    $buttonSubmitEditReceipt.setAttribute("data-kt-indicator", "on");
    $buttonSubmitEditReceipt.disabled = 1;

    var operation_id = $("#operation_id_edit_receipt").val();
    var numberOperation = $("#numberOperationDolarerosEdit").val();

    var fileInput = $('#imageOperationDolarerosEdit')[0].files[0];
    var formData = new FormData();

    formData.append('operation_id', operation_id);
    formData.append('number_operation', numberOperation);
    formData.append('image_operation', fileInput);

    $.ajax({
        url: $("#kt_modal_edit_receipt_submit").attr('data-url'),
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
                $buttonSubmitEditReceipt.disabled = 0;
                $buttonSubmitEditReceipt.removeAttribute("data-kt-indicator");
                $modalEditReceipt.hide();
                location.reload();
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

            $buttonSubmitEditReceipt.disabled = 0;
            $buttonSubmitEditReceipt.removeAttribute("data-kt-indicator");
        },
    });
}

function closeModalEditReceipt() {
    Swal.fire({
        text: "¿Estás seguro de regresar?",
        icon: "success",
        buttonsStyling: !1,
        confirmButtonText: "Si, regresar!",
        customClass: {confirmButton: "btn btn-primary"}
    }).then((function () {
        $("#rejection_id").val(null).trigger("change");
        $modalEditReceipt.hide()
    }))
}

function showModalEditReceipt() {
    var operation_id = $(this).attr('data-kt-operation');

    var image_receipt = $(this).attr('data-kt-operation_image_receipt');

    var number_operation_dolareros = $(this).attr('data-kt-operation_number_operation_dolareros');

    $("#operation_id_edit_receipt").val(operation_id);
    $("#numberOperationDolarerosEdit").val(number_operation_dolareros);
    $("#imageOperationDolarerosEdit").val("");

    $modalEditReceipt.show();
}


function submitRegisterReceipt() {
    $buttonSubmitRegisterReceipt.setAttribute("data-kt-indicator", "on");
    $buttonSubmitRegisterReceipt.disabled = 1;

    var operation_id = $("#operation_id_register_receipt").val();
    var numberOperation = $("#numberOperationDolareros").val();

    var fileInput = $('#imageOperationDolareros')[0].files[0];
    var formData = new FormData();

    formData.append('operation_id', operation_id);
    formData.append('number_operation', numberOperation);
    formData.append('image_operation', fileInput);

    $.ajax({
        url: $("#kt_modal_register_receipt_submit").attr('data-url'),
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
                $buttonSubmitRegisterReceipt.disabled = 0;
                $buttonSubmitRegisterReceipt.removeAttribute("data-kt-indicator");
                var numberPhone = data.numberPhone;
                var numberOperation = data.numberOperation;
                var text = 'Hola Dolarero, este mensaje es para informarte que tu operación '+numberOperation+' fue finalizada con éxito.';
                var url = 'https://api.whatsapp.com/send?phone='+numberPhone+'&text='+text;
                window.open(url, '_blank');
                $modalRegisterReceipt.hide();
                location.reload();
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

            $buttonSubmitRegisterReceipt.disabled = 0;
            $buttonSubmitRegisterReceipt.removeAttribute("data-kt-indicator");
        },
    });
}

function closeModalRegisterReceipt() {
    Swal.fire({
        text: "¿Estás seguro de regresar?",
        icon: "success",
        buttonsStyling: !1,
        confirmButtonText: "Si, regresar!",
        customClass: {confirmButton: "btn btn-primary"}
    }).then((function () {
        $("#rejection_id").val(null).trigger("change");
        $modalRegisterReceipt.hide()
    }))
}

function showModalRegisterReceipt() {
    var operation_id = $(this).attr('data-kt-operation');

    $("#operation_id_register_receipt").val(operation_id);
    $("#numberOperationDolareros").val("");
    $("#imageOperationDolareros").val("");

    $modalRegisterReceipt.show();
}

function closeModalRegisterRefused() {

    Swal.fire({
        text: "¿Estás seguro de regresar?",
        icon: "success",
        buttonsStyling: !1,
        confirmButtonText: "Si, regresar!",
        customClass: {confirmButton: "btn btn-primary"}
    }).then((function () {
        $("#rejection_id").val(null).trigger("change");
        $modalRegisterRefused.hide()
    }))
}

function submitRegisterRefused() {
    $buttonSubmitRegisterRefused.setAttribute("data-kt-indicator", "on");
    $buttonSubmitRegisterRefused.disabled = 1;
    var operation_id = $("#operation_id_register_refused").val();
    var rejection_id = $("#rejection_id").val();
    $.ajax({
        url: $("#kt_modal_register_refused_submit").attr('data-url'),
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({ operation_id:operation_id, rejection_id:rejection_id}),
        processData:false,
        contentType:'application/json; charset=utf-8',
        success: function (data) {
            console.log(data);
            Swal.fire({
                text: "Información verificada correctamente!",
                icon: "success",
                buttonsStyling: !1,
                confirmButtonText: "Ok, entendido!",
                customClass: {confirmButton: "btn btn-primary"}
            }).then((function (e) {
                $buttonSubmitRegisterRefused.disabled = 0;
                $buttonSubmitRegisterRefused.removeAttribute("data-kt-indicator");
                $modalRegisterRefused.hide();
                location.reload();
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

            $buttonSubmitRegisterRefused.disabled = 0;
            $buttonSubmitRegisterRefused.removeAttribute("data-kt-indicator");
        },
    });
}

function showModalRegisterRefused() {
    var operation_id = $(this).attr('data-kt-operation');

    $("#operation_id_register_refused").val(operation_id);

    $modalRegisterRefused.show();
}

function showModalRefused() {
    var operation_id = $(this).attr('data-kt-operation');

    $.get('/dashboard/get/refused/operation/'+operation_id, function(data) {
        // Función de éxito, se ejecuta cuando la solicitud GET es exitosa
        console.log(data);

        $("#reasonRefused").html(data.reasonRefused);

        $modalRefused.show();
    }).fail(function(jqXHR, textStatus, errorThrown) {
        // Función de error, se ejecuta cuando la solicitud GET falla
        console.error(textStatus, errorThrown);
        if (jqXHR.responseJSON.message && !jqXHR.responseJSON.errors) {
            toastr.error(jqXHR.responseJSON.message, 'Error', {
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
        for (var property in jqXHR.responseJSON.errors) {
            toastr.error(jqXHR.responseJSON.errors[property], 'Error', {
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
    }, 'json')
        .done(function() {
            // Configuración de encabezados
            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            };

            $.ajaxSetup({
                headers: headers
            });
        });

}

function closeModalRefused() {
    Swal.fire({
        text: "¿Estás seguro de regresar?",
        icon: "success",
        buttonsStyling: !1,
        confirmButtonText: "Si, regresar!",
        customClass: {confirmButton: "btn btn-primary"}
    }).then((function () {
        $modalRefused.hide()
    }))
}

function showModalReceipt() {
    var operation_id = $(this).attr('data-kt-operation');
    $.get('/dashboard/get/receipt/operation/'+operation_id, function(data) {
        // Función de éxito, se ejecuta cuando la solicitud GET es exitosa
        console.log(data);

        $("#rucEmisor").html(data.rucEmisor);
        $("#numberOperation").html(data.numberOperation);
        $("#fecha").html(data.fecha);
        $("#montoEnviadoReceipt").html(data.montoEnviadoReceipt);

        var url = "";
        //url = url + document.location.origin+ '/dashboard/download/image/operation/'+operation_id;
        url = url + document.location.origin+ '/assets/images/operation/receipts/'+data.imageReceipt;
        //$("#imageReceipt").attr("href", url);
        $("#imageReceipt").attr("data-url", url);

        $modalReceipt.show();
    }).fail(function(jqXHR, textStatus, errorThrown) {
        // Función de error, se ejecuta cuando la solicitud GET falla
        console.error(textStatus, errorThrown);
        if (jqXHR.responseJSON.message && !jqXHR.responseJSON.errors) {
            toastr.error(jqXHR.responseJSON.message, 'Error', {
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
        for (var property in jqXHR.responseJSON.errors) {
            toastr.error(jqXHR.responseJSON.errors[property], 'Error', {
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
    }, 'json')
        .done(function() {
            // Configuración de encabezados
            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            };

            $.ajaxSetup({
                headers: headers
            });
        });

}

function closeModalReceipt() {
    Swal.fire({
        text: "¿Estás seguro de regresar?",
        icon: "success",
        buttonsStyling: !1,
        confirmButtonText: "Si, regresar!",
        customClass: {confirmButton: "btn btn-primary"}
    }).then((function () {
        $modalReceipt.hide()
    }))
}

function closeModalDetail() {
    Swal.fire({
        text: "¿Estás seguro de regresar?",
        icon: "success",
        buttonsStyling: !1,
        confirmButtonText: "Si, regresar!",
        customClass: {confirmButton: "btn btn-primary"}
    }).then((function () {
        $modalDetail.hide()
    }))
}

function showModalDetails() {
    var operation_id = $(this).attr('data-kt-operation');
    $.get('/dashboard/get/info/operation/'+operation_id, function(data) {
        // Función de éxito, se ejecuta cuando la solicitud GET es exitosa
        console.log(data);

        $("#fechaOperacion").html(data.fechaOperacion);
        $("#numeroOperacion").html(data.numeroOperacion);
        $("#tipoCambio").html(data.tipoCambio);
        $("#montoEnviado").html(data.montoEnviado);
        $("#montoRecibido").html(data.montoRecibido);
        $("#cuentaDolareros").html(data.cuentaDolareros);
        $("#cuentaDestino").html(data.cuentaDestino);

        if ( data.estadoOperacion == 'PROCESANDO' )
        {
            $("#estadoOperacion").html('<i class="fas fa-question" style="color: #ffc107;"></i> ' + data.estadoOperacion);
            $("#estadoOperacion").removeClass('text-warning');
            $("#estadoOperacion").removeClass('text-success');
            $("#estadoOperacion").removeClass('text-danger');
            $("#estadoOperacion").addClass('text-warning');
        } else {
            if (data.estadoOperacion == 'RECHAZADO')
            {
                $("#estadoOperacion").html('<i class="fas fa-times" style="color: #dc3545;"></i> ' + data.estadoOperacion);
                $("#estadoOperacion").removeClass('text-warning');
                $("#estadoOperacion").removeClass('text-success');
                $("#estadoOperacion").removeClass('text-danger');
                $("#estadoOperacion").addClass('text-danger');
            } else {
                $("#estadoOperacion").html('<i class="fas fa-check" style="color: #28a745;"></i> ' + data.estadoOperacion);
                $("#estadoOperacion").removeClass('text-warning');
                $("#estadoOperacion").removeClass('text-success');
                $("#estadoOperacion").removeClass('text-danger');
                $("#estadoOperacion").addClass('text-primary');

            }
        }

        $modalDetail.show();
    }).fail(function(jqXHR, textStatus, errorThrown) {
        // Función de error, se ejecuta cuando la solicitud GET falla
        console.error(textStatus, errorThrown);
        if (jqXHR.responseJSON.message && !jqXHR.responseJSON.errors) {
            toastr.error(jqXHR.responseJSON.message, 'Error', {
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
        for (var property in jqXHR.responseJSON.errors) {
            toastr.error(jqXHR.responseJSON.errors[property], 'Error', {
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
    }, 'json')
        .done(function() {
            // Configuración de encabezados
            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            };

            $.ajaxSetup({
                headers: headers
            });
        });

}

function changeStatusAccount() {
    event.preventDefault();
    let button = $(this);
    let account_id = $(this).attr('data-kt-account-active');
    let statusAccount;
    if ($(this).is(':checked')) {
        statusAccount = 1;
    } else {
        statusAccount = 0;
    }

    Swal.fire({
        text: "¿Estás seguro de modificar el estado de la cuenta?",
        icon: "warning",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Si, modificar!",
        cancelButtonText: "No, regresar",
        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
    }).then((function (t) {
        t.value ? (
            $.ajax({
                url: button.attr('data-kt-action'),
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: JSON.stringify({ statusAccount: statusAccount, account_id:account_id}),
                processData:false,
                contentType:'application/json; charset=utf-8',
                success: function (data) {
                    console.log(data);
                    setTimeout((function () {
                        Swal.fire({
                            text: data.message,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, entendido!",
                            customClass: {confirmButton: "btn btn-primary"}
                        }).then((function () {
                            //window.location = redirect;
                            if ( statusAccount == 1 )
                            {
                                // Check #x
                                button.prop( "checked", true );
                            } else {
                                // Uncheck #x
                                button.prop( "checked", false );
                            }


                        }))
                    }), 2e3)
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
                },
            })
        ) : "cancel" === t.dismiss && Swal.fire({
            text: "La información no ha sido enviada!.",
            icon: "error",
            buttonsStyling: !1,
            confirmButtonText: "Ok, entendido!",
            customClass: {confirmButton: "btn btn-primary"}
        })
    }));
}

function closeModalEdit($buttonSubmit) {
    $buttonSubmit.preventDefault();
    Swal.fire({
        text: "¿Estás seguro de cancelar?",
        icon: "warning",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Si, cancelar!",
        cancelButtonText: "No, regresar",
        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
    }).then((function ($buttonSubmit) {
        $buttonSubmit.value ? ($formEdit.reset(), $modalEdit.hide()) : "cancel" === $buttonSubmit.dismiss
    }))
}

function showModalEdit() {

    var optionFormat = function(item) {
        if ( !item.id ) {
            return item.text;
        }

        var span = document.createElement('span');
        var imgUrl = item.element.getAttribute('data-kt-select2-bank');
        var template = '';

        template += '<img src="' + imgUrl + '" class="rounded-circle h-20px me-2" alt="image"/>';
        template += item.text;

        span.innerHTML = template;

        return $(span);
    };

    let idBank = $(this).attr('data-kt-bank');
    let idDepartment = $(this).attr('data-kt-department');
    let statusAccount = $(this).attr('data-kt-status');
    let numberAccount = $(this).attr('data-kt-numberAccount');
    let currency = $(this).attr('data-kt-currency');
    let idAccount = $(this).attr('data-kt-account');

    $formEdit.querySelector('[name="account_id"]').value = idAccount;

    $formEdit.querySelector('[name="numberAccount"]').value = numberAccount;

    //$formEdit.querySelector('[name="bank_id"]').value = idBank;

    //$formEdit.querySelector('[name="currency"]').value = 'USD';

    let c = $('#currency').select2({
        minimumResultsForSearch: Infinity,
        dropdownParent: $("#kt_modal_edit_customer")
    });

    c.val(currency);
    c.trigger('change');

    let b = $('#bank_id').select2({
        templateSelection: optionFormat,
        templateResult: optionFormat,
        minimumResultsForSearch: Infinity,
        dropdownParent: $("#kt_modal_edit_customer")
    });

    b.val(idBank);
    b.trigger('change');

    let d = $('#department_id').select2({
        minimumResultsForSearch: Infinity,
        dropdownParent: $("#kt_modal_edit_customer")
    });

    d.val(idDepartment);
    d.trigger('change');

    if ( statusAccount == 1 )
    {
        $formEdit.querySelector('[name="statusAccount"]').checked = true;
    } else {
        $formEdit.querySelector('[name="statusAccount"]').checked = false;
    }
    $.fn.modal.Constructor.prototype.enforceFocus = function () {};
    $modalEdit.show();
}
