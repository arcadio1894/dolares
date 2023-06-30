@extends('layouts.admin')

@section('title', 'Usuarios')

@section('page-title', 'Información de usuarios')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-dark">Información del usuario</li>
    </ul>
@endsection

@section('activeTabPanelAdmin', 'active')
@section('activeTabAdmin', 'active show')

@section('showMenuAccordionRolePermissions', 'show')
@section('activeMenuAccordionRolePermissions', 'active')
@section('activeMenuUserList', 'active')

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
    <div class="d-flex flex-column flex-xl-row">
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
            <!--begin::Card-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Summary-->
                    <!--begin::User Info-->
                    <div class="d-flex flex-center flex-column py-5">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-circle symbol-100px overflow-hidden me-3">
                            <a href="#">
                                <div class="symbol-label fs-1 bg-light-danger text-danger">{{ $userData['avatar'] }}</div>
                            </a>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{ $userData['name'] }}</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="mb-9">
                            <!--begin::Badge-->
                            <div class="badge badge-lg badge-light-primary d-inline">{{ $userData['role_description'] }}</div>
                            <!--begin::Badge-->
                        </div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <!--begin::Info heading-->
                        <div class="fw-bolder mb-3">Cantidad de operaciones
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Number of support tickets assigned, closed and pending this week."></i>
                        </div>
                        <!--end::Info heading-->
                        <div class="d-flex flex-wrap flex-center">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="fs-4 fw-bolder text-gray-700">
                                    <span class="w-75px">{{ $userData['cantProcessing'] }}</span>
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                    <span class="svg-icon svg-icon-3 svg-icon-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                                            <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <div class="fw-bold text-muted">En proceso</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                <div class="fs-4 fw-bolder text-gray-700">
                                    <span class="w-50px">{{ $userData['cantRefuse'] }}</span>
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                    <span class="svg-icon svg-icon-3 svg-icon-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="black" />
                                            <path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <div class="fw-bold text-muted">Rechazada</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="fs-4 fw-bolder text-gray-700">
                                    <span class="w-50px">{{ $userData['cantFinish'] }}</span>
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                    <span class="svg-icon svg-icon-3 svg-icon-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                                            <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <div class="fw-bold text-muted">Terminada</div>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User Info-->
                    <!--end::Summary-->
                    <!--begin::Details toggle-->
                    <div class="d-flex flex-stack fs-4 py-3">
                        <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Información
                            <span class="ms-2 rotate-180">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Editar detalles del usuario">
                            <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_details">Modificar</a>
                        </span>
                    </div>
                    <!--end::Details toggle-->
                    <div class="separator"></div>
                    <!--begin::Details content-->
                    <div id="kt_user_view_details" class="collapse show">
                        @if ( Auth::user()->account_type == 'p' )
                            <div class="pb-5 fs-6">
                                <div class="fw-bolder mt-5">Correo electrónico</div>
                                <div class="text-gray-600">{{ $userData['email'] }}</div>

                                <div class="fw-bolder mt-5">DNI/CE</div>
                                <div class="text-gray-600">{{ $userData['document'] }}</div>

                                <div class="fw-bolder mt-5">Teléfono</div>
                                <div class="text-gray-600">{{ $userData['phone'] }}</div>

                                <div class="fw-bolder mt-5">Dirección</div>
                                <div class="text-gray-600">{{ $userData['direction'] }}</div>

                                <div class="fw-bolder mt-5">Profesión</div>
                                <div class="text-gray-600">{{ $userData['profession'] }}</div>

                                <div class="fw-bolder mt-5">Fecha de registro</div>
                                <div class="text-gray-600">{{ $userData['joined_date'] }}</div>

                                <div class="fw-bolder mt-5">Ultima sesión</div>
                                <div class="text-gray-600">{{ $userData['last_login'] }}</div>

                                <div class="fw-bolder mt-5">Archivos</div>
                                <div class="text-gray-600">
                                    <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                                        <div class="row text-center">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                            <br>
                                            @if ( substr($userData['imageFront'],-3) === 'pdf' )
                                                <div class="col-lg-12">
                                                    <a target="_blank" href="{{ asset('assets/images/user/documents/'.$userData['imageFront']) }}" class="btn btn-success col-lg-12">Ver PDF</a>
                                                </div>
                                            @else
                                                <img class="img-fluid" src="{{ asset('assets/images/user/documents/'.$userData['imageFront']) }}" alt="Imagen frontal de documento" width="40px">
                                            @endif
                                            <br>
                                        </div>

                                    </div>
                                    <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                            <br>
                                            @if ( substr($userData['imageReverse'],-3) == 'pdf' )
                                                <a target="_blank" href="{{ asset('assets/images/user/documents/'.$userData['imageReverse']) }}" class="btn btn-outline-success">Ver PDF</a>
                                            @else
                                                <img class="img-fluid" src="{{ asset('assets/images/user/documents/'.$userData['imageReverse']) }}" alt="Imagen frontal de documento" width="40px">
                                            @endif
                                            <br>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        @else
                            <div class="pb-5 fs-6">
                                <div class="fw-bolder mt-5">Correo electrónico</div>
                                <div class="text-gray-600">{{ $userData['email'] }}</div>

                                <div class="fw-bolder mt-5">RUC</div>
                                <div class="text-gray-600">{{ $userData['document'] }}</div>

                                <div class="fw-bolder mt-5">Teléfono</div>
                                <div class="text-gray-600">{{ $userData['phone'] }}</div>

                                <div class="fw-bolder mt-5">Dirección Fiscal</div>
                                <div class="text-gray-600">{{ $userData['direction'] }}</div>

                                <div class="fw-bolder mt-5">Nombre del representante legal</div>
                                <div class="text-gray-600">{{ $userData['name_legal_representative'] }}</div>

                                <div class="fw-bolder mt-5">DNI del representante legal</div>
                                <div class="text-gray-600">{{ $userData['dni_legal_representative'] }}</div>

                                <div class="fw-bolder mt-5">Sector económico</div>
                                <div class="text-gray-600">{{ $userData['economic_sector'] }}</div>

                                <div class="fw-bolder mt-5">Actividad económica</div>
                                <div class="text-gray-600">{{ $userData['economic_activity'] }}</div>

                                <div class="fw-bolder mt-5">Fecha de constitución</div>
                                <div class="text-gray-600">{{ $userData['constitution_date'] }}</div>

                                <div class="fw-bolder mt-5">¿Es empresa estatal?</div>
                                <div class="text-gray-600">{{ $userData['state_company'] }}</div>

                                <div class="fw-bolder mt-5">Fecha de registro</div>
                                <div class="text-gray-600">{{ $userData['joined_date'] }}</div>

                                <div class="fw-bolder mt-5">Ultima sesión</div>
                                <div class="text-gray-600">{{ $userData['last_login'] }}</div>

                                <div class="fw-bolder mt-5">Archivos</div>
                                <div class="text-gray-600">
                                    <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                                        <div class="row text-center">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen frontal del documento</label>
                                            <br>
                                            @if ( substr($userData['imageFront'],-3) === 'pdf' )
                                                <div class="col-lg-12">
                                                    <a target="_blank" href="{{ asset('assets/images/user/documents/'.$userData['imageFront']) }}" class="btn btn-success col-lg-12">Ver PDF</a>
                                                </div>
                                            @else
                                                <img class="img-fluid" src="{{ asset('assets/images/user/documents/'.$userData['imageFront']) }}" alt="Imagen frontal de documento" width="40px">
                                            @endif
                                            <br>
                                        </div>

                                    </div>
                                    <div class="text-center notice d-flex bg-light-primary rounded border-success border border-dashed p-3 mb-5">
                                        <div class="row">
                                            <label class="col-lg-12 fw-bolder fs-7 text-gray-800">Imagen reverso del documento</label>
                                            <br>
                                            @if ( substr($userData['imageReverse'],-3) == 'pdf' )
                                                <div class="col-lg-12">
                                                    <a target="_blank" href="{{ asset('assets/images/user/documents/'.$userData['imageReverse']) }}" class="btn btn-outline-success col-lg-12">Ver PDF</a>
                                                </div>
                                            @else
                                                <img class="img-fluid" src="{{ asset('assets/images/user/documents/'.$userData['imageReverse']) }}" alt="Imagen frontal de documento" width="40px">
                                            @endif
                                            <br>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>
                    <!--end::Details content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Sidebar-->
        <!--begin::Content-->
        <div class="flex-lg-row-fluid ms-lg-15">
            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_user_view_accounts_tab">Cuentas</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_operations_tab">Operaciones</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_credentials_tab">Credenciales</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                {{--<li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_user_view_overview_events_and_logs_tab">Events &amp; Logs</a>
                </li>--}}
                <!--end:::Tab item-->
            </ul>
            <!--end:::Tabs-->
            <!--begin:::Tab content-->
            <div class="tab-content" id="myTabContent">
                <!--begin:::Tab pane-->
                <div class="tab-pane fade show active" id="kt_user_view_accounts_tab" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card card-flush mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h2 class="mb-1">Cuentas del usuario</h2>
                                <div class="fs-6 fw-bold text-muted">Listado de cuentas del usuario</div>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_schedule">
                                    <!--SVG file not found: media/icons/duotune/art/art008.svg-->
                                    Agregar Cuenta</button>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9 pt-4">

                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->
                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="kt_user_view_operations_tab" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card card-flush mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h2 class="mb-1">Operaciones del usuario</h2>
                                <div class="fs-6 fw-bold text-muted">Listado de operaciones del usuario</div>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9 pt-4">

                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->
                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="kt_user_view_credentials_tab" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Credenciales</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0 pb-5">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                                    <!--begin::Table body-->
                                    <tbody class="fs-6 fw-bold text-gray-600">
                                    <tr>
                                        <td>Email</td>
                                        <td>e.smith@kpmg.com.au</td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_email">
                                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td>******</td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_password">
                                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td>Administrator</td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">
                                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->
                <!--begin:::Tab pane-->
                {{--<div class="tab-pane fade" id="kt_user_view_overview_events_and_logs_tab" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Login Sessions</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Filter-->
                                <button type="button" class="btn btn-sm btn-flex btn-light-primary" id="kt_modal_sign_out_sesions">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr077.svg-->
                                    <span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="4" y="11" width="12" height="2" rx="1" fill="black" />
																<path d="M5.86875 11.6927L7.62435 10.2297C8.09457 9.83785 8.12683 9.12683 7.69401 8.69401C7.3043 8.3043 6.67836 8.28591 6.26643 8.65206L3.34084 11.2526C2.89332 11.6504 2.89332 12.3496 3.34084 12.7474L6.26643 15.3479C6.67836 15.7141 7.3043 15.6957 7.69401 15.306C8.12683 14.8732 8.09458 14.1621 7.62435 13.7703L5.86875 12.3073C5.67684 12.1474 5.67684 11.8526 5.86875 11.6927Z" fill="black" />
																<path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z" fill="#C4C4C4" />
															</svg>
														</span>
                                    <!--end::Svg Icon-->Sign out all sessions</button>
                                <!--end::Filter-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0 pb-5">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                                    <!--begin::Table head-->
                                    <thead class="border-bottom border-gray-200 fs-7 fw-bolder">
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted text-uppercase gs-0">
                                        <th class="min-w-100px">Location</th>
                                        <th>Device</th>
                                        <th>IP Address</th>
                                        <th class="min-w-125px">Time</th>
                                        <th class="min-w-70px">Actions</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fs-6 fw-bold text-gray-600">
                                    <tr>
                                        <!--begin::Invoice=-->
                                        <td>Australia</td>
                                        <!--end::Invoice=-->
                                        <!--begin::Status=-->
                                        <td>Chome - Windows</td>
                                        <!--end::Status=-->
                                        <!--begin::Amount=-->
                                        <td>207.36.17.328</td>
                                        <!--end::Amount=-->
                                        <!--begin::Date=-->
                                        <td>23 seconds ago</td>
                                        <!--end::Date=-->
                                        <!--begin::Action=-->
                                        <td>Current session</td>
                                        <!--end::Action=-->
                                    </tr>
                                    <tr>
                                        <!--begin::Invoice=-->
                                        <td>Australia</td>
                                        <!--end::Invoice=-->
                                        <!--begin::Status=-->
                                        <td>Safari - iOS</td>
                                        <!--end::Status=-->
                                        <!--begin::Amount=-->
                                        <td>207.17.48.291</td>
                                        <!--end::Amount=-->
                                        <!--begin::Date=-->
                                        <td>3 days ago</td>
                                        <!--end::Date=-->
                                        <!--begin::Action=-->
                                        <td>
                                            <a href="#" data-kt-users-sign-out="single_user">Sign out</a>
                                        </td>
                                        <!--end::Action=-->
                                    </tr>
                                    <tr>
                                        <!--begin::Invoice=-->
                                        <td>Australia</td>
                                        <!--end::Invoice=-->
                                        <!--begin::Status=-->
                                        <td>Chrome - Windows</td>
                                        <!--end::Status=-->
                                        <!--begin::Amount=-->
                                        <td>207.46.33.69</td>
                                        <!--end::Amount=-->
                                        <!--begin::Date=-->
                                        <td>last week</td>
                                        <!--end::Date=-->
                                        <!--begin::Action=-->
                                        <td>Expired</td>
                                        <!--end::Action=-->
                                    </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Logs</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Button-->
                                <button type="button" class="btn btn-sm btn-light-primary">
                                    <!--begin::Svg Icon | path: icons/duotune/files/fil021.svg-->
                                    <span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M19 15C20.7 15 22 13.7 22 12C22 10.3 20.7 9 19 9C18.9 9 18.9 9 18.8 9C18.9 8.7 19 8.3 19 8C19 6.3 17.7 5 16 5C15.4 5 14.8 5.2 14.3 5.5C13.4 4 11.8 3 10 3C7.2 3 5 5.2 5 8C5 8.3 5 8.7 5.1 9H5C3.3 9 2 10.3 2 12C2 13.7 3.3 15 5 15H19Z" fill="black" />
																<path d="M13 17.4V12C13 11.4 12.6 11 12 11C11.4 11 11 11.4 11 12V17.4H13Z" fill="black" />
																<path opacity="0.3" d="M8 17.4H16L12.7 20.7C12.3 21.1 11.7 21.1 11.3 20.7L8 17.4Z" fill="black" />
															</svg>
														</span>
                                    <!--end::Svg Icon-->Download Report</button>
                                <!--end::Button-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body py-0">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fw-bold text-gray-600 fs-6 gy-5" id="kt_table_users_logs">
                                    <!--begin::Table body-->
                                    <tbody>
                                    <!--begin::Table row-->
                                    <tr>
                                        <!--begin::Badge=-->
                                        <td class="min-w-70px">
                                            <div class="badge badge-light-danger">500 ERR</div>
                                        </td>
                                        <!--end::Badge=-->
                                        <!--begin::Status=-->
                                        <td>POST /v1/invoice/in_1173_4000/invalid</td>
                                        <!--end::Status=-->
                                        <!--begin::Timestamp=-->
                                        <td class="pe-0 text-end min-w-200px">05 May 2021, 5:30 pm</td>
                                        <!--end::Timestamp=-->
                                    </tr>
                                    <!--end::Table row-->
                                    <!--begin::Table row-->
                                    <tr>
                                        <!--begin::Badge=-->
                                        <td class="min-w-70px">
                                            <div class="badge badge-light-success">200 OK</div>
                                        </td>
                                        <!--end::Badge=-->
                                        <!--begin::Status=-->
                                        <td>POST /v1/invoices/in_3771_9196/payment</td>
                                        <!--end::Status=-->
                                        <!--begin::Timestamp=-->
                                        <td class="pe-0 text-end min-w-200px">19 Aug 2021, 8:43 pm</td>
                                        <!--end::Timestamp=-->
                                    </tr>
                                    <!--end::Table row-->
                                    <!--begin::Table row-->
                                    <tr>
                                        <!--begin::Badge=-->
                                        <td class="min-w-70px">
                                            <div class="badge badge-light-danger">500 ERR</div>
                                        </td>
                                        <!--end::Badge=-->
                                        <!--begin::Status=-->
                                        <td>POST /v1/invoice/in_1173_4000/invalid</td>
                                        <!--end::Status=-->
                                        <!--begin::Timestamp=-->
                                        <td class="pe-0 text-end min-w-200px">25 Jul 2021, 6:43 am</td>
                                        <!--end::Timestamp=-->
                                    </tr>
                                    <!--end::Table row-->
                                    <!--begin::Table row-->
                                    <tr>
                                        <!--begin::Badge=-->
                                        <td class="min-w-70px">
                                            <div class="badge badge-light-success">200 OK</div>
                                        </td>
                                        <!--end::Badge=-->
                                        <!--begin::Status=-->
                                        <td>POST /v1/invoices/in_3576_4152/payment</td>
                                        <!--end::Status=-->
                                        <!--begin::Timestamp=-->
                                        <td class="pe-0 text-end min-w-200px">25 Oct 2021, 5:30 pm</td>
                                        <!--end::Timestamp=-->
                                    </tr>
                                    <!--end::Table row-->
                                    <!--begin::Table row-->
                                    <tr>
                                        <!--begin::Badge=-->
                                        <td class="min-w-70px">
                                            <div class="badge badge-light-warning">404 WRN</div>
                                        </td>
                                        <!--end::Badge=-->
                                        <!--begin::Status=-->
                                        <td>POST /v1/customer/c_614857c524512/not_found</td>
                                        <!--end::Status=-->
                                        <!--begin::Timestamp=-->
                                        <td class="pe-0 text-end min-w-200px">24 Jun 2021, 6:05 pm</td>
                                        <!--end::Timestamp=-->
                                    </tr>
                                    <!--end::Table row-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Events</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Button-->
                                <button type="button" class="btn btn-sm btn-light-primary">
                                    <!--begin::Svg Icon | path: icons/duotune/files/fil021.svg-->
                                    <span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M19 15C20.7 15 22 13.7 22 12C22 10.3 20.7 9 19 9C18.9 9 18.9 9 18.8 9C18.9 8.7 19 8.3 19 8C19 6.3 17.7 5 16 5C15.4 5 14.8 5.2 14.3 5.5C13.4 4 11.8 3 10 3C7.2 3 5 5.2 5 8C5 8.3 5 8.7 5.1 9H5C3.3 9 2 10.3 2 12C2 13.7 3.3 15 5 15H19Z" fill="black" />
																<path d="M13 17.4V12C13 11.4 12.6 11 12 11C11.4 11 11 11.4 11 12V17.4H13Z" fill="black" />
																<path opacity="0.3" d="M8 17.4H16L12.7 20.7C12.3 21.1 11.7 21.1 11.3 20.7L8 17.4Z" fill="black" />
															</svg>
														</span>
                                    <!--end::Svg Icon-->Download Report</button>
                                <!--end::Button-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body py-0">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 text-gray-600 fw-bold gy-5" id="kt_table_customers_events">
                                <!--begin::Table body-->
                                <tbody>
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Event=-->
                                    <td class="min-w-400px">
                                        <a href="#" class="text-gray-600 text-hover-primary me-1">Max Smith</a>has made payment to
                                        <a href="#" class="fw-bolder text-gray-900 text-hover-primary">#SDK-45670</a></td>
                                    <!--end::Event=-->
                                    <!--begin::Timestamp=-->
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">20 Dec 2021, 11:05 am</td>
                                    <!--end::Timestamp=-->
                                </tr>
                                <!--end::Table row-->
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Event=-->
                                    <td class="min-w-400px">
                                        <a href="#" class="text-gray-600 text-hover-primary me-1">Melody Macy</a>has made payment to
                                        <a href="#" class="fw-bolder text-gray-900 text-hover-primary">#XRS-45670</a></td>
                                    <!--end::Event=-->
                                    <!--begin::Timestamp=-->
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">25 Jul 2021, 6:43 am</td>
                                    <!--end::Timestamp=-->
                                </tr>
                                <!--end::Table row-->
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Event=-->
                                    <td class="min-w-400px">
                                        <a href="#" class="text-gray-600 text-hover-primary me-1">Sean Bean</a>has made payment to
                                        <a href="#" class="fw-bolder text-gray-900 text-hover-primary">#XRS-45670</a></td>
                                    <!--end::Event=-->
                                    <!--begin::Timestamp=-->
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">22 Sep 2021, 6:05 pm</td>
                                    <!--end::Timestamp=-->
                                </tr>
                                <!--end::Table row-->
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Event=-->
                                    <td class="min-w-400px">
                                        <a href="#" class="text-gray-600 text-hover-primary me-1">Emma Smith</a>has made payment to
                                        <a href="#" class="fw-bolder text-gray-900 text-hover-primary">#XRS-45670</a></td>
                                    <!--end::Event=-->
                                    <!--begin::Timestamp=-->
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">20 Dec 2021, 9:23 pm</td>
                                    <!--end::Timestamp=-->
                                </tr>
                                <!--end::Table row-->
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Event=-->
                                    <td class="min-w-400px">Invoice
                                        <a href="#" class="fw-bolder text-gray-900 text-hover-primary me-1">#KIO-45656</a>status has changed from
                                        <span class="badge badge-light-succees me-1">In Transit</span>to
                                        <span class="badge badge-light-success">Approved</span></td>
                                    <!--end::Event=-->
                                    <!--begin::Timestamp=-->
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">24 Jun 2021, 6:05 pm</td>
                                    <!--end::Timestamp=-->
                                </tr>
                                <!--end::Table row-->
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Event=-->
                                    <td class="min-w-400px">
                                        <a href="#" class="text-gray-600 text-hover-primary me-1">Brian Cox</a>has made payment to
                                        <a href="#" class="fw-bolder text-gray-900 text-hover-primary">#OLP-45690</a></td>
                                    <!--end::Event=-->
                                    <!--begin::Timestamp=-->
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">20 Jun 2021, 11:05 am</td>
                                    <!--end::Timestamp=-->
                                </tr>
                                <!--end::Table row-->
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Event=-->
                                    <td class="min-w-400px">Invoice
                                        <a href="#" class="fw-bolder text-gray-900 text-hover-primary me-1">#KIO-45656</a>status has changed from
                                        <span class="badge badge-light-succees me-1">In Transit</span>to
                                        <span class="badge badge-light-success">Approved</span></td>
                                    <!--end::Event=-->
                                    <!--begin::Timestamp=-->
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">21 Feb 2021, 5:20 pm</td>
                                    <!--end::Timestamp=-->
                                </tr>
                                <!--end::Table row-->
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Event=-->
                                    <td class="min-w-400px">Invoice
                                        <a href="#" class="fw-bolder text-gray-900 text-hover-primary me-1">#SEP-45656</a>status has changed from
                                        <span class="badge badge-light-warning me-1">Pending</span>to
                                        <span class="badge badge-light-info">In Progress</span></td>
                                    <!--end::Event=-->
                                    <!--begin::Timestamp=-->
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">20 Dec 2021, 11:30 am</td>
                                    <!--end::Timestamp=-->
                                </tr>
                                <!--end::Table row-->
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Event=-->
                                    <td class="min-w-400px">
                                        <a href="#" class="text-gray-600 text-hover-primary me-1">Emma Smith</a>has made payment to
                                        <a href="#" class="fw-bolder text-gray-900 text-hover-primary">#XRS-45670</a></td>
                                    <!--end::Event=-->
                                    <!--begin::Timestamp=-->
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">22 Sep 2021, 2:40 pm</td>
                                    <!--end::Timestamp=-->
                                </tr>
                                <!--end::Table row-->
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Event=-->
                                    <td class="min-w-400px">
                                        <a href="#" class="text-gray-600 text-hover-primary me-1">Max Smith</a>has made payment to
                                        <a href="#" class="fw-bolder text-gray-900 text-hover-primary">#SDK-45670</a></td>
                                    <!--end::Event=-->
                                    <!--begin::Timestamp=-->
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">25 Jul 2021, 5:20 pm</td>
                                    <!--end::Timestamp=-->
                                </tr>
                                <!--end::Table row-->
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                --}}<!--end:::Tab pane-->
            </div>
            <!--end:::Tab content-->
        </div>
        <!--end::Content-->
    </div>
