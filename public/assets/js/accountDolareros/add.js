"use strict";
var KTModalCustomersAdd = function () {
    var t, e, o, n, r, i;
    return {
        init: function () {
            i = new bootstrap.Modal(document.querySelector("#kt_modal_add_customer")), r = document.querySelector("#kt_modal_add_customer_form"), t = r.querySelector("#kt_modal_add_customer_submit"), e = r.querySelector("#kt_modal_add_customer_cancel"), o = r.querySelector("#kt_modal_add_customer_close"), n = FormValidation.formValidation(r, {
                fields: {
                    numberAccount: {validators: {notEmpty: {message: "El número de cuenta es obligatorio."}}},
                    bank_id: {
                        validators: {
                            notEmpty: {
                                message: 'El banco es requerido'
                            }
                        }
                    },
                    department_id: {
                        validators: {
                            notEmpty: {
                                message: 'El departmento es requerido'
                            }
                        }
                    },
                    currency: {
                        validators: {
                            notEmpty: {
                                message: 'La moneda es requerido'
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
            }), t.addEventListener("click", (function (e) {
                e.preventDefault(), n && n.validate().then((function (e) {
                    console.log("validated!"), "Valid" == e ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0,
                        $.ajax({
                            url: $('#kt_modal_add_customer_form').attr('data-kt-action'),
                            method: 'POST',
                            data: new FormData($('#kt_modal_add_customer_form')[0]),
                            processData:false,
                            contentType:false,
                            success: function (data) {
                                console.log(data);
                                setTimeout((function () {
                                    t.removeAttribute("data-kt-indicator"), Swal.fire({
                                        text: "Información enviada correctamente!",
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, entendido!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    }).then((function (e) {
                                        e.isConfirmed && (i.hide(), t.disabled = !1, window.location = r.getAttribute("data-kt-redirect"))
                                    }))
                                }), 1000)
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
                                t.setAttribute("data-kt-indicator", "off"), t.disabled = 0
                            },
                        })) : Swal.fire({
                        text: "Lo sentimos, detectamos unos errores, por favor intente nuevamente.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, entendido!",
                        customClass: {confirmButton: "btn btn-primary"}
                    })
                }))
            })), e.addEventListener("click", (function (t) {
                t.preventDefault(), Swal.fire({
                    text: "¿Estás seguro de cancelar?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Si, cancelar!",
                    cancelButtonText: "No, regresar",
                    customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                }).then((function (t) {
                    t.value ? (r.reset(), i.hide()) : "cancel" === t.dismiss /*&& Swal.fire({
                        text: "La información no ha sido enviada!.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, entendido!",
                        customClass: {confirmButton: "btn btn-primary"}
                    })*/
                }))
            })), o.addEventListener("click", (function (t) {
                t.preventDefault(), Swal.fire({
                    text: "¿Estás seguro de cancelar?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Si, cancelar!",
                    cancelButtonText: "No, regresar",
                    customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                }).then((function (t) {
                    t.value ? (r.reset(), i.hide()) : "cancel" === t.dismiss
                }))
            }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalCustomersAdd.init()
}));