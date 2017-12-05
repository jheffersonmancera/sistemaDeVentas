<!--15-36  5:43 -->
<div class="modal fave modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$per->idpersona}}">
    {{Form::Open(array('action'=>array('ClienteController@destroy',$per->idpersona),'method'=>'delete'))}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                </button>
                <h4 class="modal-title">Eliminar Cliente</h4>
            </div>
            <div class="modal-body">
               <p>Va a eliminar un cliente</p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" type="submit">Confirmar</button>
            </div>
        </div>
    </div>
    {{Form::Close()}}
        
</div>