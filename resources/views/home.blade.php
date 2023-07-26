@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard Principal')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Inicio</a>
        </li>
        <li class="breadcrumb-item text-dark">Dashboard</li>
    </ul>
@endsection

@section('activeTabPanelMenu', 'active')
@section('activeTabHome', 'active show')
@section('activeHome', 'text-primary')

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
@if ($respError != "" || $respError != null)
    <div class="alert alert-danger" role="alert">
        Ocurrió un error al obtener las útimas divisas. <a class="fw-bolder" href="#" id="btn-reload">Recargar página</a>
    </div>
@endif
<input type="hidden" id="tipoCambioCompra" value="{{ $stopData->buyStop }}">
<input type="hidden" id="tipoCambioVenta" value="{{ $stopData->sellStop }}">
<input type="hidden" id="tipoCambioCompraControl" value="{{ $stopData->buyControl }}">
<input type="hidden" id="tipoCambioVentaControl" value="{{ $stopData->sellControl }}">
<input type="hidden" id="token" value="{{ $stopData->token }}">

<div class="mt-4 col-xxl-4 offset-xxl-4 col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-6 offset-sm-3 ">
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
        <div class="card-body text-center">
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
                    <div class="fs-2 fw-bold text-muted align-left" id="div-couponBuy" style="display: none">
                        <span class="fs-5 fw-bolder text-muted" >Nuevo tipo de cambio: </span>
                        <span class="fs-5 fw-bolder text-danger tachado" id="cuponBuyOld">4.00</span>
                        <span class="fs-5 fw-bolder text-primary" id="cuponBuyNew">5.00</span>
                    </div>
                    <div class="text-center py-5 py-lg-5">
                        <button data-generate data-url="{{ route('operation.generate') }}" class="btn btn-primary">Iniciar operación</button>
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
                    <div class="fs-2 fw-bold text-muted align-left" id="div-couponSell" style="display: none">
                        <span class="fs-5 fw-bolder text-muted" >Nuevo tipo de cambio: </span>
                        <span class="fs-5 fw-bolder text-danger tachado" id="cuponSellOld">4.00</span>
                        <span class="fs-5 fw-bolder text-primary" id="cuponSellNew">5.00</span>
                    </div>
                    <div class="text-center py-5 py-lg-5">
                        <button data-generate data-url="{{ route('operation.generate') }}" class="btn btn-primary">Iniciar operación</button>
                    </div>

                </div>
                <!--end::Tab panel-->
            </div>
            <div class="position-relative d-flex align-items-center">
                <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                    <!--begin::Icon-->
                    <div class="position-absolute translate-middle-y top-50 end-3 me-3">
                        <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                        <span class="svg-icon svg-icon-2hx text-primary">
                            <img width="30px" src="{{ asset('assets/media/icons/duotune/finance/coupon.svg') }}"/>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Icon-->
                    <!--begin::Datepicker-->
                    <input class="form-control form-control-solid ps-12" placeholder="Ingrese cupón" name="coupon" id="coupon" />
                    <!--end::Datepicker-->
                    <button class="btn btn-primary" data-url="{{ route('apply.coupon') }}" id="btn-coupon">Aplicar</button>

                </div>
            </div>
        </div>
        <!--end::Body-->

    </div>

    <div class="card card-xl-stretch mb-xl-8 mt-3" >
        <!--begin::Body-->
        <div class="card-body text-center">
            <h3>Horario de Atención</h3>
            @foreach( $schedules as $schedule )
            <h4>{{$schedule->nameDay}}: {{date('g:i a', strtotime($schedule->hourStart))}} - {{date('g:i a', strtotime($schedule->hourEnd))}}</h4>
            @endforeach
        </div>
        <!--end::Body-->

    </div>
    <!--end::Action-->
</div>

<div class="modal fade" id="kt_modal_alert" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body py-10 px-lg-17">
                <!--begin::Scroll-->
                <div class=" me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                    <div class="row pb-1 text-center px-4">
                        <h4> <strong id="first_text"> Hola Remso Rojas, estas a un solo paso de poder cambiar dolares de la manera más rápida y segura. </strong></h4>
                        <h5 class="text-muted"> Ingresa a tu PERFIL para que puedas completar el registro de tus documentos.</h5>
                        <img class="img-fluid" src="{{ (\Illuminate\Support\Facades\Auth::user()->account_type == 'b') ? asset('assets/media/document/ruc.png'):asset('assets/media/document/alert.png') }}" alt="">
                        <h5 class="text-muted"> Este proceso es muy rápido y ayudará a mantener tu cuenta más segura.</h5>
                    </div>
                </div>
                <!--end::Scroll-->
            </div>
            <div class="modal-footer flex-center">
                <!--begin::Button-->
                <button type="button" id="kt_modal_alert_cancel" class="btn btn-light me-3">Continuar</button>
                <!--end::Button-->
                <!--begin::Button-->
                <button type="button" id="kt_modal_alert_next" class="btn btn-primary" data-url="">
                    <span class="indicator-label">Completar mi perfil</span>
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
    <script src="{{ asset('assets/js/user/alert.js') }}"></script>
    <script src="{{ asset('assets/js/home/home.js') }}"></script>
@endsection
