@extends('layouts.app')

@section('title', 'Accesorios Publicados')

@section('content')
<section class="page-header padding">
    <div class="container">
        <div class="page-content text-center">
            <h2>Accesorios Publicados</h2>
            <p>Explora los accesorios disponibles de Supermotos.</p>
        </div>
    </div>
</section>

<section class="blog-section padding bg-grey">
    <div class="container">
        <div class="row">
            @forelse($accessories as $accessory)
                <div class="col-lg-4 col-md-6 sm-padding mb-30">
                    <div class="blog-item h-100 d-flex flex-column">
                        @php
                            $fallbackImage = asset('img/no-image.png');
                        @endphp
                        <div class="blog-thumb" style="height: 250px; overflow: hidden;">
                            <img src="{{ $accessory->photoUrl() }}" alt="{{ $accessory->nombre }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ $fallbackImage }}'">
                        </div>
                        <div class="blog-content d-flex flex-column flex-grow-1">
                            <h3>{{ $accessory->nombre }}</h3>
                            <p>{{ $accessory->descripcion }}</p>
                            <div class="mt-auto">
                                <h4 class="text-primary mt-10 mb-20">${{ number_format($accessory->valor, 0, ',', '.') }}</h4>
                                <a href="https://wa.me/573177952798?text=Hola,%20quiero%20informaci%C3%B3n%20sobre%20el%20accesorio%20{{ urlencode($accessory->nombre) }}" target="_blank" class="btn btn-primary btn-block">
                                    Consultar por WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fa fa-box fa-3x text-muted mb-20"></i>
                    <p>No hay accesorios publicados en este momento.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-10">Volver al inicio</a>
                </div>
            @endforelse
        </div>

        @if($accessories->hasPages())
            <div class="pagination-container d-flex justify-content-center mt-40">
                {{ $accessories->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
