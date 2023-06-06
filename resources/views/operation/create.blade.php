@extends('layouts.admin')

@section('title', 'Operación')

@section('page-title', 'Crear Operación')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-dark">Proceso de la operación</li>
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
        .stepper-item {
            margin: 0.5rem 1rem !important;
        }
        .modal-header {
            padding: 1rem 1.75rem;
        }
        .ml-5 {
            margin-left: 10px;
        }
    </style>
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Stepper-->
            @if ( $stopOperation != null )
                <div class="stepper stepper-links d-flex flex-column " id="kt_create_account_stepper">
                    <!--begin::Nav-->
                    <div class="stepper-nav mb-0">
                        <!--begin::Step 1-->
                        <div class="stepper-item current" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Completa</h3>
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Step 2-->
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Transfiere</h3>
                        </div>
                        <!--end::Step 2-->
                        {{--<!--begin::Step 3-->
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Business Info</h3>
                        </div>
                        <!--end::Step 3-->
                        <!--begin::Step 4-->
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Billing Details</h3>
                        </div>
                        <!--end::Step 4-->--}}
                        <!--begin::Step 5-->
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Constancia</h3>
                        </div>
                        <!--end::Step 5-->
                    </div>
                    <!--end::Nav-->
                    <!--begin::Form-->
                    <form class="mx-auto mw-600px w-100 pt-5 pb-10" novalidate="novalidate" id="kt_create_account_form">
                        <!--begin::Step 1-->
                        <div class="current"  data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-10 pb-lg-5 text-center">
                                    <!--begin::Title-->
                                    <h2 class="fw-bolder text-center align-items-center text-dark">Completa los datos de tu operación
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Billing is issued based on your selected account type"></i>
                                    </h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                        <a href="#" class="link-primary fw-bolder">Help Page</a>.
                                    </div>
                                    <!--end::Notice-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="fv-row">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-8 offset-lg-2">
                                            <div class="bg-light-primary rounded border-primary border border-dashed p-6">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="text-gray-700 text-start">Tu envias</h5> <h4 class="text-gray-900 fw-bolder text-end"> {{ ($stopOperation->type == 'buy') ? 'USD ':'PEN ' }}{{ number_format(round($stopOperation->sendAmount, 2), 2) }} </h4>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="text-gray-700 text-start">Tu recibes</h5> <h4 class="text-gray-900 fw-bolder text-end"> {{ ($stopOperation->type == 'buy') ? 'PEN ':'USD ' }} {{ number_format(round($stopOperation->getAmount, 2), 2) }} </h4>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="text-gray-700 text-start">Cupón aplicado</h5> <h4 class="text-gray-900 fw-bolder text-end"> {{ ( $stopOperation->coupon_id == null ) ? '--': $stopOperation->coupon->name }} </h4>
                                                </div>
                                                <hr>
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="text-gray-900 ">Tipo de cambio utilizado </h5>
                                                    <span class="fs-5 fw-bolder text-danger tachado" id="withoutCoupon" style="{{ ($stopOperation->coupon_id == null) ? 'display:none':'' }}" >{{ ($stopOperation->type == 'buy') ? number_format(round($stopOperation->buyStop, 3), 3):number_format(round($stopOperation->sellStop, 3), 3) }}</span>
                                                    <span class="fs-5 fw-bolder text-primary" id="withCoupon">{{ ($stopOperation->coupon_id == null) ? ( ($stopOperation->type == 'buy') ? $stopOperation->buyStop:$stopOperation->sellStop ):(($stopOperation->type == 'buy') ? number_format(round(($stopOperation->buyStop+$stopOperation->coupon->amountBuy), 3), 3):number_format(round(($stopOperation->sellStop-$stopOperation->coupon->amountSell), 3), 3)) }}</span>
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <br>
                                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-3">
                                                <!--begin::Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                                <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
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
                                                        <h6 class="text-gray-900 fw-bolder">Recuerda!</h6>
                                                        <div class="fs-7 text-gray-600">
                                                            Tiempo estimado de espera BCP, Interbank y Banbif: 15 min <br>
                                                            (Aplica para cualquier monto). Otros bancos 1 día útil.
                                                        </div>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <br>
                                            <h5>¿Desde que banco nos envías tu dinero?</h5>
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Input-->
                                                <select name="bank_id" id="bank_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Banco" >
                                                    <option></option>
                                                    @foreach( $accountsDolareros as $bank )
                                                        <option value="{{ $bank['name'] }}" data-kt-select2-bank="{{ asset('assets/images/banks/'.$bank['imageBank']) }}" {{ ($bank['name'] == $stopOperation->nameBankDolarero) ? 'selected':'' }}>
                                                            {{ $bank['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>

                                            <h5>¿En qué cuenta deseas recibir tu dinero?</h5>
                                            <!--begin::Input group-->

                                            <div class="fv-row mb-7">
                                                <!--begin::Input-->
                                                <select name="account_id" id="account_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Cuentas bancarias" >
                                                    <option></option>
                                                    <option value="0" data-kt-select2-bank="{{ asset('assets/media/icons/duotune/general/gen035.svg') }}">
                                                        Crear Nueva cuenta
                                                    </option>
                                                    @foreach( $arrayAccountCustomers as $account )
                                                        <option value="{{ $account['id'] }}" data-kt-select2-bank="{{ asset('assets/images/banks/'.$account['bankImage']) }}" {{ ($account['id'] == $stopOperation->account_customer_id ) ? 'selected':'' }}>
                                                            {{ $account['nameAccount'] . ' - ' . $account['numberAccount'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>

                                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-3">
                                                <!--begin::Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                                <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
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
                                                        <h6 class="text-gray-900 fw-bolder">Recuerda!</h6>
                                                        <div class="fs-7 text-gray-600">
                                                            La cuenta de destino debe estar a tu nombre. DOLAREROS no transfiere a cuentas de terceros.
                                                        </div>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <br>
                                            <h5>Origen de fondos</h5>
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Input-->
                                                <select name="source_id" id="source_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Origen de fondos" >
                                                    <option></option>
                                                    @foreach( $sources as $source )
                                                        <option value="{{ $source->id }}" {{ ($source->id == $stopOperation->source_fund_id ) ? 'selected':'' }}>
                                                            {{ $source->description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Step 2-->
                        <div data-kt-stepper-element="content">
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-5 pb-lg-5 text-center">
                                    <!--begin::Title-->
                                    <h2 class="fw-bolder text-dark">Transfiere a Dolareros</h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                        <a href="#" class="link-primary fw-bolder">Help Page</a>.</div>
                                    <!--end::Notice-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="mb-0 fv-row">
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-8 offset-lg-2">
                                            <p class="text-muted text-gray-800 fw-bold fs-6">1. Transfiere <strong class="link-primary fw-bolder" id="amountSendOperation"> 00.00 moneda</strong> desde tu banco <strong class="link-primary fw-bolder" id="nameBankOperation">  </strong> a nuestra cuenta. </p>
                                            <p class="text-muted text-gray-800 fw-bold fs-6">2. Guarda el
                                                <strong class="link-primary fw-bolder" >
                                                    <a href="#" id="showModalNumberOperation">número de tu operación</a>
                                                </strong> para el segundo paso.
                                            </p>
                                            <div class="col-sm-8 offset-sm-2 col-8 offset-2 bg-light-primary rounded border-primary border border-dashed p-6">
                                                <strong class="text-gray-900 ">Banco</strong>
                                                <p class="text-gray-900 mb-1 ml-5" id="nameBankOperationDeposit">BCP</p>
                                                <strong class="text-gray-900 ">Número de cuenta</strong>
                                                <p class="text-gray-900 mb-1 ml-5" id="nameAccountOperationDeposit">1111 1111 1111 1111</p>
                                                <strong class="text-gray-900 ">RUC</strong>
                                                <p class="text-gray-900 mb-1 ml-5" id="rucOperationDeposit">123456789123</p>
                                                <strong class="text-gray-900 ">Titular de la cuenta</strong>
                                                <p class="text-gray-900 mb-1 ml-5" id="ownerAccountOperationDeposit">Dolareros SAC</p>
                                                <strong class="text-gray-900 ">Tipo de la cuenta</strong>
                                                <p class="text-gray-900 mb-1 ml-5" id="typeAccountOperationDeposit">Cuenta Corriente - Soles</p>
                                            </div>
                                            <br>
                                            <p class="text-muted text-gray-800 fw-bold fs-6">* Recuerda que Dolareros NO realiza ningún débito automático de tus cuentas. </p>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Step 2-->
                        {{--<!--begin::Step 3-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-10 pb-lg-12">
                                    <!--begin::Title-->
                                    <h2 class="fw-bolder text-dark">Business Details</h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                        <a href="#" class="link-primary fw-bolder">Help Page</a>.</div>
                                    <!--end::Notice-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label required">Business Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input name="business_name" class="form-control form-control-lg form-control-solid" value="Keenthemes Inc." />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center form-label">
                                        <span class="required">Shortened Descriptor</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="&lt;div class='p-4 rounded bg-light'&gt; &lt;div class='d-flex flex-stack text-muted mb-4'&gt; &lt;i class='fas fa-university fs-3 me-3'&gt;&lt;/i&gt; &lt;div class='fw-bold'&gt;INCBANK **** 1245 STATEMENT&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack fw-bold text-gray-600'&gt; &lt;div&gt;Amount&lt;/div&gt; &lt;div&gt;Transaction&lt;/div&gt; &lt;/div&gt; &lt;div class='separator separator-dashed my-2'&gt;&lt;/div&gt; &lt;div class='d-flex flex-stack text-dark fw-bolder mb-2'&gt; &lt;div&gt;USD345.00&lt;/div&gt; &lt;div&gt;KEENTHEMES*&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack text-muted mb-2'&gt; &lt;div&gt;USD75.00&lt;/div&gt; &lt;div&gt;Hosting fee&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack text-muted'&gt; &lt;div&gt;USD3,950.00&lt;/div&gt; &lt;div&gt;Payrol&lt;/div&gt; &lt;/div&gt; &lt;/div&gt;"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input name="business_descriptor" class="form-control form-control-lg form-control-solid" value="KEENTHEMES" />
                                    <!--end::Input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">Customers will see this shortened version of your statement descriptor</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label required">Corporation Type</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select name="business_type" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Select..." data-allow-clear="true" data-hide-search="true">
                                        <option></option>
                                        <option value="1">S Corporation</option>
                                        <option value="1">C Corporation</option>
                                        <option value="2">Sole Proprietorship</option>
                                        <option value="3">Non-profit</option>
                                        <option value="4">Limited Liability</option>
                                        <option value="5">General Partnership</option>
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--end::Label-->
                                    <label class="form-label">Business Description</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea name="business_description" class="form-control form-control-lg form-control-solid" rows="3"></textarea>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-0">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label required">Contact Email</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input name="business_email" class="form-control form-control-lg form-control-solid" value="corp@support.com" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 3-->
                        <!--begin::Step 4-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-10 pb-lg-15">
                                    <!--begin::Title-->
                                    <h2 class="fw-bolder text-dark">Billing Details</h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                        <a href="#" class="text-primary fw-bolder">Help Page</a>.</div>
                                    <!--end::Notice-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">Name On Card</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a card holder's name"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="card_name" value="Max Doe" />
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold form-label mb-2">Card Number</label>
                                    <!--end::Label-->
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative">
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="Enter card number" name="card_number" value="4111 1111 1111 1111" />
                                        <!--end::Input-->
                                        <!--begin::Card logos-->
                                        <div class="position-absolute translate-middle-y top-50 end-0 me-5">
                                            <img src="assets/media/svg/card-logos/visa.svg" alt="" class="h-25px" />
                                            <img src="assets/media/svg/card-logos/mastercard.svg" alt="" class="h-25px" />
                                            <img src="assets/media/svg/card-logos/american-express.svg" alt="" class="h-25px" />
                                        </div>
                                        <!--end::Card logos-->
                                    </div>
                                    <!--end::Input wrapper-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-10">
                                    <!--begin::Col-->
                                    <div class="col-md-8 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold form-label mb-2">Expiration Date</label>
                                        <!--end::Label-->
                                        <!--begin::Row-->
                                        <div class="row fv-row">
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <select name="card_expiry_month" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Month">
                                                    <option></option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <select name="card_expiry_year" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Year">
                                                    <option></option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2030">2030</option>
                                                    <option value="2031">2031</option>
                                                </select>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span class="required">CVV</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter a card CVV code"></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input wrapper-->
                                        <div class="position-relative">
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" minlength="3" maxlength="4" placeholder="CVV" name="card_cvv" />
                                            <!--end::Input-->
                                            <!--begin::CVV icon-->
                                            <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                                                <span class="svg-icon svg-icon-2hx">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M22 7H2V11H22V7Z" fill="black" />
                                                                                <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::CVV icon-->
                                        </div>
                                        <!--end::Input wrapper-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Label-->
                                    <div class="me-5">
                                        <label class="fs-6 fw-bold form-label">Save Card for further billing?</label>
                                        <div class="fs-7 fw-bold text-muted">If you need more info, please check budget planning</div>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Switch-->
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" checked="checked" />
                                        <span class="form-check-label fw-bold text-muted">Save Card</span>
                                    </label>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 4-->--}}
                        <!--begin::Step 5-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-8 pb-lg-10 text-center">
                                    <!--begin::Title-->
                                    <h2 class="fw-bolder text-dark">Envía tu constancia</h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-bold fs-6">If you need more info, please
                                        <a href="#" class="link-primary fw-bolder">Sign In</a>.</div>
                                    <!--end::Notice-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Body-->
                                <div class="mb-0">
                                    <!--begin::Text-->
                                    <div class="fs-6 text-gray-800 mb-5" >Escribe el número de operación de la transferencia</div>
                                    <!--end::Text-->
                                    <!--begin::Alert-->
                                    <!--begin::Notice-->
                                    <div class="fv-row mb-7">
                                        <input type="number" pattern="[\d]*" autocomplete="off" class="form-control form-control-lg form-control-solid bg-light-primary rounded border-primary border border-dashed text-center" name="number_operation" id="number_operation" placeholder="" value="" />
                                    </div>
                                    <div class="fs-6 text-gray-800 mt-3 mb-3 text-center">¿Dónde encuentro el <a href="#" id="showModalNumberOperation2" class="link-primary fw-bolder">número de operación</a>?</div>
                                    <div class="fs-6 text-gray-800 mb-3 text-center">¿Aún no haces la transferencia?</div>
                                    <div class="fs-6 text-gray-800 mt-10 text-center">Verificaremos tu operación para transferir <strong id="amountSendOperationConstancia">{{ ($stopOperation->type == 'buy') ? 'PEN ':'USD ' }} {{ number_format($stopOperation->getAmount, 2, '.', '') }} </strong> a tu cuenta.</div>

                                    <!--end::Notice-->
                                    <!--end::Alert-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 5-->
                        <!--begin::Actions-->
                        <div class="d-flex flex-stack pt-15">
                            <!--begin::Wrapper-->
                            <div class="mr-2">
                                <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black" />
                                            <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->Regresar
                                </button>
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Wrapper-->
                            <div>
                                <button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit">
                                    <span class="indicator-label">Enviar constancia
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <span class="svg-icon svg-icon-3 ms-2 me-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="indicator-progress">Espere por favor...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                                <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continuar
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                    <span class="svg-icon svg-icon-4 ms-1 me-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                            <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
            @else
                <div class="stepper stepper-links d-flex flex-column " id="kt_create_account_stepper">
                    <!--begin::Nav-->
                    <div class="stepper-nav mb-0">
                        <!--begin::Step 1-->
                        <div class="stepper-item current" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Completa</h3>
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Step 2-->
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Transfiere</h3>
                        </div>
                        <!--end::Step 2-->
                    {{--<!--begin::Step 3-->
                    <div class="stepper-item" data-kt-stepper-element="nav">
                        <h3 class="stepper-title">Business Info</h3>
                    </div>
                    <!--end::Step 3-->
                    <!--begin::Step 4-->
                    <div class="stepper-item" data-kt-stepper-element="nav">
                        <h3 class="stepper-title">Billing Details</h3>
                    </div>
                    <!--end::Step 4-->--}}
                    <!--begin::Step 5-->
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Constancia</h3>
                        </div>
                        <!--end::Step 5-->
                    </div>
                    <!--end::Nav-->
                    <!--begin::Form-->
                    <form class="mx-auto mw-600px w-100 pt-5 pb-10" novalidate="novalidate" id="kt_create_account_form">
                        <!--begin::Step 1-->
                        <div class="current" data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-10 pb-lg-5 text-center">
                                    <!--begin::Title-->
                                    <h2 class="fw-bolder text-center align-items-center text-dark">Completa los datos de tu operación
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Billing is issued based on your selected account type"></i>
                                    </h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                        <a href="#" class="link-primary fw-bolder">Help Page</a>.
                                    </div>
                                    <!--end::Notice-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-8 offset-lg-2">
                                            <div class="bg-light-primary rounded border-primary border border-dashed p-6">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="text-gray-700 text-start">Tu envias</h5> <h4 class="text-gray-900 fw-bolder text-end"> {{ ($stopData->type == 'buy') ? 'USD ':'PEN ' }}{{ number_format(round($stopData->sendAmount, 2), 2) }} </h4>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="text-gray-700 text-start">Tu recibes</h5> <h4 class="text-gray-900 fw-bolder text-end"> {{ ($stopData->type == 'buy') ? 'PEN ':'USD ' }} {{ number_format(round($stopData->getAmount, 2), 2) }} </h4>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="text-gray-700 text-start">Cupón aplicado</h5> <h4 class="text-gray-900 fw-bolder text-end"> {{ ( $stopData->coupon_id == null ) ? '--': $stopData->coupon->name }} </h4>
                                                </div>
                                                <hr>
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="text-gray-900 ">Tipo de cambio utilizado </h5>
                                                    <span class="fs-5 fw-bolder text-danger tachado" id="withoutCoupon" style="{{ ($stopData->coupon_id == null) ? 'display:none':'' }}" >{{ ($stopData->type == 'buy') ? number_format(round($stopData->buyStop, 3), 3):number_format(round($stopData->sellStop, 3), 3) }}</span>
                                                    <span class="fs-5 fw-bolder text-primary" id="withCoupon">{{ ($stopData->coupon_id == null) ? ( ($stopData->type == 'buy') ? $stopData->buyStop:$stopData->sellStop ):(($stopData->type == 'buy') ? number_format(round(($stopData->buyStop+$stopData->coupon->amountBuy), 3), 3):number_format(round(($stopData->sellStop-$stopData->coupon->amountSell), 3), 3)) }}</span>
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <br>
                                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-3">
                                                <!--begin::Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                                <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
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
                                                        <h6 class="text-gray-900 fw-bolder">Recuerda!</h6>
                                                        <div class="fs-7 text-gray-600">
                                                            Tiempo estimado de espera BCP, Interbank y Banbif: 15 min <br>
                                                            (Aplica para cualquier monto). Otros bancos 1 día útil.
                                                        </div>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <br>
                                            <h5>¿Desde que banco nos envías tu dinero?</h5>
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Input-->
                                                <select name="bank_id" id="bank_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Banco" >
                                                    <option></option>
                                                    @foreach( $accountsDolareros as $bank )
                                                        <option value="{{ $bank['name'] }}" data-kt-select2-bank="{{ asset('assets/images/banks/'.$bank['imageBank']) }}">
                                                            {{ $bank['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>

                                            <h5>¿En qué cuenta deseas recibir tu dinero?</h5>
                                            <!--begin::Input group-->

                                            <div class="fv-row mb-7">
                                                <!--begin::Input-->
                                                <select name="account_id" id="account_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Cuentas bancarias" >
                                                    <option></option>
                                                    <option value="0" data-kt-select2-bank="{{ asset('assets/media/icons/duotune/general/gen035.svg') }}">
                                                        Crear Nueva cuenta
                                                    </option>
                                                    @foreach( $arrayAccountCustomers as $account )
                                                        <option value="{{ $account['id'] }}" data-kt-select2-bank="{{ asset('assets/images/banks/'.$account['bankImage']) }}">
                                                            {{ $account['nameAccount'] . ' - ' . $account['numberAccount'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>

                                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-3">
                                                <!--begin::Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                                <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
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
                                                        <h6 class="text-gray-900 fw-bolder">Recuerda!</h6>
                                                        <div class="fs-7 text-gray-600">
                                                            La cuenta de destino debe estar a tu nombre. DOLAREROS no transfiere a cuentas de terceros.
                                                        </div>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <br>
                                            <h5>Origen de fondos</h5>
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Input-->
                                                <select name="source_id" id="source_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Origen de fondos" >
                                                    <option></option>
                                                    @foreach( $sources as $source )
                                                        <option value="{{ $source->id }}" >
                                                            {{ $source->description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Step 2-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-5 pb-lg-5 text-center">
                                    <!--begin::Title-->
                                    <h2 class="fw-bolder text-dark">Transfiere a Dolareros</h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                        <a href="#" class="link-primary fw-bolder">Help Page</a>.</div>
                                    <!--end::Notice-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-8 offset-lg-2">
                                            <p class="text-muted text-gray-800 fw-bold fs-6">1. Transfiere <strong class="link-primary fw-bolder" id="amountSendOperation"> 00.00 moneda</strong> desde tu banco <strong class="link-primary fw-bolder" id="nameBankOperation">  </strong> a nuestra cuenta. </p>
                                            <p class="text-muted text-gray-800 fw-bold fs-6">2. Guarda el
                                                <strong class="link-primary fw-bolder" >
                                                    <a href="#" id="showModalNumberOperation">número de tu operación</a>
                                                </strong> para el segundo paso.
                                            </p>
                                            <div class="col-sm-8 offset-sm-2 col-8 offset-2 bg-light-primary rounded border-primary border border-dashed p-6">
                                                <strong class="text-gray-900 ">Banco</strong>
                                                <p class="text-gray-900 mb-1 ml-5" id="nameBankOperationDeposit">BCP</p>
                                                <strong class="text-gray-900 ">Número de cuenta</strong>
                                                <p class="text-gray-900 mb-1 ml-5" id="nameAccountOperationDeposit">1111 1111 1111 1111</p>
                                                <strong class="text-gray-900 ">RUC</strong>
                                                <p class="text-gray-900 mb-1 ml-5" id="rucOperationDeposit">123456789123</p>
                                                <strong class="text-gray-700 ">Titular de la cuenta</strong>
                                                <p class="text-gray-900 mb-1 ml-5" id="ownerAccountOperationDeposit">Dolareros SAC</p>
                                                <strong class="text-gray-700 ">Tipo de la cuenta</strong>
                                                <p class="text-gray-900 mb-1 ml-5" id="typeAccountOperationDeposit">Cuenta Corriente - Soles</p>
                                            </div>
                                            <br>
                                            <h5>* Recuerda que Dolareros NO realiza ningún débito automático de tus cuentas. </h5>
                                            <br>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 2-->
                    {{--<!--begin::Step 3-->
                    <div data-kt-stepper-element="content">
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-12">
                                <!--begin::Title-->
                                <h2 class="fw-bolder text-dark">Business Details</h2>
                                <!--end::Title-->
                                <!--begin::Notice-->
                                <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                    <a href="#" class="link-primary fw-bolder">Help Page</a>.</div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="form-label required">Business Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input name="business_name" class="form-control form-control-lg form-control-solid" value="Keenthemes Inc." />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center form-label">
                                    <span class="required">Shortened Descriptor</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="&lt;div class='p-4 rounded bg-light'&gt; &lt;div class='d-flex flex-stack text-muted mb-4'&gt; &lt;i class='fas fa-university fs-3 me-3'&gt;&lt;/i&gt; &lt;div class='fw-bold'&gt;INCBANK **** 1245 STATEMENT&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack fw-bold text-gray-600'&gt; &lt;div&gt;Amount&lt;/div&gt; &lt;div&gt;Transaction&lt;/div&gt; &lt;/div&gt; &lt;div class='separator separator-dashed my-2'&gt;&lt;/div&gt; &lt;div class='d-flex flex-stack text-dark fw-bolder mb-2'&gt; &lt;div&gt;USD345.00&lt;/div&gt; &lt;div&gt;KEENTHEMES*&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack text-muted mb-2'&gt; &lt;div&gt;USD75.00&lt;/div&gt; &lt;div&gt;Hosting fee&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack text-muted'&gt; &lt;div&gt;USD3,950.00&lt;/div&gt; &lt;div&gt;Payrol&lt;/div&gt; &lt;/div&gt; &lt;/div&gt;"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input name="business_descriptor" class="form-control form-control-lg form-control-solid" value="KEENTHEMES" />
                                <!--end::Input-->
                                <!--begin::Hint-->
                                <div class="form-text">Customers will see this shortened version of your statement descriptor</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="form-label required">Corporation Type</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="business_type" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Select..." data-allow-clear="true" data-hide-search="true">
                                    <option></option>
                                    <option value="1">S Corporation</option>
                                    <option value="1">C Corporation</option>
                                    <option value="2">Sole Proprietorship</option>
                                    <option value="3">Non-profit</option>
                                    <option value="4">Limited Liability</option>
                                    <option value="5">General Partnership</option>
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--end::Label-->
                                <label class="form-label">Business Description</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea name="business_description" class="form-control form-control-lg form-control-solid" rows="3"></textarea>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-0">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label required">Contact Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input name="business_email" class="form-control form-control-lg form-control-solid" value="corp@support.com" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 3-->
                    <!--begin::Step 4-->
                    <div data-kt-stepper-element="content">
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">
                                <!--begin::Title-->
                                <h2 class="fw-bolder text-dark">Billing Details</h2>
                                <!--end::Title-->
                                <!--begin::Notice-->
                                <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                    <a href="#" class="text-primary fw-bolder">Help Page</a>.</div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required">Name On Card</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a card holder's name"></i>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" placeholder="" name="card_name" value="Max Doe" />
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold form-label mb-2">Card Number</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="Enter card number" name="card_number" value="4111 1111 1111 1111" />
                                    <!--end::Input-->
                                    <!--begin::Card logos-->
                                    <div class="position-absolute translate-middle-y top-50 end-0 me-5">
                                        <img src="assets/media/svg/card-logos/visa.svg" alt="" class="h-25px" />
                                        <img src="assets/media/svg/card-logos/mastercard.svg" alt="" class="h-25px" />
                                        <img src="assets/media/svg/card-logos/american-express.svg" alt="" class="h-25px" />
                                    </div>
                                    <!--end::Card logos-->
                                </div>
                                <!--end::Input wrapper-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-10">
                                <!--begin::Col-->
                                <div class="col-md-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold form-label mb-2">Expiration Date</label>
                                    <!--end::Label-->
                                    <!--begin::Row-->
                                    <div class="row fv-row">
                                        <!--begin::Col-->
                                        <div class="col-6">
                                            <select name="card_expiry_month" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Month">
                                                <option></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-6">
                                            <select name="card_expiry_year" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Year">
                                                <option></option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2029">2029</option>
                                                <option value="2030">2030</option>
                                                <option value="2031">2031</option>
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-4 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">CVV</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter a card CVV code"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative">
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" minlength="3" maxlength="4" placeholder="CVV" name="card_cvv" />
                                        <!--end::Input-->
                                        <!--begin::CVV icon-->
                                        <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                                            <span class="svg-icon svg-icon-2hx">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path d="M22 7H2V11H22V7Z" fill="black" />
																			<path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" fill="black" />
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::CVV icon-->
                                    </div>
                                    <!--end::Input wrapper-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-stack">
                                <!--begin::Label-->
                                <div class="me-5">
                                    <label class="fs-6 fw-bold form-label">Save Card for further billing?</label>
                                    <div class="fs-7 fw-bold text-muted">If you need more info, please check budget planning</div>
                                </div>
                                <!--end::Label-->
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" checked="checked" />
                                    <span class="form-check-label fw-bold text-muted">Save Card</span>
                                </label>
                                <!--end::Switch-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 4-->--}}
                    <!--begin::Step 5-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-8 pb-lg-10 text-center">
                                    <!--begin::Title-->
                                    <h2 class="fw-bolder text-dark">Envía tu constancia</h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-bold fs-6">If you need more info, please
                                        <a href="#" class="link-primary fw-bolder">Sign In</a>.</div>
                                    <!--end::Notice-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Body-->
                                <div class="mb-0">
                                    <!--begin::Text-->
                                    <div class="fs-6 text-gray-800 mb-5" >Escribe el número de operación de la transferencia</div>
                                    <!--end::Text-->
                                    <!--begin::Alert-->
                                    <!--begin::Notice-->
                                    <div class="fv-row mb-7">
                                        <input type="number" pattern="[\d]*" autocomplete="off" class="form-control form-control-lg form-control-solid bg-light-primary rounded border-primary border border-dashed text-center" name="number_operation" id="number_operation" placeholder="" value="" />
                                    </div>
                                    <div class="fs-6 text-gray-800 mt-3 mb-3 text-center">¿Dónde encuentro el <a href="#" id="showModalNumberOperation2" class="link-primary fw-bolder">número de operación</a>?</div>
                                    <div class="fs-6 text-gray-800 mb-3 text-center">¿Aún no haces la transferencia?</div>
                                    <div class="fs-6 text-gray-800 mt-10 text-center">Verificaremos tu operación para transferir <strong id="amountSendOperationConstancia">{{ ($stopData->type == 'buy') ? 'PEN ':'USD ' }} {{ number_format($stopData->getAmount, 2, '.', '') }} </strong> a tu cuenta.</div>

                                    <!--end::Notice-->
                                    <!--end::Alert-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 5-->
                        <!--begin::Actions-->
                        <div class="d-flex flex-stack pt-15">
                            <!--begin::Wrapper-->
                            <div class="mr-2">
                                <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                                    <span class="svg-icon svg-icon-4 me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black" />
                                        <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black" />
                                    </svg>
                                </span>
                                    <!--end::Svg Icon-->Regresar
                                </button>
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Wrapper-->
                            <div>
                                <button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit">
                                <span class="indicator-label">Enviar constancia
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                    <span class="svg-icon svg-icon-3 ms-2 me-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                            <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                    <span class="indicator-progress">Espere por favor...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                                </button>
                                <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continuar
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                    <span class="svg-icon svg-icon-4 ms-1 me-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                    </svg>
                                </span>
                                    <!--end::Svg Icon-->
                                </button>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
            @endif
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    @if ( $stopOperation != null )
        <div class="modal fade" id="kt_modal_add_customer" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Form-->
                    <form class="form" action="#" id="kt_modal_add_customer_form" enctype="multipart/form-data" data-kt-action="{{ route('accounts.customer.operation.store') }}" data-kt-redirect="{{ route('operation.create') }}">
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
                                            <select name="currency" disabled id="currency_create" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Moneda">
                                                <option></option>
                                                <option value="PEN" {{ ($stopOperation->type == 'buy') ? 'selected':''}}>Soles</option>
                                                <option value="USD" {{ ($stopOperation->type == 'sell') ? 'selected':''}}>Dolares</option>
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
    @else
        <div class="modal fade" id="kt_modal_add_customer" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Form-->
                    <form class="form" action="#" id="kt_modal_add_customer_form" enctype="multipart/form-data" data-kt-action="{{ route('accounts.customer.operation.store') }}" data-kt-redirect="{{ route('operation.create') }}">
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
                                            <select name="currency" disabled id="currency_create" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Moneda">
                                                <option></option>
                                                <option value="PEN" {{ ($stopData->type == 'buy') ? 'selected':''}}>Soles</option>
                                                <option value="USD" {{ ($stopData->type == 'sell') ? 'selected':''}}>Dolares</option>
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
    @endif
    @if ( $stopOperation != null )
        <div class="modal fade" id="kt_modal_summary" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered">
                <!--begin::Modal content-->
                <div class="modal-content">

                    <form class="form" action="#" id="kt_modal_summary_form" enctype="multipart/form-data">
                    @csrf

                        <!--begin::Modal body-->
                        <div class="modal-body py-10 px-lg-17">
                            <!--begin::Scroll-->
                            <div class=" me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                                <div class="row pb-1 text-center">
                                    <h4> DETALLES DE LA OPERACIÓN </h4>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 offset-sm-2 col-8 offset-2 border-dashed">
                                        <strong class="text-gray-900 ">Banco Origen</strong>
                                        <p class="text-gray-900 mb-1 ml-5" id="nameBank"></p>
                                        <strong class="text-gray-900 ">Banco Destino</strong>
                                        <p class="text-gray-900 mb-1 ml-5" id="nameBank2"></p>
                                        <p class="text-gray-900 mb-1 ml-5" id="nameAccount"></p>
                                        <strong class="text-gray-900 ">Monto</strong>
                                        <p class="text-gray-900 mb-1 ml-5">Enviado: {{ ($stopOperation->type == 'buy') ? 'USD ':'PEN ' }}{{ number_format(round($stopOperation->sendAmount, 2), 2) }}</p>
                                        <p class="text-gray-900 mb-1 ml-5">Recibido: {{ ($stopOperation->type == 'buy') ? 'PEN ':'USD ' }} {{ number_format(round($stopOperation->getAmount, 2), 2) }}</p>
                                        <strong class="text-gray-700 ">Cupon</strong>
                                        <p class="text-gray-900 mb-1 ml-5">{{ ( $stopOperation->coupon_id == null ) ? '--': $stopOperation->coupon->name }}</p>
                                        <strong class="text-gray-700 ">Tipo de Cambio</strong>
                                        <p class="text-gray-900 mb-1 ml-5">
                                            <span class="fs-5 text-danger tachado" id="withoutCoupon" style="{{ ($stopOperation->coupon_id == null) ? 'display:none':'' }}" >{{ ($stopOperation->type == 'buy') ? number_format(round($stopOperation->buyStop, 3), 3):number_format(round($stopOperation->sellStop, 3), 3) }}</span>
                                            <span class="fs-5 text-primary" id="withCoupon">{{ ($stopOperation->coupon_id == null) ? ( ($stopOperation->type == 'buy') ? $stopOperation->buyStop:$stopOperation->sellStop ):(($stopOperation->type == 'buy') ? number_format(round(($stopOperation->buyStop+$stopOperation->coupon->amountBuy), 3), 3):number_format(round(($stopOperation->sellStop-$stopOperation->coupon->amountSell), 3), 3)) }}</span>
                                        </p>
                                        <strong class="text-gray-900 ">En esta operación ahorraste</strong>
                                        <p class="text-gray-900 mb-1 ml-5">{{ ($stopOperation->type == 'buy') ? 'PEN ':'USD ' }}{{ ( $stopOperation->ahorro == null ) ? '--': number_format(round($stopOperation->ahorro, 2), 2) }}</p>
                                    </div>
                                </div>
                            </div>
                            <!--end::Scroll-->


                        </div>
                        <!--end::Modal body-->
                        <!--begin::Modal footer-->
                        <div class="modal-footer flex-center">
                            <!--begin::Button-->
                            <button type="button" id="kt_modal_summary_cancel" class="btn btn-light me-3">Regresar</button>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="button" id="kt_modal_summary_next" class="btn btn-primary" data-url="{{ route('save.operation.stop') }}">
                                <span class="indicator-label">Siguiente</span>
                                <span class="indicator-progress">Por favor espere...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <!--end::Button-->
                        </div>
                        <!--end::Modal footer-->
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="modal fade" id="kt_modal_summary" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered">
                <!--begin::Modal content-->
                <div class="modal-content">

                    <form class="form" action="#" id="kt_modal_summary_form" enctype="multipart/form-data">
                    @csrf

                    <!--begin::Modal body-->
                        <div class="modal-body py-10 px-lg-17">
                            <!--begin::Scroll-->
                            <div class=" me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                                <div class="row pb-1 text-center">
                                    <h4> DETALLES DE LA OPERACIÓN </h4>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 offset-sm-2 col-8 offset-2 border-dashed">
                                        <strong class="text-gray-900 ">Banco Origen</strong>
                                        <p class="text-gray-900 mb-1 ml-5" id="nameBank"></p>
                                        <strong class="text-gray-900 ">Banco Destino</strong>
                                        <p class="text-gray-900 mb-1 ml-5" id="nameBank2"></p>
                                        <p class="text-gray-900 mb-1 ml-5" id="nameAccount"></p>
                                        <strong class="text-gray-900 ">Monto</strong>
                                        <p class="text-gray-900 mb-1 ml-5">Enviado: {{ ($stopData->type == 'buy') ? 'USD ':'PEN ' }}{{ number_format(round($stopData->sendAmount, 2), 2) }}</p>
                                        <p class="text-gray-900 mb-1 ml-5">Recibido: {{ ($stopData->type == 'buy') ? 'PEN ':'USD ' }} {{ number_format(round($stopData->getAmount, 2), 2) }}</p>
                                        <strong class="text-gray-700 ">Cupon</strong>
                                        <p class="text-gray-900 mb-1 ml-5">{{ ( $stopData->coupon_id == null ) ? '--': $stopData->coupon->name }}</p>
                                        <strong class="text-gray-700 ">Tipo de Cambio</strong>
                                        <p class="text-gray-900 mb-1 ml-5">
                                            <span class="fs-5 text-danger tachado" id="withoutCoupon" style="{{ ($stopData->coupon_id == null) ? 'display:none':'' }}" >{{ ($stopData->type == 'buy') ? number_format(round($stopData->buyStop, 3), 3):number_format(round($stopData->sellStop, 3), 3) }}</span>
                                            <span class="fs-5 text-primary" id="withCoupon">{{ ($stopData->coupon_id == null) ? ( ($stopData->type == 'buy') ? $stopData->buyStop:$stopData->sellStop ):(($stopData->type == 'buy') ? number_format(round(($stopData->buyStop+$stopData->coupon->amountBuy), 3), 3):number_format(round(($stopData->sellStop-$stopData->coupon->amountSell), 3), 3)) }}</span>
                                        </p>
                                        <strong class="text-gray-900 ">En esta operación ahorraste</strong>
                                        <p class="text-gray-900 mb-1 ml-5">{{ ($stopData->type == 'buy') ? 'PEN ':'USD ' }}{{ ( $stopData->ahorro == null ) ? '--': number_format(round($stopData->ahorro, 2), 2) }}</p>
                                    </div>
                                </div>
                            </div>
                            <!--end::Scroll-->


                        </div>
                        <!--end::Modal body-->
                        <!--begin::Modal footer-->
                        <div class="modal-footer flex-center">
                            <!--begin::Button-->
                            <button type="button" id="kt_modal_summary_cancel" class="btn btn-light me-3">Regresar</button>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="button" id="kt_modal_summary_next" class="btn btn-primary" data-url="{{ route('save.operation.stop') }}">
                                <span class="indicator-label">Siguiente</span>
                                <span class="indicator-progress">Por favor espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                            </button>
                            <!--end::Button-->
                        </div>
                        <!--end::Modal footer-->
                    </form>
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="kt_modal_second_step" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class=" me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <div class="row pb-1 text-center">
                            <h5> ¿Confirmas que ya realizaste la transferencia bancaria? </h5>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 offset-sm-1 col-8 offset-2 border-dashed pt-4">
                                <p class="text-muted text-gray-800 fw-bold fs-6">Recuerda guardar el número de operación de tu transferencia para que lo puedes registrar en el siguiente paso.
                                </p>
                                <p class="text-muted text-gray-800 fw-bold fs-6">
                                    *Ubica el número de operación.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--end::Scroll-->


                </div>
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_second_step_cancel" class="btn btn-light me-3">Regresar</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_second_step_next" class="btn btn-primary">
                        <span class="indicator-label">Confirmo</span>
                        <span class="indicator-progress">Por favor espere...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Button-->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_number_operation" aria-hidden="true">
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
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class=" me-n7 pe-7" id="" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <div class="row">
                            <div class="col-sm-8 offset-sm-2 col-8 offset-2">
                                <div class="d-flex justify-content-center">
                                    <img class="img-fluid center" style="height: 100%;max-height: 325px"  src="{{ asset('assets/images/operation/numeroOperacion.jpeg') }}" alt="">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Scroll-->


                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_final_step" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class=" me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <div class="row pb-1 text-center">
                            <h5> ¿Confirmas que el número o código de operación ingresado " <strong class="text-muted text-gray-800 fw-bold fs-6" id="numberOperationUser"> </strong> " es correcto? </h5>
                        </div>
                    </div>
                    <!--end::Scroll-->


                </div>
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_final_step_cancel" class="btn btn-light me-3">Regresar</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_final_step_next" class="btn btn-primary" data-url="{{ route('save.operation.real') }}">
                        <span class="indicator-label">Confirmo</span>
                        <span class="indicator-progress">Por favor espere...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Button-->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_success_final" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class=" me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <div class="row pb-1 text-center">
                            <h5> Constancia enviada </h5>
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
                                <h5 class="text-gray-700 text-start">* Usa tu código para dar siguimiento a tu operación</h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                @if ( $stopOperation != null )
                                    <h5 class="text-gray-700 text-start">Monto a recibir</h5> <h4 class="text-gray-900 fw-bolder text-end"> {{ ($stopOperation->type == 'buy') ? 'PEN ':'USD ' }} {{ number_format(round($stopOperation->getAmount, 2), 2) }}</h4>
                                @else
                                    <h5 class="text-gray-700 text-start">Monto a recibir</h5> <h4 class="text-gray-900 fw-bolder text-end"> {{ ($stopData->type == 'buy') ? 'PEN ':'USD ' }} {{ number_format(round($stopData->getAmount, 2), 2) }}</h4>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-700 text-start">Tiempo estimado de espera</h5> <h4 class="text-gray-900 fw-bolder text-end"> En próximos 15 min </h4>
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

            $("#bank_id").select2({
                templateSelection: optionFormat,
                templateResult: optionFormat,
                minimumResultsForSearch: Infinity,
            });

            $("#bank_id_create").select2({
                templateSelection: optionFormat,
                templateResult: optionFormat,
                minimumResultsForSearch: Infinity,
                dropdownParent: $("#kt_modal_add_customer")
            });

            $("#account_id").select2({
                templateSelection: optionFormat,
                templateResult: optionFormat,
                minimumResultsForSearch: Infinity,
            });
            $("#source_id").select2({
                minimumResultsForSearch: Infinity,
            });
            //$.fn.modal.Constructor.prototype.enforceFocus = function () {};

            $('#account_id').on('select2:select', function(e) {
                var selectedValue = e.params.data.id;

                if (selectedValue === '0') {
                    e.preventDefault();
                    // Aquí puedes mostrar el modal deseado utilizando el método correspondiente de tu modal library
                    //alert('Se quiere crear una nueva cuenta')
                    // Por ejemplo, si estás utilizando Bootstrap y el modal tiene el ID 'myModal':
                    $('#kt_modal_add_customer').modal('show');
                    $('#account_id').val(null).trigger('change');
                }
            });
        });

    </script>
    <script src="{{ asset('assets/js/operation/create.js') }}"></script>
    <script src="{{ asset('assets/js/operation/modalSummary.js') }}"></script>

    <script src="{{ asset('assets/js/accountCustomers/add.js') }}"></script>
    {{--<script>
        $(document).ready(function () {
            // Configurar KTStepper
            console.log(document.getElementById('kt_create_account_stepper'));
            const stepper = new KTStepper(document.getElementById('kt_create_account_stepper'));
            console.log(stepper);
            // Obtener los elementos del DOM
            const modal = document.getElementById('kt_modal_summary');
            const siguienteBtn = $('#kt_modal_summary_next');

            // Handle next step
            stepper.on("kt.stepper.next", function (stepper) {
                //stepper.goNext(); // go next step
                if (stepper.getCurrentStepIndex() === 1) {
                    $('#kt_modal_summary').modal('show');
                } else {
                    stepper.goNext(); // Avanzar al siguiente paso
                }
            });

            // Handle previous step
            stepper.on("kt.stepper.previous", function (stepper) {
                stepper.goPrevious(); // go previous step
            });

            siguienteBtn.on("click", function () {
                $('#kt_modal_summary').modal('hide');
                //const stepper2 = new KTStepper(document.getElementById('kt_create_account_stepper'));

                stepper.goTo(2); // go next step
            });
        });
    </script>--}}
@endsection
