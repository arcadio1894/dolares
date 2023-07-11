$(document).ready(function () {

    $modalEdit = new bootstrap.Modal(document.querySelector("#kt_modal_edit_coupon"));
    $formEdit = document.querySelector("#kt_modal_edit_coupon_form");
    $buttonSubmit = $formEdit.querySelector("#kt_modal_edit_coupon_submit");
    $buttonCancel = $formEdit.querySelector("#kt_modal_edit_coupon_cancel");
    $buttonClose = $formEdit.querySelector("#kt_modal_edit_coupon_close");

    $formValidation = FormValidation.formValidation($formEdit, {
        fields: {
            name: {validators: {notEmpty: {message: "El número de cuenta es obligatorio."}}},
            amountSell: {
                validators: {
                    notEmpty: {
                        message: 'El monto venta es requerido'
                    }
                }
            },
            amountBuy: {
                validators: {
                    notEmpty: {
                        message: 'El monto compra es requerido'
                    }
                }
            },
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
    $(document).on('click', '[data-kt-coupon-status]', changeStatusCoupon);
    $(document).on('click', '[data-kt-coupon-special]', changeSpecialCoupon);

    $buttonSubmit.addEventListener("click", updateCoupon);

    $buttonClose.addEventListener("click", closeModalEdit);

    $buttonCancel.addEventListener("click", closeModalEdit);

    $modalAssign = new bootstrap.Modal(document.querySelector("#kt_modal_assign_coupon"));
    $formAssign = document.querySelector("#kt_modal_assign_coupon_form");
    $buttonSubmitAssign = $formAssign.querySelector("#kt_modal_assign_coupon_submit");
    $buttonCancelAssign = $formAssign.querySelector("#kt_modal_assign_coupon_cancel");
    $buttonCloseAssign = $formAssign.querySelector("#kt_modal_assign_coupon_close");

    $(document).on('click', '[data-kt-coupon-action="assign_row"]', showModalAssign);
    $(document).on('click', '#btn_search', getDataUser);

    $buttonSubmitAssign.addEventListener("click", assignCoupon);

    $buttonCloseAssign.addEventListener("click", closeModalAssign);

    $buttonCancelAssign.addEventListener("click", closeModalAssign);

    $("#document").on("input", function() {
        var inputLength = $(this).val().length;
        var submitButton = $("#btn_search");

        $buttonSubmitAssign.disabled = 1;

        if (inputLength >= 8) {
            submitButton.prop("disabled", false);
        } else {
            submitButton.prop("disabled", true);
        }
    });

    $(document).on('click', '[data-kt-coupon-action="users_row"]', showModalUsers);

    $modalUser = new bootstrap.Modal(document.querySelector("#kt_modal_user_coupon"));
    $modalUser1 = document.querySelector("#kt_modal_user_coupon");
    $buttonCancelUser = $modalUser1.querySelector("#kt_modal_user_coupon_close");
    $buttonCloseUser = $modalUser1.querySelector("#kt_modal_user_coupon_cancel");

    $buttonCloseUser.addEventListener("click", closeModalUser);

    $buttonCancelUser.addEventListener("click", closeModalUser);

});

var $formEdit;
var $modalEdit;
var $buttonSubmit;
var $buttonCancel;
var $buttonClose;
var $formValidation;

var $modalAssign;
var $formAssign;
var $buttonSubmitAssign;
var $buttonCancelAssign;
var $buttonCloseAssign;

var $modalUser;
var $modalUser1;
var $buttonCancelUser;
var $buttonCloseUser;

function changeStatusCoupon() {
    event.preventDefault();
    let button = $(this);
    let coupon_id = $(this).attr('data-kt-coupon-status');
    let status;
    if ($(this).is(':checked')) {
        status = 1;
    } else {
        status = 0;
    }

    Swal.fire({
        text: "¿Estás seguro de modificar el estado del cupón?",
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
                data: JSON.stringify({ status: status, coupon_id:coupon_id}),
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

function changeSpecialCoupon() {
    event.preventDefault();
    let button = $(this);
    let coupon_id = $(this).attr('data-kt-coupon-special');
    let special;
    if ($(this).is(':checked')) {
        special = 1;
    } else {
        special = 0;
    }

    Swal.fire({
        text: "¿Estás seguro de modificar el estado espcial del cupón?",
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
                data: JSON.stringify({ special: special, coupon_id:coupon_id}),
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
                            if ( special == 1 )
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

    let idCoupon = $(this).attr('data-kt-coupon');
    let name = $(this).attr('data-kt-name');
    let amountBuy = $(this).attr('data-kt-amountBuy');
    let amountSell = $(this).attr('data-kt-amountSell');

    $formEdit.querySelector('[name="coupon_id"]').value = idCoupon;

    $formEdit.querySelector('[name="name"]').value = name;

    $formEdit.querySelector('[name="amountSell"]').value = amountSell;

    $formEdit.querySelector('[name="amountBuy"]').value = amountBuy;

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

function showModalUsers() {
    let idCoupon = $(this).attr('data-kt-coupon');
    let name = $(this).attr('data-kt-name');

    $.get('/dashboard/get/user/assign/coupon/', {idCoupon:idCoupon},function(data) {
        // Función de éxito, se ejecuta cuando la solicitud GET es exitosa
        console.log(data);

        $("#body-users-assign").html('');
        $("#titleUsersAssign").html('Usuarios asignados el cupón '+ name );

        renderTemplateUserAssign(data.users);

        $modalUser.show();
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

function closeModalUser() {
    Swal.fire({
        text: "¿Estás seguro de cerrar?",
        icon: "warning",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Si, cancelar!",
        cancelButtonText: "No, regresar",
        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
    }).then((function ($buttonSubmitAssign) {
        $buttonSubmitAssign.value ? ($modalUser.hide()) : "cancel" === $buttonSubmitAssign.dismiss
    }))
}

function renderTemplateUserAssign(users) {
    for (var t = 0; t < users.length ; t++) {
        console.log(users[t]);
        var clone = activateTemplate('#template-data');
        clone.querySelector("[data-avatar]").innerHTML = users[t]['avatar'];
        clone.querySelector("[data-name]").innerHTML = users[t]['name'];
        clone.querySelector("[data-document]").innerHTML = users[t]['document'];
        clone.querySelector("[data-phone]").innerHTML = users[t]['phone'];

        $("#body-users-assign").append(clone);
    }
}

function showModalAssign() {
    let idCoupon = $(this).attr('data-kt-coupon');
    let name = $(this).attr('data-kt-name');

    $.get('/dashboard/get/data/coupon/', {idCoupon:idCoupon},function(data) {
        // Función de éxito, se ejecuta cuando la solicitud GET es exitosa
        console.log(data);
        $formAssign.querySelector('[name="coupon_id"]').value = idCoupon;

        $("#body-users").html('');
        $("#document").val('');
        $("#btn_search").prop("disabled", true);
        $("#titleAssign").html('Asignar cupón '+ name );
        $buttonSubmitAssign.disabled = 1;
        $modalAssign.show();
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

function getDataUser() {
    let document = $("#document").val();

    $.get('/dashboard/get/user/document/', {document:document},function(data) {
        // Función de éxito, se ejecuta cuando la solicitud GET es exitosa
        console.log(data);
        if ( data.user['id'] != null )
        {
            $buttonSubmitAssign.disabled = 0;
            $formAssign.querySelector('[name="user_id"]').value = data.user['id'];
        } else {
            $buttonSubmitAssign.disabled = 1;

        }
        $("#body-users").html('');

        renderTemplateUser(data.user);
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

    /*$.get('/dashboard/get/user/coupon/'+idCoupon, function(data) {
        // Función de éxito, se ejecuta cuando la solicitud GET es exitosa
        console.log(data);
        renderTemplateUsers(data.users);

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
        });*/
}

function assignCoupon() {
    event.preventDefault();
    $buttonSubmitAssign.setAttribute("data-kt-indicator", "on");
    $buttonSubmitAssign.disabled = !0;

    $.ajax({
        url: $('#kt_modal_assign_coupon_form').attr('data-kt-action'),
        method: 'POST',
        data: new FormData($('#kt_modal_assign_coupon_form')[0]),
        processData:false,
        contentType:false,
        success: function (data) {
            console.log(data);
            setTimeout((function () {
                $buttonSubmitAssign.removeAttribute("data-kt-indicator");
                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, entendido!",
                    customClass: {confirmButton: "btn btn-primary"}
                }).then((function (e) {
                    $modalAssign.hide();
                    $buttonSubmitAssign.disabled = !1;
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
            $buttonSubmitAssign.setAttribute("data-kt-indicator", "off");
            $buttonSubmitAssign.disabled = 0
        },
    });

}

function closeModalAssign($buttonSubmitAssign) {
    $buttonSubmitAssign.preventDefault();
    Swal.fire({
        text: "¿Estás seguro de cancelar?",
        icon: "warning",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Si, cancelar!",
        cancelButtonText: "No, regresar",
        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
    }).then((function ($buttonSubmitAssign) {
        $buttonSubmitAssign.value ? ($formAssign.reset(), $modalAssign.hide()) : "cancel" === $buttonSubmitAssign.dismiss
    }))
}

function renderTemplateUser(user) {
    var clone = activateTemplate('#template-data');
    clone.querySelector("[data-avatar]").innerHTML = user['avatar'];
    clone.querySelector("[data-name]").innerHTML = user['name'];
    clone.querySelector("[data-document]").innerHTML = user['document'];
    clone.querySelector("[data-phone]").innerHTML = user['phone'];
    $("#body-users").append(clone);
}

function renderTemplateUsers( users ) {
    for (var t = 0; t < users.length ; t++) {
        console.log(users[t]);
        var clone = activateTemplate('#template-user');
        clone.querySelector("[data-name]").innerHTML = users[t]['name'];
        clone.querySelector("[data-user]").setAttribute('value', users[t]['id']);
        if (users[t]['assign'] == 1)
        {
            clone.querySelector("[data-user]").setAttribute('checked', 'checked');
        }
        $("#body-users").append(clone);
    }
}

function activateTemplate(id) {
    var t = document.querySelector(id);
    return document.importNode(t.content, true);
}