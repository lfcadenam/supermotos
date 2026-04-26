@extends('layouts.app')

@section('title', 'Contacto - Supermotos')

@section('content')
<section class="page-header padding">
    <div class="container">
        <div class="page-content text-center">
            <h2>Contacto</h2>
            <p>🏁En SUPERMOTOS te conectamos con el mercado de motocicletas más grande de Colombia.</p>
        </div>
    </div>
</section>

<section class="contact-section padding bg-grey">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 sm-padding">
                <div class="contact-info wow fadeInLeft">
                    <span class="text-primary font-weight-bold">Sobre nosotros</span>
                    <h2 class="mb-20">Supermotos RT</h2>
                    <div class="description text-justify">
                        <p>Bienvenidos a SUPER MOTOS RT, líder en el mercado de motocicletas de alto cilindraje en Colombia desde 2013. Nos enorgullece ofrecer una amplia gama de motocicletas de alta calidad que satisfacen las necesidades de los entusiastas de las dos ruedas más exigentes.</p>
                        <p>Desde nuestros humildes comienzos en 2013, hemos crecido hasta convertirnos en un referente en la industria, gracias a nuestro compromiso con la excelencia, la innovación y el servicio al cliente.</p>
                        <p>Nuestra pasión por las motocicletas se refleja en cada aspecto de nuestro negocio, desde la selección de los modelos más exclusivos hasta la atención personalizada que brindamos a cada uno de nuestros clientes.</p>
                        <div class="mt-30">
                            <p><i class="fa fa-map-marker-alt text-primary mr-2"></i> Calle Principal, Bogotá, Colombia</p>
                            <p><i class="fa fa-phone text-primary mr-2"></i> +57 317 795 2798</p>
                            <p><i class="fa fa-envelope text-primary mr-2"></i> info@supermotosrt.com</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 sm-padding">
                <div class="contact-form-wrap bg-white p-40 shadow-sm rounded">
                    <h2 class="mb-30">Envíanos un mensaje</h2>
                    <form action="#" method="POST" id="contactForm">
                        @csrf
                        <div class="form-group mb-20">
                            <input type="text" name="name" class="form-control" placeholder="Nombres" required>
                        </div>
                        <div class="form-group mb-20">
                            <input type="email" name="email" class="form-control" placeholder="Correo" required>
                        </div>
                        <div class="form-group mb-20">
                            <textarea name="message" class="form-control" rows="5" placeholder="Mensaje" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Enviar mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
