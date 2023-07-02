$(document).ready(function () {
    $modal_alert = $('#kt_modal_alert');
    $btn_modal_alert_cancel = $('#kt_modal_alert_cancel');
    $btn_modal_alert_next = $('#kt_modal_alert_next');

    // TODO: Obtenemos la operación pendiente
    $.get('/dashboard/get/user/alert', function(data) {
        // Función de éxito, se ejecuta cuando la solicitud GET es exitosa
        console.log(data);
        stopAllAndShowModal(data);
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

    $btn_modal_alert_cancel.on('click', cancelModalAlert);
    $btn_modal_alert_next.on('click', nextModalAlert);
});

var $modal_alert;
var $btn_modal_alert_cancel;
var $btn_modal_alert_next;

function nextModalAlert() {
    $btn_modal_alert_next.attr("data-kt-indicator", "on");
    $btn_modal_alert_next.attr('disabled', true);

    var url = $btn_modal_alert_next.data('url');
    location.href = url;

}

function cancelModalAlert() {
    $modal_alert.modal('hide');
}

function stopAllAndShowModal(data) {
    if ( data.alert != null )
    {
        $("#first_text").html(data.alert);
        $btn_modal_alert_next.attr('data-url', data.url);
        $modal_alert.modal('show');
    }

}
