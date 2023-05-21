"use strict";
var KTCustomersList = function () {
    var t, e, o, n, c = () => {
        n.querySelectorAll('[data-kt-customer-table-filter="delete_row"]').forEach((e => {
            let button = e;
            e.addEventListener("click", (function (e) {
                //console.log(button);
                e.preventDefault();
                const o = e.target.closest("tr"), n = o.querySelectorAll("td")[0].innerText;
                Swal.fire({
                    text: "¿Está seguro de eliminar el banco " + n + "?",
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
                            url: '/dashboard/bank/destroy/'+button.attributes[2].value,
                            method: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: JSON.stringify({ bank_id: button.attributes[2].value }),
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
                        text: n + " no fue eliminado.",
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
            o = document.querySelector('[data-kt-customer-table-select="delete_selected"]');
        e.forEach((t => {
            t.addEventListener("click", (function () {
                setTimeout((function () {
                    l()
                }), 50)
            }))
        }))
    };
    const l = () => {
        const t = document.querySelector('[data-kt-customer-table-toolbar="base"]'),
            e = document.querySelector('[data-kt-customer-table-toolbar="selected"]'),
            o = document.querySelector('[data-kt-customer-table-select="selected_count"]'),
            c = n.querySelectorAll('tbody [type="checkbox"]');
        let r = !1, l = 0;
        c.forEach((t => {
            t.checked && (r = !0, l++)
        })), r ? (o.innerHTML = l, t.classList.add("d-none"), e.classList.remove("d-none")) : (t.classList.remove("d-none"), e.classList.add("d-none"))
    };
    return {
        init: function () {
            (n = document.querySelector("#kt_customers_table")) && (n.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td")/*, o = moment(e[1].innerHTML, "DD MMM YYYY, LT").format()*/;
                /*e[1].setAttribute("data-order", o)*/
            })), (t = $(n).DataTable({
                info: !1,
                order: [],
                columnDefs: [{orderable: !1, targets: 3}]
            })).on("draw", (function () {
                r(), c(), l()
            })), r(), document.querySelector('[data-kt-customer-table-filter="search"]').addEventListener("keyup", (function (e) {
                t.search(e.target.value).draw()
            })), e = $('[data-kt-customer-table-filter="month"]'), o = document.querySelectorAll('[data-kt-customer-table-filter="payment_type"] [name="payment_type"]'),
                /*document.querySelector('[data-kt-customer-table-filter="filter"]')
                    .addEventListener("click", (function () {
                const n = e.val();
                let c = "";
                o.forEach((t => {
                    t.checked && (c = t.value), "all" === c && (c = "")
                }));
                const r = n + " " + c;
                t.search(r).draw()
            })),*/ c()
                /*document.querySelector('[data-kt-customer-table-filter="reset"]')
                    .addEventListener("click", (function () {
                e.val(null).trigger("change"), o[0].checked = !0, t.search("").draw()
            }))*/)
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTCustomersList.init()
}));