@extends('layouts.admin')

@section('title', 'Gráficos')

@section('page-title', 'Gráficos en tiempo real')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Inicio</a>
        </li>
        <li class="breadcrumb-item text-muted">Dashboard</li>
        <li class="breadcrumb-item text-dark">Gráficos Kambista</li>
    </ul>
@endsection

@section('activeTabPanelGraphs', 'active')
@section('activeTabGraphs', 'active show')
@section('activeGraphKambista', 'text-primary')

@section('content')
    <div class="row">
        <div class="col-xl-12 mt-4 d-none d-sm-block">
            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Tipo de cambio en Kambista</span>
                        <span class="text-muted fw-bold fs-7">Actualizado cada 1 minuto</span>
                    </h3>
                    <!--begin::Toolbar-->
                    <div class="card-toolbar" data-kt-buttons="true">

                        <select id="statusKambista" name="status" data-control="select2" data-hide-search="true" class="form-select form-select-sm form-select-white w-100px">
                            <option value="d" selected="selected">Diario</option>
                            <option value="w">Semanal</option>
                            <option value="m">Mensual</option>
                            <option value="y">Anual</option>
                        </select>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Chart-->
                    <div id="chartKambista" style="height: 300px"></div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/graph/indexKambista.js') }}"></script>
@endsection
