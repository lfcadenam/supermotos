@extends('layouts.app')

@section('title', 'Gestión de Accesorios')

@section('content')
<section class="page-header padding">
    <div class="container">
        <div class="page-content text-center">
            <h2>Gestión de Accesorios</h2>
            <p>Administra los productos de la tienda.</p>
        </div>
    </div>
</section>

<section class="admin-section padding bg-grey">
    <div class="container">
        @include('admin.partials.menu')
        <div class="bg-white p-30 shadow-sm rounded">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <h4>Listado de Accesorios</h4>
                <a href="{{ route('admin.accessories.create') }}" class="btn btn-primary">Nuevo Accesorio</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accessories as $item)
                        <tr>
                            <td><img src="{{ asset('fotos_motos/' . $item->foto) }}" width="50"></td>
                            <td>{{ $item->nombre }}</td>
                            <td>${{ number_format($item->valor, 0, ',', '.') }}</td>
                            <td><span class="badge badge-success">Activo</span></td>
                            <td>
                                <button class="btn btn-sm btn-info"><i class="ti-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="ti-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $accessories->links() }}
        </div>
    </div>
</section>
@endsection
