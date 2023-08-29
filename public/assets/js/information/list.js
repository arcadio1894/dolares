"use strict";
var KTCustomersList = function () {
    var t, e, o, n, c = () => {
        n.querySelectorAll('[data-kt-information-table-filter="delete_row"]').forEach((e => {
            let button = e;
            e.addEventListener("click", (function (e) {
                //console.log(button);
                e.preventDefault();
                const o = e.target.closest("tr"), n = o.querySelectorAll("td")[0].innerText;
                Swal.fire({
                    text: "¿Está seguro de eliminar la noticia?",
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
                            url: '/dashboard/information/destroy/'+button.attributes[2].value,
                            method: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: JSON.stringify({ information_id: button.attributes[2].value }),
                            processData:false,
                            contentType:'application/json; charset=utf-8',
                            success: function (data) {
                                console.log(data);
                                Swal.fire({
                                    text: "Has eliminado la noticia!.",
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, entenedido!",
                                    customClass: {confirmButton: "btn fw-bold btn-primary"}
                                }).then((function () {
                                    t.row($(o)).remove().draw();
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
                        text: "La noticia no fue eliminada.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, entendido!",
                        customClass: {confirmButton: "btn fw-bold btn-primary"}
                    })
                }))
            }))
        }))
    }, r = () => {
        const e = n.querySelectorAll('[type="checkbox"]'),
            o = document.querySelector('[data-kt-coupon-table-select="delete_selected"]');
        e.forEach((t => {
            t.addEventListener("click", (function () {
                setTimeout((function () {
                    /*l()*/
                }), 50)
            }))
        }))
    };

    return {
        init: function () {
            (n = document.querySelector("#kt_customers_table")) && (n.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td")/*, o = moment(e[1].innerHTML, "DD MMM YYYY, LT").format()*/;
                /*e[1].setAttribute("data-order", o)*/
            })), (t = $(n).DataTable({
                info: !1,
                order: [],
                columnDefs: [{orderable: !1, targets: 1}]
            })).on("draw", (function () {
                r(), c()/*, l()*/
            })), r(), e = $('[data-kt-customer-table-filter="month"]'), o = document.querySelectorAll('[data-kt-customer-table-filter="payment_type"] [name="payment_type"]'),
                c()
            )
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTCustomersList.init()
}));