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

@section('activeTabPanelMenu', 'active')
@section('activeTabHome', 'active show')
@section('activeMyAccount', 'text-primary')

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
    <div class="card">
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
            {{--<div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
                <div class="fw-bolder me-5">
                    <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected</div>
                <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
            </div>--}}
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
                    {{--<th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
                        </div>
                    </th>--}}
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
                                <div class="menu-item px-3">
                                    <a href="https://wa.link/ojsau0" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            @elseif( $operation->estado === 'FINALIZADO' )
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="https://wa.link/ojsau0" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-primary" data-kt-account="" data-kt-customer-table-filter="delete_row">Comprobante</a>
                                    </div>
                                <!--end::Menu item-->
                                </div>
                            @else
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="https://wa.link/ojsau0" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-danger" data-kt-account="" data-kt-customer-table-filter="reason_row">Motivo</a>
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
    </div>
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
                                <h5 class="text-gray-700 text-start">Código Dolareros</h5> <h4 class="text-gray-900 fw-bolder text-end" id="code_dolareros"> </h4>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">*Código para revisar tu operación</h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                @if ( $stopOperation != null )
                                    <h5 class="text-gray-700 text-start">Monto a recibir</h5> <h4 class="text-gray-900 fw-bolder text-end"> {{ ($stopOperation->type == 'buy') ? 'PEN ':'USD ' }} {{ number_format(round($stopOperation->getAmount, 2), 2) }}</h4>
                                @else
                                    <h5 class="text-gray-700 text-start">Monto a recibir</h5> <h4 class="text-gray-900 fw-bolder text-end"> {{ ($stopData->type == 'buy') ? 'PEN ':'USD ' }} {{ number_format(round($stopData->getAmount, 2), 2) }}</h4>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Tiempo estimado de espera</h5> <h4 class="text-gray-900 fw-bolder text-end"> 15 min </h4>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_success_step_home" data-url="{{ route('home') }}" class="btn btn-success me-3">Nueva operación</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_success_step_operations" data-url="{{ (session()->has('codigo_correcto')) ? route('operationCustomer.index') : route('code.index', 2) }}" class="btn btn-primary" >
                        <span class="indicator-label">Ver Operaciones</span>
                        <span class="indicator-progress">Por favor espere...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Button-->
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

        });
    </script>
    <script src="{{ asset('assets/js/operation/list.js') }}"></script>
    <script src="{{ asset('assets/js/operation/index.js') }}"></script>
@endsection
