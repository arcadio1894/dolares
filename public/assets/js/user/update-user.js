"use strict";
var KTUsersUpdatePermission = function () {
    const t = document.getElementById("kt_modal_update_user"),
        e = t.querySelector("#kt_modal_update_user_form"), n = new bootstrap.Modal(t);
    return {
        init: function () {
            (() => {
                var o = FormValidation.formValidation(e, {
                    fields: {
                        first_name: {
                            validators: {
                                notEmpty: {message: "El nombre es obligatorio."}
                            }
                        },
                        last_name: {
                            validators: {
                                notEmpty: {message: "El apellido es obligatorio."}
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {message: "El email es obligatorio."}
                            }
                        },
                        role: {
                            validators: {
                                choice: {
                                    min: 1,
                                    max: 1,
                                    message: 'Debes seleccionar una opción'
                                }
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
                t.querySelector('[data-kt-users-modal-action="close"]').addEventListener("click", (t => {
                    t.preventDefault(), Swal.fire({
                        text: "Are you sure you would like to close?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, close it!",
                        cancelButtonText: "No, return",
                        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                    }).then((function (t) {
                        t.value && n.hide()
                    }))
                })), t.querySelector('[data-kt-users-modal-action="cancel"]').addEventListener("click", (t => {
                    t.preventDefault(), Swal.fire({
                        text: "Are you sure you would like to cancel?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, cancel it!",
                        cancelButtonText: "No, return",
                        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                    }).then((function (t) {
                        t.value ? (e.reset(), n.hide()) : "cancel" === t.dismiss && Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }))
                }));
                const i = t.querySelector('[data-kt-users-modal-action="submit"]');
                i.addEventListener("click", (function (t) {
                    t.preventDefault(), o && o.validate().then((function (t) {
                        console.log("validated!"), "Valid" == t ? (i.setAttribute("data-kt-indicator", "on"), i.disabled = !0,
                            $.ajax({
                                url: $('#kt_modal_update_user_form').attr('data-kt-action'),
                                method: 'POST',
                                data: new FormData($('#kt_modal_update_user_form')[0]),
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
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }))
                }))
            })()
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTUsersUpdatePermission.init()
}));