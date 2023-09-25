$(document).ready(function () {

    getDataOperations(1);

    $(document).on('click', '[data-item]', showData);
    $("#btn-search").on('click', showDataSeach);

});

var $formEdit;
var $modalEdit;
var $buttonSubmit;
var $buttonCancel;
var $buttonClose;
var $formValidation;

function showDataSeach() {
    getDataOperations(1)
}

function showData() {
    var numberPage = $(this).attr('data-item');
    console.log(numberPage);
    getDataOperations(numberPage)
}

function getDataOperations($numberPage) {
    var documentCliente = $('#inputDocumentCliente').val(); // Obtén el valor del input de documento cliente
    var codigoOperacion = $('#inputCodigoOperacion').val(); // Obtén el valor del input de código de operación
    var bancoId = $('#selectBanco').val();

    $.get('/dashboard/get/data/operations/'+$numberPage, {
        document_cliente: documentCliente,
        codigo_operacion: codigoOperacion,
        banco_id: bancoId
    }, function(data) {
        renderDataOperations(data);

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

function renderDataOperations(data) {
    var dataAccounting = data.data;
    var pagination = data.pagination;
    console.log(dataAccounting);
    console.log(pagination);

    $("#body-table").html('');
    $("#body-card").html('');
    $("#pagination").html('');
    $("#textPagination").html('');
    $("#textPagination").html('Mostrando '+pagination.startRecord+' a '+pagination.endRecord+' de '+pagination.totalFilteredRecords+' operaciones');
    $('#numberItems').html('');
    $('#numberItems').html(pagination.totalFilteredRecords);

    for (let j = 0; j < dataAccounting.length ; j++) {
        renderDataTableCard(dataAccounting[j]);
    }

    if (pagination.currentPage > 1)
    {
        renderPreviousPage(pagination.currentPage-1);
    }

    if (pagination.totalPages > 1)
    {
        if (pagination.currentPage > 3)
        {
            renderItemPage(1);

            if (pagination.currentPage > 4) {
                renderDisabledPage();
            }
        }

        for (var i = Math.max(1, pagination.currentPage - 2); i <= Math.min(pagination.totalPages, pagination.currentPage + 2); i++)
        {
            renderItemPage(i, pagination.currentPage);
        }

        if (pagination.currentPage < pagination.totalPages - 2)
        {
            if (pagination.currentPage < pagination.totalPages - 3)
            {
                renderDisabledPage();
            }
            renderItemPage(i, pagination.currentPage);
        }

    }

    if (pagination.currentPage < pagination.totalPages)
    {
        renderNextPage(pagination.currentPage+1);
    }
}

function renderDataTableCard(data) {
    var clone = activateTemplate('#item-table');
    clone.querySelector("[data-numOperation]").innerHTML = data.numOperation;
    clone.querySelector("[data-bank]").innerHTML = data.bank;
    clone.querySelector("[data-numOperationUser]").innerHTML = data.numOperationUser;
    clone.querySelector("[data-enviado]").innerHTML = data.enviado;
    clone.querySelector("[data-recibido]").innerHTML = data.recibido;
    clone.querySelector("[data-tipoCambio]").innerHTML = data.tipoCambio;
    clone.querySelector("[data-fecha]").innerHTML = data.fecha;
    clone.querySelector("[data-estado]").innerHTML = data.estado;
    if ( data.state == 'PROCESANDO' )
    {
        console.log('procesando');
        var template_procesando = activateTemplate('#template-procesando');
        var append_procesando = clone.querySelector("[data-buttons]");
        template_procesando.querySelector("[data-show_details]").setAttribute('data-kt-operation', data.id);
        template_procesando.querySelector("[data-finish_operation]").setAttribute('data-kt-operation', data.id);
        template_procesando.querySelector("[data-refused_operation]").setAttribute('data-kt-operation', data.id);

        append_procesando.append(template_procesando);
    } else {
        if( data.state == 'FINALIZADO' )
        {
            var template_finalizado = activateTemplate('#template-finalizado');
            var append_finalizado = clone.querySelector("[data-buttons]");
            template_finalizado.querySelector("[data-show_details]").setAttribute('data-kt-operation', data.id);
            template_finalizado.querySelector("[data-show_receipt]").setAttribute('data-kt-operation', data.id);
            template_finalizado.querySelector("[data-change_receipt]").setAttribute('data-kt-operation', data.id);
            template_finalizado.querySelector("[data-change_receipt]").setAttribute('data-kt-operation_image_receipt', data.image_receipt);
            template_finalizado.querySelector("[data-change_receipt]").setAttribute('data-kt-operation_number_operation_dolareros', data.number_operation_dolareros);

            append_finalizado.append(template_finalizado);
        } else {
            var template_otro = activateTemplate('#template-otro');
            var append_otro = clone.querySelector("[data-buttons]");
            template_otro.querySelector("[data-show_details]").setAttribute('data-kt-operation', data.id);
            template_otro.querySelector("[data-finish_operation]").setAttribute('data-kt-operation', data.id);
            template_otro.querySelector("[data-show_refused]").setAttribute('data-kt-operation', data.id);

            append_otro.append(template_otro);
        }
    }

    $("#body-table").append(clone);

    var clone2 = activateTemplate('#item-card');
    clone2.querySelector("[data-numOperation]").innerHTML = data.numOperation;
    clone2.querySelector("[data-numOperationUser]").innerHTML = data.numOperationUser;
    clone2.querySelector("[data-enviado]").innerHTML = data.enviado;
    clone2.querySelector("[data-recibido]").innerHTML = data.recibido;
    clone2.querySelector("[data-tipoCambio]").innerHTML = data.tipoCambio;
    clone2.querySelector("[data-fecha]").innerHTML = data.fecha;
    clone2.querySelector("[data-estado]").innerHTML = data.estado;

    if ( data.state == 'PROCESANDO' )
    {
        console.log('procesando');
        var template_procesando2 = activateTemplate('#template-procesando');
        var append_procesando2 = clone2.querySelector("[data-buttons]");
        template_procesando2.querySelector("[data-show_details]").setAttribute('data-kt-operation', data.id);
        template_procesando2.querySelector("[data-finish_operation]").setAttribute('data-kt-operation', data.id);
        template_procesando2.querySelector("[data-refused_operation]").setAttribute('data-kt-operation', data.id);

        append_procesando2.append(template_procesando2);
    } else {
        if( data.state == 'FINALIZADO' )
        {
            var template_finalizado2 = activateTemplate('#template-finalizado');
            var append_finalizado2 = clone2.querySelector("[data-buttons]");
            template_finalizado2.querySelector("[data-show_details]").setAttribute('data-kt-operation', data.id);
            template_finalizado2.querySelector("[data-show_receipt]").setAttribute('data-kt-operation', data.id);
            template_finalizado2.querySelector("[data-change_receipt]").setAttribute('data-kt-operation', data.id);
            template_finalizado2.querySelector("[data-change_receipt]").setAttribute('data-kt-operation_image_receipt', data.image_receipt);
            template_finalizado2.querySelector("[data-change_receipt]").setAttribute('data-kt-operation_number_operation_dolareros', data.number_operation_dolareros);

            append_finalizado2.append(template_finalizado2);
        } else {
            var template_otro2 = activateTemplate('#template-otro');
            var append_otro2 = clone2.querySelector("[data-buttons]");
            template_otro2.querySelector("[data-show_details]").setAttribute('data-kt-operation', data.id);
            template_otro2.querySelector("[data-finish_operation]").setAttribute('data-kt-operation', data.id);
            template_otro2.querySelector("[data-show_refused]").setAttribute('data-kt-operation', data.id);

            append_otro2.append(template_otro2);
        }
    }

    $("#body-card").append(clone2);

    $('[data-toggle="tooltip"]').tooltip();
}

function renderPreviousPage($numberPage) {
    var clone = activateTemplate('#previous-page');
    clone.querySelector("[data-item]").setAttribute('data-item', $numberPage);
    $("#pagination").append(clone);
}

function renderDisabledPage() {
    var clone = activateTemplate('#disabled-page');
    $("#pagination").append(clone);
}

function renderItemPage($numberPage, $currentPage) {
    var clone = activateTemplate('#item-page');
    if ( $numberPage == $currentPage )
    {
        clone.querySelector("[data-item]").setAttribute('data-item', $numberPage);
        clone.querySelector("[data-active]").setAttribute('class', 'page-item active');
        clone.querySelector("[data-item]").innerHTML = $numberPage;
    } else {
        clone.querySelector("[data-item]").setAttribute('data-item', $numberPage);
        clone.querySelector("[data-item]").innerHTML = $numberPage;
    }

    $("#pagination").append(clone);
}

function renderNextPage($numberPage) {
    var clone = activateTemplate('#next-page');
    clone.querySelector("[data-item]").setAttribute('data-item', $numberPage);
    $("#pagination").append(clone);
}

function activateTemplate(id) {
    var t = document.querySelector(id);
    return document.importNode(t.content, true);
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
    let numberAccount = $(this).attr('data-kt-numberAccount');
    let currency = $(this).attr('data-kt-currency');
    let numberInterbank = $(this).attr('data-kt-numberInterbank');
    let balance = $(this).attr('data-kt-balance');
    let idAccount = $(this).attr('data-kt-account');

    $formEdit.querySelector('[name="account_id"]').value = idAccount;

    $formEdit.querySelector('[name="numberAccount"]').value = numberAccount;

    $formEdit.querySelector('[name="number_interbank"]').value = numberInterbank;

    $formEdit.querySelector('[name="balance"]').value = balance;

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
    $.fn.modal.Constructor.prototype.enforceFocus = function () {};
    $modalEdit.show();
}