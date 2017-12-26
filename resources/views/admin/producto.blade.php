@if(auth()->user()->hasRole('Admin'))

    @extends('layouts.base')

    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-ls-12 col-sm-12 text-center" id="loader" style="margin-top: 3%;"></div>
            <div class="col-md-12 col-ls-12 col-sm-12" id="mostrarTablaProductos"></div>          
        </div>
    </div>
    @endsection

    @include('admin.modal.actualizarProducto')
    @include('admin.modal.eliminarProducto')
    @include('admin.modal.cargar')

    @section('javascript')
        <script src="{{ asset('js/admin/producto.js') }}"></script>
    @endsection

@else
    <div class="col-md-12 col-ls-12 col-sm-12 text-center">
        <h1>No tiene permisos para ver esta página</h1>
    </div>
@endif