@extends('layouts.admin')

@section('title', 'Código Verificación')

@section('page-title', 'Código de Verificación')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Inicio</a>
        </li>
        <li class="breadcrumb-item text-dark">Verificar contraseña</li>
    </ul>
@endsection

@section('activeTabPanelMenu', 'active')
@section('activeTabHome', 'active show')
{{--@section('activeMyAccount', 'text-primary')--}}

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

<div class="mt-4 col-xxl-4 offset-xxl-4 col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-6 offset-sm-3 ">
    <div class="card card-xl-stretch mb-xl-8" >
        <!--begin::Body-->
        <div class="card-body text-center">
            <form class="form w-100 mb-10" id="formCreate" data-url="{{ route('code.verification', $url) }}">
            @csrf
            <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h1 class="text-dark mb-3">Ingrese contraseña segura</h1>
                    <!--end::Title-->
                    <!--begin::Sub-title-->
                    @if( $flag == 0 )
                    <div class="text-muted fw-bold fs-5 mb-5">Si no tiene una contraseña, <a class="fw-bolder" href="{{ route('dashboard.profile.token') }}">ingrese aquí</a></div>
                    @endif
                    <!--end::Sub-title-->
                </div>
                <!--end::Heading-->
                <!--begin::Section-->
                <div class="mb-10 px-md-10">
                    <!--begin::Label-->
                    <div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">Ingresa tu contraseña</div>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-wrap flex-stack form__pincode1" >
                        <input type="tel" maxlength="1" pattern="[\d]*" tabindex="1" placeholder="" autocomplete="off" class="coden form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="pincode-5" />
                        <input type="tel" maxlength="1" pattern="[\d]*" tabindex="2" placeholder="" autocomplete="off" class="coden form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="pincode-6" />
                        <input type="tel" maxlength="1" pattern="[\d]*" tabindex="3" placeholder="" autocomplete="off" class="coden form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="pincode-7" />
                        <input type="tel" maxlength="1" pattern="[\d]*" tabindex="4" placeholder="" autocomplete="off" class="coden form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="pincode-8" />
                    </div>
                    <!--begin::Input group-->
                </div>
                <!--end::Section-->
                <!--begin::Submit-->
                <div class="d-flex flex-center">
                    <button type="button" id="btn-save" class="btn btn-lg btn-primary fw-bolder">
                        <span class="indicator-label">Ingresar contraseña</span>
                    </button>
                </div>
                <!--end::Submit-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Body-->

    </div>


    <!--end::Action-->
</div>
@endsection

@section('scripts')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/jquery.inputmask.min.js'></script>

    <script src="{{ asset('assets/js/code/index.js') }}"></script>
@endsection
