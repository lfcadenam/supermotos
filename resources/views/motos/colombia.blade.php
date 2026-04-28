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

<!-- Start Filters area -->
<section class="filters-section bg-grey bd-bottom">
    <div class="container">
        <form action="{{ url()->current() }}" method="GET" class="filter-form padding-20">
            <div class="row align-items-end">
                <div class="col-lg-3 col-md-6 mb-10">
                    <label class="small font-weight-bold">Búsqueda libre</label>
                    <input type="text" name="query" class="form-control" placeholder="Ej. Yamaha R6, 600cc..." value="{{ request('query') }}">
                </div>
                <div class="col-lg-2 col-md-6 mb-10">
                    <label class="small font-weight-bold">Marca</label>
                    <select name="marca" class="form-control">
                        <option value="">Todas las marcas</option>
                        @foreach(['BMW', 'YAMAHA', 'HONDA', 'SUZUKI', 'KAWASAKI', 'DUCATI', 'BAJAJ', 'KTM', 'PIAGGIO', 'BENELLI', 'VICTORY', 'AKT'] as $marca)
                            <option value="{{ $marca }}" {{ request('marca') == $marca ? 'selected' : '' }}>{{ $marca }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-6 mb-10">
                    <label class="small font-weight-bold">Modelo (Año)</label>
                    <input type="number" name="status" class="form-control" placeholder="Año" value="{{ request('status') }}">
                </div>
                <div class="col-lg-3 col-md-6 mb-10">
                    <label class="small font-weight-bold">Tipo de Moto</label>
                    <select name="linea" class="form-control">
                        <option value="">Todos los tipos</option>
                        @foreach(['Deportiva', 'Naked', 'Touring', 'Scooter', 'Enduro', 'Cross', 'Calle', 'Custom'] as $tipo)
                            <option value="{{ $tipo }}" {{ request('linea') == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-12 mb-10">
                    <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- End Filters area -->

<section class="blog-section padding bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @forelse($motos as $moto)
                    <div class="moto-horizontal-card wow fadeInUp">
                        <div class="moto-card-img">
                            @php
                                $mainFoto = $moto->fotos ? explode(',', $moto->fotos)[0] : 'no-image.png';
                                $fallbackImage = asset('img/no-image.png');
                            @endphp
                            <a href="{{ route('motos.show', md5($moto->id_moto_disp)) }}">
                                <img src="{{ $moto->photoUrl($mainFoto) }}" alt="{{ $moto->nombre }}" onerror="this.onerror=null; this.src='{{ $fallbackImage }}'">
                            </a>
                        </div>
                        <div class="moto-card-content">
                            <div class="moto-card-header">
                                <span class="badge badge-primary mb-10">{{ $moto->marca }}</span>
                                <h3><a href="{{ route('motos.show', md5($moto->id_moto_disp)) }}">{{ $moto->nombre }}</a></h3>
                                <div class="moto-card-meta">
                                    <span><i class="fa fa-calendar"></i> Modelo {{ $moto->modelo }}</span>
                                    <span><i class="fa fa-tachometer-alt"></i> {{ $moto->kilometraje }} km</span>
                                    <span><i class="fa fa-map-marker-alt"></i> {{ $moto->ciudad_clie_moto }}</span>
                                </div>
                            </div>
                            <div class="moto-card-body">
                                <p>{{ Str::limit(strip_tags($moto->descripcion), 180) }}</p>
                            </div>
                            <div class="moto-card-footer">
                                <div class="moto-price">${{ number_format($moto->valor, 0, ',', '.') }}</div>
                                <a href="{{ route('motos.show', md5($moto->id_moto_disp)) }}" class="btn-view-detail">
                                    <i class="fa fa-plus"></i> VER DETALLE
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center p-50">
                        <i class="fa fa-motorcycle fa-3x text-muted mb-20"></i>
                        <p>No hay motos disponibles con los filtros seleccionados.</p>
                        <a href="{{ route('motos.colombia') }}" class="btn btn-primary mt-10">Limpiar filtros</a>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="pagination-container d-flex justify-content-center mt-40">
            {{ $motos->appends(request()->input())->links() }}
        </div>
    </div>
</section>
@endsection
