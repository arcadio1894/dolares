@extends('layouts.auth')

@section('title', 'Crear cuenta')

@section('content')
<div class="d-flex flex-column flex-lg-row-fluid py-10">
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column flex-column-fluid">
        <!--begin::Wrapper-->
        <div class="w-lg-600px p-10 p-lg-15 mx-auto">
            <!--begin::Form-->
            <form class="form w-100" method="POST" action="{{ route('register') }}" id="formRegister">
                @csrf
                <!--begin::Heading-->
                <div class="mb-10 text-center">
                    <!--begin::Title-->
                    <h1 class="text-dark mb-3">¡Regístrate!</h1>
                    <!--end::Title-->
                    <!--begin::Link-->
                    <div class="text-gray-400 fw-bold fs-4">¿Ya tienes una cuenta?
                        <a href="{{ route('login') }}" class="link-primary fw-bolder">¡Ingresa aquí!</a></div>
                    <!--end::Link-->
                </div>

                <div class="row">
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        <!--begin::Option-->
                        <input type="radio" class="btn-check" name="account_type" value="personal" checked="checked" id="kt_type_personal" />
                        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-5 d-flex align-items-center mb-10" for="kt_type_personal">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                            <span class="svg-icon svg-icon-3x me-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="black" />
                                    <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--begin::Info-->
                            <span class="d-block fw-bold text-start">
                                <span class="text-dark fw-bolder d-block fs-4 mb-2">Cuenta Personal</span>
                            </span>
                            <!--end::Info-->
                        </label>
                        <!--end::Option-->
                    </div>
                    <div class="col-lg-6">
                        <!--begin::Option-->
                        <input type="radio" class="btn-check" name="account_type" value="corporate" id="kt_type_corporate" />
                        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-5 d-flex align-items-center" for="kt_type_corporate">
                            <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                            <span class="svg-icon svg-icon-3x me-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black" />
                                    <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--begin::Info-->
                            <span class="d-block fw-bold text-start">
                                <span class="text-dark fw-bolder d-block fs-4 mb-2">Cuenta Empresarial</span>
                            </span>
                            <!--end::Info-->
                        </label>
                        <!--end::Option-->
                    </div>
                    <!--end::Col-->
                </div>

                <div class="row fv-row mb-7" id="personal_names">
                    <div class="col-xl-6">
                        <label class="form-label fw-bolder text-dark fs-6">Nombres</label>
                        <input class="form-control form-control-lg form-control-solid @error('first_name') is-invalid @enderror" type="text" placeholder="" name="first_name" id="first_name" autocomplete="off" required />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-xl-6">
                        <label class="form-label fw-bolder text-dark fs-6">Apellidos</label>
                        <input class="form-control form-control-lg form-control-solid @error('last_name') is-invalid @enderror" type="text" placeholder="" name="last_name" id="last_name" autocomplete="off" required />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row fv-row mb-7" id="business_names" {{--style="display: none"--}}>
                    <div class="col-xl-12">
                        <label class="form-label fw-bolder text-dark fs-6">Razón Social</label>
                        <input class="form-control form-control-lg form-control-solid @error('business_name') is-invalid @enderror" type="text" placeholder="" name="business_name" id="business_name" autocomplete="off" required />
                        @error('business_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row fv-row mb-7">
                    <div class="col-xl-6">
                        <label class="form-label fw-bolder text-dark fs-6">Teléfono</label>
                        <input class="form-control form-control-lg form-control-solid @error('phone') is-invalid @enderror" type="text" placeholder="" name="phone" autocomplete="off" required />
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-xl-6">
                        <label class="form-label fw-bolder text-dark fs-6" id="type_document">DNI/CE</label>

                        <input class="form-control form-control-lg form-control-solid @error('document') is-invalid @enderror" type="text" placeholder="" name="document" autocomplete="off" required />
                        @error('document')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row fv-row mb-7">
                    <label class="form-label fw-bolder text-dark fs-6" id="type_direction">Dirección</label>

                    <div class="col-xl-4">
                        <label class="form-label fw-bolder text-dark fs-6" >Departamento</label>
                        <select name="department" id="department" class="form-select form-select-solid @error('department') is-invalid @enderror" data-control="select2" data-hide-search="true" data-placeholder="Departamento">
                            <option></option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-xl-4">
                        <label class="form-label fw-bolder text-dark fs-6">Provincia</label>
                        <select name="province" disabled id="province" class="form-select form-select-solid @error('province') is-invalid @enderror" data-control="select2" data-hide-search="true" data-placeholder="Provincia">
                            <option></option>
                        </select>
                        @error('province')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-xl-4">
                        <label class="form-label fw-bolder text-dark fs-6">Distrito</label>
                        <select name="district" disabled id="district" class="form-select form-select-solid @error('district') is-invalid @enderror" data-control="select2" data-hide-search="true" data-placeholder="Distrito">
                            <option></option>
                        </select>
                        @error('district')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-xl-12 mt-3">
                        <input class="form-control form-control-lg form-control-solid @error('direction') is-invalid @enderror" type="text" placeholder="" name="direction" autocomplete="off" required />
                        @error('direction')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row fv-row mb-7" id="name_legal_representative_div" {{--style="display: none"--}}>
                    <div class="col-xl-12">
                        <label class="form-label fw-bolder text-dark fs-6">Nombre del representante legal</label>
                        <input class="form-control form-control-lg form-control-solid @error('name_legal_representative') is-invalid @enderror" type="text" placeholder="" name="name_legal_representative" id="name_legal_representative" autocomplete="off" required />
                        @error('name_legal_representative')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row fv-row mb-7" id="dni_legal_representative_div" {{--style="display: none"--}}>
                    <div class="col-xl-12">
                        <label class="form-label fw-bolder text-dark fs-6">DNI del representante legal</label>
                        <input class="form-control form-control-lg form-control-solid @error('dni_legal_representative') is-invalid @enderror" type="text" placeholder="" name="dni_legal_representative" id="dni_legal_representative" autocomplete="off" required />
                        @error('dni_legal_representative')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row fv-row mb-7" id="type_profession">
                    <div class="col-xl-12">
                        <label class="form-label fw-bolder text-dark fs-6">Profesión</label>
                        <input class="form-control form-control-lg form-control-solid @error('profession') is-invalid @enderror" type="text" placeholder="" name="profession" id="profession" autocomplete="off" required />
                        @error('profession')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row fv-row mb-7" id="economic_activity_div" {{--style="display: none"--}}>
                    <div class="col-xl-12">
                        <label class="form-label fw-bolder text-dark fs-6">Actividad económica</label>
                        <select name="economic_activity" id="economic_activity" class="form-select form-select-solid @error('economic_activity') is-invalid @enderror" data-control="select2" data-hide-search="true" data-placeholder="Actividad económica">
                            <option></option>
                            @foreach ($activities as $activity)
                            <option value="{{$activity->id}}">{{ $activity->description }}</option>
                            @endforeach
                        </select>
                        @error('economic_activity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row fv-row mb-7" id="economic_sector_div" {{--style="display: none"--}}>
                    <div class="col-xl-12">
                        <label class="form-label fw-bolder text-dark fs-6">Sector económico</label>
                        <select name="economic_sector" id="economic_sector" class="form-select form-select-solid @error('economic_sector') is-invalid @enderror" data-control="select2" data-hide-search="true" data-placeholder="Sector económico">
                            <option></option>
                            @foreach ($sectors as $sector)
                                <option value="{{$sector->id}}">{{ $sector->description }}</option>
                            @endforeach
                        </select>
                        @error('economic_sector')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row fv-row mb-7" id="constitution_date" {{--style="display: none"--}}>
                    <div class="col-xl-6">
                        <label class="form-label fw-bolder text-dark fs-6">Fecha de constitución</label>
                        <div class="position-relative d-flex align-items-center">
                            <!--begin::Datepicker-->
                            <input class="form-control form-control-white fw-bolder pe-5" placeholder="Seleccione fecha" name="constitution_date" id="const_date" />
                            <!--end::Datepicker-->
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                            <span class="svg-icon svg-icon-2 position-absolute end-0 ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                        </div>
                        @error('constitution_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-xl-6">
                        <div class="d-flex flex-stack">
                            <!--begin::Label-->
                            <div class="me-5">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold">¿La empresa es estatal?</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div class="fs-7 fw-bold text-muted">Si se activa, indica que la empresa es estatal</div>
                                <!--end::Input-->
                            </div>
                            <!--end::Label-->
                            <!--begin::Switch-->
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" name="state_company" id="state_company" type="checkbox" value="1" />
                            </label>
                            <!--end::Switch-->
                        </div>
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <label class="form-label fw-bolder text-dark fs-6">Email</label>
                    <input class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="email" placeholder="" name="email" autocomplete="off" required />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-10 fv-row" data-kt-password-meter="true">
                    <!--begin::Wrapper-->
                    <div class="mb-1">
                        <!--begin::Label-->
                        <label class="form-label fw-bolder text-dark fs-6">Password</label>
                        <!--end::Label-->
                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-3">
                            <input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" type="password" placeholder="" name="password" autocomplete="off" required />
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                            <i class="bi bi-eye-slash fs-2"></i>
                            <i class="bi bi-eye fs-2 d-none"></i>
                        </span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <!--end::Input wrapper-->
                        <!--begin::Meter-->
                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                        <!--end::Meter-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Hint-->
                    <div class="text-muted">Use mínimo 8 or más caracteres con letras, números &amp; símbolos. No es obligatorio</div>
                    <!--end::Hint-->
                </div>

                <div class="fv-row mb-5">
                    <label class="form-label fw-bolder text-dark fs-6">Confirmar Password</label>
                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password_confirmation" autocomplete="off" required/>
                </div>

                <div class="fv-row mb-10">
                    <label class="form-check form-check-custom form-check-solid form-check-inline">
                        <input class="form-check-input" type="checkbox" name="toc" value="1" />
                        <span class="form-check-label fw-bold text-gray-700 fs-6">Estoy de acuerdo con los
                            <a href="#" class="ms-1 link-primary">Términos y condiciones</a>.
                        </span>
                    </label>
                </div>
                <!--end::Input group-->
                <!--begin::Actions-->
                <div class="text-center">
                    <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                        <span class="indicator-label">Crear cuenta</span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->
    <!--begin::Footer-->
    <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
        <!--begin::Links-->
        <div class="d-flex flex-center fw-bold fs-6">
            <a href="https://dolareros.com/" class="text-muted text-hover-primary px-2" target="_blank">Dolareros</a>
            <a href="https://api.whatsapp.com/send?phone=51921867035&amp;text=Hola%20necesito%20ayuda" class="text-muted text-hover-primary px-2" target="_blank">Soporte</a>
        </div>
        <!--end::Links-->
    </div>
    <!--end::Footer-->
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            // Inputs a habilitar
            $('#type_document').html('DNI/CE');
            $('#type_direction').html('Dirección');
            $('#first_name').prop('disabled', false).show();
            $('#last_name').prop('disabled', false).show();
            $('#profession').prop('disabled', false).show();

            // Divs a mostrar
            $('#personal_names').show();
            $('#type_profession').show();

            // Inputs a deshabilitar
            $('#business_name').prop('disabled', true).hide();
            $('#name_legal_representative').prop('disabled', true).hide();
            $('#dni_legal_representative').prop('disabled', true).hide();
            $('#economic_activity').prop('disabled', true).hide();
            $('#economic_sector').prop('disabled', true).hide();
            $('#const_date').prop('disabled', true).hide();

            // Divs a ocultar
            $('#business_names').hide();
            $('#economic_activity_div').hide();
            $('#economic_sector_div').hide();
            $('#constitution_date').hide();
            $('#name_legal_representative_div').hide();
            $('#dni_legal_representative_div').hide();

            $("#department").select2({
                minimumResultsForSearch: Infinity,
            });

            $("#province").select2({
                minimumResultsForSearch: Infinity,
            });

            $("#district").select2({
                minimumResultsForSearch: Infinity,
            });

            $("#const_date").flatpickr({
                enableTime: !1,
                dateFormat: "d/m/Y"
            });

            $('input[name="account_type"]').change(function() {
                if ($(this).val() === 'personal') {
                    // Inputs a habilitar
                    $('#type_document').html('DNI/CE');
                    $('#type_direction').html('Dirección');
                    $('#first_name').prop('disabled', false).show();
                    $('#last_name').prop('disabled', false).show();
                    $('#profession').prop('disabled', false).show();

                    // Divs a mostrar
                    $('#personal_names').show();
                    $('#type_profession').show();

                    // Inputs a deshabilitar
                    $('#business_name').prop('disabled', true).hide();
                    $('#name_legal_representative').prop('disabled', true).hide();
                    $('#dni_legal_representative').prop('disabled', true).hide();
                    $('#economic_activity').prop('disabled', true).hide();
                    $('#economic_sector').prop('disabled', true).hide();
                    $('#const_date').prop('disabled', true).hide();

                    // Divs a ocultar
                    $('#business_names').hide();
                    $('#economic_activity_div').hide();
                    $('#economic_sector_div').hide();
                    $('#constitution_date').hide();
                    $('#name_legal_representative_div').hide();
                    $('#dni_legal_representative_div').hide();

                } else if ($(this).val() === 'corporate') {
                    // Inputs a deshabilitar
                    $('#type_document').html('RUC');
                    $('#type_direction').html('Dirección Fiscal');
                    $('#first_name').prop('disabled', true).hide();
                    $('#last_name').prop('disabled', true).hide();
                    $('#profession').prop('disabled', true).hide();

                    // Divs a ocultar
                    $('#personal_names').hide();
                    $('#type_profession').hide();

                    // Inputs a habilitar
                    $('#business_name').prop('disabled', false).show();
                    $('#name_legal_representative').prop('disabled', false).show();
                    $('#dni_legal_representative').prop('disabled', false).show();
                    $('#economic_activity').prop('disabled', false).show();
                    $('#economic_sector').prop('disabled', false).show();
                    $('#const_date').prop('disabled', false).show();

                    // Divs a mostrar
                    $('#business_names').show();
                    $('#economic_activity_div').show();
                    $('#economic_sector_div').show();
                    $('#constitution_date').show();
                    $('#name_legal_representative_div').show();
                    $('#dni_legal_representative_div').show();
                }
            });

            $selectDepartments = $('#department');
            $selectProvince = $('#province');
            $selectDistrict = $('#district');

            $selectDepartments.val(null);

            $selectDepartments.change(function () {
                var departamento =  $selectDepartments.val();

                $selectProvince.attr('disabled', 'disabled');
                $selectDistrict.attr('disabled', 'disabled');

                $selectProvince.empty();
                $selectProvince.val('');
                //$selectProvince.trigger('change');
                $selectDistrict.empty();
                $selectDistrict.val('');
                //$selectDistrict.trigger('change');

                $.get( "/get/province/of/department/"+departamento, function( data ) {
                    $selectProvince.append($("<option>", {
                        value: '',
                        text: ''
                    }));
                    for ( var i=0; i<data.length; i++ )
                    {
                        $selectProvince.append($("<option>", {
                            value: data[i].id,
                            text: data[i].name
                        }));
                    }

                    $selectProvince.removeAttr('disabled');
                });

            });

            $selectProvince.change(function () {
                var provincia =  $selectProvince.val();

                $selectDistrict.attr('disabled', 'disabled');

                $selectDistrict.empty();
                $selectDistrict.val('');

                $.get( "/get/district/of/province/"+provincia, function( data ) {
                    $selectDistrict.append($("<option>", {
                        value: '',
                        text: ''
                    }));
                    for ( var i=0; i<data.length; i++ )
                    {
                        $selectDistrict.append($("<option>", {
                            value: data[i].id,
                            text: data[i].name
                        }));
                    }
                    $selectDistrict.removeAttr('disabled');
                });

            });
        });
        var $selectDepartments;
        var $selectProvince;
        var $selectDistrict;
    </script>
@endsection
