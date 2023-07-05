$(document).ready(function () {

    $(document).on('click', '[data-kt-account-action="delete_row"]', deleteAccount);

});

function deleteAccount() {
    var button = $(this);
    var n = button.attr('data-kt-numberAccount');
    var account_id  = button.attr('data-kt-account');
    Swal.fire({
        text: "¿Está seguro de eliminar la cuenta " + n + "?",
        icon: "warning",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then((function (e) {
        //console.log(button.attributes[2].value);
        e.value ? (
            //console.log(button.attributes[2].value),
            $.ajax({
                url: '/dashboard/account/customer/destroy/'+account_id,
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: JSON.stringify({ account_id: account_id }),
                processData:false,
                contentType:'application/json; charset=utf-8',
                success: function (data) {
                    console.log(data);
                    Swal.fire({
                        text: "Has eliminado " + n + "!.",
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, entenedido!",
                        customClass: {confirmButton: "btn fw-bold btn-primary"}
                    }).then((function () {
                        button.parent().parent().parent().remove();
                        location.reload();
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
                },
            })
        ) : "cancel" === e.dismiss && Swal.fire({
            text: n + " no fue eliminado.",
            icon: "error",
            buttonsStyling: !1,
            confirmButtonText: "Ok, entendido!",
            customClass: {confirmButton: "btn fw-bold btn-primary"}
        })
    }))
}
