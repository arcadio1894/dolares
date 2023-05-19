$(document).ready(function () {

    $modalEdit = new bootstrap.Modal(document.querySelector("#kt_modal_edit_customer"));
    $formEdit = document.querySelector("#kt_modal_edit_customer_form");
    $buttonSubmit = $formEdit.querySelector("#kt_modal_edit_customer_submit");
    $buttonCancel = $formEdit.querySelector("#kt_modal_edit_customer_cancel");
    $buttonClose = $formEdit.querySelector("#kt_modal_edit_customer_close");

    $formValidation = FormValidation.formValidation($formEdit, {
        fields: {
            numberAccount: {validators: {notEmpty: {message: "El número de cuenta es obligatorio."}}},
            nameAccount: {validators: {notEmpty: {message: "El nombre de la cuenta es obligatorio."}}},
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
                        message: 'El departamento es requerido'
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
            type_account: {
                validators: {
                    notEmpty: {
                        message: 'El tipo de cuenta es requerido'
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

    $(document).on('click', '[data-kt-account-action="update_row"]', showModalEdit);
    $(document).on('click', '[data-kt-account-active]', changeStatusAccount);


    $buttonSubmit.addEventListener("click", updateAccount);

    $buttonClose.addEventListener("click", closeModalEdit);

    $buttonCancel.addEventListener("click", closeModalEdit);

});

var $formEdit;
var $modalEdit;
var $buttonSubmit;
var $buttonCancel;
var $buttonClose;
var $formValidation;

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
    let nameAccount = $(this).attr('data-kt-nameAccount');
    let property = $(this).attr('data-kt-property');
    let numberAccount = $(this).attr('data-kt-numberAccount');
    let currency = $(this).attr('data-kt-currency');
    let type_account = $(this).attr('data-kt-type-account');
    let idAccount = $(this).attr('data-kt-account');

    $formEdit.querySelector('[name="account_id"]').value = idAccount;

    $formEdit.querySelector('[name="numberAccount"]').value = numberAccount;

    $formEdit.querySelector('[name="nameAccount"]').value = nameAccount;

    //$formEdit.querySelector('[name="bank_id"]').value = idBank;

    //$formEdit.querySelector('[name="currency"]').value = 'USD';

    let t = $('#type_account_update').select2({
        minimumResultsForSearch: Infinity,
        dropdownParent: $("#kt_modal_edit_customer")
    });

    t.val(type_account);
    t.trigger('change');

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

    if ( property == 1 )
    {
        $formEdit.querySelector('[name="property"]').checked = true;
    } else {
        $formEdit.querySelector('[name="property"]').checked = false;
    }
    $.fn.modal.Constructor.prototype.enforceFocus = function () {};
    $modalEdit.show();
}

function updateAccount() {
    event.preventDefault();
    $formValidation.validate().then((function (e) {
        console.log("validated!"), "Valid" == e ? ($buttonSubmit.setAttribute("data-kt-indicator", "on"), $buttonSubmit.disabled = !0,
            $.ajax({
                url: $('#kt_modal_edit_customer_form').attr('data-kt-action'),
                method: 'POST',
                data: new FormData($('#kt_modal_edit_customer_form')[0]),
                processData:false,
                contentType:false,
                success: function (data) {
                    console.log(data);
                    setTimeout((function () {
                        $buttonSubmit.removeAttribute("data-kt-indicator"), Swal.fire({
                            text: "Información enviada correctamente!",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, entendido!",
                            customClass: {confirmButton: "btn btn-primary"}
                        }).then((function (e) {
                            e.isConfirmed && ($modalEdit.hide(), $buttonSubmit.disabled = !1, window.location = $formEdit.getAttribute("data-kt-redirect"))
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