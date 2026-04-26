@extends('layouts.app')

@section('title', 'Respuesta de Pago')

@section('content')
<section class="payment-response padding bg-grey">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="bg-white p-50 text-center shadow-sm rounded">
                    @if($status == 'approved')
                        <div class="mb-30">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#198754" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 1 0-1.06-1.06L7.5 9.439 5.53 7.47a.75.75 0 0 0-1.06 1.06l2.5 2.5z"/>
                            </svg>
                        </div>
                        <h1 class="mb-20">¡Pago Exitoso!</h1>
                        <p class="lead mb-30">
                            Gracias por tu pago. Tu publicación <strong>{{ $moto->nombre ?? '' }}</strong> ahora se encuentra activa en nuestra página.
                        </p>
                        <a href="{{ route('motos.show', md5($moto->id_moto_disp ?? 0)) }}" class="btn btn-primary">Ver mi publicación</a>
                    @else
                        <div class="mb-30">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#dc3545" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </div>
                        <h1 class="text-danger mb-20">¡Pago Fallido o Rechazado!</h1>
                        <p class="mb-30">
                            Lo sentimos, tu pago no pudo ser procesado. Por favor verifica los datos de tu tarjeta o intenta con otro método de pago.
                        </p>
                        <a href="{{ route('motos.create') }}" class="btn btn-warning">Intentar nuevamente</a>
                    @endif
                    
                    <div class="mt-30">
                        <a href="{{ route('home') }}" class="text-muted small">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
