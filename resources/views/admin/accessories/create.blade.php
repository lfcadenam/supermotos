@extends('layouts.app')

@section('title', isset($accessory) ? 'Editar Accesorio' : 'Nuevo Accesorio')

@section('content')
<section class="page-header padding">
    <div class="container">
        <div class="page-content text-center">
            <h2>{{ isset($accessory) ? 'Editar Accesorio' : 'Nuevo Accesorio' }}</h2>
            <p>{{ isset($accessory) ? 'Actualiza el producto del catálogo.' : 'Agrega un producto al catálogo.' }}</p>
        </div>
    </div>
</section>

<section class="admin-section padding bg-grey">
    <div class="container">
        @include('admin.partials.menu')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="bg-white p-30 shadow-sm rounded">
                    <form action="{{ isset($accessory) ? route('admin.accessories.update', $accessory->id_accesorio) : route('admin.accessories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($accessory))
                            @method('PUT')
                        @endif
                        <div class="form-group mb-20">
                            <label>Nombre del Accesorio</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $accessory->nombre ?? '') }}" required>
                        </div>

                        <div class="form-group mb-20">
                            <label>Precio (COP)</label>
                            <input type="number" name="valor" class="form-control" value="{{ old('valor', $accessory->valor ?? '') }}" required>
                        </div>

                        <div class="form-group mb-20">
                            <label>Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="4" required>{{ old('descripcion', $accessory->descripcion ?? '') }}</textarea>
                        </div>

                        <div class="form-group mb-30">
                            <label>Imagen del Producto @if(!isset($accessory))<span class="text-danger">*</span>@endif</label>
                            <input type="file" name="foto" class="form-control-file" accept="image/*" {{ isset($accessory) ? '' : 'required' }}>
                            @if(isset($accessory) && $accessory->foto)
                                <div class="mt-10">
                                    <img src="{{ $accessory->photoUrl() }}" alt="Imagen actual" style="width: 110px; height: 90px; object-fit: cover;" class="rounded border">
                                </div>
                            @endif
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">{{ isset($accessory) ? 'Actualizar Accesorio' : 'Guardar Accesorio' }}</button>
                            <a href="{{ route('admin.accessories') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
