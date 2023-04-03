@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard Principal')

@section('breadcrumb')
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="../../demo7/dist/index.html" class="text-muted">Inicio</a>
        </li>
        <li class="breadcrumb-item text-dark">Dashboard</li>
    </ul>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
