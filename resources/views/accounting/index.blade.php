@extends('layouts.admin')

@section('title', 'Módulo de Contabilidad')

@section('page-title', 'Módulo de Contabilidad')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-dark">Historial Contable</li>
    </ul>
@endsection

@section('activeTabPanelAdmin', 'active')
@section('activeTabAdmin', 'active show')

@section('showMenuAccordionAccounting', 'show')
@section('activeMenuAccordionAccounting', 'active')
@section('activeMenuAccounting', 'active')

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
    <!--begin::Form-->
    <form action="#">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Compact form-->
                <div class="d-flex align-items-center">
                    <!--begin::Input group-->
                    <div class="position-relative w-md-400px me-md-2">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" class="form-control form-control-solid ps-10" id="inputCodigoOperacion" name="search" value="" placeholder="Código de operación" />
                    </div>
                    <!--end::Input group-->
                    <!--begin:Action-->
                    <div class="d-flex align-items-center">
                        <button type="button" id="btn-search" class="btn btn-primary me-5">Buscar</button>
                        <a id="kt_horizontal_search_advanced_link" class="btn btn-link" data-bs-toggle="collapse" href="#kt_advanced_search_form">Búsqueda avanzada</a>
                    </div>
                    <!--end:Action-->
                </div>
                <!--end::Compact form-->
                <!--begin::Advance form-->
                <div class="collapse" id="kt_advanced_search_form">
                    <!--begin::Separator-->
                    <div class="separator separator-dashed mt-9 mb-6"></div>
                    <!--end::Separator-->
                    <!--begin::Row-->
                    <div class="row g-8 mb-8">
                        <!--begin::Col-->
                        <div class="col-xxl-5">
                            <!--begin::Row-->
                            <div class="row g-8">
                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <label class="fs-6 form-label fw-bolder text-dark">Banco</label>
                                    <!--begin::Select-->
                                    <select id="selectBanco" class="form-select form-select-solid" data-control="select2" data-placeholder="Seleccione un banco" data-hide-search="true">
                                        <option value=""></option>
                                        @foreach( $banks as $bank )
                                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <label class="fs-6 form-label fw-bolder text-dark">Documento Cliente</label>
                                    <input type="text" class="form-control form-control form-control-solid" name="inputDocumentCliente" id="inputDocumentCliente" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Advance form-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </form>
    <!--end::Form-->
    <!--begin::Toolbar-->
    <div class="d-flex flex-wrap flex-stack pb-7">
        <!--begin::Title-->
        <div class="d-flex flex-wrap align-items-center my-1">
            <h3 class="fw-bolder me-5 my-1"><span id="numberItems"></span> Operaciones encontradas
                <span class="text-gray-400 fs-6">por fecha de creación ↓</span>
            </h3>
        </div>
        <!--end::Title-->
        <!--begin::Controls-->
        <div class="d-flex flex-wrap my-1">
            <!--begin::Tab nav-->
            <ul class="nav nav-pills me-6 mb-2 mb-sm-0">
                <li class="nav-item m-0">
                    <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary active" data-bs-toggle="tab" href="#kt_project_users_table_pane">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                                <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </a>
                </li>
                <li class="nav-item m-0">
                    <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary me-3 " data-bs-toggle="tab" href="#kt_project_users_card_pane">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </a>
                </li>
            </ul>
            <!--end::Tab nav-->
        </div>
        <!--end::Controls-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Tab Content-->
    <div class="tab-content">
        <!--begin::Tab pane-->
        <div id="kt_project_users_card_pane" class="tab-pane fade">
            <!--begin::Row-->
            <div class="row g-6 g-xl-9" id="body-card">

            </div>
            <!--end::Row-->
        </div>
        <!--end::Tab pane-->
        <!--begin::Tab pane-->
        <div id="kt_project_users_table_pane" class="tab-pane fade show active">
            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table id="kt_project_users_table" class="table table-row-bordered table-row-dashed align-middle fw-bolder table-sm">
                            <!--begin::Head-->
                            <thead class="fs-7 text-gray-400 text-uppercase">
                            <tr>
                                <th class="min-w-90px">ID</th>
                                <th class="min-w-90px">Banco</th>
                                <th class="min-w-90px">Documento Cliente</th>
                                <th class="min-w-90px">Tipo Operación</th>
                                <th class="min-w-90px">Cod. Operación Entrante</th>
                                <th class="min-w-90px">Cod. Operación Saliente</th>
                                <th class="min-w-90px">Moneda</th>
                                <th class="min-w-90px">Monto Previo</th>
                                <th class="min-w-90px">Monto Nuevo</th>
                                <th class="min-w-90px">Fecha</th>
                                <th class="min-w-90px">Observación</th>
                            </tr>
                            </thead>
                            <!--end::Head-->
                            <!--begin::Body-->
                            <tbody class="fs-6" id="body-table">

                            </tbody>
                            <!--end::Body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Tab pane-->
        <!--begin::Pagination-->
        <div class="d-flex flex-stack flex-wrap pt-1">
            <div class="fs-6 fw-bold text-gray-700" id="textPagination"></div>
            <!--begin::Pages-->
            <ul class="pagination" style="margin-right: 30px" id="pagination">

            </ul>
            <!--end::Pages-->
        </div>
        <!--end::Pagination-->
    </div>
    <!--end::Tab Content-->


    <template id="previous-page">
        <li class="page-item previous">
            <a href="#" class="page-link" data-item>
                <i class="previous"></i>
            </a>
        </li>
    </template>

    <template id="item-page">
        <li class="page-item" data-active>
            <a href="#" class="page-link" data-item="">5</a>
        </li>
    </template>

    <template id="next-page">
        <li class="page-item next">
            <a href="#" class="page-link" data-item>
                <i class="next"></i>
            </a>
        </li>
    </template>

    <template id="disabled-page">
        <li class="page-item disabled">
            <span class="page-link">...</span>
        </li>
    </template>

    <template id="item-card">
        <!--begin::Col-->
        <div class="col-md-4 col-xxl-4">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">ID</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-id></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">BANCO</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-banco></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">DOCUMENTO CLIENTE</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-docIndentidadCliente></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">TIPO OPERACION</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-tipoOperacion></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">COD. OPERACION ENTRANTE</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-codOperacionEntrante></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">COD. OPERACION SALIENTE</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-codOperacionSaliente></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">MONEDA</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-moneda></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">MONTO PREVIO</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-monto_previo></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">MONTO NUEVO</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-monto_nuevo></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">FECHA</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-fecha></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">OBSERVACION</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-observacion></h5>

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Col-->
    </template>

    <template id="item-table">
        <!--begin::Col-->
        <tr>
            <td data-id></td>
            <td data-banco></td>
            <td data-docIndentidadCliente></td>
            <td data-tipoOperacion></td>
            <td data-codOperacionEntrante></td>
            <td data-codOperacionSaliente></td>
            <td data-moneda></td>
            <td data-monto_previo></td>
            <td data-monto_nuevo></td>
            <td data-fecha></td>
            <td data-observacion></td>
            {{--<td class="text-end">
                <a href="#" class="btn btn-light btn-sm">View</a>
            </td>--}}
        </tr>
        <!--end::Col-->
    </template>
@endsection

@section('scripts')
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/MDtimepicker/js/mdtimepicker.js') }}"></script>

    <!--end::Page Vendors Javascript-->
    <script>
        $(document).ready(function(){
            $("#day").select2({
                minimumResultsForSearch: Infinity,
                dropdownParent: $("#kt_modal_add_coupon")
            });
            $('.timepicker').mdtimepicker({
                timeFormat: 'hh:mm:ss.000',
                format:'hh:mm tt',
                theme:'blue',
                readOnly:true,
                hourPadding:true,
                clearBtn:false,
                is24hour: false,
            });
            //$.fn.modal.Constructor.prototype.enforceFocus = function () {};
        });
    </script>
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('assets/js/accounting/index.js') }}"></script>
    {{--<script src="{{ asset('assets/js/schedule/list.js') }}"></script>
    <script src="{{ asset('assets/js/schedule/add.js') }}"></script>
    <script src="{{ asset('assets/js/schedule/edit.js') }}"></script>--}}
@endsection
