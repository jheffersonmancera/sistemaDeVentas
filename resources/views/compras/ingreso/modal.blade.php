<div class="modal fave modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$ing->idingreso}}">
    {{Form::Open(array('action'=>array('IngresoController@destroy',$ing->idingreso),'method'=>'delete'))}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                </button>
                <h4 class="modal-title">Cancelar Ingreso</h4>
            </div>
            <div class="modal-body">
               <p>Esta a punto de cancelar un Ingreso a almacén</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" type="submit">Confirmar</button>
            </div>
        </div>
    </div>
    {{Form::Close()}}

</div>
