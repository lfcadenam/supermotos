@extends('layouts.app')

@section('title', 'Mi Carrito de Compras')

@section('content')
<section class="page-header padding">
    <div class="container">
        <div class="page-content text-center">
            <h2>Mi Carrito</h2>
            <p>Gestiona tus productos seleccionados.</p>
        </div>
    </div>
</section>

<section class="cart-section padding bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="bg-white p-30 shadow-sm rounded">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->producto)
                                                <img src="{{ asset('fotos_motos/' . $item->producto->foto) }}" alt="{{ $item->producto->nombre }}" width="50" class="mr-10">
                                                <span>{{ $item->producto->nombre }}</span>
                                            @else
                                                <span>Producto #{{ $item->id_producto }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>${{ number_format($item->valor_unitario, 0, ',', '.') }}</td>
                                    <td>{{ $item->cantidad }}</td>
                                    <td>${{ number_format($item->valor_unitario * $item->cantidad, 0, ',', '.') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger"><i class="ti-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <p>Tu carrito está vacío.</p>
                                        <a href="{{ route('home') }}#accesorios" class="btn btn-primary mt-10">Ver Accesorios</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="bg-white p-30 shadow-sm rounded">
                    <h4>Resumen del Pedido</h4>
                    <hr>
                    @php
                        $total = $items->sum(function($item) { return $item->valor_unitario * $item->cantidad; });
                    @endphp
                    <div class="d-flex justify-content-between mb-10">
                        <span>Subtotal</span>
                        <span>${{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-20 font-weight-bold">
                        <span>Total</span>
                        <span class="text-primary">${{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    
                    <h5 class="mt-30">Información de Envío</h5>
                    <form action="{{ route('cart.updateCustomer', $items->first()->id_carrito_pro ?? 0) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" value="{{ $items->first()->nombre ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" value="{{ $items->first()->correo ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="{{ $items->first()->telefono ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <textarea name="direccion" class="form-control" placeholder="Dirección de envío" required>{{ $items->first()->direccion ?? '' }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block mt-20" {{ $items->isEmpty() ? 'disabled' : '' }}>
                            Proceder al Pago
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
