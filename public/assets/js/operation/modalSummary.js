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

    $("#showModalNumberOperation").on('click', showModalOperation);

    $("#showModalNumberOperation2").on('click', showModalOperation);

    $modalNumberOperation = $("#kt_modal_number_operation");

    $modalEdit3 = new bootstrap.Modal(document.querySelector("#kt_modal_second_step"));
    $modalEdit31 = document.querySelector("#kt_modal_second_step");
    $buttonSubmit3 = $modalEdit31.querySelector("#kt_modal_second_step_next");
    $buttonCancel3 = $modalEdit31.querySelector("#kt_modal_second_step_cancel");

    $buttonSubmit3.addEventListener("click", goToFinalStep);
    $buttonCancel3.addEventListener("click", closeModalSecondStep);

    $modalEdit4 = new bootstrap.Modal(document.querySelector("#kt_modal_final_step"));
    $modalEdit41 = document.querySelector("#kt_modal_final_step");
    $buttonSubmit4 = $modalEdit41.querySelector("#kt_modal_final_step_next");
    $buttonCancel4 = $modalEdit41.querySelector("#kt_modal_final_step_cancel");

    $buttonSubmit4.addEventListener("click", sendDataFinalStep);
    $buttonCancel4.addEventListener("click", closeModalFinalStep);

    $modalEdit5 = new bootstrap.Modal(document.querySelector("#kt_modal_success_final"), {
        backdrop: 'static',
        keyboard: false
    });
    $modalEdit51 = document.querySelector("#kt_modal_success_final");
    $buttonSubmit5 = $modalEdit51.querySelector("#kt_modal_success_step_home");
    $buttonCancel5 = $modalEdit51.querySelector("#kt_modal_success_step_operations");

    $buttonSubmit5.addEventListener("click", goToHome);
    $buttonCancel5.addEventListener("click", goToOperations);

});

var $modalEdit5;
var $modalEdit51;
var $buttonSubmit5;
var $buttonCancel5;

var $modalEdit4;
var $modalEdit41;
var $buttonSubmit4;
var $buttonCancel4;

var $modalEdit3;
var $modalEdit31;
var $buttonSubmit3;
var $buttonCancel3;

var $formEdit2;
var $modalEdit2;
var $buttonSubmit2;
var $buttonCancel2;
var $stepper2;
var $modalNumberOperation;

function goToHome() {
    //alert("Se ira al home")
    var url = $("#kt_modal_success_step_home").data('url');
    location.href = url;
}

function goToOperations() {
    //alert("Se ira a las operaciones")
    var url = $("#kt_modal_success_step_operations").data('url');
    location.href = url;
}

function sendDataFinalStep() {
    $buttonSubmit4.setAttribute("data-kt-indicator", "on");
    $buttonSubmit4.disabled = 1;
    var codigo = $.trim($("#number_operation").val());
    $.ajax({
        url: $("#kt_modal_final_step_next").attr('data-url'),
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({ codigo:codigo}),
        processData:false,
        contentType:'application/json; charset=utf-8',
        success: function (data) {
            console.log(data);
            $modalEdit4.hide();
            $buttonSubmit4.disabled = 0;
            $buttonSubmit4.removeAttribute("data-kt-indicator");
            $("#code_dolareros").html(data.code_operation);
            $modalEdit5.show();
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

            $buttonSubmit4.disabled = 0;
            $buttonSubmit4.removeAttribute("data-kt-indicator");
        },
    });
    /*Swal.fire({
        text: "Información verificada correctamente!",
        icon: "success",
        buttonsStyling: !1,
        confirmButtonText: "Ok, entendido!",
        customClass: {confirmButton: "btn btn-primary"}
    }).then((function (e) {
        console.log($stepper2);
        $modalEdit3.hide();
        $stepper2.goTo(3);
        $buttonSubmit3.disabled = !1;

    }))*/
}

