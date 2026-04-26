@extends('layouts.app')

@section('title', 'Publicar mi Moto')

@section('content')
<section class="page-header padding">
    <div class="container">
        <div class="page-content text-center">
            <h2>Publica tu moto aquí</h2>
            <p>🏁 En SUPERMOTOS te conectamos con el mercado más grande de Colombia.</p>
        </div>
    </div>
</section>

<section class="service-section section-2 bg-grey padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 sm-padding">
                <div class="service-content wow fadeInLeft">
                    <h2>¡Supermotos!</h2>
                    <h3 class="text-success mt-20">A tener en cuenta:</h3>
                    <div class="mt-20" style="text-align: justify;">
                        {!! $textoPublica !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-6 sm-padding">
                <div class="service-content wow fadeInRight">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('motos.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-30 shadow-sm rounded">
                        @csrf
                        <p class="pb-10">Los campos con <span class="text-danger">*</span> son obligatorios.</p>
                        
                        <div class="form-group">
                            <label class="font-weight-bold d-block mb-10">Medio de pago <span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="pse" value="1" checked>
                                <label class="form-check-label" for="pse">PSE</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="transfer" value="2">
                                <label class="form-check-label" for="transfer">Transferencia Nequi / Daviplata / CORTESÍA</label>
                            </div>
                            <div id="medioPago" class="mt-10">
                                <h5 class="text-success small" id="payment-info">Su publicación quedará activa una vez se confirme el pago por medio de PSE.</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="buyerFullName">Nombres completos <span class="text-danger">*</span></label>
                                <input type="text" name="buyerFullName" id="buyerFullName" class="form-control" value="{{ old('buyerFullName') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="payerPhone">Teléfono <span class="text-danger">*</span></label>
                                <input type="text" name="payerPhone" id="payerPhone" class="form-control" value="{{ old('payerPhone') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="buyerEmail">Correo electrónico <span class="text-danger">*</span></label>
                            <input type="email" name="buyerEmail" id="buyerEmail" class="form-control" value="{{ old('buyerEmail') }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="billingCity">Ciudad <span class="text-danger">*</span></label>
                                <input type="text" name="billingCity" id="billingCity" class="form-control" value="{{ old('billingCity') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="nombre">Referencia de la moto <span class="text-danger">*</span></label>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej. Yamaha MT 09" value="{{ old('nombre') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="Marca">Marca <span class="text-danger">*</span></label>
                                <select name="Marca" id="Marca" class="form-control" required>
                                    @foreach(['AKT', 'APRILLA', 'BAJAJ', 'BENELLI', 'BMW', 'DUCATI', 'HARLEY DAVIDSON', 'HERO', 'HONDA', 'HUSQVARNA', 'KAWASAKI', 'KTM', 'KYMCO', 'PIAGGIO', 'ROYAL ENFIELD', 'SUZUKI', 'TVS', 'TRIUMPH', 'VICTORY', 'YAMAHA'] as $marca)
                                        <option value="{{ $marca }}" {{ old('Marca') == $marca ? 'selected' : '' }}>{{ $marca }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="tipoMoto">Tipo de Moto <span class="text-danger">*</span></label>
                                <select name="tipoMoto" id="tipoMoto" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    @foreach(['Deportiva', 'Naked', 'Touring', 'Scooter', 'Enduro', 'Cross', 'Calle', 'Custom'] as $tipo)
                                        <option value="{{ $tipo }}" {{ old('tipoMoto') == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="linea">Línea <span class="text-danger">*</span></label>
                                <input type="text" name="linea" id="linea" class="form-control" placeholder="Ej. MTN320-A (MT03)" value="{{ old('linea') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="modelo">Modelo <span class="text-danger">*</span></label>
                                <input type="number" name="modelo" id="modelo" class="form-control" placeholder="Ej. 2024" value="{{ old('modelo') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="kilometraje">Kilometraje <span class="text-danger">*</span></label>
                                <input type="text" name="kilometraje" id="kilometraje" class="form-control" placeholder="Ej. 24.200km" value="{{ old('kilometraje') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="soat-tecno-matricula">Soat-Tecno <span class="text-danger">*</span></label>
                                <input type="text" name="soat-tecno-matricula" id="soat-tecno-matricula" class="form-control" placeholder="Ej. Matriculada en Funza..." value="{{ old('soat-tecno-matricula') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción <span class="text-danger">*</span></label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="5" class="form-control">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="precio">Precio <span class="text-danger">*</span></label>
                                <input type="number" name="precio" id="precio" class="form-control" value="{{ old('precio') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="url">Contacto Instagram <span class="text-danger">*</span></label>
                                <input type="text" name="url" id="url" class="form-control" placeholder="Ej. https://instagram.com/..." value="{{ old('url') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fotos_cars">Fotos del Vehículo <span class="text-danger">*</span></label>
                            <input type="file" name="fotos_cars[]" id="fotos_cars" multiple accept="image/*" class="form-control-file" required style="border: none !important; height: auto !important;">
                            <small class="form-text text-muted">Puedes seleccionar varias imágenes.</small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-30">Guardar e Ir a Pagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#descripcion')).catch(error => { console.error(error); });
    
    document.querySelectorAll('input[name="payment_method"]').forEach(input => {
        input.addEventListener('change', function() {
            const info = document.getElementById('payment-info');
            if(this.value == '2') {
                info.innerText = "Su publicación quedará activa una vez se confirme el pago por WhatsApp y el administrador la active manualmente.";
            } else {
                info.innerText = "Su publicación quedará activa una vez se confirme el pago por medio de PSE.";
            }
        });
    });
</script>
@endpush
