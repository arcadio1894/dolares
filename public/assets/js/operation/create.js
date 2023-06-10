"use strict";
var KTCreateAccount = function () {
    var e, t, i, o, s, a = [];
    return {
        init: function () {
            (e = document.querySelector("#kt_modal_create_account"))
            &&
            new bootstrap.Modal(e),
                t = document.querySelector("#kt_create_account_stepper"),
                i = t.querySelector("#kt_create_account_form"),
                o = t.querySelector('[data-kt-stepper-action="submit"]'),
                s = t.querySelector('[data-kt-stepper-action="next"]'),
                ($r = new KTStepper(t)).on("kt.stepper.changed", (function (e) {
                3 === $r.getCurrentStepIndex() ? (o.classList.remove("d-none"), o.classList.add("d-inline-block"), s.classList.add("d-none")) : 4 === $r.getCurrentStepIndex() ? (o.classList.add("d-none"), s.classList.add("d-none")) : (o.classList.remove("d-inline-block"), o.classList.remove("d-none"), s.classList.remove("d-none"))
            })), $r.on("kt.stepper.next", (function (e) {
                console.log("stepper.next");
                var t = a[e.getCurrentStepIndex() - 1];
                if ( e.getCurrentStepIndex() != 1 )
                {
                    if ( e.getCurrentStepIndex() == 2 )
                    {
                        t ? t.validate().then((function (t) {
                        console.log("validated!"), "Valid" == t ? ((
                            showModalSecondStep()
                        ), KTUtil.scrollTop()) : Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn btn-light"}
                        }).then((function () {
                            KTUtil.scrollTop()
                        }))
                    })) : ((
                            showModalSecondStep()
                        ), KTUtil.scrollTop())
                    } else {
                        t ? t.validate().then((function (t) {
                        console.log("validated!"), "Valid" == t ? (e.goNext(), KTUtil.scrollTop()) : Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn btn-light"}
                        }).then((function () {
                            KTUtil.scrollTop()
                        }))
                    })) : (e.goNext(), KTUtil.scrollTop())
                    }

                } else {
                    t ? t.validate().then((function (t) {
                        console.log("validated!"), "Valid" == t ? ((
                            showModalSummary()
                            //$('#kt_modal_summary').modal('show')
                        ), KTUtil.scrollTop()) : Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn btn-light"}
                        }).then((function () {
                            KTUtil.scrollTop()
                        }))
                    })) : ((
                        showModalSummary()
                        //$('#kt_modal_summary').modal('show')
                    ), KTUtil.scrollTop())
                }

            })), $r.on("kt.stepper.previous", (function (e) {
                console.log("stepper.previous"), e.goPrevious(), KTUtil.scrollTop()
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    bank_id:
                        {
                            validators: {notEmpty: {message: "El banco desde donde nos envias tu dinero es obligatorio."}}
                        },
                    source_id:
                        {
                            validators: {notEmpty: {message: "El origen de fondos es obligatorio."}}
                        },
                    account_id:
                        {
                            validators: {notEmpty: {message: "La cuenta en la que deseas recibir tu dinero es obligatorio."}}
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
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    //number_operation : {validators: {notEmpty: {message: "Busines description is required"}}}
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    number_operation : {validators: {notEmpty: {message: "EL código de la operación es obligatorio."}}}
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })),
                /*a.push(FormValidation.formValidation(i, {
                fields: {
                    card_name: {validators: {notEmpty: {message: "Name on card is required"}}},
                    card_number: {
                        validators: {
                            notEmpty: {message: "Card member is required"},
                            creditCard: {message: "Card number is not valid"}
                        }
                    },
                    card_expiry_month: {validators: {notEmpty: {message: "Month is required"}}},
                    card_expiry_year: {validators: {notEmpty: {message: "Year is required"}}},
                    card_cvv: {
                        validators: {
                            notEmpty: {message: "CVV is required"},
                            digits: {message: "CVV must contain only digits"},
                            stringLength: {min: 3, max: 4, message: "CVV must contain 3 to 4 digits only"}
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
            })),*/ o.addEventListener("click", (function (e) {
                a[2].validate().then((function (t) {
                    console.log("validated!"), "Valid" == t ? (e.preventDefault(), o.disabled = !0, o.setAttribute("data-kt-indicator", "on"), setTimeout((function () {
                        o.removeAttribute("data-kt-indicator"), o.disabled = !1, showModalFinalStep()
                    }), 2e3)) : Swal.fire({
                        text: "Disculpe, hemos detectado algunos errores, revise que los campos estén llenados correctamente.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, entendido!",
                        customClass: {confirmButton: "btn btn-light"}
                    }).then((function () {
                        KTUtil.scrollTop()
                    }))
                }))
            }))
        }
    }
}();

var $r;

KTUtil.onDOMContentLoaded((function () {
    KTCreateAccount.init();
}));

function showModalSummary() {
    var selectElement = $("#bank_id"); // Reemplaza "miSelect2" con el ID de tu elemento select2

    var selectedOption = selectElement.select2("data")[0];
    var nameBank = selectedOption.text;

    var selectElement2 = $("#account_id"); // Reemplaza "miSelect2" con el ID de tu elemento select2

    var selectedOption2 = selectElement2.select2("data")[0];
    var option = selectedOption2.text;
    //var banco = banco.substring(0, texto.indexOf("-")-1);
    var primerGuion = option.indexOf("-");

    // Buscar la posición del segundo guion a partir de la posición del primer guion
    var segundoGuion = option.indexOf("-", primerGuion + 1);

    // Obtener la subcadena desde el principio hasta el segundo guion
    var nameBank2 = option.substring(0, segundoGuion).trim();

    var partes = option.split("-");

    // Obtener la segunda parte del arreglo
    var nameAccount = partes[2].trim();

    $('#nameBank').html(nameBank);
    $('#nameBank2').html(nameBank2);
    $('#nameAccount').html(nameAccount);

    $('#kt_modal_summary').modal('show')
}

function showModalSecondStep() {
    $('#kt_modal_second_step').modal('show')
}

function showModalFinalStep() {
    var codigo = $.trim($("#number_operation").val());
    $("#numberOperationUser").html(codigo);
    $('#kt_modal_final_step').modal('show')
}