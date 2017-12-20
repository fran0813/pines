@if(auth()->user()->hasRole('Admin'))

    @extends('layouts.base')

    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12"></div>          
        </div>
    </div>
    @endsection

@else
    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
        <h1>No tiene permisos para ver esta página</h1>
    </div>
@endif