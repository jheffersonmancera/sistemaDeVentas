@extends ('layouts.admin')
@section ('contenido')
 <div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Nueva Venta</h3>
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
   {!!Form::open(array('url'=>'ventas/venta','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="row">
             <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
             <label for="nombre">Cliente</label>
             <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
              @foreach($personas as $persona)
              <option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>
              @endforeach
              </select>
            </div>
       </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
               <div class="form-group">
               <label>Tipo de Comprobante</label>
               <select name="tipo_comprobante" class="form-control">
               <option value="Boleta">Boleta</option>
               <option value="Factura">Factura</option>
               <option value="Ticket">Ticket</option>
               </select>
            </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                 <div class="form-group">
             <label for="serie_comprobante">Serie del Comprobante</label>
             <input type="text" name="serie_comprobante" value="{{old('serie_comprobante')}}" class="form-control" placeholder="Serie del Comprobante..">
            </div>
            </div>
               <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                 <div class="form-group">
              <label for="num_comprobante">Numero del Comprobante</label>
              <input type="text" name="num_comprobante" required value="{{old('num_comprobante')}}" class="form-control" placeholder="Numero del Comprobante..">
            </div>
            </div>
            </div>
            <div class="row">
            <div class="panel panel-primary">
            <div class="panel-body">
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
            <label>Articulo</label>
            <select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true">
            @foreach($articulos as $articulo)
            <option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_promedio}}">{{$articulo->articulo}}</option>
            @endforeach
            </select>
            </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
                </div>
            </div>

            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" disabled name="pstock" id="pstock" class="form-control" placeholder="Stock">
                </div>
            </div>    

            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <label for="precio_venta">Precio de venta</label>
                    <input type="number" disabled name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="P.Venta">
                </div>
            </div>

            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <label for="descuento">Descuento</label>
                     <input type="number" name="pdescuento" id="pdescuento" class="form-control" placeholder="P.Compra">
                </div>
            </div>
              
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
            <button class="btn btn-primary" type="button" id="bt_add">Agregar</button>
            </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
            <thead style="background-color: #A9D0F5">
            <th>Opciones</th>
            <th>Articulo</th>
            <th>Cantidad</th>
            <th>Precio Venta</th>
            <th>Descuento</th>
            <th>Subtotal</th>
            </thead>
            <tfoot>
            <th>TOTAL</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th><h4 id="total">$/. 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
            </tfoot>
            <tbody>              
            </tbody>
            </table>
            </div>
            </div>
            </div>
            </div>
           <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">         
            <div class="form-group">
            <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
             <button class="btn btn-primary" type="submit">Guardar</button>
             <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
            </div>
            </div>
   {!!Form::close()!!}  
         @push ('scripts')
         <script>
           $(document).ready(function(){
        $('#bt_add').click(function(){
         agregar();
         });
       });

  var cont=0;
  total=0;
  subtotal=[];
  $("#guardar").hide();
  $("#pidarticulo").change(mostrarValores);//trae los valores del articulo cada vez que se seleccione

  function mostrarValores()
  {
    datosArticulo=document.getElementById('pidarticulo').value.split('_');
    $("#pprecio_venta").val(datosArticulo[2]);
    $("#pstock").val(datosArticulo[1]);
  }

  function agregar(){
    datosArticulo=document.getElementById('pidarticulo').value.split('_');

    idarticulo=datosArticulo[0];
    articulo=$("#pidarticulo option:selected").text();
    cantidad=$("#pcantidad").val();

    descuento=$("#pdescuento").val();
    precio_venta=$("#pprecio_venta").val();
    stock=$("#pstock").val();

    if (idarticulo!="" && cantidad!="" && cantidad>0 && descuento!="" && precio_venta!="")
    {
        if (stock>=cantidad) 
        {
          subtotal[cont]=(cantidad*precio_venta-descuento);
          total=total+subtotal[cont];

          var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td><input type="number" name="descuento[]" value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';
          cont++;
          limpiar();
          $("#total").html("$/. " + total);
          $("#total_venta").val(total);
          evaluar();
          $('#detalles').append(fila);
        }
        else
        {
          alert("La cantidad a vender supera el stock actual");
        }
    }
    else
    {
      alert("Error al ingresar el detalle de la venta, revise los datos del articulo")
    }
  
  }
  function limpiar(){
    $("#pcantidad").val("");
    $("#pdescuento").val("");
    $("#pprecio_venta").val("");
  }

  function evaluar()
  {
    if (total>0)
    {
      $("#guardar").show();
    }
    else
    {
      $("#guardar").hide(); 
    }
   }

   function eliminar(index){
    total=total-subtotal[index]; 
    $("#total").html("S/. " + total);  
    $("#total_venta").val(total);  
    $("#fila" + index).remove();
    evaluar();

  }
         </script>
         @endpush
         @endsection