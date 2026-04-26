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

<section class="service-section section-2 bg-grey padding">
    <div class="dots"></div>
    <div class="container">
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
                                        @endphp
                                        @foreach($images as $index => $image)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                @if($moto->moto_inv_ext == 2)
                                                    <img class="w-100 h-100" src="{{ asset('fotos_motos/' . trim($image)) }}" alt="Imagen de {{ $moto->nombre }}" onerror="this.onerror=null; this.src='{{ asset('img/no-image.png') }}'">
                                                @else
                                                    <img class="w-100 h-100" src="{{ asset('admin_files/fotos_motos/' . trim($image)) }}" alt="Imagen de {{ $moto->nombre }}" onerror="this.onerror=null; this.src='{{ asset('img/no-image.png') }}'">
                                                @endif
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

                            <div class="col-lg-7 h-auto mb-30">
                                <div class="h-100 bg-light p-30">
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
                                    
                                    <hr>
                                    <div class="security-tips mt-20">
                                        <p class="font-weight-bold">🛡️ Consejos de seguridad</p>
                                        <ul class="small list-unstyled">
                                            <li>• <b>SÚPER MOTOS COMPANY</b> nunca pediremos códigos o contraseñas por WhatsApp.</li>
                                            <li>• Verifica que el vendedor sea el propietario real.</li>
                                            <li>• No realices pagos sin ver la moto físicamente.</li>
                                            <li>• Consulta los antecedentes en el RUNT.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row px-xl-5 mt-30">
                            <div class="col">
                                <div class="bg-light p-30">
                                    <nav>
                                        <div class="nav nav-tabs mb-4" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab">Descripción</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-info" role="tabpanel">
                                            <div class="p-3">
                                                {!! $moto->descripcion !!}
                                            </div>
                                        </div>
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
