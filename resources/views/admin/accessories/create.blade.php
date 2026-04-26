@extends('layouts.app')

@section('title', 'Nuevo Accesorio')

@section('content')
<section class="page-header padding">
    <div class="container">
        <div class="page-content text-center">
            <h2>Nuevo Accesorio</h2>
            <p>Agrega un producto al catálogo.</p>
        </div>
    </div>
</section>

<section class="admin-section padding bg-grey">
    <div class="container">
        @include('admin.partials.menu')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="bg-white p-30 shadow-sm rounded">
                    <form action="{{ route('admin.accessories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-20">
                            <label>Nombre del Accesorio</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <div class="form-group mb-20">
                            <label>Precio (COP)</label>
                            <input type="number" name="valor" class="form-control" required>
                        </div>

                        <div class="form-group mb-20">
                            <label>Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="form-group mb-30">
                            <label>Imagen del Producto</label>
                            <input type="file" name="foto" class="form-control-file" accept="image/*" required>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Guardar Accesorio</button>
                            <a href="{{ route('admin.accessories') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
