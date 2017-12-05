
{!! Form::open(array('url'=>'ventas/venta','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}

<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}"><!--16:14 7 CategoriaController.php esta esperando un objeto llamado searchText linea 25-->
		<span class="input-group-btn"><!--Para que el boton salga justo al lado de la caja de texto-->
			<button type="submit" class="btn btn-primary">Buscar</button><!--se envia lo que se escribe en la caja de texto a almacen categoria que a su vez llama al metodo index en la linea 21 y realiza el filtro con la palabra-->
			
		</span>
	</div>

</div>		

{{Form::close()}}
