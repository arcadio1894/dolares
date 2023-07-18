@extends('layouts.admin')

@section('title', 'Usuarios')

@section('page-title', 'Verificación de imágenes de usuarios')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('verification.images.users') }}" class="text-muted">Usuarios sin verificación</a>
        </li>
        <li class="breadcrumb-item text-dark">Verificación de imágenes</li>
    </ul>
@endsection

@section('activeTabPanelAdmin', 'active')
@section('activeTabAdmin', 'active show')

@section('showMenuAccordionVerificationUsers', 'show')
@section('activeMenuAccordionVerificationUsers', 'active')
@section('activeMenuVerificationUserList', 'active')

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
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <div class="fw-bolder mt-5">Archivos</div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                        <div class="row text-center">
                            @if ( $user->account_type == 'p' )
                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                            @else
                                <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen de ficha de RUC</label>
                            @endif
                            <br>
                            @if ( substr($user->front_image,-3) === 'pdf' )
                                <div class="col-lg-12">
                                    <a target="_blank" href="{{ asset('assets/images/user/documents/'.$user->front_image) }}" class="btn btn-success col-lg-12">Ver PDF</a>
                                </div>
                            @else
                                <img class="img-fluid" src="{{ asset('assets/images/user/documents/'.$user->front_image) }}" alt="Imagen frontal de documento" width="40px">
                            @endif
                            <br>
                            <div class="d-flex mt-5">
                                <div class="col-lg-6 px-3">
                                    <button type="button" {{ ($user->flag_front == 1) ? 'disabled':'' }} class="btn {{ ($user->flag_front == 1) ? 'btn-secondary':'btn-primary' }} col-lg-12" data-verify_image_front data-url="{{ route('verify.image.front', $user->id) }}"> Validar </button>
                                </div>
                                <div class="col-lg-6 px-3">
                                    <button type="button" {{ ($user->flag_front == 0) ? 'disabled':'' }} class="btn {{ ($user->flag_front == 0) ? 'btn-secondary':'btn-danger' }} col-lg-12" data-refuse_image_front="{{ $user->id }}" id="btn_refuse_image_front"> Rechazar </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @if ( $user->account_type == 'p' )
                <div class="col-lg-6">
                    <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                        <div class="row">
                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                            <br>
                            @if ( substr($user->reverse_image,-3) == 'pdf' )
                                <div class="col-lg-12">
                                    <a target="_blank" href="{{ asset('assets/images/user/documents/'.$user->reverse_image) }}" class="btn btn-success col-lg-12">Ver PDF</a>
                                </div>
                            @else
                                <img class="img-fluid" src="{{ asset('assets/images/user/documents/'.$user->reverse_image) }}" alt="Imagen reverso de documento" width="40px">
                            @endif
                            <br>
                            <div class="d-flex mt-5">
                                <div class="col-lg-6 px-3">
                                    <button type="button" {{ ($user->flag_reverse == 1) ? 'disabled':'' }} class="btn {{ ($user->flag_reverse == 1) ? 'btn-secondary':'btn-primary' }} col-lg-12" data-verify_image_reverse data-url="{{ route('verify.image.reverse', $user->id) }}"> Validar </button>
                                </div>
                                <div class="col-lg-6 px-3">
                                    <button type="button" {{ ($user->flag_reverse == 0) ? 'disabled':'' }} class="btn {{ ($user->flag_reverse == 0) ? 'btn-secondary':'btn-danger' }} col-lg-12" data-refuse_image_reverse="{{ $user->id }}" id="btn_refuse_image_reverse"> Rechazar </button>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
                @endif
            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--begin::Modals-->
    <div class="modal fade" id="modalRefuseImageFront" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="formRefuseImageFront">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id_image_front">
                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div class=" me-n7 pe-7" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                            <div class="row pb-1 text-center">
                                <h4> Motivo de rechazo </h4>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 offset-sm-1 col-8 offset-2 text-center pt-4">
                                    <input type="text" name="reason_refuse" id="reason_refuse_front" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="button" id="modalRefuseImageFrontalCancel" class="btn btn-light me-3">Regresar</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="button" id="modalRefuseImageFrontalSubmit" class="btn btn-primary" data-url="{{ route('refuse.image.front', $user->id) }}">
                            <span class="indicator-label">Confirmar</span>
                            <span class="indicator-progress">Por favor espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        <!--end::Button-->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRefuseImageReverse" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="formRefuseImageReverse">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id_image_reverse">
                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div class=" me-n7 pe-7" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                            <div class="row pb-1 text-center">
                                <h4> Motivo de rechazo </h4>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 offset-sm-1 col-8 offset-2 text-center pt-4">
                                    <input type="text" name="reason_refuse" id="reason_refuse_reverse" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="button" id="modalRefuseImageReverseCancel" class="btn btn-light me-3">Regresar</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="button" id="modalRefuseImageReverseSubmit" class="btn btn-primary" data-url="{{ route('refuse.image.reverse', $user->id) }}">
                            <span class="indicator-label">Confirmar</span>
                            <span class="indicator-progress">Por favor espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        <!--end::Button-->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modals-->
@endsection

@section('scripts')
    <!--begin::Page Custom Javascript(used by this page)-->
    <script>

    </script>
    <script src="{{ asset('assets/js/user/verifyImageUser.js') }}"></script>
@endsection
