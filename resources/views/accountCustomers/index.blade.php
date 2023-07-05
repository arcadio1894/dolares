@extends('layouts.admin')

@section('title', 'Cuentas Bancarias')

@section('page-title', 'Cuentas Bancarias')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1 float-left">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-dark">Listado de cuentas</li>
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
                    <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Buscar cuentas" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Agregar Cuenta</button>

                </div>

            </div>
        </div>
        <div class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Banco</th>
                    <th class="min-w-125px">Nombre</th>
                    <th class="min-w-125px">Cuenta</th>
                    <th class="min-w-125px">Departamento</th>
                    <th class="min-w-125px">Moneda</th>
                    <th class="min-w-125px">Tipo</th>
                    <th class="min-w-125px">Estado</th>
                    <th class="text-end min-w-70px">Acciones</th>
                </tr>
                </thead>
                <tbody class="fw-bold text-gray-600">
                @foreach( $accounts as $account )
                    <tr>
                        <td>
                            <img src="{{ asset('assets/images/banks/'.$account->bank->imageBank) }}" alt="{{ $account->bank->name }}" class="img-fluid" style="max-width: 30px;"> {{ $account->bank->name }}

                        </td>
                        <td>
                            {{ $account->nameAccount }}
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
                        <td>
                            {{ ($account->type_account == 'a') ? 'Ahorros':'Corriente' }}
                        </td>
                        <td>
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input" name="status" type="checkbox" value="{{ $account->status }}" {{ ($account->status == 1) ? 'checked':''  }} data-kt-action="{{ route('accounts.customer.update.status') }}" data-kt-account-active="{{ $account->id }}" />
                                <!--end::Input-->
                                <!--begin::Label-->
                                <span class="form-check-label fw-bold text-muted" >Activo</span>
                                <!--end::Label-->
                            </label>
                        </td>
                        <td>
                            <div class="d-sm-flex justify-content-end">
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                   data-kt-account="{{ $account->id }}" data-kt-bank="{{ $account->bank->id }}" data-kt-department="{{ $account->department->id }}" data-kt-nameBank="{{ $account->bank->name }}" data-kt-status="{{ $account->status }}" data-kt-numberAccount="{{ $account->numberAccount }}" data-kt-currency="{{ $account->currency }}" data-kt-nameAccount="{{ $account->nameAccount }}" data-kt-type-account="{{ $account->type_account }}" data-kt-property="{{ $account->property }}" data-kt-account-action="update_row">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                   data-kt-account="{{ $account->id }}" data-kt-customer-table-filter="delete_row">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <div class="d-sm-none">
        <div class="d-flex justify-content-center mb-5" data-kt-customer-table-toolbar="base">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Agregar Cuenta</button>
        </div>

        @foreach( $accounts as $account )
            <div class="card mb-4">
                <div class="card-body p-5">
                    <div class="d-flex">
                        <div class="col-sm-3 ">
                            <img src="{{ asset('assets/images/banks/'.$account->bank->imageBank) }}" alt="{{ $account->bank->name }}" class="img-fluid" style="max-width: 40px;">

                        </div>
                        <div class="col-sm-7 mx-3">
                            <p class="mb-1">{{ $account->nameAccount }}</p>
                            <p class="mb-1">{{ $account->bank->name }}</p>
                        </div>

                        <button class="p-0 btn btn-lg btn-flex btn-link btn-color-gray-800 ms-auto" data-kt-account="{{ $account->id }}" data-kt-bank="{{ $account->bank->id }}" data-kt-department="{{ $account->department->id }}" data-kt-nameBank="{{ $account->bank->name }}" data-kt-status="{{ $account->status }}" data-kt-numberAccount="{{ $account->numberAccount }}" data-kt-currency="{{ $account->currency }}" data-kt-nameAccount="{{ $account->nameAccount }}" data-kt-type-account="{{ $account->type_account }}" data-kt-property="{{ $account->property }}" data-kt-account-action="update_row"><i class="p-2 far fa-edit"></i></button>

                    </div>
                    <hr>
                    <div style="display: flex; justify-content: space-between;">
                        <div class="col-sm-7 mx-3">
                            <p class="mb-1">{{ ($account->currency == 'PEN') ? 'Soles':'Dólares' }} - {{ ($account->type_account == 'a') ? 'Ahorros':'Corriente' }}</p>
                            <p class="mb-1">{{ $account->numberAccount }}</p>
                        </div>

                        <button class="p-0 btn btn-lg btn-flex btn-link btn-color-gray-800 ms-auto" data-kt-account="{{ $account->id }}" data-kt-numberAccount="{{ $account->numberAccount }}" data-kt-account-action="delete_row"><i class="p-2 far fa-trash-alt fa-lg"></i></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal fade" id="kt_modal_add_customer" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_add_customer_form" enctype="multipart/form-data" data-kt-action="{{ route('accounts.customer.store') }}" data-kt-redirect="{{ route('accountCustomer.index') }}">
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
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Nombre de cuenta</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="Nombre de cuenta" name="nameAccount" value="" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Tipo de cuenta</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="type_account" id="type_account_create" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Tipo de cuenta">
                                            <option></option>
                                            <option value="a">Ahorros</option>
                                            <option value="c">Corriente</option>
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
                                        <label class="required fs-6 fw-bold mb-2">Número de cuenta</label>
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
                                        <select name="bank_id" id="bank_id_create" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Banco" >
                                            <option></option>
                                            @foreach( $banks as $bank )
                                                <option value="{{ $bank->id }}" data-kt-select2-bank="{{ asset('assets/images/banks/'.$bank->imageBank) }}">
                                                    {{ $bank->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Moneda de cuenta</label>
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
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Seleccione un departamento</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="department_id" id="department_id_create" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Departamento" >
                                            <option></option>
                                            @foreach( $departments as $department )
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack">

                                        <!--begin::Label-->
                                        <div class="me-5">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold">Declaro que esta cuenta es mía</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div class="fs-7 fw-bold text-muted">Si desactiva, indica que la cuenta no es propia</div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Switch-->
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input" name="property" type="checkbox" value="1" checked="checked" />
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <span class="form-check-label fw-bold text-muted"></span>
                                            <!--end::Label-->
                                        </label>
                                        <!--end::Switch-->
                                    </div>
                                    <!--begin::Wrapper-->
                                </div>
                                <!--end::Input group-->
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

    <div class="modal fade" id="kt_modal_edit_customer" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_edit_customer_form" enctype="multipart/form-data" data-kt-action="{{ route('accounts.customer.update') }}" data-kt-redirect="{{ route('accountCustomer.index') }}">
                @csrf
                <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_edit_customer_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Modificar Cuenta Bancaria</h2>
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
                    <div class="modal-body py-3 px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_edit_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_customer_header" data-kt-scroll-wrappers="#kt_modal_edit_customer_scroll" data-kt-scroll-offset="300px">
                            <input type="hidden" name="account_id">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Nombre de cuenta</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="Nombre de cuenta" name="nameAccount" value="" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Tipo de cuenta</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="type_account" id="type_account_update" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Tipo de cuenta">
                                            <option></option>
                                            <option value="a">Ahorros</option>
                                            <option value="c">Corriente</option>
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
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Seleccione un Departamento</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="department_id" id="department_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Departamento">
                                            @foreach( $departments as $department )
                                                <option value="{{ $department->id }}" >{{ $department->name }}</option>
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
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack">

                                            <!--begin::Label-->
                                            <div class="me-5">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold">Declaro que la cuenta es mía</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div class="fs-7 fw-bold text-muted">Si desactiva, indica que la cuenta no es propia</div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input" name="property" type="checkbox" value="1" checked="checked" />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <span class="form-check-label fw-bold text-muted"></span>
                                                <!--end::Label-->
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                        <!--begin::Wrapper-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-6">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack">

                                            <!--begin::Label-->
                                            <div class="me-5">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold">La cuenta estará activa?</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div class="fs-7 fw-bold text-muted">Si desactiva, desaparecerá del listado de sus cuentas</div>
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
                            </div>


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

            $("#type_account_create").select2({
                minimumResultsForSearch: Infinity,
                dropdownParent: $("#kt_modal_add_customer")
            });
            //$.fn.modal.Constructor.prototype.enforceFocus = function () {};
        });
    </script>
    <script src="{{ asset('assets/js/accountCustomers/list.js') }}"></script>
    <script src="{{ asset('assets/js/accountCustomers/add.js') }}"></script>
    <script src="{{ asset('assets/js/accountCustomers/edit.js') }}"></script>
    <script src="{{ asset('assets/js/accountCustomers/delete.js') }}"></script>
@endsection
