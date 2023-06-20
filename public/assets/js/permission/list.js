"use strict";
var KTUsersPermissionsList = function () {
    var t, e;
    return {
        init: function () {
            (e = document.querySelector("#kt_permissions_table")) && (e.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td")/*, /*n = moment(e[2].innerHTML, "DD MMM YYYY, LT").format();
                e[2].setAttribute("data-order", n)*/
            })), t = $(e).DataTable({
                info: !1,
                order: [],
                columnDefs: [{orderable: !1, targets: 1}, {orderable: !1, targets: 3}]
            }), document.querySelector('[data-kt-permissions-table-filter="search"]').addEventListener("keyup", (function (e) {
                t.search(e.target.value).draw()
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTUsersPermissionsList.init()
}));

/*
e.querySelectorAll('[data-kt-permissions-table-filter="delete_row"]').forEach((e => {
    e.addEventListener("click", (function (e) {
        e.preventDefault();
        console.log("Entre aqui");
        const n = e.target.closest("tr"), o = n.querySelectorAll("td")[1].innerText;
        Swal.fire({
            text: "Are you sure you want to delete " + o + "?",
            icon: "warning",
            showCancelButton: !0,
            buttonsStyling: !1,
            confirmButtonText: "Yes, delete!",
            cancelButtonText: "No, cancel",
            customClass: {
                confirmButton: "btn fw-bold btn-danger",
                cancelButton: "btn fw-bold btn-active-light-primary"
            }
        }).then((function (l) {
            l.value ? Swal.fire({
                text: "You have deleted " + o + "!.",
                icon: "success",
                buttonsStyling: !1,
                confirmButtonText: "Ok, got it!",
                customClass: {confirmButton: "btn fw-bold btn-primary"}
            }).then((function () {
                t.row($(n)).remove().draw()
            })) : "cancel" === l.dismiss && Swal.fire({
                text: o + " was not deleted.",
                icon: "error",
                buttonsStyling: !1,
                confirmButtonText: "Ok, got it!",
                customClass: {confirmButton: "btn fw-bold btn-primary"}
            })
        }))
    }))
}))*/
