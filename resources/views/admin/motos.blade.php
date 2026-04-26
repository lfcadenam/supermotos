@extends('layouts.app')

@section('title', 'Gestión de Motos')

@section('content')
<section class="page-header padding">
    <div class="container">
        <div class="page-content text-center">
            <h2>Gestión de Motos</h2>
            <p>Administra las publicaciones de vehículos.</p>
        </div>
    </div>
</section>

<section class="admin-section padding bg-grey">
    <div class="container">
        @include('admin.partials.menu')
        <div class="bg-white p-30 shadow-sm rounded">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <h4>Listado de Motos</h4>
                <a href="{{ route('motos.create') }}" class="btn btn-primary">Nueva Publicación</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Referencia</th>
                            <th>Marca</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($motos as $moto)
                            <tr>
                                <td><span class="text-muted small">#{{ $moto->id_moto_disp }}</span></td>
                                <td>
                                    @php 
                                        $fotos = explode(',', $moto->fotos); 
                                        $mainFoto = !empty($fotos[0]) ? trim($fotos[0]) : 'no-image.png';
                                        $folder = ($moto->moto_inv_ext == 2) ? 'fotos_motos/' : 'admin_files/fotos_motos/';
                                    @endphp
                                    <div class="rounded shadow-sm overflow-hidden" style="width: 60px; height: 45px;">
                                        <img src="{{ asset($folder . $mainFoto) }}" alt="{{ $moto->nombre }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('img/no-image.png') }}'">
                                    </div>
                                </td>
                                <td><strong>{{ $moto->nombre }}</strong></td>
                                <td>{{ $moto->marca }}</td>
                                <td><span class="text-success font-weight-bold">${{ number_format($moto->valor, 0, ',', '.') }}</span></td>
                                <td>
                                    @if($moto->estado == 1)
                                        <span class="badge bg-success text-white px-2 py-1">Activa</span>
                                    @elseif($moto->estado == 0)
                                        <span class="badge bg-warning text-dark px-2 py-1">Pendiente</span>
                                    @else
                                        <span class="badge bg-danger text-white px-2 py-1">Inactiva</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-info btn-preview" data-id="{{ $moto->id_moto_disp }}" title="Previsualizar">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-primary" title="Editar"><i class="fa fa-pencil-alt"></i></button>
                                        <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-20">
                {{ $motos->links() }}
            </div>
        </div>
    </div>
</section>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vista Previa de Publicación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="previewContent">
                <div class="text-center p-5">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.btn-preview').on('click', function() {
        const id = $(this).data('id');
        $('#previewContent').html('<div class="text-center p-5"><div class="spinner-border text-primary" role="status"></div></div>');
        $('#previewModal').modal('show');
        
        $.get(`/admin/motos/${id}/preview`, function(data) {
            $('#previewContent').html(data);
        });
    });
});
</script>
@endpush
