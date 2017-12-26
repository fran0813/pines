@if(auth()->user()->hasRole('Admin'))

	@extends('layouts.base')

    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-ls-12 col-sm-12 text-center" id="loader"></div>
            <div class="col-md-12 col-ls-12 col-sm-12" id="mostrarTablaInformacion"></div>
        </div>
    </div>
    @endsection

    @include('admin.modal.informacion')

    @section('javascript')
    	<script src="{{ asset('js/admin/informacion.js') }}"></script>
    @endsection

@else
    <div class="col-md-12 col-ls-12 col-sm-12 text-center">
        <h1>No tiene permisos para ver esta página</h1>
    </div>
@endif