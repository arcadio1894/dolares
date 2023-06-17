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
});

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
        url = url + document.location.origin+ '/dashboard/download/image/operation/'+operation_id;
        $("#imageReceipt").attr("href", url);

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
