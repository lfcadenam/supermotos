@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<section class="page-header padding">
    <div class="container">
        <div class="page-content text-center">
            <h2>Panel de Administración</h2>
            <p>Resumen de actividad de Supermotos.</p>
        </div>
    </div>
</section>

<section class="admin-section padding bg-grey">
    <div class="container">
        @include('admin.partials.menu')
        
        <div class="row">
            <div class="col-lg-3 col-sm-6 mb-20">
                <div class="bg-white p-30 text-center shadow-sm rounded">
                    <h3 class="text-success">{{ $stats['motos_activas'] }}</h3>
                    <p>Motos Activas</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-20">
                <div class="bg-white p-30 text-center shadow-sm rounded">
                    <h3 class="text-warning">{{ $stats['motos_pendientes'] }}</h3>
                    <p>Motos Pendientes</p>
                </div>
            </div>
            <!--<div class="col-lg-3 col-sm-6 mb-20">
                <div class="bg-white p-30 text-center shadow-sm rounded">
                    <h3 class="text-primary">{{ $stats['pedidos_hoy'] }}</h3>
                    <p>Pedidos Hoy</p>
                </div>
            </div>-->
            <div class="col-lg-3 col-sm-6 mb-20">
                <div class="bg-white p-30 text-center shadow-sm rounded">
                    <h3 class="text-info">{{ $stats['usuarios'] }}</h3>
                    <p>Usuarios</p>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
