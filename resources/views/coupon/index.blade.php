@extends('layouts.admin')

@section('title', 'Cupones de Dolareros')

@section('page-title', 'Cupones de Dolareros')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-dark">Listado de Cupones</li>
    </ul>
@endsection

@section('activeTabPanelAdmin', 'active')
@section('activeTabAdmin', 'active show')

@section('showMenuAccordionCouponsUsers', 'show')
@section('activeMenuAccordionCouponsUsers', 'active')
@section('activeMenuCouponList', 'active')


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
                    <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Buscar cupón" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <!--begin::Add customer-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_coupon">Agregar cupón</button>
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
                    <th class="min-w-125px">Cupones</th>
                    <th class="min-w-125px">Monto Compra</th>
                    <th class="min-w-125px">Monto Venta</th>
                    <th class="min-w-125px">Estado</th>
                    <th class="min-w-125px">Especial</th>
                    <th class="text-end min-w-70px">Actions</th>
                </tr>
                <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                @foreach( $coupons as $coupon )
                    <tr>
                        <!--begin::Name=-->
                        <td>
                            {{ $coupon->name }}
                        </td>
                        <td>
                            {{ $coupon->amountBuy }}
                        </td>
                        <td>
                            {{ $coupon->amountSell }}
                        </td>
                        <td>
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input" name="status" type="checkbox" value="{{ $coupon->status }}" {{ ($coupon->status == 1) ? 'checked':''  }} data-kt-action="{{ route('coupon.update.status') }}" data-kt-coupon-status="{{ $coupon->id }}" />
                                <!--end::Input-->
                                <!--begin::Label-->
                                <span class="form-check-label fw-bold text-muted" >Activo</span>
                                <!--end::Label-->
                            </label>
                        </td>

                        <td>
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input" name="special" type="checkbox" value="{{ $coupon->special }}" {{ ($coupon->special == 1) ? 'checked':''  }} data-kt-action="{{ route('coupon.update.special') }}" data-kt-coupon-special="{{ $coupon->id }}" />
                                <!--end::Input-->
                                <!--begin::Label-->
                                <span class="form-check-label fw-bold text-muted" >Especial</span>
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
                                    <a href="#" class="menu-link px-3" data-kt-coupon="{{ $coupon->id }}" data-kt-name="{{ $coupon->name }}" data-kt-amountBuy="{{ $coupon->amountBuy }}" data-kt-amountSell="{{ $coupon->amountSell }}" data-kt-status="{{ $coupon->status }}" data-kt-special="{{ $coupon->special }}" data-kt-coupon-action="update_row">Editar</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 text-danger" data-kt-coupon="{{ $coupon->id }}" data-kt-coupon-table-filter="delete_row">Eliminar</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 text-primary" data-kt-coupon="{{ $coupon->id }}" data-kt-name="{{ $coupon->name }}" data-kt-coupon-action="assign_row">Asignar</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 text-primary" data-kt-coupon="{{ $coupon->id }}" data-kt-name="{{ $coupon->name }}" data-kt-coupon-action="users_row">Usuarios</a>
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
                <form class="form" action="#" id="kt_modal_add_coupon_form" enctype="multipart/form-data" data-kt-action="{{ route('coupon.store') }}" data-kt-redirect="{{ route('coupon.index') }}">
                @csrf
                <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_coupon_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Crear nuevo cupón</h2>
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
                                <label class="required fs-6 fw-bold mb-2">Nombre del cupón</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="Nombre del cupón" name="name" value="" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Monto Venta del cupón</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" class="form-control form-control-solid" name="amountSell" value="" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Monto Compra del cupón</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" class="form-control form-control-solid" name="amountBuy" value="" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="fv-row mb-7">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Label-->
                                        <div class="me-5">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold">Este cupón es especial?</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div class="fs-7 fw-bold text-muted">Si activa, indica que el cupón es especial</div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Switch-->
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input" name="special" type="checkbox" value="1"/>
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <span class="form-check-label fw-bold text-muted">SI</span>
                                            <!--end::Label-->
                                        </label>
                                        <!--end::Switch-->
                                    </div>
                                    <!--begin::Wrapper-->
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
    <!--end::Modal - Customers - Add-->
    <!--begin::Modal - Customers - Add-->
    <div class="modal fade" id="kt_modal_edit_coupon" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_edit_coupon_form" enctype="multipart/form-data" data-kt-action="{{ route('coupon.update') }}" data-kt-redirect="{{ route('coupon.index') }}">
                @csrf
                <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_edit_coupon_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Editar cupón</h2>
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
                        <input type="hidden" name="coupon_id">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_edit_coupon_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_coupon_header" data-kt-scroll-wrappers="#kt_modal_edit_coupon_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold mb-2">Nombre del cupón</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="Nombre del cupón" name="name" value="" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Monto Venta del cupón</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" class="form-control form-control-solid" name="amountSell" value="" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Monto Compra del cupón</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" class="form-control form-control-solid" name="amountBuy" value="" />
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
    <!--end::Modal - Customers - Add-->
    <div class="modal fade" id="kt_modal_assign_coupon" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_assign_coupon_form" enctype="multipart/form-data" data-kt-action="{{ route('coupon.assign') }}" data-kt-redirect="{{ route('coupon.index') }}">
                @csrf
                <!--begin::Modal header-->
                    <div class="modal-header p-3" id="kt_modal_assign_coupon_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder" id="titleAssign">Asignar cupón a usuarios</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_assign_coupon_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                        <input type="hidden" name="coupon_id">
                        <input type="hidden" name="user_id">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_assign_coupon_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_assign_coupon_header" data-kt-scroll-wrappers="#kt_modal_assign_coupon_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="d-flex align-items-center form-label mb-5">Documento del usuario a asignar
                                    <i class="fas fa-exclamation-circle ms-2 fs-7 text-danger" data-bs-toggle="tooltip" title="Escriba mínimo 8 digitos en el documento"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Options-->
                                <div class="mb-0">
                                    <!--begin:Option-->
                                    <!--end::Option-->
                                    <div class="form-group mt-3">
                                        <div class="input-group">
                                            <input type="number" class="form-control form-control-lg form-control-solid" name="document" id="document" placeholder="" value="">
                                            <div class="input-group-append">
                                                <button class="btn btn-bg-primary" disabled type="button" id="btn_search" >Buscar</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="mt-4" id="body-users">
                                </div>
                            </div>
                            <!--end::Input group-->

                        </div>
                        <!--end::Scroll-->


                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="button" id="kt_modal_assign_coupon_cancel" class="btn btn-light me-3">Descartar</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="button" id="kt_modal_assign_coupon_submit" class="btn btn-primary">
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
    <div class="modal fade" id="kt_modal_user_coupon" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">

                <!--begin::Modal header-->
                    <div class="modal-header p-3" id="kt_modal_assign_coupon_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder" id="titleUsersAssign">Usuarios asignados</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_user_coupon_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_user_coupon_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_user_coupon_header" data-kt-scroll-wrappers="#kt_modal_user_coupon_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <div class="mt-4" id="body-users-assign">
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="button" id="kt_modal_user_coupon_cancel" class="btn btn-light me-3">Descartar</button>
                        <!--end::Button-->

                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modals-->
    <template id="template-user">
        <label class="d-flex flex-stack mb-5 cursor-pointer">
            <!--begin:Label-->
            <span class="d-flex align-items-center me-2">
                <!--begin::Icon-->
                <span class="symbol symbol-50px me-6">
                    <span class="symbol-label">
                        <!--begin::Svg Icon | path: icons/duotune/finance/fin001.svg-->
                        <span class="svg-icon svg-icon-1 svg-icon-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 19.725V18.725C20 18.125 19.6 17.725 19 17.725H5C4.4 17.725 4 18.125 4 18.725V19.725H3C2.4 19.725 2 20.125 2 20.725V21.725H22V20.725C22 20.125 21.6 19.725 21 19.725H20Z" fill="black" />
                                <path opacity="0.3" d="M22 6.725V7.725C22 8.325 21.6 8.725 21 8.725H18C18.6 8.725 19 9.125 19 9.725C19 10.325 18.6 10.725 18 10.725V15.725C18.6 15.725 19 16.125 19 16.725V17.725H15V16.725C15 16.125 15.4 15.725 16 15.725V10.725C15.4 10.725 15 10.325 15 9.725C15 9.125 15.4 8.725 16 8.725H13C13.6 8.725 14 9.125 14 9.725C14 10.325 13.6 10.725 13 10.725V15.725C13.6 15.725 14 16.125 14 16.725V17.725H10V16.725C10 16.125 10.4 15.725 11 15.725V10.725C10.4 10.725 10 10.325 10 9.725C10 9.125 10.4 8.725 11 8.725H8C8.6 8.725 9 9.125 9 9.725C9 10.325 8.6 10.725 8 10.725V15.725C8.6 15.725 9 16.125 9 16.725V17.725H5V16.725C5 16.125 5.4 15.725 6 15.725V10.725C5.4 10.725 5 10.325 5 9.725C5 9.125 5.4 8.725 6 8.725H3C2.4 8.725 2 8.325 2 7.725V6.725L11 2.225C11.6 1.925 12.4 1.925 13.1 2.225L22 6.725ZM12 3.725C11.2 3.725 10.5 4.425 10.5 5.225C10.5 6.025 11.2 6.725 12 6.725C12.8 6.725 13.5 6.025 13.5 5.225C13.5 4.425 12.8 3.725 12 3.725Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                </span>
                <!--end::Icon-->
                <!--begin::Description-->
                <span class="d-flex flex-column">
                    <span class="fw-bolder text-gray-800 text-hover-primary fs-5" data-name>Company Account</span>
                </span>
                <!--end:Description-->
            </span>
            <!--end:Label-->
            <!--begin:Input-->
            <span class="form-check form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" name="users[]" data-user value="1" />
            </span>
            <!--end:Input-->
        </label>
    </template>

    <template id="template-data">
        <div class="d-flex align-items-sm-center mb-7">
            <!--begin::Symbol-->
            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                <a href="#">
                    <div class="symbol-label fs-3 bg-light-danger text-danger" data-avatar></div>
                </a>
            </div>
            <!--end::Symbol-->
            <!--begin::Section-->
            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                <div class="flex-grow-1 me-2">
                    <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder" data-name></a>
                    <span class="text-muted fw-bold d-block fs-7" data-document></span>
                </div>
                <span class="badge badge-light fw-bolder my-2" data-phone></span>
            </div>
            <!--end::Section-->
        </div>
    </template>
@endsection

@section('scripts')
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('assets/js/coupon/list.js') }}"></script>
    <script src="{{ asset('assets/js/coupon/add.js') }}"></script>
    <script src="{{ asset('assets/js/coupon/edit.js') }}"></script>
@endsection