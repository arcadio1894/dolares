@extends('layouts.admin')

@section('title', 'Perfil')

@section('page-title', 'Perfil de Usuario')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Inicio</a>
        </li>
        <li class="breadcrumb-item text-muted">Dashboard</li>
        <li class="breadcrumb-item text-dark">Perfil</li>
    </ul>
@endsection

@section('activeTabProfile', 'active show')
@section('activeProfileInformation', 'text-primary')

@section('styles')
    <style>
        .gray-image {
            filter: grayscale(100%);
        }

        .yellow-image {
            filter: sepia(100%) hue-rotate(45deg);
        }

        .red-image {
            filter: sepia(100%) hue-rotate(0deg);
        }

        .green-image {
            filter: sepia(100%) hue-rotate(90deg);
        }
    </style>
@endsection

@section('content')
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <!--begin: Pic-->
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{ asset('assets/media/avatars/150-26.jpg') }}" alt="image" />
                    </div>
                </div>
                <!--end::Pic-->
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ (Auth::user()->account_type == 'b') ? Auth::user()->business_name : Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
                                <a href="#">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                    <span class="svg-icon svg-icon-1 svg-icon-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                            <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF" />
                                            <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                            </div>
                            <!--end::Name-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
                                            <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->Developer</a>
                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="black" />
                                            <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->SF, Bay Area</a>
                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="black" />
                                            <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->max@kt.com</a>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Title-->
                    <!--begin::Stats-->
                    <!--begin::Notice-->
                    {{--<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
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
                                <h4 class="text-gray-900 fw-bolder">Necesitamos tu atención!</h4>
                                <div class="fs-6 text-gray-700">Es importante que verifique su correo. Por favor
                                    <a class="fw-bolder" href="#" id="btn-verify">verificar correo electrónico</a>.</div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    --}}<!--end::Notice-->
                    @if(!isset($token))
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
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
                                    <h4 class="text-gray-900 fw-bolder">Necesitamos tu atención!</h4>
                                    <div class="fs-6 text-gray-700">Para proteger tus operaciones y datos financieros, por favor
                                        <a class="fw-bolder" href="#" id="btn-create">Crear contraseña segura de 4 dígitos</a>.
                                    </div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                    @else
                        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                            <span class="svg-icon svg-icon-2tx svg-icon-success me-1">
                                <img width="40px" src="{{ asset('assets/media/icons/duotune/general/gen048.svg') }}" class="align-self-center" alt="" />

                            </span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1">
                                <!--begin::Content-->
                                <div class="fw-bold">
                                    <h4 class="text-gray-900 fw-bolder">Contraseña generada, se puede usar para proteger tus operaciones.</h4>
                                    <div class="fs-6 text-gray-700">Si deseas cambiar tu contraseña de 4 dígitos, por favor
                                        <a class="fw-bolder" href="#" id="btn-refresh">Cambiar contraseña segura</a>.</div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                    @endif
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->

        </div>
    </div>
    <!--end::Navbar-->
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">Detalle de perfil</h3>
            </div>
            <!--end::Card title-->
            <!--begin::Action-->
            <button class="btn btn-primary align-self-center">Editar perfil</button>
            <!--end::Action-->
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <div class="card-body p-9">
            <!--begin::Notice-->
            @if (is_null(Auth::user()->front_image) && is_null(Auth::user()->reverse_image))
                {{--<p>No ha ingresado ninguna imagen.</p>--}}
                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
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
                            <h4 class="text-gray-900 fw-bolder">Necesitamos tu atención!</h4>
                            <div class="fs-6 text-gray-700">
                                No ha ingresado ninguna imagen.
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
            @else
                @if (is_null(Auth::user()->flag_front) && is_null(Auth::user()->flag_reverse))
                    @if (!is_null(Auth::user()->front_image) && is_null(Auth::user()->reverse_image))
                        {{--<p>Estamos verificando la frontal y debe subir la reversa.</p>--}}
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
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
                                    <h4 class="text-gray-900 fw-bolder">Necesitamos tu atención!</h4>
                                    <div class="fs-6 text-gray-700">
                                        Estamos verificando la imagen frontal y debe subir la imagen de reverso.
                                    </div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                    @elseif (!is_null(Auth::user()->reverse_image) && is_null(Auth::user()->front_image))
                        {{--<p>Estamos verificando la reversa y debe subir la frontal.</p>--}}
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
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
                                    <h4 class="text-gray-900 fw-bolder">Necesitamos tu atención!</h4>
                                    <div class="fs-6 text-gray-700">
                                        Estamos verificando la imagen de reverso y debe subir la imagen frontal.
                                    </div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                    @else
                        {{--<p>Estamos verificando sus imágenes.</p>--}}
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
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
                                    <h4 class="text-gray-900 fw-bolder">Necesitamos tu atención!</h4>
                                    <div class="fs-6 text-gray-700">
                                        Estamos verificando sus imágenes.
                                    </div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                    @endif
                @elseif (is_null(Auth::user()->flag_front) && !is_null(Auth::user()->flag_reverse))
                    {{--<p>Debe subir la frontal y estamos verificando la reversa.</p>--}}
                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
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
                                <h4 class="text-gray-900 fw-bolder">Necesitamos tu atención!</h4>
                                <div class="fs-6 text-gray-700">
                                    Debe subir la imagen frontal y estamos verificando la imagen de reverso.
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                @elseif (!is_null(Auth::user()->flag_front) && is_null(Auth::user()->flag_reverse))
                    {{--<p>Debe subir la reversa y estamos verificando la frontal.</p>--}}
                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
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
                                <h4 class="text-gray-900 fw-bolder">Necesitamos tu atención!</h4>
                                <div class="fs-6 text-gray-700">
                                    Debe subir la imagen de reverso y estamos verificando la imagen frontal.
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                @elseif (Auth::user()->flag_front === 1 && Auth::user()->flag_reverse === 0)
                    {{--<p>Hemos aceptado la frontal y hemos rechazado la reversa.</p>--}}
                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
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
                                <h4 class="text-gray-900 fw-bolder">Necesitamos tu atención!</h4>
                                <div class="fs-6 text-gray-700">
                                    Hemos aceptado la imagen frontal y hemos rechazado la imagen de reverso.
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                @elseif (Auth::user()->flag_front === 0 && Auth::user()->flag_reverse === 1)
                    {{--<p>Hemos aceptado la reversa y hemos rechazado la frontal.</p>--}}
                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
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
                                <h4 class="text-gray-900 fw-bolder">Necesitamos tu atención!</h4>
                                <div class="fs-6 text-gray-700">
                                    Hemos aceptado la imagen de reverso0 y hemos rechazado la imagen frontal.
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                @elseif (Auth::user()->flag_front === 1 && Auth::user()->flag_reverse === 1)
                    {{--<p>Las imágenes han sido validadas.</p>--}}
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-3 mb-5">
                        <!--begin::Icon-->
                        <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                        <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
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
                                <h4 class="text-gray-900 fw-bolder">Necesitamos tu atención!</h4>
                                <div class="fs-6 text-gray-700">
                                    Las imágenes han sido validadas.
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                @elseif (Auth::user()->flag_front === 0 && Auth::user()->flag_reverse === 0)
                    {{--<p>Ambas imágenes han sido rechazadas.</p>--}}
                    <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-3 mb-5">
                        <!--begin::Icon-->
                        <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                        <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
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
                                <h4 class="text-gray-900 fw-bolder">Necesitamos tu atención!</h4>
                                <div class="fs-6 text-gray-700">
                                    Ambas imágenes han sido rechazadas.
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                @else
                    <p>Estado de verificación desconocido.</p>
                @endif
            @endif
            <!--end::Notice-->
            <!--begin::Row-->
            @if ( Auth::user()->account_type == 'p' )
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Nombre completo</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Correo Electrónico</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6">{{ Auth::user()->email }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Teléfono</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 d-flex align-items-center">
                        <span class="fw-bolder fs-6 text-gray-800 me-2">{{ Auth::user()->phone }}</span>
                        {{--<span class="badge badge-success">Verified</span>--}}
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">DNI/CE</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6">{{ Auth::user()->document }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Dirección</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6">{{ Auth::user()->department->name . ','. Auth::user()->province->name . ',' . Auth::user()->district->name . ' ' . Auth::user()->direction}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Profesión</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ Auth::user()->profession }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-10">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Documentos personales</label>
                    <!--begin::Label-->
                    <!--begin::Label-->
                    <div class="col-lg-8">
                        @if (empty(Auth::user()->front_image) && empty(Auth::user()->reverse_image))
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-secondary rounded border-secondary border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                            <br>
                                            <img class="img-fluid gray-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                            <div class="form-group mt-3">
                                                <div class="input-group">
                                                    <input type="file" class="form-control form-control-sm" id="front_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-bg-warning btn-sm" type="button" id="btn_front_image" data-url="{{ route('submit.image.front') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-secondary rounded border-secondary border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                            <br>
                                            <img class="img-fluid gray-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen reverso de documento" width="40px">
                                            <div class="form-group mt-3">
                                                <div class="input-group">
                                                    <input type="file" class="form-control form-control-sm" id="reverse_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-bg-warning btn-sm" type="button" id="btn_reverse_image" data-url="{{ route('submit.image.reverse') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @else
                            @if (is_null(Auth::user()->flag_front) && is_null(Auth::user()->flag_reverse))
                                @if (!is_null(Auth::user()->front_image) && is_null(Auth::user()->reverse_image))
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                                <div class="row">
                                                    <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                    <br>
                                                    <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                                    <br>
                                                    <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-center notice d-flex bg-secondary rounded border-secondary border border-dashed p-3 mb-5">
                                                <div class="row">
                                                    <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                                    <br>
                                                    <img class="img-fluid gray-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen reverso de documento" width="40px">
                                                    <div class="form-group mt-3">
                                                        <div class="input-group">
                                                            <input type="file" class="form-control form-control-sm" id="reverse_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-bg-warning btn-sm" type="button" id="btn_reverse_image" data-url="{{ route('submit.image.reverse') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @elseif (!is_null(Auth::user()->reverse_image) && is_null(Auth::user()->front_image))
                                    {{--<p>Estamos verificando la reversa y debe subir la frontal.</p>--}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text-center notice d-flex bg-secondary rounded border-secondary border border-dashed p-3 mb-5">
                                                <div class="row">
                                                    <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                    <br>
                                                    <img class="img-fluid gray-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                                    <div class="form-group mt-3">
                                                        <div class="input-group">
                                                            <input type="file" class="form-control form-control-sm" id="front_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-bg-warning btn-sm" type="button" id="btn_front_image" data-url="{{ route('submit.image.front') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                                <div class="row">
                                                    <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                                    <br>
                                                    <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen frontal de documento" width="40px">
                                                    <br>
                                                    <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {{--<p>Estamos verificando sus imágenes.</p>--}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                                <div class="row">
                                                    <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                    <br>
                                                    <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                                    <br>
                                                    <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                                <div class="row">
                                                    <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                                    <br>
                                                    <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen frontal de documento" width="40px">
                                                    <br>
                                                    <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @elseif (Auth::user()->flag_front === 1 && is_null(Auth::user()->flag_reverse))
                                {{--<p>Hemos aceptado la frontal y estamos ferificando la reversa.</p>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                <br>
                                                <img class="img-fluid green-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <br>
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800 mt-5">Validación correcta</label>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                                <br>
                                                <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <br>
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @elseif (Auth::user()->flag_front === 0 && is_null(Auth::user()->flag_reverse))
                                {{--<p>Hemos rechazado la frontal y estamos ferificando la reversa.</p>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-danger rounded border-danger border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                <br>
                                                <img class="img-fluid red-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <div class="form-group mt-3">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control form-control-sm" id="front_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-bg-warning btn-sm" type="button" id="btn_front_image" data-url="{{ route('submit.image.front') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                                <br>
                                                <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <br>
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @elseif (Auth::user()->flag_reverse === 1 && is_null(Auth::user()->flag_front))
                                {{--<p>Hemos aceptado la reversa y estamos ferificando la frontal.</p>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                <br>
                                                <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <br>
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                                <br>
                                                <img class="img-fluid green-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <br>
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800 mt-5">Validación correcta</label>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @elseif (Auth::user()->flag_reverse === 0 && is_null(Auth::user()->flag_front))
                                {{--<p>Hemos rechazado la reversa y estamos ferificando la frontal.</p>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                <br>
                                                <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <br>
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-danger rounded border-danger border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                                <br>
                                                <img class="img-fluid red-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen reverso de documento" width="40px">
                                                <div class="form-group mt-3">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control form-control-sm" id="reverse_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-bg-warning btn-sm" type="button" id="btn_reverse_image" data-url="{{ route('submit.image.reverse') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @elseif (Auth::user()->flag_front === 1 && Auth::user()->flag_reverse === 0)
                                {{--<p>Hemos aceptado la frontal y hemos rechazado la reversa.</p>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-primary rounded border-primary border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                <br>
                                                <img class="img-fluid green-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <br>
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800 mt-5">Validación correcta</label>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-danger rounded border-danger border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                                <br>
                                                <img class="img-fluid red-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen reverso de documento" width="40px">
                                                <div class="form-group mt-3">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control form-control-sm" id="reverse_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-bg-warning btn-sm" type="button" id="btn_reverse_image" data-url="{{ route('submit.image.reverse') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @elseif (Auth::user()->flag_front === 0 && Auth::user()->flag_reverse === 1)
                                {{--<p>Hemos aceptado la reversa y hemos rechazado la frontal.</p>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-danger rounded border-danger border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                <br>
                                                <img class="img-fluid red-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <div class="form-group mt-3">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control form-control-sm" id="front_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-bg-warning btn-sm" type="button" id="btn_front_image" data-url="{{ route('submit.image.front') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                <br>
                                                <img class="img-fluid green-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <br>
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800 mt-5">Validación correcta</label>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @elseif (Auth::user()->flag_front === 1 && Auth::user()->flag_reverse === 1)
                                {{--<p>Las imágenes han sido validadas.</p>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                <br>
                                                <img class="img-fluid green-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <br>
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800 mt-5">Validación correcta</label>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                                <br>
                                                <img class="img-fluid green-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <br>
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800 mt-5">Validación correcta</label>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @elseif (Auth::user()->flag_front === 0 && Auth::user()->flag_reverse === 0)
                                {{--<p>Ambas imágenes han sido rechazadas.</p>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-danger rounded border-danger border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                <br>
                                                <img class="img-fluid red-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <div class="form-group mt-3">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control form-control-sm" id="front_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-bg-warning btn-sm" type="button" id="btn_front_image" data-url="{{ route('submit.image.front') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-danger rounded border-danger border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                                <br>
                                                <img class="img-fluid red-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen reverso de documento" width="40px">
                                                <div class="form-group mt-3">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control form-control-sm" id="reverse_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-bg-warning btn-sm" type="button" id="btn_reverse_image" data-url="{{ route('submit.image.reverse') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @else
                                <p>Estado de verificación desconocido.</p>
                            @endif
                        @endif
                    </div>
                    <!--begin::Label-->
                </div>
                <!--end::Input group-->
            @else
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Razón social</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ Auth::user()->business_name }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Correo Electrónico</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6">{{ Auth::user()->email }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Teléfono</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6">{{ Auth::user()->phone }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">RUC</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6">{{ Auth::user()->document }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Dirección</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6">{{ Auth::user()->department->name . ', '. Auth::user()->province->name . ', ' . Auth::user()->district->name . ' ' . Auth::user()->direction}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Nombre del representante legal</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ Auth::user()->name_legal_representative }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-10">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">DNI del representante legal</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ Auth::user()->dni_legal_representative }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-10">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Sector económico</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ Auth::user()->economic_sector->description }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-10">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Actividad económica</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ Auth::user()->economic_activity->description }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-10">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Fecha de constitución</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ (Auth::user()->constitution_date == null) ? '': Auth::user()->constitution_date->format('d/m/Y') }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-10">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">¿Es empresa estatal?</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ (Auth::user()->state_company == 1) ? 'SI': 'NO' }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-10">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Documentos personales</label>
                    <!--begin::Label-->
                    <!--begin::Label-->
                    <div class="col-lg-8">
                    @if (empty(Auth::user()->front_image) && empty(Auth::user()->reverse_image))
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center notice d-flex bg-secondary rounded border-secondary border border-dashed p-3 mb-5">
                                    <div class="row">
                                        <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                        <br>
                                        <img class="img-fluid gray-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                        <div class="form-group mt-3">
                                            <div class="input-group">
                                                <input type="file" class="form-control form-control-sm" id="front_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                <div class="input-group-append">
                                                    <button class="btn btn-bg-warning btn-sm" type="button" id="btn_front_image" data-url="{{ route('submit.image.front') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center notice d-flex bg-secondary rounded border-secondary border border-dashed p-3 mb-5">
                                    <div class="row">
                                        <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                        <br>
                                        <img class="img-fluid gray-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen reverso de documento" width="40px">
                                        <div class="form-group mt-3">
                                            <div class="input-group">
                                                <input type="file" class="form-control form-control-sm" id="reverse_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                <div class="input-group-append">
                                                    <button class="btn btn-bg-warning btn-sm" type="button" id="btn_reverse_image" data-url="{{ route('submit.image.reverse') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @else
                        @if (is_null(Auth::user()->flag_front) && is_null(Auth::user()->flag_reverse))
                            @if (!is_null(Auth::user()->front_image) && is_null(Auth::user()->reverse_image))
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                <br>
                                                <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <br>
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-secondary rounded border-secondary border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                                <br>
                                                <img class="img-fluid gray-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen reverso de documento" width="40px">
                                                <div class="form-group mt-3">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control form-control-sm" id="reverse_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-bg-warning btn-sm" type="button" id="btn_reverse_image" data-url="{{ route('submit.image.reverse') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @elseif (!is_null(Auth::user()->reverse_image) && is_null(Auth::user()->front_image))
                                {{--<p>Estamos verificando la reversa y debe subir la frontal.</p>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-secondary rounded border-secondary border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                <br>
                                                <img class="img-fluid gray-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <div class="form-group mt-3">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control form-control-sm" id="front_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-bg-warning btn-sm" type="button" id="btn_front_image" data-url="{{ route('submit.image.front') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                                <br>
                                                <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <br>
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @else
                                {{--<p>Estamos verificando sus imágenes.</p>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                                <br>
                                                <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <br>
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                            <div class="row">
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                                <br>
                                                <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen frontal de documento" width="40px">
                                                <br>
                                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif
                        @elseif (Auth::user()->flag_front === 1 && is_null(Auth::user()->flag_reverse))
                            {{--<p>Hemos aceptado la frontal y estamos ferificando la reversa.</p>--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                            <br>
                                            <img class="img-fluid green-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                            <br>
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800 mt-5">Validación correcta</label>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                            <br>
                                            <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen frontal de documento" width="40px">
                                            <br>
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        @elseif (Auth::user()->flag_front === 0 && is_null(Auth::user()->flag_reverse))
                            {{--<p>Hemos rechazado la frontal y estamos ferificando la reversa.</p>--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-danger rounded border-danger border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                            <br>
                                            <img class="img-fluid red-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                            <div class="form-group mt-3">
                                                <div class="input-group">
                                                    <input type="file" class="form-control form-control-sm" id="front_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-bg-warning btn-sm" type="button" id="btn_front_image" data-url="{{ route('submit.image.front') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                            <br>
                                            <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen frontal de documento" width="40px">
                                            <br>
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        @elseif (Auth::user()->flag_reverse === 1 && is_null(Auth::user()->flag_front))
                            {{--<p>Hemos aceptado la reversa y estamos ferificando la frontal.</p>--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                            <br>
                                            <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                            <br>
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                            <br>
                                            <img class="img-fluid green-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen frontal de documento" width="40px">
                                            <br>
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800 mt-5">Validación correcta</label>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        @elseif (Auth::user()->flag_reverse === 0 && is_null(Auth::user()->flag_front))
                            {{--<p>Hemos rechazado la reversa y estamos ferificando la frontal.</p>--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-warning rounded border-warning border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                            <br>
                                            <img class="img-fluid yellow-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                            <br>
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Estamos validando sus documentos. Espere unos minutos</label>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-danger rounded border-danger border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                            <br>
                                            <img class="img-fluid red-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen reverso de documento" width="40px">
                                            <div class="form-group mt-3">
                                                <div class="input-group">
                                                    <input type="file" class="form-control form-control-sm" id="reverse_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-bg-warning btn-sm" type="button" id="btn_reverse_image" data-url="{{ route('submit.image.reverse') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @elseif (Auth::user()->flag_front === 1 && Auth::user()->flag_reverse === 0)
                            {{--<p>Hemos aceptado la frontal y hemos rechazado la reversa.</p>--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-primary rounded border-primary border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                            <br>
                                            <img class="img-fluid green-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                            <br>
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800 mt-5">Validación correcta</label>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-danger rounded border-danger border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                            <br>
                                            <img class="img-fluid red-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen reverso de documento" width="40px">
                                            <div class="form-group mt-3">
                                                <div class="input-group">
                                                    <input type="file" class="form-control form-control-sm" id="reverse_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-bg-warning btn-sm" type="button" id="btn_reverse_image" data-url="{{ route('submit.image.reverse') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @elseif (Auth::user()->flag_front === 0 && Auth::user()->flag_reverse === 1)
                            {{--<p>Hemos aceptado la reversa y hemos rechazado la frontal.</p>--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-danger rounded border-danger border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                            <br>
                                            <img class="img-fluid red-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                            <div class="form-group mt-3">
                                                <div class="input-group">
                                                    <input type="file" class="form-control form-control-sm" id="front_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-bg-warning btn-sm" type="button" id="btn_front_image" data-url="{{ route('submit.image.front') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                            <br>
                                            <img class="img-fluid green-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen frontal de documento" width="40px">
                                            <br>
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800 mt-5">Validación correcta</label>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        @elseif (Auth::user()->flag_front === 1 && Auth::user()->flag_reverse === 1)
                            {{--<p>Las imágenes han sido validadas.</p>--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                            <br>
                                            <img class="img-fluid green-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                            <br>
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800 mt-5">Validación correcta</label>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                            <br>
                                            <img class="img-fluid green-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen frontal de documento" width="40px">
                                            <br>
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800 mt-5">Validación correcta</label>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        @elseif (Auth::user()->flag_front === 0 && Auth::user()->flag_reverse === 0)
                            {{--<p>Ambas imágenes han sido rechazadas.</p>--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-danger rounded border-danger border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                            <br>
                                            <img class="img-fluid red-image" src="{{ asset('assets/media/document/front.png') }}" alt="Imagen frontal de documento" width="40px">
                                            <div class="form-group mt-3">
                                                <div class="input-group">
                                                    <input type="file" class="form-control form-control-sm" id="front_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-bg-warning btn-sm" type="button" id="btn_front_image" data-url="{{ route('submit.image.front') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center notice d-flex bg-light-danger rounded border-danger border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                            <br>
                                            <img class="img-fluid red-image" src="{{ asset('assets/media/document/back.png') }}" alt="Imagen reverso de documento" width="40px">
                                            <div class="form-group mt-3">
                                                <div class="input-group">
                                                    <input type="file" class="form-control form-control-sm" id="reverse_image" placeholder="Imagen" accept=".jpg, .jpeg, .png, .pdf">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-bg-warning btn-sm" type="button" id="btn_reverse_image" data-url="{{ route('submit.image.reverse') }}"><i class="fas fa-save text-success fs-3"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @else
                            <p>Estado de verificación desconocido.</p>
                        @endif
                    @endif
                    </div>
                    <!--begin::Label-->
                </div>
                <!--end::Input group-->
            @endif
        </div>
        <!--end::Card body-->
    </div>
    <!--end::details View-->
    <!--begin::Row-->
    {{--<div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-xl-6">
            <!--begin::Charts Widget 1-->
            <div class="card card-xl-stretch mb-xl-10">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Recent Statistics</span>
                        <span class="text-muted fw-bold fs-7">More than 400 new members</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                        <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                        <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                        <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_61485793b229e">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Status:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_61485793b229e" data-allow-clear="true">
                                            <option></option>
                                            <option value="1">Approved</option>
                                            <option value="2">Pending</option>
                                            <option value="2">In Process</option>
                                            <option value="2">Rejected</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Member Type:</label>
                                    <!--end::Label-->
                                    <!--begin::Options-->
                                    <div class="d-flex">
                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                            <span class="form-check-label">Author</span>
                                        </label>
                                        <!--end::Options-->
                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                            <span class="form-check-label">Customer</span>
                                        </label>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Options-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Notifications:</label>
                                    <!--end::Label-->
                                    <!--begin::Switch-->
                                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                        <label class="form-check-label">Enabled</label>
                                    </div>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Chart-->
                    <div id="kt_charts_widget_1_chart" style="height: 350px"></div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Charts Widget 1-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6">
            <!--begin::Tables Widget 1-->
            <div class="card card-xl-stretch mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Tasks Overview</span>
                        <span class="text-muted fw-bold fs-7">Pending 10 tasks</span>
                    </h3>
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                            <span class="svg-icon svg-icon-2">
														<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
																<rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																<rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																<rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
															</g>
														</svg>
													</span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_61485793b2699">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Status:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_61485793b2699" data-allow-clear="true">
                                            <option></option>
                                            <option value="1">Approved</option>
                                            <option value="2">Pending</option>
                                            <option value="2">In Process</option>
                                            <option value="2">Rejected</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Member Type:</label>
                                    <!--end::Label-->
                                    <!--begin::Options-->
                                    <div class="d-flex">
                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                            <span class="form-check-label">Author</span>
                                        </label>
                                        <!--end::Options-->
                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                            <span class="form-check-label">Customer</span>
                                        </label>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Options-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Notifications:</label>
                                    <!--end::Label-->
                                    <!--begin::Switch-->
                                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                        <label class="form-check-label">Enabled</label>
                                    </div>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                        <!--end::Menu-->
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-5">
                            <!--begin::Table head-->
                            <thead>
                            <tr>
                                <th class="p-0 w-50px"></th>
                                <th class="p-0 min-w-200px"></th>
                                <th class="p-0 min-w-100px"></th>
                                <th class="p-0 min-w-40px"></th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            <tr>
                                <th>
                                    <div class="symbol symbol-50px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ asset('assets/media/svg/brand-logos/plurk.svg') }}" class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </th>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Top Authors</a>
                                    <span class="text-muted fw-bold d-block fs-7">Successful Fellas</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column w-100 me-2">
                                        <div class="d-flex flex-stack mb-2">
                                            <span class="text-muted me-2 fs-7 fw-bold">70%</span>
                                        </div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <span class="svg-icon svg-icon-2">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																			<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																		</svg>
																	</span>
                                        <!--end::Svg Icon-->
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <div class="symbol symbol-50px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ asset('assets/media/svg/brand-logos/telegram.svg') }}" class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </th>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Popular Authors</a>
                                    <span class="text-muted fw-bold d-block fs-7">Most Successful</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column w-100 me-2">
                                        <div class="d-flex flex-stack mb-2">
                                            <span class="text-muted me-2 fs-7 fw-bold">50%</span>
                                        </div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <span class="svg-icon svg-icon-2">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																			<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																		</svg>
																	</span>
                                        <!--end::Svg Icon-->
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <div class="symbol symbol-50px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ asset('assets/media/svg/brand-logos/vimeo.svg') }}" class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </th>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">New Users</a>
                                    <span class="text-muted fw-bold d-block fs-7">Awesome Users</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column w-100 me-2">
                                        <div class="d-flex flex-stack mb-2">
                                            <span class="text-muted me-2 fs-7 fw-bold">80%</span>
                                        </div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <span class="svg-icon svg-icon-2">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																			<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																		</svg>
																	</span>
                                        <!--end::Svg Icon-->
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <div class="symbol symbol-50px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ asset('assets/media/svg/brand-logos/bebo.svg') }}" class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </th>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Active Customers</a>
                                    <span class="text-muted fw-bold d-block fs-7">Best Customers</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column w-100 me-2">
                                        <div class="d-flex flex-stack mb-2">
                                            <span class="text-muted me-2 fs-7 fw-bold">90%</span>
                                        </div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <span class="svg-icon svg-icon-2">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																			<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																		</svg>
																	</span>
                                        <!--end::Svg Icon-->
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <div class="symbol symbol-50px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ asset('assets/media/svg/brand-logos/kickstarter.svg') }}" class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </th>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Bestseller Theme</a>
                                    <span class="text-muted fw-bold d-block fs-7">Amazing Templates</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column w-100 me-2">
                                        <div class="d-flex flex-stack mb-2">
                                            <span class="text-muted me-2 fs-7 fw-bold">70%</span>
                                        </div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <span class="svg-icon svg-icon-2">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																			<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																		</svg>
																	</span>
                                        <!--end::Svg Icon-->
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
            </div>
            <!--endW::Tables Widget 1-->
        </div>
        <!--end::Col-->
    </div>--}}
    <!--end::Row-->
    <!--begin::Row-->
    {{--<div class="row gy-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xl-6">
            <!--begin::List Widget 5-->
            <div class="card card-xl-stretch mb-xl-10">
                <!--begin::Header-->
                <div class="card-header align-items-center border-0 mt-4">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="fw-bolder mb-2 text-dark">Activities</span>
                        <span class="text-muted fw-bold fs-7">890,344 Sales</span>
                    </h3>
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                            <span class="svg-icon svg-icon-2">
														<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
																<rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																<rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																<rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
															</g>
														</svg>
													</span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_61485793b2f97">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Status:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_61485793b2f97" data-allow-clear="true">
                                            <option></option>
                                            <option value="1">Approved</option>
                                            <option value="2">Pending</option>
                                            <option value="2">In Process</option>
                                            <option value="2">Rejected</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Member Type:</label>
                                    <!--end::Label-->
                                    <!--begin::Options-->
                                    <div class="d-flex">
                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                            <span class="form-check-label">Author</span>
                                        </label>
                                        <!--end::Options-->
                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                            <span class="form-check-label">Customer</span>
                                        </label>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Options-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Notifications:</label>
                                    <!--end::Label-->
                                    <!--begin::Switch-->
                                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                        <label class="form-check-label">Enabled</label>
                                    </div>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                        <!--end::Menu-->
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5">
                    <!--begin::Timeline-->
                    <div class="timeline-label">
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6">08:42</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Text-->
                            <div class="fw-mormal timeline-content text-muted ps-3">Outlines keep you honest. And keep structure</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6">10:00</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-success fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Content-->
                            <div class="timeline-content d-flex">
                                <span class="fw-bolder text-gray-800 ps-3">AEOL meeting</span>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6">14:37</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-danger fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Desc-->
                            <div class="timeline-content fw-bolder text-gray-800 ps-3">Make deposit
                                <a href="#" class="text-primary">USD 700</a>. to ESL</div>
                            <!--end::Desc-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6">16:50</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Text-->
                            <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving and keep structure keep great</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6">21:03</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-danger fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Desc-->
                            <div class="timeline-content fw-bold text-gray-800 ps-3">New order placed
                                <a href="#" class="text-primary">#XF-2356</a>.</div>
                            <!--end::Desc-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6">16:50</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Text-->
                            <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving and keep structure keep great</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6">21:03</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-danger fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Desc-->
                            <div class="timeline-content fw-bold text-gray-800 ps-3">New order placed
                                <a href="#" class="text-primary">#XF-2356</a>.</div>
                            <!--end::Desc-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6">10:30</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-success fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Text-->
                            <div class="timeline-content fw-mormal text-muted ps-3">Finance KPI Mobile app launch preparion meeting</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Timeline-->
                </div>
                <!--end: Card Body-->
            </div>
            <!--end: List Widget 5-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6">
            <!--begin::Tables Widget 5-->
            <div class="card card-xl-stretch mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Latest Products</span>
                        <span class="text-muted mt-1 fw-bold fs-7">More than 400 new products</span>
                    </h3>
                    <div class="card-toolbar">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark active fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">Month</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_2">Week</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4" data-bs-toggle="tab" href="#kt_table_widget_5_tab_3">Day</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <div class="tab-content">
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade show active" id="kt_table_widget_5_tab_1">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                    <tr class="border-0">
                                        <th class="p-0 w-50px"></th>
                                        <th class="p-0 min-w-150px"></th>
                                        <th class="p-0 min-w-140px"></th>
                                        <th class="p-0 min-w-110px"></th>
                                        <th class="p-0 min-w-50px"></th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="symbol symbol-45px me-2">
                                                <span class="symbol-label">
                                                    <img src="{{ asset('assets/media/svg/brand-logos/plurk.svg') }}" class="h-50 align-self-center" alt="" />
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Brad Simmons</a>
                                            <span class="text-muted fw-bold d-block">Movie Creator</span>
                                        </td>
                                        <td class="text-end text-muted fw-bold">React, HTML</td>
                                        <td class="text-end">
                                            <span class="badge badge-light-success">Approved</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-2">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																					<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																				</svg>
																			</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="symbol symbol-45px me-2">
                                                <span class="symbol-label">
                                                    <img src="{{ asset('assets/media/svg/brand-logos/telegram.svg') }}" class="h-50 align-self-center" alt="" />
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Popular Authors</a>
                                            <span class="text-muted fw-bold d-block">Most Successful</span>
                                        </td>
                                        <td class="text-end text-muted fw-bold">Python, MySQL</td>
                                        <td class="text-end">
                                            <span class="badge badge-light-warning">In Progress</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-2">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																					<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																				</svg>
																			</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="symbol symbol-45px me-2">
                                                <span class="symbol-label">
                                                    <img src="{{ asset('assets/media/svg/brand-logos/vimeo.svg') }}" class="h-50 align-self-center" alt="" />
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">New Users</a>
                                            <span class="text-muted fw-bold d-block">Awesome Users</span>
                                        </td>
                                        <td class="text-end text-muted fw-bold">Laravel,Metronic</td>
                                        <td class="text-end">
                                            <span class="badge badge-light-primary">Success</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-2">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																					<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																				</svg>
																			</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="symbol symbol-45px me-2">
																			<span class="symbol-label">
																				<img src="assets/media/svg/brand-logos/bebo.svg" class="h-50 align-self-center" alt="" />
																			</span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Active Customers</a>
                                            <span class="text-muted fw-bold d-block">Movie Creator</span>
                                        </td>
                                        <td class="text-end text-muted fw-bold">AngularJS, C#</td>
                                        <td class="text-end">
                                            <span class="badge badge-light-danger">Rejected</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-2">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																					<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																				</svg>
																			</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="symbol symbol-45px me-2">
																			<span class="symbol-label">
																				<img src="assets/media/svg/brand-logos/kickstarter.svg" class="h-50 align-self-center" alt="" />
																			</span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Bestseller Theme</a>
                                            <span class="text-muted fw-bold d-block">Best Customers</span>
                                        </td>
                                        <td class="text-end text-muted fw-bold">ReactJS, Ruby</td>
                                        <td class="text-end">
                                            <span class="badge badge-light-warning">In Progress</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-2">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																					<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																				</svg>
																			</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade" id="kt_table_widget_5_tab_2">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                    <tr class="border-0">
                                        <th class="p-0 w-50px"></th>
                                        <th class="p-0 min-w-150px"></th>
                                        <th class="p-0 min-w-140px"></th>
                                        <th class="p-0 min-w-110px"></th>
                                        <th class="p-0 min-w-50px"></th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="symbol symbol-45px me-2">
																			<span class="symbol-label">
																				<img src="assets/media/svg/brand-logos/plurk.svg" class="h-50 align-self-center" alt="" />
																			</span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Brad Simmons</a>
                                            <span class="text-muted fw-bold d-block">Movie Creator</span>
                                        </td>
                                        <td class="text-end text-muted fw-bold">React, HTML</td>
                                        <td class="text-end">
                                            <span class="badge badge-light-success">Approved</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-2">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																					<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																				</svg>
																			</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="symbol symbol-45px me-2">
																			<span class="symbol-label">
																				<img src="assets/media/svg/brand-logos/telegram.svg" class="h-50 align-self-center" alt="" />
																			</span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Popular Authors</a>
                                            <span class="text-muted fw-bold d-block">Most Successful</span>
                                        </td>
                                        <td class="text-end text-muted fw-bold">Python, MySQL</td>
                                        <td class="text-end">
                                            <span class="badge badge-light-warning">In Progress</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-2">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																					<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																				</svg>
																			</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="symbol symbol-45px me-2">
																			<span class="symbol-label">
																				<img src="assets/media/svg/brand-logos/bebo.svg" class="h-50 align-self-center" alt="" />
																			</span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Active Customers</a>
                                            <span class="text-muted fw-bold d-block">Movie Creator</span>
                                        </td>
                                        <td class="text-end text-muted fw-bold">AngularJS, C#</td>
                                        <td class="text-end">
                                            <span class="badge badge-light-danger">Rejected</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-2">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																					<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																				</svg>
																			</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade" id="kt_table_widget_5_tab_3">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                    <tr class="border-0">
                                        <th class="p-0 w-50px"></th>
                                        <th class="p-0 min-w-150px"></th>
                                        <th class="p-0 min-w-140px"></th>
                                        <th class="p-0 min-w-110px"></th>
                                        <th class="p-0 min-w-50px"></th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="symbol symbol-45px me-2">
																			<span class="symbol-label">
																				<img src="assets/media/svg/brand-logos/kickstarter.svg" class="h-50 align-self-center" alt="" />
																			</span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Bestseller Theme</a>
                                            <span class="text-muted fw-bold d-block">Best Customers</span>
                                        </td>
                                        <td class="text-end text-muted fw-bold">ReactJS, Ruby</td>
                                        <td class="text-end">
                                            <span class="badge badge-light-warning">In Progress</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-2">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																					<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																				</svg>
																			</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="symbol symbol-45px me-2">
																			<span class="symbol-label">
																				<img src="assets/media/svg/brand-logos/bebo.svg" class="h-50 align-self-center" alt="" />
																			</span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Active Customers</a>
                                            <span class="text-muted fw-bold d-block">Movie Creator</span>
                                        </td>
                                        <td class="text-end text-muted fw-bold">AngularJS, C#</td>
                                        <td class="text-end">
                                            <span class="badge badge-light-danger">Rejected</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-2">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																					<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																				</svg>
																			</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="symbol symbol-45px me-2">
																			<span class="symbol-label">
																				<img src="assets/media/svg/brand-logos/vimeo.svg" class="h-50 align-self-center" alt="" />
																			</span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">New Users</a>
                                            <span class="text-muted fw-bold d-block">Awesome Users</span>
                                        </td>
                                        <td class="text-end text-muted fw-bold">Laravel,Metronic</td>
                                        <td class="text-end">
                                            <span class="badge badge-light-primary">Success</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-2">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																					<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																				</svg>
																			</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="symbol symbol-45px me-2">
																			<span class="symbol-label">
																				<img src="assets/media/svg/brand-logos/telegram.svg" class="h-50 align-self-center" alt="" />
																			</span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Popular Authors</a>
                                            <span class="text-muted fw-bold d-block">Most Successful</span>
                                        </td>
                                        <td class="text-end text-muted fw-bold">Python, MySQL</td>
                                        <td class="text-end">
                                            <span class="badge badge-light-warning">In Progress</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-2">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																					<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
																				</svg>
																			</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Tap pane-->
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Tables Widget 5-->
        </div>
        <!--end::Col-->
    </div>--}}
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
        <!--begin::Modal header-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
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
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y pt-0 pb-15 px-lg-17">
                    <form class="form w-100 mb-10" id="formCreate" data-url="{{ route('token.store') }}">
                    @csrf
                    <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Ingrese contraseña segura</h1>
                            <!--end::Title-->
                            <!--begin::Sub-title-->
                            <div class="text-muted fw-bold fs-5 mb-5">Esta contraseña segura ayudará a proteger tu información y así nos aseguramos que solo tú puedas tener acceso</div>
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
                                <span class="indicator-label">Guardar contraseña</span>
                            </button>
                        </div>
                        <!--end::Submit-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--begin::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal header-->
    </div>

    <div class="modal fade" id="modalRefresh" tabindex="-1" aria-hidden="true">
        <!--begin::Modal header-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
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
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y pt-0 pb-15 px-lg-17">
                    <form class="form w-100 mb-10" id="formRefresh" data-url="{{ route('token.renew') }}">
                    @csrf
                    <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Ingrese nueva contraseña segura</h1>
                            <!--end::Title-->
                            <!--begin::Sub-title-->
                            <div class="text-muted fw-bold fs-5 mb-5">Esta contraseña segura ayudará a proteger tu información y así nos aseguramos que solo tú puedas tener acceso</div>
                            <!--end::Sub-title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Section-->
                        <div class="mb-10 px-md-10">
                            <!--begin::Label-->
                            <div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">Ingresa tu contraseña anterior</div>
                            <!--end::Label-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-wrap flex-stack form__pincodel1">
                                <input type="tel" maxlength="1" pattern="[\d]*" tabindex="1" placeholder="" autocomplete="off" class="codel form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="pincodel-1" />
                                <input type="tel" maxlength="1" pattern="[\d]*" tabindex="2" placeholder="" autocomplete="off" class="codel form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="pincodel-2" />
                                <input type="tel" maxlength="1" pattern="[\d]*" tabindex="3" placeholder="" autocomplete="off" class="codel form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="pincodel-3" />
                                <input type="tel" maxlength="1" pattern="[\d]*" tabindex="4" placeholder="" autocomplete="off" class="codel form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="pincodel-4" />
                            </div>
                            <!--begin::Input group-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Section-->
                        <div class="mb-10 px-md-10">
                            <!--begin::Label-->
                            <div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">Ingresa tu nueva contraseña</div>
                            <!--end::Label-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-wrap flex-stack form__pincode1">
                                <input type="tel" maxlength="1" pattern="[\d]*" tabindex="1" placeholder="" autocomplete="off" class="code form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="pincode-1" />
                                <input type="tel" maxlength="1" pattern="[\d]*" tabindex="2" placeholder="" autocomplete="off" class="code form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="pincode-2" />
                                <input type="tel" maxlength="1" pattern="[\d]*" tabindex="3" placeholder="" autocomplete="off" class="code form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="pincode-3" />
                                <input type="tel" maxlength="1" pattern="[\d]*" tabindex="4" placeholder="" autocomplete="off" class="code form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="pincode-4" />
                            </div>
                            <!--begin::Input group-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Submit-->
                        <div class="d-flex flex-center">
                            <button type="button" id="btn-renew" class="btn btn-lg btn-primary fw-bolder">
                                <span class="indicator-label">Guardar nueva contraseña</span>
                            </button>
                        </div>
                        <!--end::Submit-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--begin::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal header-->
    </div>
@endsection

@section('scripts')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/jquery.inputmask.min.js'></script>

    <script src="{{ asset('assets/js/token/create.js') }}"></script>

    <script src="{{ asset('assets/js/user/profile.js') }}"></script>
@endsection
