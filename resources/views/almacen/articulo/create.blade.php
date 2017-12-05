@extends ('layouts.admin')
@section ('contenido')
<!--8-36 2:33-->
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Nueva Articulo</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
			</div>
			@endif

		</div>	
	</div>	

			<!--CategoriaController, si el metodo es POST llama a la funcion store, si el metodo es path va a llamar a la funcion update, si el metodo es  delete llama a la funcion destroy-->
			{!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}<!-- 13-36 3:13 se habilita files para que permita enviar archivos-->
			{{Form::token()}}
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
					</div>	
				</div>


				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label>Categoría</label>
						<select name="idcategoria" class="form-control"><!--con el name se valida en el ArticuloFormRequest-->
							<!--voy a recibir todas las categorias en una variable $categorias desde el metodo create de ArticuloController-->
							@foreach ($categorias as $cat)
								<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
							@endforeach
						</select>
					</div>		
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="codigo">Código</label>
						<input type="text" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Código del artículo...">
					</div>						
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="stock">Stock</label>
						<input type="text" name="stock" required value="{{old('stock')}}" class="form-control" placeholder="Stock del artículo...">
					</div>		
					
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="descripcion">Descripción</label>
						<input type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control" placeholder="Descripción del artículo...">
					</div>		
					
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="imagen">Imagen</label>
						<input type="file" name="imagen" class="form-control">
					</div>		
					
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<button class="btn btn-primary" type="submit">Guardar</button>
						<button class="btn btn-danger" type="reset">Cancelar</button>
					</div>
				</div>
			</div>
			
			
			{!!Form::close()!!}
	

@endsection