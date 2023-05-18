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
}