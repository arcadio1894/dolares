$(document).ready(function () {

    getDataUsers(1);

    $(document).on('click', '[data-item]', showData);
    $("#btn-search").on('click', showDataSearch);

});

var $formEdit;
var $modalEdit;
var $buttonSubmit;
var $buttonCancel;
var $buttonClose;
var $formValidation;

function showDataSearch() {
    getDataUsers(1)
}

function showData() {
    var numberPage = $(this).attr('data-item');
    console.log(numberPage);
    getDataUsers(numberPage)
}

function getDataUsers($numberPage) {
    var nombreCliente = $('#inputNombreCliente').val(); // Obtén el valor del input de documento cliente
    var documentCliente = $('#inputDocumentCliente').val(); // Obtén el valor del input de código de operación
    var roleId = $('#selectBanco').val();

    $("#body-table").html('');
    $("#body-card").html('');
    $("#pagination").html('');
    $("#textPagination").html('');
    $('#numberItems').html('');

    $.get('/dashboard/get/data/users/'+$numberPage, {
        nombre_cliente: nombreCliente,
        document_cliente: documentCliente,
        role_id: roleId
    }, function(data) {
        renderDataUser(data);

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

function renderDataUser(data) {
    var dataUser = data.data;
    var pagination = data.pagination;
    console.log(dataUser);
    console.log(pagination);


    $("#textPagination").html('Mostrando '+pagination.startRecord+' a '+pagination.endRecord+' de '+pagination.totalFilteredRecords+' usuarios');
    $('#numberItems').html(pagination.totalFilteredRecords);

    for (let j = 0; j < dataUser.length ; j++) {
        renderDataTableCard(dataUser[j]);
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
    clone.querySelector("[data-avatar]").innerHTML = data.avatar;
    clone.querySelector("[data-name]").innerHTML = data.name;
    clone.querySelector("[data-email]").innerHTML = data.email;
    clone.querySelector("[data-role_description]").innerHTML = data.role_description;
    clone.querySelector("[data-last_login]").innerHTML = data.last_login;
    clone.querySelector("[data-joined_date]").innerHTML = data.joined_date;
    var origin = location.origin;
    var enlaceCompleto = origin + "/dashboard/usuario/detalles/"+data.id;
    clone.querySelector("[data-btn_information]").setAttribute('href', enlaceCompleto);
    clone.querySelector("[data-btn_update]").setAttribute('data-users-id', data.id);
    clone.querySelector("[data-btn_update]").setAttribute('data-users-first_name', data.first_name);
    clone.querySelector("[data-btn_update]").setAttribute('data-users-last_name', data.last_name);
    clone.querySelector("[data-btn_update]").setAttribute('data-users-email', data.email);
    clone.querySelector("[data-btn_update]").setAttribute('data-users-phone', data.phone);
    clone.querySelector("[data-btn_update]").setAttribute('data-users-document', data.document);
    clone.querySelector("[data-btn_update]").setAttribute('data-users-role_id', data.role_id);
    clone.querySelector("[data-btn_delete]").setAttribute('data-users-id', data.id);
    clone.querySelector("[data-btn_delete]").setAttribute('data-users-name', data.name);
    /*clone.querySelector("[data-monto_nuevo]").innerHTML = data.monto_nuevo;
    clone.querySelector("[data-fecha]").innerHTML = data.fecha;
    clone.querySelector("[data-observacion]").innerHTML = data.observacion;*/
    $("#body-table").append(clone);

    var clone2 = activateTemplate('#item-card');
    clone2.querySelector("[data-name]").innerHTML = data.name;
    clone2.querySelector("[data-email]").innerHTML = data.email;
    clone2.querySelector("[data-role_description]").innerHTML = data.role_description;
    clone2.querySelector("[data-last_login]").innerHTML = data.last_login;
    clone2.querySelector("[data-joined_date]").innerHTML = data.joined_date;
    clone2.querySelector("[data-document]").innerHTML = data.document;
    clone2.querySelector("[data-phone]").innerHTML = data.phone;
    clone2.querySelector("[data-avatar]").innerHTML = data.avatar;
    clone2.querySelector("[data-btn_information]").setAttribute('href', enlaceCompleto);
    clone2.querySelector("[data-btn_update]").setAttribute('data-users-id', data.id);
    clone2.querySelector("[data-btn_update]").setAttribute('data-users-first_name', data.first_name);
    clone2.querySelector("[data-btn_update]").setAttribute('data-users-last_name', data.last_name);
    clone2.querySelector("[data-btn_update]").setAttribute('data-users-email', data.email);
    clone2.querySelector("[data-btn_update]").setAttribute('data-users-phone', data.phone);
    clone2.querySelector("[data-btn_update]").setAttribute('data-users-document', data.document);
    clone2.querySelector("[data-btn_update]").setAttribute('data-users-role_id', data.role_id);
    clone2.querySelector("[data-btn_delete]").setAttribute('data-users-id', data.id);
    clone2.querySelector("[data-btn_delete]").setAttribute('data-users-name', data.name);

    $("#body-card").append(clone2);
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
