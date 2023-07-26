@extends('layouts.admin')

@section('title', 'Horario de Atención de Dolareros')

@section('page-title', 'Horario de Atención de Dolareros')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-dark">Horario de Atención</li>
    </ul>
@endsection

@section('activeTabPanelAdmin', 'active')
@section('activeTabAdmin', 'active show')

@section('showMenuAccordionSchedule', 'show')
@section('activeMenuAccordionSchedule', 'active')
@section('activeMenuSchedule', 'active')

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
    <div class="notice d-flex @if( $buttonTurnOff->valueNumber == 1 ) bg-light-primary @else bg-light-danger @endif rounded @if( $buttonTurnOff->valueNumber == 1 ) border-primary @else border-danger @endif border border-dashed p-6 mb-4">
        <!--begin::Icon-->
        <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
        <span class="svg-icon svg-icon-2tx @if( $buttonTurnOff->valueNumber == 1 ) svg-icon-primary @else svg-icon-danger @endif me-4">
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
                <h4 class="text-gray-900 fw-bolder">Botón de apagado de emergencia!</h4>
                <label class="form-check form-switch form-check-custom form-check-solid float-end">
                    <!--begin::Input-->
                    <input class="form-check-input" type="checkbox" value="{{ $buttonTurnOff->valueNumber }}" {{ ($buttonTurnOff->valueNumber == 1) ? 'checked':''  }} data-kt-action="{{ route('button.turn.off.update') }}" data-kt-button-turn-off-status="{{ $buttonTurnOff->id }}" />
                    <!--end::Input-->
                </label>
                <div class="fs-6 text-gray-700">
                    <span class="left">Si apaga el sistema, los clientes no podrán realizar ninguna operación</span>

                </div>

            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>

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
                    <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Buscar horario" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <!--begin::Add customer-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_coupon">Agregar Horario</button>
                    <!--end::Add customer-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Group actions-->
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
                    <th class="min-w-50px">#</th>
                    <th class="min-w-125px">Día</th>
                    <th class="min-w-125px">Hora de Inicio</th>
                    <th class="min-w-125px">Hora de Término</th>
                    <th class="min-w-125px">Activo</th>
                    <th class="text-end min-w-70px">Actions</th>
                </tr>
                <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                @foreach( $schedules as $schedule )
                    <tr>
                        <!--begin::Name=-->
                        <td>
                            {{ $schedule->day }}
                        </td>
                        <td>
                            {{ $schedule->nameDay }}
                        </td>
                        <td>
                            {{ $schedule->hourStart }}
                        </td>
                        <td>
                            {{ $schedule->hourEnd }}
                        </td>
                        <td>
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input" name="status" type="checkbox" value="{{ $schedule->active }}" {{ ($schedule->active == 1) ? 'checked':''  }} data-kt-action="{{ route('schedule.update.active') }}" data-kt-schedule-status="{{ $schedule->id }}" />
                                <!--end::Input-->
                                <!--begin::Label-->
                                <span class="form-check-label fw-bold text-muted" >Activo</span>
                                <!--end::Label-->
                            </label>
                        </td>

                        <!--end::Name=-->
                        <!--begin::Action=-->
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-5 m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                </svg>
                            </span>
                                <!--end::Svg Icon--></a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-schedule="{{ $schedule->id }}" data-kt-day="{{ $schedule->day }}" data-kt-nameDay="{{ $schedule->nameDay }}" data-kt-hourStart="{{ $schedule->hourStart }}" data-kt-hourEnd="{{ $schedule->hourEnd }}" data-kt-coupon-action="update_row">Editar</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 text-danger" data-kt-coupon="{{ $schedule->id }}" data-kt-coupon-table-filter="delete_row">Eliminar</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
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
    <!--end::Card-->
    <!--begin::Modals-->
    <!--begin::Modal - Customers - Add-->
    <div class="modal fade" id="kt_modal_add_coupon" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_add_coupon_form" enctype="multipart/form-data" data-kt-action="{{ route('schedule.store') }}" data-kt-redirect="{{ route('schedule.index') }}">
                @csrf
                <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_coupon_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Crear nuevo horario</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_add_coupon_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_add_coupon_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_coupon_header" data-kt-scroll-wrappers="#kt_modal_add_coupon_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold mb-2">Seleccione el día</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="day" id="day" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Día de la semana">
                                    <option value=""></option>
                                    @foreach( $daysOfWeek as $item )
                                        <option value="{{ $item['day'] }}" >{{ $item['nameDay'] }}</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Hora de inicio</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="input-group date input-group-sm datestart" data-target-input="nearest">
                                            <input type="text" name="hourStart" value="" class="form-control timepicker" />
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Hora de Término</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="input-group date input-group-sm datestart" data-target-input="nearest">
                                            <input type="text" value="" name="hourEnd" class="form-control timepicker" />
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>

                            </div>

                        </div>
                        <!--end::Scroll-->


                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_add_coupon_cancel" class="btn btn-light me-3">Descartar</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="button" id="kt_modal_add_coupon_submit" class="btn btn-primary">
                            <span class="indicator-label">Guardar Horario</span>
                            <span class="indicator-progress">Por favor espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - Customers - Add-->
    <!--begin::Modal - Customers - Add-->
    <div class="modal fade" id="kt_modal_edit_coupon" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_edit_coupon_form" enctype="multipart/form-data" data-kt-action="{{ route('schedule.update') }}" data-kt-redirect="{{ route('schedule.index') }}">
                @csrf
                <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_edit_coupon_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Editar horario</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_edit_coupon_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <input type="hidden" name="schedule_id">
                        <input type="hidden" name="day">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_edit_coupon_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_coupon_header" data-kt-scroll-wrappers="#kt_modal_edit_coupon_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold mb-2">Día del horario</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="Día del horario" readonly name="nameDay" value="" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Hora de inicio</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="input-group date input-group-sm datestart" data-target-input="nearest">
                                            <input type="text" name="hourStart" value="" class="form-control timepicker" />
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Hora de término</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="input-group date input-group-sm datestart" data-target-input="nearest">
                                            <input type="text" value="" name="hourEnd" class="form-control timepicker" />
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                            </div>

                        </div>
                        <!--end::Scroll-->


                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="button" id="kt_modal_edit_coupon_cancel" class="btn btn-light me-3">Descartar</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="button" id="kt_modal_edit_coupon_submit" class="btn btn-primary">
                            <span class="indicator-label">Guardar</span>
                            <span class="indicator-progress">Por favor espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modals-->

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
    <script src="{{ asset('assets/js/schedule/list.js') }}"></script>
    <script src="{{ asset('assets/js/schedule/add.js') }}"></script>
    <script src="{{ asset('assets/js/schedule/edit.js') }}"></script>
@endsection
