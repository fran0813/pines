<div class="modal fade" id="modalActualizarProducto" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Editar producto</h4>
            </div>
            
            <div class="modal-body">
                <input id="idActualizarProducto" type="text" style="display: none;" disabled>
                <form id="formActualizarProducto">
                    <label class="control-label" for="actualizarProducto">Nombre del producto</label>
                    <input id="actualizarProducto" class="form-control" type="text">
                    <textarea class="form-control" id="actualizarDescripcion" rows="4" style="resize: none; margin-top: 2%;"></textarea>
                    <button class="btn btn-info" type="submit" style="margin-top: 1%;">Actualizar</button>
                </form>
                <p id="respuestaActualizarProducto"></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>