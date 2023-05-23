$(document).ready(function () {

    //console.log(document.getElementById('kt_create_account_stepper'));
    $modalEdit2 = new bootstrap.Modal(document.querySelector("#kt_modal_summary"));
    $stepper2 = $r;
    $formEdit2 = document.querySelector("#kt_modal_summary_form");
    $buttonSubmit2 = $formEdit2.querySelector("#kt_modal_summary_next");
    $buttonCancel2 = $formEdit2.querySelector("#kt_modal_summary_cancel");

    $buttonSubmit2.addEventListener("click", goToSecondStep);

    console.log($formEdit2.querySelector("#kt_modal_summary_close"));

    $buttonCancel2.addEventListener("click", closeModalSummary);

});

var $formEdit2;
var $modalEdit2;
var $buttonSubmit2;
var $buttonCancel2;
var $stepper2;

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