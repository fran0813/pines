@if(auth()->user()->hasRole('Admin'))

    @extends('layouts.base')

    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form id="formGenerarPines">
                    <div class="col-md-6 col-ls-6 col-sm-6" style="margin-bottom: 20px;">                        
                        <div class="col-md-12 col-ls-12 col-sm-12">
                            <label class="control-label" for="titulo">Título</label>
                            <input class="form-control" type="text" id="titulo" style="margin-bottom: 2%;" required>

                            <label class="control-label" for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" rows="4" style="resize: none;"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 col-ls-6 col-sm-6">            
                        <div class="col-md-12 col-ls-12 col-sm-12">
                            <label class="control-label" for="numero">Cuantos pines quiere generar?</label>
                            <input class="form-control" type="number" id="numero" min="10" value="100" style="margin-bottom: 2%;" required>
                            <button id="generar" class="btn btn-success" type="submit">Generar</button>

                            <p id="respuestaCrearPines" style="margin-top: 3%;"></p>                          
                        </div>                              
                    </div>
                </form>

                <div class="col-md-12 col-ls-12 col-sm-12 text-center" id="loader" style="margin-top: 3%;"></div>
                <div class="col-md-12 col-ls-12 col-sm-12" id="tablaPinesGenerados"></div>
            </div>          
        </div>
    </div>
    @endsection

    @section('javascript')
        <script src="{{ asset('js/admin/pin.js') }}"></script>
    @endsection

@else
    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
        <h1>No tiene permisos para ver esta página</h1>
    </div>
@endif