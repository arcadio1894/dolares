@extends('layouts.admin')

@section('title', 'Cuentas Dolareros')

@section('page-title', 'Cuentas Dolareros')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-dark">Listado de cuentas</li>
    </ul>
@endsection

@section('activeTabPanelAdmin', 'active')
@section('activeTabAdmin', 'active show')

@section('showMenuAccordionAccounts', 'show')
@section('activeMenuAccordionAccounts', 'active')
@section('activeMenuAccountList', 'active')


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
                    <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Buscar cuenta" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <!--begin::Add customer-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Agregar cuenta</button>
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
            <div class="table-responsive">
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
                        <th class="min-w-125px">Banco</th>
                        <th class="min-w-125px">Cuenta</th>
                        <th class="min-w-125px">Departamento</th>
                        <th class="min-w-125px">Moneda</th>
                        <th class="min-w-125px">Estado</th>
                        <th class="min-w-125px">Interbank</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                    <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                    @foreach( $accounts as $account )
                        <tr>
                            <!--begin::Checkbox-->
                        {{--<td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="{{ $bank->id }}" />
                            </div>
                        </td>--}}
                        <!--end::Checkbox-->
                            <!--begin::Name=-->
                            <td>
                                <img src="{{ asset('assets/images/banks/'.$account->bank->imageBank) }}" alt="{{ $account->bank->name }}" class="img-fluid" style="max-width: 30px;"> {{ $account->bank->name }}
                            </td>
                            <td>
                                {{ $account->numberAccount }}
                            </td>
                            <td>
                                {{ $account->department->name }}
                            </td>
                            <td>
                                {{ ($account->currency == 'PEN') ? 'Soles':'Dólares' }}
                            </td>
                            <!--end::Name=-->
                            <!--begin::Status=-->
                            <td>
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input" name="status" type="checkbox" value="{{ $account->status }}" {{ ($account->status == 1) ? 'checked':''  }} data-kt-action="{{ route('accounts.update.status') }}" data-kt-account-active="{{ $account->id }}" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <span class="form-check-label fw-bold text-muted" >Activo</span>
                                    <!--end::Label-->
                                </label>
                                <!--end::Switch-->
                            </td>
                            <td>
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input" name="apply_interbank" type="checkbox" value="{{ $account->apply_interbank }}" {{ ($account->apply_interbank == 1) ? 'checked':''  }} data-kt-action="{{ route('accounts.update.apply.interbank') }}" data-kt-account-interbank="{{ $account->id }}" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <span class="form-check-label fw-bold text-muted" >Activo</span>
                                    <!--end::Label-->
                                </label>
                                <!--end::Switch-->
                            </td>
                            <!--end::Status=-->
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
                                        <a href="#" class="menu-link px-3" data-kt-account="{{ $account->id }}" data-kt-bank="{{ $account->bank->id }}" data-kt-nameBank="{{ $account->bank->nameBank }}" data-kt-department="{{ $account->department->id }}" data-kt-status="{{ $account->status }}" data-kt-numberAccount="{{ $account->numberAccount }}" data-kt-currency="{{ $account->currency }}" data-kt-numberInterbank="{{ $account->number_interbank }}" data-kt-balance="{{ $account->balance }}" data-kt-account-action="update_row">Editar</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-danger" data-kt-account="{{ $account->id }}" data-kt-customer-table-filter="delete_row">Eliminar</a>
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

        </div>
        <!--end::Card body-->
    </div>

    <div class="d-sm-none">
        <div class="card-header border-0 mb-5">
            <h3 class="card-title align-items-start flex-column">
            </h3>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <!--begin::Add customer-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Agregar cuenta</button>
                    <!--end::Add customer-->
                </div>
            </div>
        </div>
        <div class="card-body py-3">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="kt_table_widget_5_tab_1">
                @foreach( $accounts as $account )
                    <div class="card mb-4">
                        <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                        <!--begin::Avatar-->
                        <img src="{{ asset('assets/images/banks/'.$account->bank->imageBank) }}" alt="{{ $account->bank->name }}" class="img-fluid symbol symbol-65px symbol-circle mb-5" style="max-width: 30px;">

                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0 text-center" data-name>{{ $account->bank->name }}</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fw-bold text-gray-600 mb-1" data-role_description>{{ $account->numberAccount }}</div>
                        <div class="fw-bold text-gray-400 mb-1" data-email>{{ $account->department->name }}</div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <div class="d-flex flex-center flex-wrap">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-2 px-2">
                                <div class="fs-6 fw-bolder text-gray-700" data-document>{{ ($account->currency == 'PEN') ? 'Soles':'Dólares' }}</div>
                                <div class="fw-bold text-gray-500">Moneda</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-2 px-2">
                                <div class="fs-6 fw-bolder text-gray-700" data-phone>
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input" name="status" type="checkbox" value="{{ $account->status }}" {{ ($account->status == 1) ? 'checked':''  }} data-kt-action="{{ route('accounts.update.status') }}" data-kt-account-active="{{ $account->id }}" />
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <span class="form-check-label fw-bold text-muted" >Activo</span>
                                        <!--end::Label-->
                                    </label>
                                </div>
                                <div class="fw-bold text-gray-400">Estado</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-2 px-2">
                                <div class="fs-6 fw-bolder text-gray-700" data-phone>
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input" name="apply_interbank" type="checkbox" value="{{ $account->apply_interbank }}" {{ ($account->apply_interbank == 1) ? 'checked':''  }} data-kt-action="{{ route('accounts.update.apply.interbank') }}" data-kt-account-interbank="{{ $account->id }}" />
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <span class="form-check-label fw-bold text-muted" >Activo</span>
                                        <!--end::Label-->
                                    </label>
                                </div>
                                <div class="fw-bold text-gray-400">Interbancario</div>
                            </div>
                            <!--end::Stats-->

                        </div>
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-kt-account="{{ $account->id }}" data-kt-bank="{{ $account->bank->id }}" data-kt-nameBank="{{ $account->bank->nameBank }}" data-kt-department="{{ $account->department->id }}" data-kt-status="{{ $account->status }}" data-kt-numberAccount="{{ $account->numberAccount }}" data-kt-currency="{{ $account->currency }}" data-kt-numberInterbank="{{ $account->number_interbank }}" data-kt-balance="{{ $account->balance }}" data-kt-account-action="update_row">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="#" data-btn_delete data-kt-users-table-filter="delete_row" data-kt-numberAccount="{{ $account->numberAccount }}" data-kt-account="{{ $account->id }}" data-kt-customer-table-filter="delete_row" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
                        </div>
                        <!--end::Info-->
                    </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--end::Card-->
    <!--begin::Modals-->
    <!--begin::Modal - Customers - Add-->
    <div class="modal fade" id="kt_modal_add_customer" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_add_customer_form" enctype="multipart/form-data" data-kt-action="{{ route('accounts.store') }}" data-kt-redirect="{{ route('accounts.dolareros.index') }}">
                @csrf
                <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_customer_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Crear nueva cuenta</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Número de cuenta</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" class="form-control form-control-solid" placeholder="Número de cuenta" name="numberAccount" value="" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Seleccione un Banco</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="bank_id" id="bank_id_create" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Banco">
                                            <option></option>
                                            @foreach( $banks as $bank )
                                                <option value="{{ $bank->id }}" data-kt-select2-bank="{{ asset('assets/images/banks/'.$bank->imageBank) }}">{{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                            </div>
                            <!--begin::Input group-->

                            <div class="row">
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Seleccione un departamento</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="department_id" id="department_id_create" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Banco">
                                            <option></option>
                                            @foreach( $departments as $department )
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Seleccione una moneda</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="currency" id="currency_create" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Moneda">
                                            <option></option>
                                            <option value="PEN">Soles</option>
                                            <option value="USD">Dolares</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold mb-2">Número Interbancario</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" class="form-control form-control-solid" placeholder="Número Interbancario" name="number_interbank" value="" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold mb-2">Monto inicial</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" class="form-control form-control-solid" placeholder="Monto inicial" name="balance" value="" />
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
                        <button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3">Descartar</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="button" id="kt_modal_add_customer_submit" class="btn btn-primary">
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
    <!--begin::Modal - Customers - Edit-->
    <div class="modal fade" id="kt_modal_edit_customer" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_edit_customer_form" enctype="multipart/form-data" data-kt-action="{{ route('accounts.update') }}" data-kt-redirect="{{ route('accounts.dolareros.index') }}">
                @csrf
                <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_edit_customer_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Modificar banco</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_edit_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_edit_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_customer_header" data-kt-scroll-wrappers="#kt_modal_edit_customer_scroll" data-kt-scroll-offset="300px">
                            <input type="hidden" name="account_id">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Numero de cuenta</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="Número de cuenta" name="numberAccount" value="" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Seleccione un Banco</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="bank_id" id="bank_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Banco">
                                            @foreach( $banks as $bank )
                                                <option value="{{ $bank->id }}" data-kt-select2-bank="{{ asset('assets/images/banks/'.$bank->imageBank) }}">{{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Seleccione un departamento</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="department_id" id="department_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Departamento">
                                            @foreach( $departments as $department )
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Moneda de cuenta</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="currency" id="currency" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Moneda">
                                            <option value="PEN">Soles</option>
                                            <option value="USD">Dolares</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold mb-2">Número Interbancario</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" class="form-control form-control-solid" placeholder="Número Interbancario" name="number_interbank" value="" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold mb-2">Monto inicial</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" class="form-control form-control-solid" placeholder="Monto inicial" name="balance" value="" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                            </div>

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack">

                                    <!--begin::Label-->
                                    <div class="me-5">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold">La cuenta estará activa a los clientes?</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="fs-7 fw-bold text-muted">Si desactiva, desaparecerá del listado para los clientes</div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Switch-->
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input" name="statusAccount" type="checkbox" value="1" checked="checked" />
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <span class="form-check-label fw-bold text-muted">Activo</span>
                                        <!--end::Label-->
                                    </label>
                                    <!--end::Switch-->
                                </div>
                                <!--begin::Wrapper-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_edit_customer_cancel" class="btn btn-light me-3">Descartar</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="button" id="kt_modal_edit_customer_submit" class="btn btn-primary">
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
    <!--end::Modals-->

@endsection

@section('scripts')
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script>
        $(document).ready(function(){
            var optionFormat = function(item) {
                if ( !item.id ) {
                    return item.text;
                }

                var span = document.createElement('span');
                var imgUrl = item.element.getAttribute('data-kt-select2-bank');
                var template = '';

                template += '<img src="' + imgUrl + '" class="rounded-circle h-20px me-2" alt="image"/>';
                template += item.text;

                span.innerHTML = template;

                return $(span);
            };

            $("#bank_id_create").select2({
                templateSelection: optionFormat,
                templateResult: optionFormat,
                minimumResultsForSearch: Infinity,
                dropdownParent: $("#kt_modal_add_customer")
            });
            $("#department_id_create").select2({
                minimumResultsForSearch: Infinity,
                dropdownParent: $("#kt_modal_add_customer")
            });
            $("#currency_create").select2({
                minimumResultsForSearch: Infinity,
                dropdownParent: $("#kt_modal_add_customer")
            });
            $.fn.modal.Constructor.prototype.enforceFocus = function () {};

            $(document).on('click', '[data-btn_delete]', deleteAccountDolarero)
        });

        function deleteAccountDolarero() {
            var account_id = $(this).attr('data-kt-account');
            var account_number = $(this).attr('data-kt-numberAccount');
            Swal.fire({
                text: "¿Está seguro de eliminar la cuenta " + account_number + "?",
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
                        url: '/dashboard/account/destroy/'+account_id,
                        method: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: JSON.stringify({ account_id: account_id }),
                        processData:false,
                        contentType:'application/json; charset=utf-8',
                        success: function (data) {
                            console.log(data);
                            Swal.fire({
                                text: "Has eliminado " + account_number + "!.",
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
                    text: account_number + " no fue eliminado.",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, entendido!",
                    customClass: {confirmButton: "btn fw-bold btn-primary"}
                })
            }));
        }
    </script>
    <script src="{{ asset('assets/js/accountDolareros/list.js') }}"></script>
    <script src="{{ asset('assets/js/accountDolareros/add.js') }}"></script>
    <script src="{{ asset('assets/js/accountDolareros/edit.js') }}"></script>
@endsection
