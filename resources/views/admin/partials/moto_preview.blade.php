<div class="row">
    <div class="col-md-6">
        <div id="previewCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @php
                    $images = explode(',', $moto->fotos);
                    $folder = ($moto->moto_inv_ext == 2) ? 'fotos_motos/' : 'admin_files/fotos_motos/';
                @endphp
                @foreach($images as $index => $image)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img class="d-block w-100" src="{{ asset($folder . trim($image)) }}" alt="Imagen {{ $index }}" style="height: 300px; object-fit: cover;">
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#previewCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#previewCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>
    </div>
    <div class="col-md-6">
        <h4>{{ $moto->nombre }}</h4>
        <p class="text-primary font-weight-bold" style="font-size: 20px;">💰 ${{ number_format($moto->valor, 0, ',', '.') }}</p>
        <ul class="list-unstyled">
            <li><strong>Modelo:</strong> {{ $moto->modelo }}</li>
            <li><strong>Kilometraje:</strong> {{ $moto->kilometraje }}</li>
            <li><strong>Ubicación:</strong> {{ $moto->ciudad_clie_moto ?? $moto->ciudad }}</li>
            <li><strong>Marca:</strong> {{ $moto->marca }}</li>
        </ul>
        <hr>
        <h6>Descripción:</h6>
        <div style="max-height: 150px; overflow-y: auto; font-size: 13px;">
            {!! $moto->descripcion !!}
        </div>
    </div>
</div>
