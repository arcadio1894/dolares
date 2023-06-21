@extends('layouts.admin')

@section('title', 'Roles')

@section('page-title', 'Crear nuevo rol')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-dark">Gestor de roles</li>
    </ul>
@endsection

@section('activeTabPanelAdmin', 'active')
@section('activeTabAdmin', 'active show')

@section('showMenuAccordionRolePermissions', 'show')
@section('activeMenuAccordionRolePermissions', 'active')
@section('activeMenuRoleList', 'active')

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
    <div class="row">
        <!--begin::Input group-->
        <div class="card card-flush h-md-100">
            <form id="kt_create_role_form" class="form-horizontal" data-kt-action="{{ route('roles.update') }}" enctype="multipart/form-data" data-kt-redirect="{{ route('roles.index') }}">
                @csrf
                <input type="hidden" name="role_id" value="{{ $role->id }}">
                <div class="card-body pt-10">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="fv-row mb-10">
                                <label class="fs-5 fw-bolder form-label mb-2">
                                    <span class="required">Código del Rol</span>
                                </label>
                                <input class="form-control form-control-solid" placeholder="Ingrese un código del rol" name="role_name" value="{{ $role->name }}" />

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="fv-row mb-10">
                                <label class="fs-5 fw-bolder form-label mb-2">
                                    <span class="required">Descripción del Rol</span>
                                </label>
                                <input class="form-control form-control-solid" placeholder="Ingrese una descripción" name="role_description" value="{{ $role->description }}" />

                            </div>
                        </div>
                    </div>

                    <div class="fv-row">
                        <!--begin::Label-->
                        <label class="fs-5 fw-bolder form-label mb-2">Permisos del rol</label>
                        <!--end::Label-->
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-bold">
                                @foreach( $groups as $group )
                                    <tr>
                                        <td class="text-gray-800">{{ $group['name'] }}</td>
                                        <td>
                                            <!--begin::Wrapper-->
                                            <div class="d-flex">
                                            @foreach( $permissions as $permission )
                                                <!--begin::Checkbox-->
                                                @if ( substr($permission->name, strpos($permission->name, '_')+1) === $group['group'] )
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" type="checkbox" id="permission{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->name, $permissionsSelected) ? 'checked' : '' }} />
                                                    <span class="form-check-label">{{ $permission->description }}</span>
                                                    </label>
                                                @endif
                                                <!--end::Checkbox-->
                                            @endforeach
                                            </div>
                                            <!--end::Wrapper-->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
                    </div>
                </div>
                <div class="card-footer text-center flex-wrap pt-0">
                    <button type="reset" class="btn btn-light me-3">Descartar</button>
                    <button class="btn btn-primary" id="kt_create_role_submit">
                        <span class="indicator-label">Guardar rol</span>
                        <span class="indicator-progress">Espere por favor...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
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

        });

    </script>
    <script src="{{ asset('assets/js/role/edit.js') }}"></script>
    {{--<script src="{{ asset('assets/js/permission/index.js') }}"></script>--}}
@endsection
