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
@section('activeMyOperation', 'text-primary')

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

        .custom-table {
            border-collapse: collapse;
        }

        .custom-table td {
            border: none;
            padding: 10px;
        }

        .custom-table td:not(:nth-child(2)) {
            border-right: 1px solid black;
        }
        .right-aligned {
            text-align: right;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card d-none d-sm-block">
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
                                <div class="menu-item px-3">
                                    <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
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
                                        <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-primary" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_receipt">Comprobante</a>
                                    </div>
                                <!--end::Menu item-->
                                </div>
                            @else
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
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
    </div>

    <div class="d-sm-none">
        <div class="card-header border-0 mb-5">
            <h3 class="card-title align-items-start flex-column">
            </h3>
            <div class="card-toolbar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4 me-1 active" data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">En proceso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_2">Finalizadas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4" data-bs-toggle="tab" href="#kt_table_widget_5_tab_3">Rechazadas</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card-body py-3">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="kt_table_widget_5_tab_1">
                    @foreach( $operations as $operation )
                        @if ( $operation->state == 'processing' )
                        <div class="card mb-4">
                            <div class="card-body p-5">
                                <div style="display: flex; justify-content: space-between;">
                                    <span>N° de operación {{ $operation->code_operation }}</span>
                                    <span class="right-aligned"> {{ $operation->estado}} </span>
                                </div>
                                <hr>
                                <table class="table custom-table">
                                    <tbody>
                                    <tr>
                                        <td class="pb-1" style="display: flex; justify-content: space-between;">Enviado <span class="right-aligned">{{ $operation->send_amount_list }}</span></td>
                                        <td class="pb-1">Tipo de Cambio </td>
                                    </tr>
                                    <tr>
                                        <td class="pt-1" style="display: flex; justify-content: space-between;">Recibido <span class="right-aligned">{{ $operation->get_amount_list }}</span></td>
                                        <td class="pt-1">{{ $operation->type_change }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <div style="display: flex; justify-content: space-between;">

                                    <span>{{ $operation->created_at->format('d/m/Y') }}</span>
                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary right-aligned" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Elegir
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
                                                <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
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
                                                <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 text-primary" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_receipt">Comprobante</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                    @else
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 text-danger" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_refused">Motivo</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                    @endif
                                    {{--<button class="p-0 btn btn-lg btn-flex btn-link btn-color-gray-800 right-aligned">Ver detalles <i class="p-2 fas fa-chevron-right"></i></button>--}}
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                <div class="tab-pane fade" id="kt_table_widget_5_tab_2">
                    @foreach( $operations as $operation )
                        @if ( $operation->state == 'finished' )
                            <div class="card mb-4">
                                <div class="card-body p-5">
                                    <div style="display: flex; justify-content: space-between;">
                                        <span>N° de operación {{ $operation->code_operation }}</span>
                                        <span class="right-aligned"> {{ $operation->estado}} </span>
                                    </div>
                                    <hr>
                                    <table class="table custom-table">
                                        <tbody>
                                        <tr>
                                            <td class="pb-1" style="display: flex; justify-content: space-between;">Enviado <span class="right-aligned">{{ $operation->send_amount_list }}</span></td>
                                            <td class="pb-1">Tipo de Cambio </td>
                                        </tr>
                                        <tr>
                                            <td class="pt-1" style="display: flex; justify-content: space-between;">Recibido <span class="right-aligned">{{ $operation->get_amount_list }}</span></td>
                                            <td class="pt-1">{{ $operation->type_change }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div style="display: flex; justify-content: space-between;">

                                        <span>{{ $operation->created_at->format('d/m/Y') }}</span>
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary right-aligned" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Elegir
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
                                                    <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
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
                                                    <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3 text-primary" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_receipt">Comprobante</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                        @else
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3 text-danger" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_refused">Motivo</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                        @endif
                                        {{--<button class="p-0 btn btn-lg btn-flex btn-link btn-color-gray-800 right-aligned">Ver detalles <i class="p-2 fas fa-chevron-right"></i></button>--}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="tab-pane fade" id="kt_table_widget_5_tab_3">
                    @foreach( $operations as $operation )
                        @if ( $operation->state == 'refused' )
                            <div class="card mb-4">
                                <div class="card-body p-5">
                                    <div style="display: flex; justify-content: space-between;">
                                        <span>N° de operación {{ $operation->code_operation }}</span>
                                        <span class="right-aligned"> {{ $operation->estado}} </span>
                                    </div>
                                    <hr>
                                    <table class="table custom-table">
                                        <tbody>
                                        <tr>
                                            <td class="pb-1" style="display: flex; justify-content: space-between;">Enviado <span class="right-aligned">{{ $operation->send_amount_list }}</span></td>
                                            <td class="pb-1">Tipo de Cambio </td>
                                        </tr>
                                        <tr>
                                            <td class="pt-1" style="display: flex; justify-content: space-between;">Recibido <span class="right-aligned">{{ $operation->get_amount_list }}</span></td>
                                            <td class="pt-1">{{ $operation->type_change }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div style="display: flex; justify-content: space-between;">

                                        <span>{{ $operation->created_at->format('d/m/Y') }}</span>
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary right-aligned" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Elegir
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
                                                    <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
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
                                                    <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3 text-primary" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_receipt">Comprobante</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                        @else
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3 text-danger" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_refused">Motivo</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                        @endif
                                        {{--<button class="p-0 btn btn-lg btn-flex btn-link btn-color-gray-800 right-aligned">Ver detalles <i class="p-2 fas fa-chevron-right"></i></button>--}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        {{--@foreach( $operations as $operation )
        <div class="card mb-4">
            <div class="card-body p-5">
                <div style="display: flex; justify-content: space-between;">
                    <span>N° de operación {{ $operation->code_operation }}</span>
                    <span class="right-aligned"> {{ $operation->estado}} </span>
                </div>
                <hr>
                <table class="table custom-table">
                    <tbody>
                    <tr>
                        <td class="pb-1" style="display: flex; justify-content: space-between;">Enviado <span class="right-aligned">{{ $operation->send_amount_list }}</span></td>
                        <td class="pb-1">Tipo de Cambio </td>
                    </tr>
                    <tr>
                        <td class="pt-1" style="display: flex; justify-content: space-between;">Recibido <span class="right-aligned">{{ $operation->get_amount_list }}</span></td>
                        <td class="pt-1">{{ $operation->type_change }}</td>
                    </tr>
                    </tbody>
                </table>
                <hr>
                <div style="display: flex; justify-content: space-between;">

                    <span>{{ $operation->created_at->format('d/m/Y') }}</span>
                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary right-aligned" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Elegir
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
                                <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
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
                                <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3 text-primary" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_receipt">Comprobante</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                    @else
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="https://api.whatsapp.com/send?phone=51921867035&text=Hola%20necesito%20ayuda" target="_blank" class="menu-link px-3" ><i class="fab fa-whatsapp fs-4" style="margin-right: 5px;color: #14ad33;"></i> Ayuda</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3 text-success" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_details">Detalles</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3 text-danger" data-kt-operation="{{ $operation->id }}" data-kt-operation-action="show_refused">Motivo</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                    @endif
                    --}}{{--<button class="p-0 btn btn-lg btn-flex btn-link btn-color-gray-800 right-aligned">Ver detalles <i class="p-2 fas fa-chevron-right"></i></button>--}}{{--
                </div>
            </div>
        </div>
        @endforeach--}}
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
                                <h5 class="text-gray-700 text-start">Fecha de operación</h5> <h4 class="text-gray-900 fw-bolder text-end" id="fechaOperacion"> </h4>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">N° de operación</h5> <h4 class="text-gray-900 fw-bolder text-end" id="numeroOperacion"> </h4>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Tipo de cambio</h5> <h4 class="text-gray-900 fw-bolder text-end" id="tipoCambio"> </h4>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Monto enviado</h5> <h5 class="text-gray-900 fw-bolder text-end" id="montoEnviado"> </h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Monto recibido</h5> <h5 class="text-gray-900 fw-bolder text-end" id="montoRecibido"> </h5>
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

        });
    </script>
    <script src="{{ asset('assets/js/operation/list.js') }}"></script>
    <script src="{{ asset('assets/js/operation/index.js') }}"></script>
@endsection
