"use strict";
var KTUsersAddPermission = function () {
    const t = document.getElementById("kt_modal_add_permission"), e = t.querySelector("#kt_modal_add_permission_form"),
        n = new bootstrap.Modal(t);
    return {
        init: function () {
            (() => {
                var o = FormValidation.formValidation(e, {
                    fields: {
                        permission_name: {
                            validators: {
                                notEmpty: {message: "El nombre en código es obligatorio."}
                            }
                        },
                        permission_description: {
                            validators: {
                                notEmpty: {message: "La descripción es obligatorio."}
                            }
                        }
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
                t.querySelector('[data-kt-permissions-modal-action="close"]').addEventListener("click", (t => {
                    t.preventDefault(), Swal.fire({
                        text: "¿Estás seguro de cerrar?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Sí, cerrar!",
                        cancelButtonText: "No, regresar",
                        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                    }).then((function (t) {
                        t.value && n.hide()
                    }))
                })), t.querySelector('[data-kt-permissions-modal-action="cancel"]').addEventListener("click", (t => {
                    t.preventDefault(), Swal.fire({
                        text: "¿Estás seguro de cancelar?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Si, cancelar!",
                        cancelButtonText: "No, regresar",
                        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                    }).then((function (t) {
                        t.value ? (e.reset(), n.hide()) : "cancel" === t.dismiss && Swal.fire({
                            text: "El formulario no ha sido cancelado!.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, entendido!",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }))
                }));
                const i = t.querySelector('[data-kt-permissions-modal-action="submit"]');
                i.addEventListener("click", (function (t) {
                    t.preventDefault(), o && o.validate().then((function (t) {
                        console.log("validated!"), "Valid" == t ? (i.setAttribute("data-kt-indicator", "on"), i.disabled = !0,
                            $.ajax({
                                url: $('#kt_modal_add_permission_form').attr('data-kt-action'),
                                method: 'POST',
                                data: new FormData($('#kt_modal_add_permission_form')[0]),
                                processData:false,
                                contentType:false,
                                success: function (data) {
                                    console.log(data);
                                    setTimeout((function () {
                                        i.removeAttribute("data-kt-indicator"), Swal.fire({
                                            text: data.message,
                                            icon: "success",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, entendido!",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        }).then((function (l) {
                                            l.isConfirmed && (n.hide(), i.disabled = !1, window.location = e.getAttribute("data-kt-redirect"))
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
                                    i.setAttribute("data-kt-indicator", "off"), i.disabled = 0
                                },
                            })) : Swal.fire({
                            text: "Lo sentimos, detectamos unos errores, por favor intente nuevamente.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, entendido!",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }))
                }))
            })()
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTUsersAddPermission.init()
}));