@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8  col-xs-12">
		<h3>Listado de Categorías <a href="categoria/create"><button class="btn btn-success">Nuevo</button></a></h3>
		<!--//se incluye la vista search.blade.php-->
		
		@include('almacen.categoria.search')
	</div> <!-- //14:01 7-36--> 
</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>	
					<th>Descripción</th>
					<th>Opciones</th>
				</thead>
				@foreach($categorias as $cat)
				<tr>
					<td>{{$cat->idcategoria}}</td>
					<td>{{$cat->nombre}}</td>
					<td>{{$cat->descripcion}}</td>
					<td>
					        <!--llamo a CategoriaController y el metodo edit y enviamos el idcategoria-->
                    <a href="{{URL::action('CategoriaController@edit',$cat->idcategoria)}}"><button class="btn btn-info">Editar</button></a>
                    <a href="" data-target="#modal-delete-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.categoria.modal')
				@endforeach
			</table>
			</div>
			{{$categorias->render()}}
			<!--el metodo render nos va a permitir paginar.-->
			<!--10:29 7-->
		</div>
	</div>
	
@endsection
<!-->//7-36  </!-->