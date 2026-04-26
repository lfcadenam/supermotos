@extends('layouts.app')

@section('title', 'Supermotos - Inicio')

@section('content')
<!-- Start Hero area -->
<section class="hero-section padding bg-dark d-flex align-items-center" style="min-height: 80vh; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('img/banner1.jpg') }}'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="hero-content text-left">
                    <span class="text-primary font-weight-bold text-uppercase mb-10 d-block wow fadeInUp">Bienvenidos a SUPER MOTOS COMPANY</span>
                    <h1 class="text-white display-4 font-weight-bold mb-20 wow fadeInUp" data-wow-delay="200ms">🏁 El mercado de motos más grande de Colombia.</h1>
                    <p class="text-light lead mb-30 wow fadeInUp" data-wow-delay="400ms">Vende tu moto de forma rápida y segura o encuentra tu próxima compañera de aventuras en nuestro catálogo exclusivo.</p>
                    <div class="hero-btns wow fadeInUp" data-wow-delay="600ms">
                        <a href="{{ route('motos.create') }}" class="btn btn-primary btn-lg mr-3">Publica tu moto aquí</a>
                        <a href="{{ route('motos.colombia') }}" class="btn btn-outline-light btn-lg">Explorar Catálogo</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
                <!-- Espacio para la burbuja de precio o imagen destacada similar a la referencia -->
                <div class="price-bubble wow zoomIn" data-wow-delay="800ms" style="background: var(--primary-orange); width: 200px; height: 200px; border-radius: 50%; display: flex; flex-direction: column; justify-content: center; align-items: center; color: #fff; margin-top: 50px; box-shadow: 0 10px 30px rgba(255,109,0,0.4);">
                    <span class="small text-uppercase">Desde</span>
                    <h2 class="text-white mb-0">$1.000</h2>
                    <span class="small">Publica ya</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Hero area -->

<!--Start Features Area-->
<div class="padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6 mb-15 wow fadeInUp" data-wow-delay="300ms">
                <div class="service_block">
                    <span></span>
                    <div class="service_icon"><img src="{{ asset('img/responsive.png') }}" alt="image" /></div>
                    <h4>Motos disponibles</h4>      
                    <a href="{{ route('motos.colombia') }}" class="clv_btn1 wow fadeInUp">Ver Aquí</a>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-15 wow fadeInUp" data-wow-delay="400ms">
                <div class="service_block">
                    <span></span>
                    <div class="service_icon"><img src="{{ asset('img/support.png') }}" alt="image" /></div>
                    <h4>Publica tu moto aquí</h4>
                    <a href="{{ route('motos.create') }}" class="clv_btn1 wow fadeInUp">Ver Aquí</a>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-15 wow fadeInUp" data-wow-delay="500ms">
                <div class="service_block" id="accesorios">
                    <span></span>
                    <div class="service_icon"><img src="{{ asset('img/creative.png') }}" alt="image" /></div>
                    <h4>Accesorios</h4>
                    <a href="#" class="clv_btn1 wow fadeInUp">Ver Aquí</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/particle/particles.min.js') }}"></script>
<script src="{{ asset('assets/particle/app.js') }}"></script>
@endpush
