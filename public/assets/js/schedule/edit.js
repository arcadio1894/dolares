$(document).ready(function () {

    $modalEdit = new bootstrap.Modal(document.querySelector("#kt_modal_edit_coupon"));
    $formEdit = document.querySelector("#kt_modal_edit_coupon_form");
    $buttonSubmit = $formEdit.querySelector("#kt_modal_edit_coupon_submit");
    $buttonCancel = $formEdit.querySelector("#kt_modal_edit_coupon_cancel");
    $buttonClose = $formEdit.querySelector("#kt_modal_edit_coupon_close");

    $formValidation = FormValidation.formValidation($formEdit, {
        fields: {
            hourStart: {validators: {notEmpty: {message: "La hora de inicio es obligatorio."}}},
            hourEnd: {validators: {notEmpty: {message: "La hora de término es obligatorio."}}},
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger,
            bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: ".fv-row",
                eleInvalidClass: "",
                eleValidClass: ""
            })
        }
    });

    $(document).on('click', '[data-kt-coupon-action="update_row"]', showModalEdit);
    $(document).on('click', '[data-kt-schedule-status]', changeStatusSchedule);

    $(document).on('click', '[data-kt-button-turn-off-status]', changeStatusTurnOff);

    $buttonSubmit.addEventListener("click", updateCoupon);

    $buttonClose.addEventListener("click", closeModalEdit);

    $buttonCancel.addEventListener("click", closeModalEdit);

});

var $formEdit;
var $modalEdit;
var $buttonSubmit;
var $buttonCancel;
var $buttonClose;
var $formValidation;

function changeStatusTurnOff() {
    event.preventDefault();
    let button = $(this);
    let data_id = $(this).attr('data-kt-button-turn-off-status');
    let status;
    if ($(this).is(':checked')) {
        status = 1;
    } else {
        status = 0;
    }

    Swal.fire({
        text: "¿Estás seguro de apagar el sistema?",
        icon: "warning",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Si, apagar!",
        cancelButtonText: "No, regresar",
        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
    }).then((function (t) {
        t.value ? (
            $.ajax({
                url: button.attr('data-kt-action'),
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: JSON.stringify({ status: status, data_id:data_id}),
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
                            if ( status == 1 )
                            {
                                // Check #x
                                button.prop( "checked", true );
                            } else {
                                // Uncheck #x
                                button.prop( "checked", false );
                            }

                            location.reload();
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

function changeStatusSchedule() {
    event.preventDefault();
    let button = $(this);
    let schedule_id = $(this).attr('data-kt-schedule-status');
    let status;
    if ($(this).is(':checked')) {
        status = 1;
    } else {
        status = 0;
    }

    Swal.fire({
        text: "¿Estás seguro de modificar el estado del horario?",
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
                data: JSON.stringify({ status: status, schedule_id:schedule_id}),
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
                            if ( status == 1 )
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

    let idSchedule = $(this).attr('data-kt-schedule');
    let day = $(this).attr('data-kt-day');
    let nameDay = $(this).attr('data-kt-nameDay');
    let hourStart = $(this).attr('data-kt-hourStart');
    let hourEnd = $(this).attr('data-kt-hourEnd');

    $formEdit.querySelector('[name="schedule_id"]').value = idSchedule;

    $formEdit.querySelector('[name="nameDay"]').value = nameDay;

    $formEdit.querySelector('[name="day"]').value = day;

    $formEdit.querySelector('[name="hourStart"]').value = hourStart;

    $formEdit.querySelector('[name="hourEnd"]').value = hourEnd;

    $modalEdit.show();
}

function updateCoupon() {
    event.preventDefault();
    $formValidation.validate().then((function (e) {
        console.log("validated!"), "Valid" == e ? ($buttonSubmit.setAttribute("data-kt-indicator", "on"), $buttonSubmit.disabled = !0,
            $.ajax({
                url: $('#kt_modal_edit_coupon_form').attr('data-kt-action'),
                method: 'POST',
                data: new FormData($('#kt_modal_edit_coupon_form')[0]),
                processData:false,
                contentType:false,
                success: function (data) {
                    console.log(data);
                    setTimeout((function () {
                        $buttonSubmit.removeAttribute("data-kt-indicator"), Swal.fire({
                            text: data.message,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, entendido!",
                            customClass: {confirmButton: "btn btn-primary"}
                        }).then((function (e) {
                            e.isConfirmed && ($modalEdit.hide(), $buttonSubmit.disabled = !1, window.location = $formEdit.getAttribute("data-kt-redirect"))
                        }))
                    }), 500)
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
                    $buttonSubmit.setAttribute("data-kt-indicator", "off"), $buttonSubmit.disabled = 0
                },
            })) : Swal.fire({
            text: "Lo sentimos, detectamos unos errores, por favor intente nuevamente.",
            icon: "error",
            buttonsStyling: !1,
            confirmButtonText: "Ok, entendido!",
            customClass: {confirmButton: "btn btn-primary"}
        })
    }));
}