function closeModalFinalStep() {
    //$buttonSubmit4.hide();
    /*var url = $buttonCancel4.getAttribute("data-url");
    console.log(url);*/
    //location.href = url;
    Swal.fire({
        text: "¿Estás seguro de regresar?",
        icon: "success",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Si, regresar!",
        cancelButtonText: "No, continuar aquí",
        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
    }).then((function ($buttonSubmit4) {
        $buttonSubmit4.value ? ($modalEdit4.hide()) : "cancel" === $buttonSubmit4.dismiss
    }))
}

function goToFinalStep() {
    $modalEdit3.hide();
    $stepper2.goTo(3);
    /*$.ajax({
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

                $("#nameBankOperationDeposit").html(data.bankAccount);
                $("#nameAccountOperationDeposit").html(data.numberAccount);
                $("#rucOperationDeposit").html(data.companyRUC);
                $("#ownerAccountOperationDeposit").html(data.companyName);
                $("#typeAccountOperationDeposit").html(data.typeAccount);
                $("#amountSendOperation").html(data.amountSend + " " +data.currencyAccount);
                $("#nameBankOperation").html(data.bankCustomer);

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
    });*/
    /*Swal.fire({
        text: "Información verificada correctamente!",
        icon: "success",
        buttonsStyling: !1,
        confirmButtonText: "Ok, entendido!",
        customClass: {confirmButton: "btn btn-primary"}
    }).then((function (e) {
        console.log($stepper2);
        $modalEdit3.hide();
        $stepper2.goTo(3);
        $buttonSubmit3.disabled = !1;

    }))*/
}

function closeModalSecondStep($buttonSubmit3) {
    $buttonSubmit3.preventDefault();
    Swal.fire({
        text: "¿Estás seguro de regresar?",
        icon: "success",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Si, regresar!",
        cancelButtonText: "No, continuar aquí",
        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
    }).then((function ($buttonSubmit3) {
        $buttonSubmit3.value ? ($modalEdit3.hide()) : "cancel" === $buttonSubmit3.dismiss
    }))
}

function showModalOperation() {
    if ( $(this).data('image') == "" )
    {
        $modalNumberOperation.modal('show');
    } else {
        $("#imageNumberOperation").attr('src', '');
        var url = $(this).data('image');
        $("#imageNumberOperation").attr('src', url);
        $modalNumberOperation.modal('show');
    }

}

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

                if ( data.isYape )
                {
                    $("#typeAccountOperationDeposit").css('display', 'none');
                    $("#ownerAccountOperationDeposit").css('display', 'none');
                    $("#rucOperationDeposit").css('display', 'none');
                    $("#nameAccountOperationDeposit").css('display', 'none');
                    $("#imgYape").css('display', '');
                    $("#nameBankOperationDeposit").html(data.nameBankOperationDeposit);
                    $("#amountSendOperation").html(data.amountSend + " " +data.currencyAccount);
                    var url = "";
                    //url = url + document.location.origin+ '/dashboard/download/image/operation/'+operation_id;
                    url = url + document.location.origin+ '/assets/images/banks/'+data.qrYape;
                    var url2 = "";
                    //url = url + document.location.origin+ '/dashboard/download/image/operation/'+operation_id;
                    url2 = url2 + document.location.origin+ '/assets/images/operation/numberOperationYape.png';
                    $("#imgYape").attr('src', url);
                    $("#title").css('display', 'none');
                    $("#titleRUC").css('display', 'none');
                    $("#titleTitular").css('display', 'none');
                    $("#titleTipoCuenta").css('display', 'none');
                    $("#showModalNumberOperation").attr('data-image', url2);
                    $("#showModalNumberOperation2").attr('data-image', url2);
                } else {
                    $("#nameBankOperationDeposit").html(data.nameBankOperationDeposit);
                    $("#nameAccountOperationDeposit").html(data.numberAccount);
                    $("#rucOperationDeposit").html(data.companyRUC);
                    $("#ownerAccountOperationDeposit").html(data.companyName);
                    $("#typeAccountOperationDeposit").html(data.typeAccount);
                    $("#amountSendOperation").html(data.amountSend + " " +data.currencyAccount);
                    $("#nameBankOperation").html(data.bankCustomer);
                    $("#title").html(data.title);
                }

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