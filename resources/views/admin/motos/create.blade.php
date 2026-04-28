@extends('layouts.app')

@section('title', isset($moto) ? 'Editar Moto - Admin' : 'Registrar Moto Disponible - Admin')

@section('content')
<section class="page-header padding">
    <div class="container">
        <div class="page-content text-center">
            <h2>{{ isset($moto) ? 'Editar Moto Disponible' : 'Nueva Moto Disponible' }}</h2>
            <p>{{ isset($moto) ? 'Actualiza la información de la publicación.' : 'Registro administrativo de vehículos.' }}</p>
        </div>
    </div>
</section>

<section class="admin-section padding bg-grey">
    <div class="container">
        @include('admin.partials.menu')
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="bg-white p-40 shadow-sm rounded">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 small">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ isset($moto) ? route('admin.motos.update', $moto->id_moto_disp) : route('admin.motos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($moto))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6 form-group mb-20">
                                <label>Nombre / Referencia <span class="text-danger">*</span></label>
                                <input type="text" name="nombre" class="form-control" placeholder="Ej. Yamaha R6" value="{{ old('nombre', $moto->nombre ?? '') }}" required>
                            </div>
                            <div class="col-md-6 form-group mb-20">
                                <label>Marca <span class="text-danger">*</span></label>
                                <select name="marca" class="form-control" required>
                                    @foreach(['AKT', 'APRILLA', 'BAJAJ', 'BENELLI', 'BMW', 'DUCATI', 'HARLEY DAVIDSON', 'HERO', 'HONDA', 'HUSQVARNA', 'KAWASAKI', 'KTM', 'KYMCO', 'PIAGGIO', 'ROYAL ENFIELD', 'SUZUKI', 'TVS', 'TRIUMPH', 'VICTORY', 'YAMAHA'] as $marca)
                                        <option value="{{ $marca }}" {{ old('marca', $moto->marca ?? '') == $marca ? 'selected' : '' }}>{{ $marca }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-20">
                                <label>Tipo de Moto <span class="text-danger">*</span></label>
                                <select name="tipoMoto" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    @foreach(['Deportiva', 'Naked', 'Touring', 'Scooter', 'Enduro', 'Cross', 'Calle', 'Custom'] as $tipo)
                                        <option value="{{ $tipo }}" {{ old('tipoMoto', $moto->tipoMoto ?? '') == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-20">
                                <label>Línea <span class="text-danger">*</span></label>
                                <input type="text" name="linea" class="form-control" placeholder="Ej. MTN320-A (MT03)" value="{{ old('linea', $moto->linea ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group mb-20">
                                <label>Modelo <span class="text-danger">*</span></label>
                                <input type="number" name="modelo" class="form-control" placeholder="Ej. 2024" value="{{ old('modelo', $moto->modelo ?? '') }}" required>
                            </div>
                            <div class="col-md-4 form-group mb-20">
                                <label>Kilometraje <span class="text-danger">*</span></label>
                                <input type="text" name="kilometraje" class="form-control" placeholder="Ej. 10.500km" value="{{ old('kilometraje', $moto->kilometraje ?? '') }}" required>
                            </div>
                            <div class="col-md-4 form-group mb-20">
                                <label>Ciudad de Matrícula <span class="text-danger">*</span></label>
                                <input type="text" name="ciudad" class="form-control" placeholder="Ej. Bogotá" value="{{ old('ciudad', $moto->ciudad_clie_moto ?? '') }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-20">
                            <label>Soat-Tecno-Matricula <span class="text-danger">*</span></label>
                            <input type="text" name="soat_tecno_matri" class="form-control" placeholder="Ej. Soat hasta Dic 2024..." value="{{ old('soat_tecno_matri', $moto->soat_tecno_matri ?? '') }}" required>
                        </div>

                        <div class="form-group mb-20">
                            <label>Descripción <span class="text-danger">*</span></label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="5" class="form-control">{{ old('descripcion', $moto->descripcion ?? '') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-20">
                                <label>Precio <span class="text-danger">*</span></label>
                                <input type="number" name="valor" class="form-control" placeholder="Ej. 45000000" value="{{ old('valor', $moto->valor ?? '') }}" required>
                            </div>
                            <div class="col-md-6 form-group mb-20">
                                <label>Url Instagram <span class="text-danger">*</span></label>
                                <input type="text" name="url_insta" class="form-control" placeholder="Ruta Instagram" value="{{ old('url_insta', $moto->url_insta ?? '') }}">
                            </div>
                        </div>

                        <div class="form-group mb-20">
                            <label>Fotos del Vehículo @if(!isset($moto))<span class="text-danger">*</span>@endif</label>
                            <input type="file" name="archivo[]" multiple accept="image/*" class="form-control-file" {{ isset($moto) ? '' : 'required' }}>
                            @if(isset($moto) && !empty($moto->fotos))
                                <small class="form-text text-muted">Si subes nuevas imágenes, reemplazarán las actuales.</small>
                                <div class="d-flex flex-wrap gap-2 mt-10">
                                    @foreach(explode(',', $moto->fotos) as $image)
                                        <img src="{{ $moto->photoUrl($image) }}" alt="Foto actual" style="width: 90px; height: 70px; object-fit: cover;" class="rounded border">
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="form-group mb-30">
                            <label>Tipo de Inventario <span class="text-danger">*</span></label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="moto_inv_ext" id="inv_int" value="1" {{ (string) old('moto_inv_ext', $moto->moto_inv_ext ?? '') === '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="inv_int">Moto Inventario Interno</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="moto_inv_ext" id="inv_ext" value="2" {{ (string) old('moto_inv_ext', $moto->moto_inv_ext ?? '') === '2' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="inv_ext">Moto Cliente Externo</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">{{ isset($moto) ? 'Actualizar Moto' : 'Guardar Moto' }}</button>
                            <a href="{{ isset($moto) && $moto->estado == 0 ? route('admin.orders') : route('admin.motos') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
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
</script>
@endpush
