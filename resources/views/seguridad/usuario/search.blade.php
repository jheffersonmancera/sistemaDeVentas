{!! Form::open(array('url'=>'seguridad/usuario','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}

<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}"><!--16:14 7 CategoriaController.php esta esperando un objeto llamado searchText linea 25-->
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
			
		</span>
	</div>

</div>		

{{Form::close()}}
