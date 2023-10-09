@extends('layouts.admin')

@section('title', 'Operaciones')

@section('page-title', 'Historial de Operaciones')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-dark">Listado de operaciones</li>
    </ul>
@endsection

@section('activeTabPanelAdmin', 'active')
@section('activeTabAdmin', 'active show')

@section('showMenuAccordionOperations', 'show')
@section('activeMenuAccordionOperations', 'active')
@section('activeMenuOperationList', 'active')

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
@endsection

@section('content')
    <!--begin::Card-->
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
                                <th class="min-w-125px">Código</th>
                                <th class="min-w-125px">Banco Dolarero</th>
                                <th class="min-w-125px">N° de Op. Usuario</th>
                                <th class="min-w-125px">Por Recibir</th>
                                <th class="min-w-125px">Por Enviar</th>
                                <th class="min-w-125px">Tipo de cambio</th>
                                <th class="min-w-125px">Fecha</th>
                                <th class="min-w-125px">Estado</th>
                                <th class="text-end min-w-70px">Acciones</th>
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
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">Código</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-numOperation></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">N° Oper. Usuario</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-numOperationUser></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">Por Recibir</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-enviado></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">Por Enviar</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-recibido></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">Tipo de Cambio</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-tipoCambio></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">Fecha</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-fecha></h5>
                    <h4 class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">Estado</h4>
                    <h5 class="fw-bold text-gray-400 mb-6" data-estado></h5>
                    <div data-buttons>

                    </div>
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
            <td data-numOperation></td>
            <td data-bank></td>
            <td data-numOperationUser></td>
            <td data-enviado></td>
            <td data-recibido></td>
            <td data-tipoCambio></td>
            <td data-fecha></td>
            <td data-estado></td>
            <td class="text-end" data-buttons>
                {{--<div class="d-flex justify-content-end flex-shrink-0">
                    <a href="#" data-btn_information class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                        <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"></path>
                            <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"></path>
                        </svg>
                    </span>
                        <!--end::Svg Icon-->
                    </a>
                    <a href="#" data-btn_update data-kt-users-table-filter="update_row" data-users-id="" data-users-first_name="" data-users-last_name="" data-users-email="" data-users-phone="" data-users-document="" data-users-role_id="" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </a>
                    <a href="#" data-btn_delete data-kt-users-table-filter="delete_row" data-users-id="" data-users-name="" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </a>
                </div>--}}
            </td>
        </tr>
        <!--end::Col-->
    </template>

    <template id="template-procesando">
        <div class="d-flex justify-content-end flex-shrink-0">

            <a href="https://wa.link/ojsau0" target="_blank" data-toggle="tooltip" data-placement="top" title="Ayuda" class="btn btn-icon btn-bg-light btn-sm me-1">
                <i class="fab fa-whatsapp fs-4" style="color: #14ad33;"></i>
            </a>
            <a href="#" class="btn btn-icon btn-bg-light btn-sm me-1" data-show_details data-kt-operation="" data-kt-operation-action="show_details" data-toggle="tooltip" data-placement="top" title="Ver detalles">
                <i class="fas fa-list fs-4" style="color: #0a53be;"></i>
            </a>

            <a href="#" class="btn btn-icon btn-bg-light btn-sm me-1" data-finish_operation data-kt-operation="" data-kt-operation-action="finish_operation" data-toggle="tooltip" data-placement="top" title="Finalizar operación">
                <i class="fas fa-check-double fs-4" style="color: #cc8500;"></i>
            </a>

            <a href="#" class="btn btn-icon btn-bg-light btn-sm me-1" data-refused_operation data-kt-operation="" data-kt-operation-action="refused_operation" data-toggle="tooltip" data-placement="top" title="Rechazar operación">
                <i class="fas fa-window-close fs-4" style="color: #cc0000;"></i>
            </a>

        </div>
    </template>

    <template id="template-finalizado">

        <div class="d-flex justify-content-end flex-shrink-0">

            <a href="https://wa.link/ojsau0" target="_blank" class="btn btn-icon btn-bg-light btn-sm me-1" data-toggle="tooltip" data-placement="top" title="Ayuda">
                <i class="fab fa-whatsapp fs-4" style="color: #14ad33;"></i>
            </a>

            <a href="#" class="btn btn-icon btn-bg-light btn-sm me-1" data-show_details data-kt-operation="" data-kt-operation-action="show_details" data-toggle="tooltip" data-placement="top" title="Ver detalles">
                <i class="fas fa-list fs-4" style="color: #0a53be;"></i>
            </a>

            <a href="#" class="btn btn-icon btn-bg-light btn-sm me-1" data-show_receipt data-kt-operation="" data-kt-operation-action="show_receipt" data-toggle="tooltip" data-placement="top" title="Ver comprobante">
                <i class="fas fa-eye" style="color: #5014d0;"></i>
            </a>

            <a href="#" class="btn btn-icon btn-bg-light btn-sm me-1" data-change_receipt data-kt-operation="" data-kt-operation_image_receipt="" data-kt-operation_number_operation_dolareros="" data-kt-operation-action="change_receipt" data-toggle="tooltip" data-placement="top" title="Cambiar comprobante" >
                <i class="fas fa-exchange-alt" style="color: #cc0000;"></i>
            </a>

        </div>
    </template>

    <template id="template-otro">
        <div class="d-flex justify-content-end flex-shrink-0">
            <a href="https://wa.link/ojsau0" target="_blank" class="btn btn-icon btn-bg-light btn-sm me-1" data-toggle="tooltip" data-placement="top" title="Ayuda">
                <i class="fab fa-whatsapp fs-4" style="color: #14ad33;"></i>
            </a>
            <a href="#" class="btn btn-icon btn-bg-light btn-sm me-1" data-show_details data-kt-operation="" data-kt-operation-action="show_details" data-toggle="tooltip" data-placement="top" title="Ver detalles">
                <i class="fas fa-list fs-4" style="color: #0a53be;"></i>
            </a>
            <a href="#" class="btn btn-icon btn-bg-light btn-sm me-1" data-finish_operation data-kt-operation="" data-kt-operation-action="finish_operation" data-toggle="tooltip" data-placement="top" title="Finalizar operación">
                <i class="fas fa-check-double fs-4" style="color: #cc8500;"></i>
            </a>
            <a href="#" class="menu-link px-3 text-danger" data-show_refused data-kt-operation="" data-kt-operation-action="show_refused" data-toggle="tooltip" data-placement="top" title="Ver motivo de rechazo">
                <i class="fas fa-exclamation-triangle" style="color: #cc8500;"></i>
            </a>

        </div>
    </template>

    {{--<div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Buscar operación" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <!--begin::Add customer-->
                    <!--end::Add customer-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Group actions-->
            --}}{{--<div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
                <div class="fw-bolder me-5">
                    <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected</div>
                <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
            </div>--}}{{--
            <!--end::Group actions-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                <!--begin::Table head-->
                <thead>
                <!--begin::Table row-->
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    --}}{{--<th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
                        </div>
                    </th>--}}{{--
                    <th class="min-w-125px">Código</th>
                    <th class="min-w-125px">N° de Operación</th>
                    <th class="min-w-125px">Enviado</th>
                    <th class="min-w-125px">Recibido</th>
                    <th class="min-w-125px">Tipo de cambio</th>
                    <th class="min-w-125px">Fecha</th>
                    <th class="min-w-125px">Estado</th>
                    <th class="text-end min-w-70px">Acciones</th>
                </tr>
                <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                @foreach( $operations as $operation )
                    <tr>
                        <td>
                            {{ $operation->code_operation }}
                        </td>
                        <td>
                            {{ ($operation->number_operation_user == null) ? 'Pendiente': $operation->number_operation_user }}
                        </td>
                        <td>
                            {{ $operation->send_amount_list }}
                        </td>
                        <td>
                            {{ $operation->get_amount_list }}
                        </td>
                        <td>
                            {{ $operation->type_change }}
                        </td>
                        <td>
                            {{ $operation->created_at->format('d/m/Y') }}
                        </td>
                        <td>
                            @if( $operation->estado == 'RECHAZADO' )
                                <span class="badge badge-light-danger">{{ $operation->estado }}</span>
                            @elseif( $operation->estado == 'PROCESANDO' )
                                <span class="badge badge-light-warning">{{ $operation->estado }}</span>
                            @else
                                <span class="badge badge-light-primary">{{ $operation->estado }}</span>
                            @endif

                        </td>
                        <!--end::Status=-->
                        <!--begin::Action=-->
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Elegir
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-5 m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                </svg>
                            </span>
                                <!--end::Svg Icon--></a>
                            <!--begin::Menu-->
                            @if ( $operation->estado === 'PROCESANDO' )
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                --}}{{--<div class="menu-item px-3">
                                    <a href="https://wa.link/ojsau0" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                                </div>--}}{{--
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                                </div>

                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 text-primary" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="finish_operation">Finalizar</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 text-danger" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="refused_operation">Rechazar</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            @elseif( $operation->estado === 'FINALIZADO' )
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    --}}{{--<div class="menu-item px-3">
                                        <a href="https://wa.link/ojsau0" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                                    </div>--}}{{--
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-primary" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_receipt">Comprobante</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-warning" data-kt-operation="{{ $operation->id }}" data-kt-operation_image_receipt="{{ $operation->image_receipt }}" data-kt-operation_number_operation_dolareros="{{ $operation->number_operation_dolareros }}" data-kt-operation-action="change_receipt">Cambiar</a>
                                    </div>
                                <!--end::Menu item-->
                                </div>
                            @else
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    --}}{{--<div class="menu-item px-3">
                                        <a href="https://wa.link/ojsau0" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                                    </div>--}}{{--
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-primary" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="finish_operation">Finalizar</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-danger" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_refused">Motivo</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                            @endif
                            <!--end::Menu-->
                        </td>
                        <!--end::Action=-->
                    </tr>
                @endforeach
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>--}}
    <div class="modal fade" id="kt_modal_operation_details" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class=" me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <div class="row pb-1 text-center">
                            <h5> Detalle de la operación </h5>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <div class="row">

                        <div class="bg-light-primary rounded border-primary border border-dashed p-6">
                            <!--begin::Wrapper-->
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Fecha de operación</h5> <h4 class="text-gray-900 fw-bolder text-end" id="fechaOperacion"> </h4>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">N° de operación</h5> <h4 class="text-gray-900 fw-bolder text-end" id="numeroOperacion"> </h4>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Tipo de cambio</h5> <h4 class="text-gray-900 fw-bolder text-end" id="tipoCambio"> </h4>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Por Recibir</h5> <h5 class="text-gray-900 fw-bolder text-end" id="montoEnviado"> </h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Por Enviar</h5> <h5 class="text-gray-900 fw-bolder text-end" id="montoRecibido"> </h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Cuenta Dolareros</h5> <h5 class="text-gray-900 fw-bolder text-end" id="cuentaDolareros"> </h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Cuenta destino</h5> <h5 class="text-gray-900 fw-bolder text-end" id="cuentaDestino"> </h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Estado de la operación</h5> <h5 class="fw-bolder text-end " id="estadoOperacion"> </h5>
                            </div>

                            <!--end::Wrapper-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_operation_detail_close" class="btn btn-secondary me-3">Cerrar</button>
                    <!--end::Button-->

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_operation_receipt" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class=" me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <div class="row pb-1 text-center">
                            <h5> Detalle del comprobante </h5>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <div class="row">

                        <div class="bg-light-primary rounded border-primary border border-dashed p-6">
                            <!--begin::Wrapper-->
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">RUC del emisor</h5> <h4 class="text-gray-900 fw-bolder text-end" id="rucEmisor"> </h4>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Numero de operación</h5> <h4 class="text-gray-900 fw-bolder text-end" id="numberOperation"> </h4>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Fecha</h5> <h5 class="text-gray-900 fw-bolder text-end" id="fecha"> </h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Monto enviado</h5> <h5 class="text-gray-900 fw-bolder text-end" id="montoEnviadoReceipt"> </h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Imagen comprobante</h5> <h5 class="text-gray-900 fw-bolder text-end" > <button data-image_receipt id="imageReceipt" data-url="" class="btn btn-primary btn-sm">Descargar</button> </h5>
                            </div>

                            <!--end::Wrapper-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_operation_receipt_close" class="btn btn-secondary me-3">Cerrar</button>
                    <!--end::Button-->

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_operation_refused" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class=" me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <div class="row pb-1 text-center">
                            <h5> Motivo del rechazo </h5>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <div class="row">

                        <div class="bg-light-danger rounded border-danger border border-dashed p-6">
                            <!--begin::Wrapper-->
                            <div class="d-flex justify-content-center">
                                <h5 class="text-gray-700 text-center" id="reasonRefused"></h5>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_operation_refused_close" class="btn btn-secondary me-3">Cerrar</button>
                    <!--end::Button-->

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_register_refused" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class=" me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <div class="row pb-1 text-center">
                            <h5> Registrar motivo del rechazo </h5>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <div class="row">
                        <input type="hidden" name="operation_id_register_refused" id="operation_id_register_refused">
                        {{--<div class="bg-light-danger rounded border-danger border border-dashed p-6">--}}
                            <!--begin::Wrapper-->
                            <div class="d-flex justify-content-center">
                                <select name="rejection_id" id="rejection_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Motivo de rechazo" >
                                    <option></option>
                                    @foreach( $rejections as $rejection )
                                        <option value="{{ $rejection->id }}">
                                            {{ $rejection->reason }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Wrapper-->
                        {{--</div>--}}
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_register_refused_close" class="btn btn-secondary me-3">Cerrar</button>
                    <!--end::Button-->
                    <button type="button" id="kt_modal_register_refused_submit" class="btn btn-primary" data-url="{{ route('save.refused.operation') }}">
                        <span class="indicator-label">Rechazar operación</span>
                        <span class="indicator-progress">Por favor espere...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_register_receipt" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class=" me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <div class="row pb-1 text-center">
                            <h5> Registrar Comprobante </h5>
                        </div>
                    </div>

                    <input type="hidden" name="operation_id_register_receipt" id="operation_id_register_receipt">

                    <div class="row">
                        <div class="col-lg-12">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Número de operación</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="number" class="form-control form-control-solid" placeholder="Número de operación" name="numberOperationDolareros" id="numberOperationDolareros" value="" />
                            <!--end::Input-->

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">

                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Imagen de comprobante</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="file" class="form-control form-control-solid" name="imageOperationDolareros" id="imageOperationDolareros" value="" />
                            <!--end::Input-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_register_receipt_close" class="btn btn-secondary me-3">Cerrar</button>
                    <!--end::Button-->
                    <button type="button" id="kt_modal_register_receipt_submit" class="btn btn-primary" data-url="{{ route('save.receipt.operation') }}">
                        <span class="indicator-label">Finalizar operación</span>
                        <span class="indicator-progress">Por favor espere...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_edit_receipt" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class=" me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <div class="row pb-1 text-center">
                            <h5> Editar Comprobante </h5>
                        </div>
                    </div>

                    <input type="hidden" name="operation_id_edit_receipt" id="operation_id_edit_receipt">

                    <div class="row">
                        <div class="col-lg-12">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Número de operación</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="tel" class="form-control form-control-solid" placeholder="Número de operación" name="numberOperationDolarerosEdit" id="numberOperationDolarerosEdit" value="" />
                            <!--end::Input-->

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">

                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Imagen de comprobante</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="file" class="form-control form-control-solid" name="imageOperationDolarerosEdit" id="imageOperationDolarerosEdit" value="" />
                            <!--end::Input-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_edit_receipt_close" class="btn btn-secondary me-3">Cerrar</button>
                    <!--end::Button-->
                    <button type="button" id="kt_modal_edit_receipt_submit" class="btn btn-primary" data-url="{{ route('update.receipt.operation') }}">
                        <span class="indicator-label">Cambiar comprobante</span>
                        <span class="indicator-progress">Por favor espere...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_image_receipt" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">

                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
								</svg>
							</span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal body-->
                <div class="modal-body pb-10 pt-0 px-lg-17">
                    <!--begin::Scroll-->
                    <div class=" me-n7 pe-7" id="" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">

                        <div class="row">
                            <div class="col-sm-8 offset-sm-2 col-8 offset-2">
                                <div class="d-flex justify-content-center">
                                    <img class="img-fluid center" style="height: 100%;max-height: 325px" id="showImageReceipt" src="#" alt="">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Scroll-->


                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors Javascript-->

    <!--begin::Page Custom Javascript(used by this page)-->
    <script>
        $(document).ready(function(){
            $("#rejection_id").select2({
                minimumResultsForSearch: Infinity,
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    {{--<script src="{{ asset('assets/js/operation/listDolareros.js') }}"></script>--}}
    <script src="{{ asset('assets/js/operation/indexDolareros.js') }}"></script>
    <script src="{{ asset('assets/js/operation/index2.js') }}"></script>
@endsection
