@extends('layouts.app')

@section('title', 'Gestión de Pedidos')

@section('content')
<section class="page-header padding">
    <div class="container">
        <div class="page-content text-center">
            <h2>Gestión de Pedidos</h2>
            <p>Administra las compras de accesorios.</p>
        </div>
    </div>
</section>

<section class="admin-section padding bg-grey">
    <div class="container">
        @include('admin.partials.menu')
        <div class="bg-white p-30 shadow-sm rounded">
            <h4 class="mb-20 text-primary">Publicaciones de Motos Pendientes</h4>
            @if($pendingMotos->count() > 0)
                <div class="table-responsive">
                    <table class="table mb-50 admin-table-mobile">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Moto</th>
                                <th>Valor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingMotos as $moto)
                                <tr>
                                    <td>#{{ $moto->id_moto_disp }}</td>
                                    <td><small>{{ $moto->fecha_registro }}</small></td>
                                    <td>
                                        <div class="font-weight-bold">{{ $moto->nombre_clie_moto }}</div>
                                        <small>{{ $moto->telefono_clie_moto }}</small>
                                    </td>
                                    <td>{{ $moto->nombre }} <span class="text-muted">({{ $moto->modelo }})</span></td>
                                    <td><span class="text-success font-weight-bold">${{ number_format($moto->valor, 0, ',', '.') }}</span></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <form action="{{ route('admin.motos.activate', $moto->id_moto_disp) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-xs btn-success" title="Activar">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </form>
                                            <button class="btn btn-xs btn-info btn-preview" data-id="{{ $moto->id_moto_disp }}" title="Ver">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-light mb-50">No hay publicaciones pendientes de revisión.</div>
            @endif

            <h4 class="mb-20">Listado de Pedidos (Accesorios)</h4>
            <div class="table-responsive">
                <table class="table admin-table-mobile">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Ciudad</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id_carrito_pro }}</td>
                                <td><small>{{ $order->fch_registro }}</small></td>
                                <td>{{ $order->nombre_cli }}</td>
                                <td>{{ $order->ciudad_cli }}</td>
                                <td>{{ $order->telefono_cli }}</td>
                                <td>
                                    @if($order->estado == 1)
                                        <span class="badge badge-success">Pagado</span>
                                    @else
                                        <span class="badge badge-warning">Pendiente</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-xs btn-info"><i class="fa fa-pencil-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-20">
                {{ $orders->links() }}
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
