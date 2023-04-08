@extends('layouts.admin')

@section('title', 'Gráficos')

@section('page-title', 'Gráficos en tiempo real')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted">Inicio</a>
        </li>
        <li class="breadcrumb-item text-muted">Dashboard</li>
        <li class="breadcrumb-item text-dark">Gráficos</li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-6 mt-4 d-none d-sm-block">
            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Tipo de cambio en tiempo real</span>
                        <span class="text-muted fw-bold fs-7">Actualizado cada 1 minuto</span>
                    </h3>
                    <!--begin::Toolbar-->
                    <div class="card-toolbar" data-kt-buttons="true">
                        <a class="btn btn-sm btn-color-muted btn-active btn-active-primary active px-4" id="kt_charts_widget_3_day_btn">Diario</a>
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
        <div class="col-xl-6 mt-4 d-none d-sm-block">
            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Tipo de cambio en tiempo real</span>
                        <span class="text-muted fw-bold fs-7">Actualizado cada 1 minuto</span>
                    </h3>
                    <!--begin::Toolbar-->
                    <div class="card-toolbar" data-kt-buttons="true">
                        <a class="btn btn-sm btn-color-muted btn-active btn-active-primary active px-4" id="kt_charts_widget_3_day_btn">Diario</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Chart-->
                    {{--<div id="chartBloomberg" style="height: 300px"></div>--}}
                    <div id="chart-area">

                    </div>
                    <div id="chart-bar">

                    </div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/graph/index.js') }}"></script>
@endsection
