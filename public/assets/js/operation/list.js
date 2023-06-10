"use strict";
var KTCustomersList = function () {
    var t, e, o, n;

    return {
        init: function () {
            (n = document.querySelector("#kt_customers_table")) && (n.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td")/*, o = moment(e[1].innerHTML, "DD MMM YYYY, LT").format()*/;
                /*e[1].setAttribute("data-order", o)*/
            })), (t = $(n).DataTable({
                info: !1,
                order: [],
                columnDefs: [{orderable: !1, targets: 5}]
            })).on("draw", (function () {
                /*r() ,c(), l()*/
            }))/*, r()*/, document.querySelector('[data-kt-customer-table-filter="search"]').addEventListener("keyup", (function (e) {
                t.search(e.target.value).draw()
            })), e = $('[data-kt-customer-table-filter="month"]'), o = document.querySelectorAll('[data-kt-customer-table-filter="payment_type"] [name="payment_type"]'))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTCustomersList.init()
}));