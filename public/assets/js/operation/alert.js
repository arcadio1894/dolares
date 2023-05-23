$(document).ready(function () {

    // TODO: Obtenemos la operación pendiente
    $.get('/dashboard/get/operation/pending', function(data) {
        // Función de éxito, se ejecuta cuando la solicitud GET es exitosa
        console.log(data);
        stopAllAndShowModal(data);
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
    /*$.ajax({
        url: '/dashboard/get/operation/pending/',
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        processData:false,
        contentType:'application/json; charset=utf-8',
        success: function (data) {
            console.log(data);
            stopAllAndShowModal(data.stopOperation);
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
    });*/

});

var $formEdit2;
var $modalEdit2;
var $buttonSubmit2;
var $buttonCancel2;
var $stepper2;

function stopAllAndShowModal(data) {
    if ( data.stopOperation != null )
    {
        Swal.fire({
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            text: "Tienes una operación pendiente!",
            icon: "warning",
            buttonsStyling: !1,
            confirmButtonText: "Continuar operación",
            showDenyButton: true,
            denyButtonText: `Cancelar operación`,
            customClass: {confirmButton: "btn btn-primary", denyButton: "btn btn-danger"}
        }).then((function (result) {
            if (result.isConfirmed) {
                //TODO: Enviar a crear operación
                Swal.fire({
                    icon: 'success',
                    title: 'Redireccionando a la operación',
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function() {
                    location.href = data.url;
                }, 1500);

            } else if (result.isDenied) {
                //TODO: Cancelar la operación
                cancelOperation(data.stopOperation);
                /*Swal.fire('Changes are not saved', '', 'info')*/
            }

        }))
    }

}

function cancelOperation(stopOperation) {
    $.post('/dashboard/cancel/operation/pending', {
        operationID: stopOperation.id
    }, function(data) {
        // Función de éxito, se ejecuta cuando la solicitud POST es exitosa
        Swal.fire({
            icon: 'success',
            title: data.message,
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function() {
            location.href = data.url;
        }, 1500);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        // Función de error, se ejecuta cuando la solicitud POST falla
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
    });
    /*$.ajax({
        url: '/dashboard/cancel/operation/pending/',
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({ operationID: stopOperation.id }),
        processData:false,
        contentType:'application/json; charset=utf-8',
        success: function (data) {
            Swal.fire({
                icon: 'success',
                title: data.message,
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout(function() {
                location.href = data.url;
            }, 1500);
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
    });*/
}

function closeModalSummary($buttonSubmit2) {
    $buttonSubmit2.preventDefault();
    Swal.fire({
        text: "¿Estás seguro de regresar?",
        icon: "success",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Si, regresar!",
        cancelButtonText: "No, continuar aquí",
        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
    }).then((function ($buttonSubmit2) {
        $buttonSubmit2.value ? ($modalEdit2.hide()) : "cancel" === $buttonSubmit2.dismiss
    }))
}

function goToSecondStep() {
    // TODO: Guardar el stopOperation con los datos que estan
    let bancoOrigen = "";
    let cuentaDestinoId = "";
    let sourceId = "";

    $buttonSubmit2.disabled = 1;
    var selectElement = $("#bank_id");
    var selectElement2 = $("#account_id");
    var selectElement3 = $("#source_id");

    var selectedOption = selectElement.select2("data")[0];
    bancoOrigen = selectedOption.text;

    var selectedOption2 = selectElement2.select2("data")[0];
    cuentaDestinoId = selectedOption2.id;

    var selectedOption3 = selectElement3.select2("data")[0];
    sourceId = selectedOption3.id;

    $.ajax({
        url: $("#kt_modal_summary_next").attr('data-url'),
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({ bancoOrigen: bancoOrigen, cuentaDestinoId:cuentaDestinoId, sourceId:sourceId}),
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
                console.log($stepper2);
                $modalEdit2.hide();
                $stepper2.goTo(2);
                $buttonSubmit2.disabled = !1;
                //e.isConfirmed && ($modalEdit2.hide(), $stepper2.goTo(2), );

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

            $buttonSubmit2.disabled = 0;
        },
    });

}