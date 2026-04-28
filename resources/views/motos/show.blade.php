@extends('layouts.app')

@section('title', 'Detalle de Moto - ' . $moto->nombre)

@section('content')
<section class="page-header padding">
    <div class="container">
        <div class="page-content text-center">
            <h2>Detalle de Motocicleta</h2>
            <p>🏁 En SUPERMOTOS te conectamos con el mercado más grande de Colombia.</p>
        </div>
    </div>
</section>

<section class="service-section section-2 bg-grey padding-small">
    <div class="container">
        <div class="mb-10">
            <a href="{{ route('motos.colombia') }}" class="btn-back-list">
                <i class="fa fa-arrow-left"></i> Volver a Motos Disponibles
            </a>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-lg-12 sm-padding">
                <div class="service-content wow fadeInLeft">
                    <div class="container-fluid pb-5">
                        <div class="row px-xl-5">
                            <div class="col-lg-5 mb-30">
                                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner bg-light">
                                        @php
                                            $images = explode(',', $moto->fotos);
                                            $fallbackImage = asset('img/no-image.png');
                                        @endphp
                                        @foreach($images as $index => $image)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img class="w-100 h-100" src="{{ $moto->photoUrl($image) }}" alt="Imagen de {{ $moto->nombre }}" onerror="this.onerror=null; this.src='{{ $fallbackImage }}'">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                                    </a>
                                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-7 h-auto mb-10">
                                <div class="h-100 bg-light p-10">
                                    <h2>{{ $moto->nombre }}</h2>
                                    <p class="lead">Modelo {{ $moto->modelo }} / {{ $moto->kilometraje }} Kilómetros</p>
                                    <h3 class="font-weight-semi-bold mb-4 text-primary">💰 ${{ number_format($moto->valor, 0, ',', '.') }}</h3>
                                    <p class="mb-4">✔️ {{ $moto->soat_tecno_matri }}</p>

                                    <div class="mb-4">
                                        <h5>Para más información:</h5>
                                        <div class="d-flex gap-2">
                                            @if($moto->url_insta)
                                                <a href="{{ $moto->url_insta }}" target="_blank" class="btn btn-outline-danger mr-2">
                                                    <i class="fab fa-instagram"></i> Instagram
                                                </a>
                                            @endif
                                            @php
                                                $telefono = ($moto->moto_inv_ext == 1) ? '3177952798' : $moto->telefono_clie_moto;
                                            @endphp
                                            <a href="https://wa.me/57{{ $telefono }}/?text=Quiero%20más%20información%20de%20la%20moto%20{{ urlencode($moto->nombre) }}" target="_blank" class="btn btn-outline-success">
                                                <i class="fab fa-whatsapp"></i> WhatsApp
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row px-xl-5">
                            <div class="col">
                                <div class="bg-light">
                                    <nav>
                                        <div class="nav nav-tabs mb-4" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab">Descripción</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-info" role="tabpanel">
                                            <div class="moto-description-content">
                                                {!! $moto->descripcion !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(isset($relatedMotos) && $relatedMotos->count() > 0)
                            <div class="row px-xl-5 mt-40">
                                <div class="col">
                                    <div class="bg-light p-20 related-motos-wrapper">
                                        <div class="d-flex justify-content-between align-items-center mb-20">
                                            <h4 class="mb-0">Motos sugeridas</h4>
                                            <small class="text-muted">También te puede interesar</small>
                                        </div>

                                        @php
                                            $fallbackImageRelated = asset('img/no-image.png');
                                        @endphp
                                        <div class="related-motos-carousel owl-carousel">
                                            @foreach($relatedMotos as $item)
                                                @php
                                                    $relatedPhoto = !empty($item->fotos) ? explode(',', $item->fotos)[0] : null;
                                                @endphp
                                                <div class="related-moto-item">
                                                    <article class="related-moto-card">
                                                        <a href="{{ route('motos.show', md5($item->id_moto_disp)) }}" class="related-moto-image-link">
                                                            <img src="{{ $item->photoUrl($relatedPhoto) }}" alt="{{ $item->nombre }}" class="related-moto-image" onerror="this.onerror=null; this.src='{{ $fallbackImageRelated }}'">
                                                        </a>
                                                        <div class="related-moto-body">
                                                            <h6 class="related-moto-title">
                                                                <a href="{{ route('motos.show', md5($item->id_moto_disp)) }}">{{ $item->nombre }}</a>
                                                            </h6>
                                                            <p class="related-moto-meta">{{ $item->marca }} | Modelo {{ $item->modelo }}</p>
                                                            <div class="related-moto-price">${{ number_format($item->valor, 0, ',', '.') }}</div>
                                                            <a href="{{ route('motos.show', md5($item->id_moto_disp)) }}" class="related-moto-link">Ver detalle</a>
                                                        </div>
                                                    </article>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="security-card-container mt-50">
                            <div class="security-card">
                                <div class="security-shield-wrapper">
                                    <div class="security-shield-svg">
                                        <svg width="76" height="86" viewBox="0 0 76 86" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                                            <defs>
                                                <linearGradient id="shieldGradient" x1="38" y1="4" x2="38" y2="82" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#EAF2FF"/>
                                                    <stop offset="1" stop-color="#D5E6FF"/>
                                                </linearGradient>
                                            </defs>
                                            <path d="M38 5.5L66 15.8V36.8C66 56.1 53.9 73.8 38 80.5C22.1 73.8 10 56.1 10 36.8V15.8L38 5.5Z" fill="url(#shieldGradient)" stroke="#8BB7FF" stroke-width="2"/>
                                            <path d="M38 13.5L59 21.2V36.4C59 51.2 49.7 64.9 38 70.3C26.3 64.9 17 51.2 17 36.4V21.2L38 13.5Z" stroke="#3483FA" stroke-opacity="0.45" stroke-width="2"/>
                                            <circle cx="38" cy="40" r="11.5" fill="#3483FA"/>
                                            <rect x="36.7" y="33" width="2.6" height="9" rx="1.3" fill="white"/>
                                            <circle cx="38" cy="45.5" r="1.7" fill="white"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h4 class="mt-20 mb-20">Consejos de seguridad</h4>
                                </div>
                                <div class="security-list-content">
                                    <p><b>SÚPER MOTOS COMPANY</b> nunca pediremos códigos o contraseñas por WhatsApp o vía telefónica.</p>
                                    <p>Verifica que el vendedor sea el propietario del vehículo, revisa los documentos y la placa.</p>
                                    <p>No hagas pagos antes de ver y verificar el estado de la motocicleta que te interesa.</p>
                                    <p>Verifica la moto que vas a comprar por medio del Runt, <a href="https://www.runt.com.co/consulta-ciudadana/consulta-vehiculos" target="_blank" class="text-primary font-weight-bold">Aquí</a>.</p>
                                    <p>Toma las precauciones necesarias para mostrar o comprar tu moto, asesórate de expertos en seguridad y siempre permanece en lugares con cámaras de vigilancia o con acompañamiento de policía.</p>
                                    <p>No entregues tu moto hasta verificar la transacción bancaria. Evita recibir dinero en efectivo en lugares públicos.</p>

                                    <div class="mt-30 pt-15 border-top text-center">
                                        <small class="text-muted">SUPER MOTOS COMPANY es una página abierta para toda clase de público. Aplican condiciones y restricciones.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .moto-description-content {
        font-size: 18px;
        line-height: 1.7;
    }

    .moto-description-content p,
    .moto-description-content li,
    .moto-description-content span {
        font-size: inherit;
        line-height: inherit;
    }

    .related-motos-wrapper {
        border-radius: 10px;
        border: 1px solid #e6e6e6;
    }

    .related-moto-card {
        background: #fff;
        border: 1px solid #e6e6e6;
        border-radius: 8px;
        overflow: hidden;
        height: 100%;
        transition: box-shadow .2s ease;
    }

    .related-moto-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, .12);
    }

    .related-moto-image-link {
        display: block;
        width: 100%;
        height: 180px;
        overflow: hidden;
        border-bottom: 1px solid #f0f0f0;
    }

    .related-moto-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .related-moto-body {
        padding: 14px;
    }

    .related-moto-title {
        min-height: 42px;
        margin-bottom: 8px;
        font-size: 15px;
        line-height: 1.4;
    }

    .related-moto-title a {
        color: #333;
    }

    .related-moto-meta {
        margin-bottom: 10px;
        font-size: 12px;
        color: #666;
    }

    .related-moto-price {
        color: #111;
        font-size: 24px;
        line-height: 1;
        margin-bottom: 12px;
    }

    .related-moto-link {
        color: #3483fa;
        font-size: 14px;
        font-weight: 500;
    }

    .related-motos-carousel .owl-stage-outer {
        padding: 2px 1px 10px;
    }

    .related-motos-carousel .owl-nav {
        position: static;
        margin-top: 14px;
        display: flex;
        justify-content: flex-end;
        gap: 8px;
    }

    .related-motos-carousel .owl-nav .owl-prev,
    .related-motos-carousel .owl-nav .owl-next {
        position: static !important;
        left: auto !important;
        right: auto !important;
        top: auto !important;
        transform: none !important;
        margin: 0 !important;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 1px solid #d9d9d9 !important;
        background: #fff !important;
        color: #3483fa !important;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
    }

    .related-motos-carousel .owl-nav .owl-prev span,
    .related-motos-carousel .owl-nav .owl-next span {
        line-height: 1;
        font-size: 16px;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function () {
        const $related = $('.related-motos-carousel');
        if ($related.length) {
            $related.owlCarousel({
                loop: false,
                margin: 16,
                nav: true,
                dots: false,
                smartSpeed: 500,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                responsive: {
                    0: { items: 1 },
                    576: { items: 2 },
                    992: { items: 3 },
                    1200: { items: 4 }
                }
            });
        }
    });
</script>
@endpush
