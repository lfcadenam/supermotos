<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Supermotos - Compra y venta de motocicletas en Colombia">
    <meta name="author" content="LuisferDeveloper">
    <title>@yield('title', 'Supermotos')</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elegant-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elegant-font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/odometer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/venobox/venobox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modern.css') }}">

    <script src="{{ asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/brands.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/solid.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/fontawesome.min.css">

    @stack('styles')
</head>
<body>
    <div class="site-preloader-wrap">
        <div class="spinner"></div>
    </div>

    <!-- Top Bar -->
    <div class="top-bar d-none d-md-block">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="mr-3"><i class="fa fa-envelope"></i> info@supermotosrt.com</span>
                    <span><i class="fa fa-phone"></i> +57 317 795 2798</span>
                </div>
                <div>
                    <a href="https://www.instagram.com/supermotoscompany" target="_blank" class="text-white mr-3"><i class="fab fa-instagram"></i></a>
                    <a href="https://m.facebook.com/supermotosrt/" target="_blank" class="text-white"><i class="fab fa-facebook"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="header" id="header">
        <div class="primary-header">
            <div class="container">
                <div class="primary-header-inner">
                    <div class="header-logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt="Supermotos"></a>
                    </div>
                    <div class="header-menu-wrap">
                        <ul class="dl-menu">
                            <li class="{{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="{{ request()->routeIs('pages.about') ? 'active' : '' }}"><a href="{{ route('pages.about') }}">Quienes somos</a></li>
                            <li class="{{ request()->routeIs('motos.colombia') ? 'active' : '' }}">
                                <a href="{{ route('motos.colombia') }}">Motos disponibles</a>
                            </li>
                            <li class="{{ request()->routeIs('motos.create') ? 'active' : '' }}"><a href="{{ route('motos.create') }}">Publicar mi moto</a></li>
                            <li class="{{ request()->routeIs('accessories.index') ? 'active' : '' }}"><a href="{{ route('accessories.index') }}">Accesorios</a></li>
                            <li class="{{ request()->routeIs('pages.contact') ? 'active' : '' }}"><a href="{{ route('pages.contact') }}">Contacto</a></li>
                            @auth
                                <li class="d-md-none auth-mobile-item">
                                    <a href="{{ route('admin.index') }}" class="btn-auth-mobile">Panel Administrativo</a>
                                </li>
                                <li class="d-md-none auth-mobile-item">
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" class="btn-auth-mobile btn-auth-logout">Cerrar Sesión</a>
                                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @endauth
                        </ul>
                    </div>
                    <div class="header-right">
                        @auth
                            <div class="auth-buttons d-flex align-items-center">
                                <a class="btn btn-outline-primary btn-sm mr-2" href="{{ route('admin.index') }}">Admin</a>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Salir</button>
                                </form>
                            </div>
                        @else
                            <a class="menu-btn" href="{{ route('login') }}">Acceso</a>
                        @endauth
                        <div class="mobile-menu-icon">
                            <div class="burger-menu">
                                <div class="line-menu line-half first-line"></div>
                                <div class="line-menu"></div>
                                <div class="line-menu line-half last-line"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <section class="widget-section padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 sm-padding wow fadeInUp">
                    <div class="footer-logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt="Supermotos"></a>
                    </div>
                    <div class="widgets-social">
                        <a href="https://m.facebook.com/supermotosrt/" target="_blank"> <i class="ti-facebook"></i> </a>
                        <a href="https://www.instagram.com/supermotoscompany" target="_blank"> <i class="ti-instagram"></i></a>
                        <a href="https://www.tiktok.com/@supermotosrt" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                                <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 sm-padding wow fadeInUp" data-wow-delay="300ms"></div>
                <div class="col-lg-3 col-sm-6 sm-padding wow fadeInUp" data-wow-delay="500ms">
                    <div class="widget-content">
                        <h4>Encuentranos</h4>
                        <p><i class="fa fa-location-arrow text-primary mr-3"></i> Cra 64 # 68 Bogotá</p>
                        <span><i class="fa fa-whatsapp text-primary mr-3"></i>Info 3177952798 WhatsApp</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-section align-center">
        <div class="container">
            <p>Copyright © {{ date('Y') }} <a class="text-primary" href="https://luisferdeveloper.com">LuisferDeveloper</a></p>
        </div>
    </footer>

    <a data-scroll href="#header" id="scroll-to-top"><i class="arrow_carrot-up"></i></a>

    <!-- JS Files -->
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/vendor/tether.min.js') }}"></script>
    <script src="{{ asset('js/vendor/headroom.min.js') }}"></script>
    <script src="{{ asset('js/vendor/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/vendor/smooth-scroll.min.js') }}"></script>
    <script src="{{ asset('js/vendor/venobox.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('js/vendor/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/vendor/odometer.min.js') }}"></script>
    <script src="{{ asset('js/vendor/wow.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/brands.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/solid.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/fontawesome.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
</body>
</html>
