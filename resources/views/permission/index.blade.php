@extends('layouts.admin')

@section('title', 'Permisos')

@section('page-title', 'Listado de permisos')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-dark">Listado de permisos</li>
    </ul>
@endsection

@section('activeTabPanelAdmin', 'active')
@section('activeTabAdmin', 'active show')

@section('showMenuAccordionRolePermissions', 'show')
@section('activeMenuAccordionRolePermissions', 'active')
@section('activeMenuPermissionList', 'active')

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
                    <input type="text" data-kt-permissions-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Permissions" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_permission">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Add Permission
                </button>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                <!--begin::Table head-->
                <thead>
                <!--begin::Table row-->
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th class="min-w-250px">Descripción</th>
                    <th class="min-w-60px">Código</th>
                    <th class="min-w-250px">Asignado a</th>
                    <th class="text-end min-w-100px">Acciones</th>
                </tr>
                <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                @foreach( $permissions as $permission )
                    <tr>
                        <td>
                            {{ $permission->description }}
                        </td>
                        <td>
                            {{ $permission->name }}
                        </td>
                        <td>
                            <a href="../../demo7/dist/apps/user-management/roles/view.html" class="badge badge-light-primary fs-7 m-1">Administrator</a>
                            <a href="../../demo7/dist/apps/user-management/roles/view.html" class="badge badge-light-danger fs-7 m-1">Developer</a>
                            <a href="../../demo7/dist/apps/user-management/roles/view.html" class="badge badge-light-success fs-7 m-1">Analyst</a>
                            <a href="../../demo7/dist/apps/user-management/roles/view.html" class="badge badge-light-info fs-7 m-1">Support</a>
                            <a href="../../demo7/dist/apps/user-management/roles/view.html" class="badge badge-light-warning fs-7 m-1">Trial</a>
                        </td>
                        <!--end::Status=-->
                        <!--begin::Action=-->
                        <td class="text-end">
                            <!--begin::Update-->
                            <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-permission_id="{{ $permission->id }}" data-permission_name="{{ $permission->name }}" data-permission_description="{{ $permission->description }}" data-kt-permissions-action="update_row" {{--data-bs-toggle="modal" data-bs-target="#kt_modal_update_permission"--}}>
                                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
                                        <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                            <!--end::Update-->
                            <!--begin::Delete-->
                            <button class="btn btn-icon btn-active-light-primary w-30px h-30px" data-permission_id="{{ $permission->id }}" data-permission_name="{{ $permission->name }}" data-permission_description="{{ $permission->description }}" data-kt-permissions-action="delete_row">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                            <!--end::Delete-->
                        </td>
                        <!--end::Action=-->
                    </tr>
                @endforeach
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--begin::Modals-->
    <!--begin::Modal - Add permissions-->
    <div class="modal fade" id="kt_modal_add_permission" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header py-2">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Agregar nuevo permiso</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-permissions-modal-action="close">
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
                <div class="modal-body scroll-y mx-5 mx-xl-15">
                    <!--begin::Form-->
                    <form id="kt_modal_add_permission_form" class="form" action="#" data-kt-action="{{ route('permissions.store') }}" data-kt-redirect="{{ route('permissions.index') }}">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mb-2">
                                <span class="required">Código</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="El nombre en código es obligatorio."></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Ingrese el nombre en código" name="permission_name" />
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mb-2">
                                <span class="required">Descripción</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="La descripción del permiso es obligatoria."></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Ingrese la descripción" name="permission_description" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-custom form-check-solid me-9">
                                <input class="form-check-input" type="checkbox" checked value="" name="permissions_core" id="kt_permissions_core" />
                                <span class="form-check-label" for="kt_permissions_core">Asignar al administrador</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Disclaimer-->
                        <div class="text-gray-600">Si el permiso está
                            <strong class="me-1">agregado al administrador</strong>estará asignado
                            <strong class="me-1">automáticamente</strong>al rol Administrador</div>
                        <!--end::Disclaimer-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-permissions-modal-action="cancel">Descartar</button>
                            <button type="submit" class="btn btn-primary" data-kt-permissions-modal-action="submit">
                                <span class="indicator-label">Guardar permiso</span>
                                <span class="indicator-progress">Espere por favor...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Add permissions-->
    <!--begin::Modal - Update permissions-->
    <div class="modal fade" id="kt_modal_update_permission" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Modificar permiso</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-permissions-modal-action="close">
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
                <div class="modal-body scroll-y mx-5 mx-xl-15">
                    <!--begin::Notice-->
                    <!--begin::Notice-->
                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
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
                                <div class="fs-6 text-gray-700">
                                    <strong class="me-1">¡Advertencia!</strong>Al editar el nombre del permiso, puede romper la funcionalidad de permisos del sistema. Asegúrese de estar absolutamente seguro antes de continuar.</div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Notice-->
                    <!--end::Notice-->
                    <!--begin::Form-->
                    <form id="kt_modal_update_permission_form" class="form" action="#" data-kt-action="{{ route('permissions.update') }}" data-kt-redirect="{{ route('permissions.index') }}">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mb-2">
                                <span class="required">Código</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="El nombre en código es obligatorio."></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="hidden" name="permission_id" id="permission_id_edit">
                            <input class="form-control form-control-solid" id="permission_name_edit" placeholder="Ingrese el nombre en código" name="permission_name" />
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mb-2">
                                <span class="required">Descripción</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="La descripción del permiso es obligatoria."></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" id="permission_description_edit" placeholder="Ingrese la descripción" name="permission_description" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-permissions-modal-action="cancel">Descartar</button>
                            <button type="submit" class="btn btn-primary" data-kt-permissions-modal-action="submit">
                                <span class="indicator-label">Guardar cambios</span>
                                <span class="indicator-progress">Espere por favor...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Update permissions-->
    <!--end::Modals-->
@endsection

@section('scripts')
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script>
        $(document).ready(function(){
            $(document).on('click', '[data-kt-permissions-action="update_row"]', showModalEdit);
            $(document).on('click', '[data-kt-permissions-action="delete_row"]', showModalDelete);
        });
        function showModalEdit() {

            let idPermission = $(this).attr('data-permission_id');
            let name = $(this).attr('data-permission_name');
            let description = $(this).attr('data-permission_description');

            $("#permission_id_edit").val(idPermission);
            $("#permission_name_edit").val(name);
            $("#permission_description_edit").val(description);

            $("#kt_modal_update_permission").modal('show');
        }

        function showModalDelete() {
            var button = $(this);
            var description = button.attr('data-permission_description');
            var permission_id = button.attr('data-permission_id');
            Swal.fire({
                text: "¿Está seguro de eliminar el permiso " + description + "?",
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
                        url: '/dashboard/permission/destroy/'+permission_id,
                        method: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: JSON.stringify({ permission_id: permission_id }),
                        processData:false,
                        contentType:'application/json; charset=utf-8',
                        success: function (data) {
                            console.log(data);
                            Swal.fire({
                                text: "Has eliminado el permiso " + description + "!.",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, entenedido!",
                                customClass: {confirmButton: "btn fw-bold btn-primary"}
                            }).then((function () {
                                button.parent().parent().remove();
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
        }

    </script>
    <script src="{{ asset('assets/js/permission/list.js') }}"></script>
    <script src="{{ asset('assets/js/permission/add-permission.js') }}"></script>
    <script src="{{ asset('assets/js/permission/update-permission.js') }}"></script>
    {{--<script src="{{ asset('assets/js/permission/index.js') }}"></script>--}}
@endsection
