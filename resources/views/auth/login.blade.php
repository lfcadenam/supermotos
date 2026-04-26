@extends('layouts.app')

@section('title', 'Iniciar Sesión - Supermotos')

@section('content')
<section class="login-section padding bg-grey">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="bg-white p-40 shadow-sm rounded">
                    <div class="text-center mb-30">
                        <img src="{{ asset('img/logo.png') }}" alt="Supermotos" width="150">
                        <h3 class="mt-20">Acceso Administrativo</h3>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 small">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="form-group mb-20">
                            <label>Nombre de Usuario</label>
                            <input type="text" name="usuario" class="form-control" value="{{ old('usuario') }}" required autofocus>
                        </div>
                        
                        <div class="form-group mb-20">
                            <label>Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-check mb-20">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Recordarme</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Ingresar al Panel</button>
                    </form>
                    
                    <div class="mt-20 text-center">
                        <a href="{{ route('home') }}" class="text-muted small">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
