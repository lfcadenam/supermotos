@extends('layouts.app')

@section('title', 'Quienes Somos - Supermotos')

@section('content')
<section class="page-header padding">
    <div class="container">
        <div class="page-content text-center">
            <h2>SUPER MOTOS COMPANY</h2>
            <p>🏁En SUPER MOTOS COMPANY te conectamos con el mercado de motocicletas más grande de Colombia.</p>        
        </div>
    </div>
</section>

<section class="service-section section-2 bg-grey padding">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 sm-padding">
                <div class="service-content wow fadeInLeft">
                    <span class="text-primary font-weight-bold">Quienes somos</span>
                    <h2 class="mb-20">SUPER MOTOS COMPANY!!!</h2>
                    <div class="description text-justify">
                        <p>En SUPER MOTOS COMPANY te ofrecemos una experiencia única en el mundo de las motocicletas. Somos tu mejor opción para comprar o vender motos de manera rápida, segura y sin complicaciones.</p>
                        <p><strong>🚨 ¿Quieres vender tu moto?</strong></p>
                        <p>Aquí encontrarás una plataforma exclusiva donde puedes publicar tu moto fácilmente, en solo unos minutos y sin vueltas. Tu anuncio llegará a miles de compradores potenciales que buscan justo lo que ofreces.</p>
                        <p><strong>🏍 ¿Buscas la moto de tus sueños?</strong></p>
                        <p>Accede a una gran variedad de modelos, con información detallada y exclusiva. Con tan solo un clic puedes encontrar esa moto que tanto deseas, al mejor precio y con total confianza.</p>
                        <ul class="list-unstyled mt-20">
                            <li><i class="fa fa-check text-primary mr-2"></i> Página ágil y efectiva</li>
                            <li><i class="fa fa-check text-primary mr-2"></i> Información exclusiva y confiable</li>
                            <li><i class="fa fa-check text-primary mr-2"></i> Publicación rápida y sencilla</li>
                            <li><i class="fa fa-check text-primary mr-2"></i> ¡Miles de oportunidades al alcance de un clic!</li>
                        </ul>
                        <p class="mt-20">Con SUPER MOTOS COMPANY, ¡tu próxima moto o comprador está a solo un clic de distancia!</p>
                        <p class="font-weight-bold">🛵 Explora ahora y haz que tu pasión ruja en la pista o carretera</p>
                    </div>
                    <a href="{{ route('motos.create') }}" class="btn btn-primary mt-30">Publica tu moto aquí</a>
                </div>
            </div>
            <div class="col-lg-6 sm-padding">
                <div class="row services-list">
                    <div class="col-md-6 padding-15">
                        <div class="service-item bg-white p-30 text-center shadow-sm rounded mb-20">
                            <i class="fab fa-instagram fa-3x text-primary mb-20"></i>
                            <h4>Encuéntranos en Instagram</h4>
                            <a href="https://www.instagram.com/supermotoscompany" class="btn btn-outline-primary btn-sm" target="_blank">Ver Aquí</a>
                        </div>
                    </div>
                    <div class="col-md-6 padding-15 mt-md-30">
                        <div class="service-item bg-white p-30 text-center shadow-sm rounded mb-20">
                            <i class="fab fa-facebook fa-3x text-primary mb-20"></i>
                            <h4>También en Facebook</h4>
                            <a href="https://m.facebook.com/supermotosrt/" class="btn btn-outline-primary btn-sm" target="_blank">Ver Aquí</a>
                        </div>
                    </div>
                    <div class="col-md-6 padding-15">
                        <div class="service-item bg-white p-30 text-center shadow-sm rounded mb-20">
                            <i class="fab fa-tiktok fa-3x text-primary mb-20"></i>
                            <h4>Encuéntranos en TikTok</h4>
                            <a href="https://www.tiktok.com/@supermotosrt" class="btn btn-outline-primary btn-sm" target="_blank">Ver Aquí</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="work-pro-section padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6 sm-padding wow fadeInUp" data-wow-delay="100ms">
                <div class="work-pro-item text-center">
                    <span class="number h4 d-block text-primary">1</span>
                    <h3>Ingresa a nuestra página</h3>
                    <p>En ella podrás encontrar toda la información para poder publicar tu moto.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 sm-padding wow fadeInUp" data-wow-delay="300ms">
                <div class="work-pro-item text-center">
                    <span class="number h4 d-block text-primary">2</span>
                    <h3>Publica tu moto aquí</h3>
                    <p>Allí encontrarás un formulario para registrar tu publicación y dependiendo tu forma de pago se publicará de inmediato.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 sm-padding wow fadeInUp" data-wow-delay="400ms">
                <div class="work-pro-item text-center">
                    <span class="number h4 d-block text-primary">3</span>
                    <h3>Pago Confirmado</h3>
                    <p>Apenas se confirme tu pago y regreses a la página tu publicación quedará activa de inmediato.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 sm-padding wow fadeInUp" data-wow-delay="500ms">
                <div class="work-pro-item text-center">
                    <span class="number h4 d-block text-primary">4</span>
                    <h3>¡Listo para vender!</h3>
                    <p>Tu moto ya es visible para miles de compradores potenciales en todo el país.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
