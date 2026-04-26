<div class="row mb-30">
    <div class="col-md-12">
        <div class="admin-nav-container bg-white shadow-sm rounded">
            <!-- Scrollable Nav Wrapper -->
            <div class="admin-nav-scrollable d-flex align-items-center p-15">
                <div class="admin-nav-links d-flex gap-2 flex-nowrap overflow-auto pb-2 pb-md-0 w-100">
                    <a href="{{ route('admin.index') }}" class="btn {{ request()->routeIs('admin.index') ? 'btn-primary' : 'btn-light' }} flex-shrink-0">
                        <i class="fa fa-home"></i> <span class="d-none d-md-inline">Inicio</span>
                    </a>
                    <a href="{{ route('admin.motos') }}" class="btn {{ request()->routeIs('admin.motos') ? 'btn-primary' : 'btn-light' }} flex-shrink-0">
                        <i class="fa fa-motorcycle"></i> <span class="d-none d-md-inline">Motos</span>
                    </a>
                    <a href="{{ route('admin.orders') }}" class="btn {{ request()->routeIs('admin.orders') ? 'btn-primary' : 'btn-light' }} flex-shrink-0">
                        <i class="fa fa-motorcycle"></i> <span class="d-none d-md-inline">Motos Pendientes</span>
                    </a>
                    <a href="{{ route('admin.accessories') }}" class="btn {{ request()->routeIs('admin.accessories*') ? 'btn-primary' : 'btn-light' }} flex-shrink-0">
                        <i class="fa fa-box"></i> <span class="d-none d-md-inline">Accesorios</span>
                    </a>
                    <div class="border-left mx-2 d-none d-md-block"></div>
                    <a href="{{ route('admin.motos.create') }}" class="btn btn-outline-info btn-sm flex-shrink-0">
                        <i class="fa fa-plus"></i> <span class="d-none d-md-inline">Moto</span>
                    </a>
                    <a href="{{ route('admin.accessories.create') }}" class="btn btn-outline-dark btn-sm flex-shrink-0">
                        <i class="fa fa-plus"></i> <span class="d-none d-md-inline">Accesorio</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
