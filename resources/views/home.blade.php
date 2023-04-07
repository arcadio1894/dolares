@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard Principal')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="../../demo7/dist/index.html" class="text-muted">Inicio</a>
        </li>
        <li class="breadcrumb-item text-dark">Dashboard</li>
    </ul>
@endsection

@section('styles')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            display: none;
        }
        .highSize {
            font-size: 1.55rem !important;
        }
    </style>
@endsection

@section('content')
{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>--}}
<div class="col-xl-6 mt-4 offset-3">
    <div class="card card-xl-stretch mb-xl-8" >
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Calculadora</span>
            </h3>
            <div class="card-toolbar">
                <ul class="nav nav-tabs nav-line-tabs nav-stretch border-transparent fs-5 fw-bolder">
                    <li class="nav-item">
                        <a class="nav-link text-active-primary active" data-kt-countup-tabs="true" data-bs-toggle="tab" id="btn_buy_tab_panel" data-tab="buy" href="#type_buy_tab_panel">COMPRA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary " data-kt-countup-tabs="true" data-bs-toggle="tab" id="btn_sell_tab_panel" data-tab="sell" href="#type_sell_tab_panel">VENTA</a>
                    </li>


                </ul>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body">
            <span class="text-muted fw-bold fs-5">Tipo de cambio hoy en Perú </span><br>
            <span class="text-muted fw-bold fs-5" id="text_buy">Compra: 0 </span> <span class="text-muted fw-bold fs-4"> | </span>
            <span class="text-muted fw-bold fs-5" id="text_sell">Venta: 0</span>
            <div class="tab-content mt-4">
                <!--begin::Tab panel-->
                <div class="tab-pane fade active show" id="type_buy_tab_panel" role="tabpanel">
                    <div class="col-md-12 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                            <span class="required">Envias</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Ingrese una cantidad válida"></i>
                        </label>
                        <!--end::Label-->

                        <div class="position-relative">
                            <!--begin::Input-->
                            <input type="number" class="form-control form-control-solid highSize" placeholder="" value="100.00" id="sendBuy" />
                            <!--end::Input-->
                            <!--begin::CVV icon-->
                            <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                                <span class="svg-icon svg-icon-2hx">
                                                            <img src="https://img.icons8.com/fluency/36/null/usa-circular.png"/>
                                                        </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::CVV icon-->
                        </div>
                        <!--end::Input wrapper-->
                    </div>
                    <div class="col-md-12 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                            <span class="required">Recibes</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Ingrese una cantidad válida"></i>
                        </label>
                        <!--end::Label-->

                        <div class="position-relative">
                            <!--begin::Input-->
                            <input type="number" class="form-control form-control-solid highSize" placeholder="" id="getBuy" />
                            <!--end::Input-->
                            <!--begin::CVV icon-->
                            <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                                <span class="svg-icon svg-icon-2hx">
                                                            <img src="https://img.icons8.com/fluency/36/null/peru-circular.png"/>
                                                        </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::CVV icon-->
                        </div>
                        <!--end::Input wrapper-->
                    </div>
                    <div class="fs-2 fw-bold text-muted text-center">
                        <span class="fs-4 fw-bolder text-primary" id="ahorroBuy"> </span>
                        <i class="fas fa-exclamation-circle text-primary ms-2 fs-7" data-bs-toggle="tooltip" title="Ahorro aprox. frente al tipo de cambio publicado en otras entidades bancarias"></i>

                    </div>
                    <div class="text-center py-5 py-lg-5">
                        <a href="{{ route('home') }}" class="btn btn-primary">Iniciar operación</a>
                    </div>
                </div>
                <!--end::Tab panel-->
                <!--begin::Tab panel-->
                <div class="tab-pane fade " id="type_sell_tab_panel" role="tabpanel">
                    <div class="col-md-12 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                            <span class="required">Envias</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Ingrese una cantidad válida"></i>
                        </label>
                        <!--end::Label-->

                        <div class="position-relative">
                            <!--begin::Input-->
                            <input type="number" class="form-control form-control-solid highSize" placeholder="" value="100.00" id="sendSell" />
                            <!--end::Input-->
                            <!--begin::CVV icon-->
                            <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                                <span class="svg-icon svg-icon-2hx">
                                                            <img src="https://img.icons8.com/fluency/36/null/peru-circular.png"/>
                                                        </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::CVV icon-->
                        </div>
                        <!--end::Input wrapper-->
                    </div>
                    <div class="col-md-12 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                            <span class="required">Recibes</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Ingrese una cantidad válida"></i>
                        </label>
                        <!--end::Label-->

                        <div class="position-relative">
                            <!--begin::Input-->
                            <input type="number" class="form-control form-control-solid highSize" placeholder="" id="getSell" />
                            <!--end::Input-->
                            <!--begin::CVV icon-->
                            <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                                <span class="svg-icon svg-icon-2hx">
                                                            <img src="https://img.icons8.com/fluency/36/null/usa-circular.png"/>
                                                        </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::CVV icon-->
                        </div>
                    </div>
                    <div class="fs-2 fw-bold text-muted text-center">
                        <span class="fs-4 fw-bolder text-primary" id="ahorroSell">Estás ahorrando aprox. USD </span>
                        <i class="fas fa-exclamation-circle text-primary ms-2 fs-7" data-bs-toggle="tooltip" title="Ahorro aprox. frente al tipo de cambio publicado en otras entidades bancarias"></i>

                    </div>
                    <div class="text-center py-5 py-lg-5">
                        <a href="{{ route('home') }}" class="btn btn-primary">Iniciar operación</a>
                    </div>

                </div>
                <!--end::Tab panel-->
            </div>
        </div>
        <!--end::Body-->

    </div>


    <!--end::Action-->
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/home/home.js') }}"></script>
@endsection
