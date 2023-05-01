$(document).ready(function () {

    $modalEdit = new bootstrap.Modal(document.querySelector("#kt_modal_edit_customer"));
    $formEdit = document.querySelector("#kt_modal_edit_customer_form");
    $buttonSubmit = $formEdit.querySelector("#kt_modal_edit_customer_submit");
    $buttonCancel = $formEdit.querySelector("#kt_modal_edit_customer_cancel");
    $buttonClose = $formEdit.querySelector("#kt_modal_edit_customer_close");

    $formValidation = FormValidation.formValidation($formEdit, {
        fields: {
            description: {validators: {notEmpty: {message: "La descripción es obligatorio."}}},
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

    $(document).on('click', '[data-kt-source-action="update_row"]', showModalEdit);

    $buttonSubmit.addEventListener("click", updateSource);

    $buttonClose.addEventListener("click", closeModalEdit);

    $buttonCancel.addEventListener("click", closeModalEdit);

});

var $formEdit;
var $modalEdit;
var $buttonSubmit;
var $buttonCancel;
var $buttonClose;
var $formValidation;

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

    let idSource = $(this).attr('data-kt-source');
    let description = $(this).attr('data-kt-description');

    $formEdit.querySelector('[name="source_id"]').value = idSource;

    $formEdit.querySelector('[name="description"]').value = description;

    $modalEdit.show();
}

function updateSource() {
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