@endsection

@section('scripts')
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script>
        $(document).ready(function(){
            /*$(document).on('click', '[data-kt-users-table-filter="update_row"]', showModalEdit);
            $(document).on('click', '[data-kt-users-table-filter="delete_row"]', showModalDelete);*/
        });
        /*function showModalEdit() {

            $('input[name="role_edit"]').each(function() {
                $(this).prop('checked', false);
            });

            let user_id = $(this).attr('data-users-id');
            let first_name = $(this).attr('data-users-first_name');
            let last_name = $(this).attr('data-users-last_name');
            let email = $(this).attr('data-users-email');
            let phone = $(this).attr('data-users-phone');
            let document = $(this).attr('data-users-document');
            let role_id = $(this).attr('data-users-role_id');

            console.log(role_id);

            $("#user_id_edit").val(user_id);
            $("#first_name_edit").val(first_name);
            $("#last_name_edit").val(last_name);
            $("#email_edit").val(email);
            $("#phone_edit").val(phone);
            $("#document_edit").val(document);

            $('input[name="role_edit"]').each(function() {
                console.log("Entre");
                if ($(this).val() === role_id) {
                    console.log("Encontre");
                    $(this).prop('checked', true);
                    return false;
                }
            });

            $("#kt_modal_update_user").modal('show');
        }

        function showModalDelete() {
            var button = $(this);
            var user_id = button.attr('data-users-id');
            var name = button.attr('data-users-name');
            Swal.fire({
                text: "¿Está seguro de eliminar al usuario " + name + "?",
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
                        url: '/dashboard/user/destroy/'+user_id,
                        method: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: JSON.stringify({ user_id: user_id }),
                        processData:false,
                        contentType:'application/json; charset=utf-8',
                        success: function (data) {
                            console.log(data);
                            Swal.fire({
                                text: "Has eliminado al usuario " + name + "!.",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, entenedido!",
                                customClass: {confirmButton: "btn fw-bold btn-primary"}
                            }).then((function () {
                                button.parent().parent().parent().parent().remove();
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
                    text: description + " no fue eliminado.",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, entendido!",
                    customClass: {confirmButton: "btn fw-bold btn-primary"}
                })
            }))
        }*/

    </script>
    {{--<script src="{{ asset('assets/js/user/list.js') }}"></script>
    <script src="{{ asset('assets/js/user/add-user.js') }}"></script>
    <script src="{{ asset('assets/js/user/update-user.js') }}"></script>--}}
    {{--<script src="{{ asset('assets/js/permission/index.js') }}"></script>--}}
@endsection
