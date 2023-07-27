@extends('layouts.admin')

@section('title', 'Tipo de Cambio Manual de Dolareros')

@section('page-title', 'Tipo de Cambio Manual de Dolareros')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-dark">Tipo de Cambio Manual</li>
    </ul>
@endsection

@section('activeTabPanelAdmin', 'active')
@section('activeTabAdmin', 'active show')

@section('showMenuAccordionTypeExchange', 'show')
@section('activeMenuAccordionTypeExchange', 'active')
@section('activeMenuTypeExchange', 'active')

@section('styles')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            display: none;
        }
        .highSize {
            font-size: 1.55rem !important;
        }
        .tachado {
            text-decoration: line-through;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/MDtimepicker/css/mdtimepicker.css') }}">

@endsection

@section('content')

    <div class="notice d-flex @if( $tcManual->valueNumber == 1 ) bg-light-primary @else bg-light-warning @endif rounded @if( $tcManual->valueNumber == 1 ) border-primary @else border-warning @endif border border-dashed p-6 mb-4">
        <!--begin::Icon-->
        <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
        <span class="svg-icon svg-icon-2tx @if( $tcManual->valueNumber == 1 ) svg-icon-primary @else svg-icon-warning @endif me-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
            </svg>
        </span>
        <!--end::Svg Icon-->
        <!--end::Icon-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-grow-1">
            <!--begin::Content-->
            <div class="fw-bold">
                <h4 class="text-gray-900 fw-bolder">Botón de Tipo de Cambio Manual!</h4>
                <label class="form-check form-switch form-check-custom form-check-solid float-end">
                    <!--begin::Input-->
                    <input class="form-check-input"  type="checkbox" value="{{ $tcManual->valueNumber }}" {{ ($tcManual->valueNumber == 1) ? 'checked':'' }} data-kt-action="{{ route('typeExchange.tcManual.update') }}" data-kt-tc-manual="{{ $tcManual->id }}"/>
                    <!--end::Input-->
                </label>
                <div class="fs-6 text-gray-700">
                    @if( $tcManual->valueNumber == 1 )
                        <span class="left" id="message1">Se esta usando los tipos de cambios obtenidos por el bot de forma automática</span>
                    @else
                        <span class="left" id="message2">Se esta usando los tipos de cambios ingresados manualmente</span>
                    @endif
                </div>

            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    @if($tcManual->valueNumber == 1)
    <div style="display: none;">
        <form class="form" action="#" id="kt_modal_change_typeExchange_form" enctype="multipart/form-data" data-kt-action="{{ route('typeExchange.store') }}" data-kt-redirect="{{ route('typeExchange.index') }}">
        @csrf
        <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="modal-header" id="kt_modal_change_typeExchange_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Guardar Tipos de Cambio</h2>
                    <!--end::Modal title-->
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold mb-2">Compra</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" name="buyManual" value="{{ $buyManual }}" class="form-control form-control-solid" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="col-lg-6">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold mb-2">Venta</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" value="{{ $sellManual }}" name="sellManual" class="form-control form-control-solid" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>

                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_change_typeExchange_cancel" class="btn btn-light me-3">Descartar</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_change_typeExchange_submit" class="btn btn-primary">
                        <span class="indicator-label">Guardar Tipos de Cambio</span>
                        <span class="indicator-progress">Por favor espere...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <!--begin::Modals-->

        </form>
    </div>
    @elseif($tcManual->valueNumber == 2)
        <div>
            <form class="form" action="#" id="kt_modal_change_typeExchange_form" enctype="multipart/form-data" data-kt-action="{{ route('typeExchange.store') }}" data-kt-redirect="{{ route('typeExchange.index') }}">
            @csrf
            <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="modal-header" id="kt_modal_change_typeExchange_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Guardar Tipos de Cambio</h2>
                        <!--end::Modal title-->
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-lg-6">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">Compra</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" name="buyManual" value="{{ $buyManual->valueNumber }}" class="form-control form-control-solid" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="col-lg-6">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">Venta</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" value="{{ $sellManual->valueNumber }}" name="sellManual" class="form-control form-control-solid" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer flex-center">
                         <!--begin::Button-->
                        <button type="button" id="kt_modal_change_typeExchange_submit" class="btn btn-primary">
                            <span class="indicator-label">Guardar Tipos de Cambio</span>
                            <span class="indicator-progress">Por favor espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Modals-->

            </form>
        </div>
    @endif
@endsection

@section('scripts')
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/MDtimepicker/js/mdtimepicker.js') }}"></script>

    <!--end::Page Vendors Javascript-->
    <script>
        var $formEdit;
        var $buttonSubmit;
        var $buttonCancel;
        var $formValidation;

        $(document).ready(function(){
            $(document).on('click', '[data-kt-tc-manual]', changeStatusTCManual);
            //$.fn.modal.Constructor.prototype.enforceFocus = function () {};
            $formEdit = document.querySelector("#kt_modal_change_typeExchange_form");
            $buttonSubmit = $formEdit.querySelector("#kt_modal_change_typeExchange_submit");
            $buttonCancel = $formEdit.querySelector("#kt_modal_change_typeExchange_cancel");

            $formValidation = FormValidation.formValidation($formEdit, {
                fields: {
                    buyManual: {validators: {notEmpty: {message: "La tipo de cambio de compra es obligatorio."}}},
                    sellManual: {validators: {notEmpty: {message: "La tipo de cambio de venta es obligatorio."}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            });

            $buttonSubmit.addEventListener("click", updateTypeExchange);
        });
        function changeStatusTCManual() {
            event.preventDefault();
            let button = $(this);
            let data_id = $(this).attr('data-kt-tc-manual');
            let status;
            if ($(this).is(':checked')) {
                status = 1;
            } else {
                status = 2;
            }

            if (status == 1)
            {
                $buttonSubmit.disabled = 1;
            }

            Swal.fire({
                text: "¿Estás seguro de cambiar los tipos de cambios?",
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Si, cambiar!",
                cancelButtonText: "No, regresar",
                allowOutsideClick: false, // Impide que el Swal se cierre al hacer clic fuera de él
                allowEscapeKey: false, // Impide que el Swal se cierre al presionar la tecla "Escape"
                allowEnterKey: false, // Impide que el Swal se cierre al presionar la tecla "Enter"
                customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
            }).then((function (result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: button.attr('data-kt-action'),
                        method: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: JSON.stringify({ status: status, data_id:data_id}),
                        processData:false,
                        contentType:'application/json; charset=utf-8',
                        success: function (data) {
                            console.log(data);
                            setTimeout((function () {
                                Swal.fire({
                                    text: data.message,
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, entendido!",
                                    customClass: {confirmButton: "btn btn-primary"}
                                }).then((function () {
                                    //window.location = redirect;
                                    if ( status == 1 )
                                    {
                                        // Check #x
                                        button.prop( "checked", true );
                                    } else {
                                        // Uncheck #x
                                        button.prop( "checked", false );
                                    }

                                    location.reload();
                                }))
                            }), 2e3)
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
                } else if (result.dismiss === Swal.DismissReason.cancel) {

                    // Mostrar mensaje de error
                    Swal.fire({
                        text: "La información no ha sido enviada!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, entendido!",
                        customClass: { confirmButton: "btn btn-primary" }
                    });
                    $buttonSubmit.disabled = 0;
                }
            }));
        }

        function updateTypeExchange() {
            event.preventDefault();
            $formValidation.validate().then((function (e) {
                console.log("validated!"), "Valid" == e ? ($buttonSubmit.setAttribute("data-kt-indicator", "on"), $buttonSubmit.disabled = !0,
                    $.ajax({
                        url: $('#kt_modal_change_typeExchange_form').attr('data-kt-action'),
                        method: 'POST',
                        data: new FormData($('#kt_modal_change_typeExchange_form')[0]),
                        processData:false,
                        contentType:false,
                        success: function (data) {
                            console.log(data);
                            setTimeout((function () {
                                $buttonSubmit.removeAttribute("data-kt-indicator"), Swal.fire({
                                    text: data.message,
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, entendido!",
                                    customClass: {confirmButton: "btn btn-primary"}
                                }).then((function (e) {
                                    e.isConfirmed && ($buttonSubmit.disabled = !1, window.location = $formEdit.getAttribute("data-kt-redirect"))
                                }))
                            }), 500)
                        },
                        error: function (data) {
                            console.log(data);
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
                            $buttonSubmit.setAttribute("data-kt-indicator", "off"), $buttonSubmit.disabled = 0
                        },
                    })) : Swal.fire({
                    text: "Lo sentimos, detectamos unos errores, por favor intente nuevamente.",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, entendido!",
                    customClass: {confirmButton: "btn btn-primary"}
                })
            }));
        }
    </script>
    <!--begin::Page Custom Javascript(used by this page)-->
@endsection
