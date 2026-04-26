@extends('layouts.app')

@section('title', 'Motos Disponibles')

@section('content')
<section class="page-header padding">
    <div class="container">
        <div class="page-content text-center">
            <h2>Motos Disponibles</h2>
            <p>Encuentra la moto de tus sueños.</p>
        </div>
    </div>
</section>

<section class="blog-section padding">
    <div class="container">
        <div class="row">
            @forelse($motos as $moto)
                <div class="col-lg-4 col-md-6 sm-padding">
                    <div class="blog-item">
                        <div class="blog-thumb">
                            @php
                                $mainFoto = $moto->fotos ? explode(',', $moto->fotos)[0] : 'no-image.png';
                                $folder = ($moto->moto_inv_ext == 2) ? 'fotos_motos/' : 'admin_files/fotos_motos/';
                            @endphp
                            <img src="{{ asset($folder . trim($mainFoto)) }}" alt="{{ $moto->nombre }}" onerror="this.onerror=null; this.src='{{ asset('img/no-image.png') }}'">
                        </div>
                        <div class="blog-content">
                            <h3><a href="{{ route('motos.show', md5($moto->id_moto_disp)) }}">{{ $moto->nombre }}</a></h3>
                            <p>{{ Str::limit(strip_tags($moto->descripcion), 100) }}</p>
                            <div class="blog-meta">
                                <span><i class="fa fa-tag"></i> {{ $moto->marca }}</span>
                                <span><i class="fa fa-calendar"></i> {{ $moto->modelo }}</span>
                            </div>
                            <h4 class="text-primary mt-10">${{ number_format($moto->valor, 0, ',', '.') }}</h4>
                            <a href="{{ route('motos.show', md5($moto->id_moto_disp)) }}" class="read-more">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No hay motos disponibles en este momento.</p>
                </div>
            @endforelse
        </div>
        <div class="pagination-wrap text-center mt-30">
            {{ $motos->links() }}
        </div>
    </div>
</section>
@endsection
