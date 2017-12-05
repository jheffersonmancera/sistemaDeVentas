@extends ('layouts.admin')
@section ('contenido')


            <div class="row">
             <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
             <label for="nombre">Cliente</label>
             <p>{{$venta->nombre}}</p>
            </div>
       </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
               <div class="form-group">
               <label>Tipo de Comprobante</label>
               <p>{{$venta->tipo_comprobante}}</p>
            </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                 <div class="form-group">
             <label for="serie_comprobante">Serie del Comprobante</label>
             <p>{{$venta->serie_comprobante}}</p>
            </div>
            </div>
               <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                 <div class="form-group">
              <label for="num_comprobante">Numero del Comprobante</label>
              <p>{{$venta->num_comprobante}}</p>
            </div>
            </div>
            </div>
            <div class="row">

            <div class="panel panel-primary">
              <div class="panel-body">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
            <thead style="background-color: #A9D0F5">
            <th>Articulo</th>
            <th>Cantidad</th>
            <th>Precio Venta</th>
            <th>Descuento</th>
            <th>Subtotal</th>
            </thead>
            <tfoot>

            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th><h4 id="total">{{$venta->total_venta}}</h4></th>
            </tfoot>
            <tbody>
              @foreach($detalles as $det)
              <tr>
                <td>{{$det->articulo}}</td>
                <td>{{$det->cantidad}}</td>
                <td>{{$det->precio_venta}}</td>
                <td>{{$det->descuento}}</td>
                <td>{{$det->cantidad*$det->precio_venta-$det->descuento}}</td>
              </tr>
              @endforeach

            </tbody>
            </table>
            </div>
            </div>
            </div>

            </div>
 @endsection  
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

  function agregar(){
    idarticulo=$("#pidarticulo").val();
    articulo=$("#pidarticulo option:selected").text();
    cantidad=$("#pcantidad").val();
    precio_compra=$("#pprecio_compra").val();
    precio_venta=$("#pprecio_venta").val();

    if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_compra!="" && precio_venta!="")
    {
       subtotal[cont]=(cantidad*precio_compra);
       total=total+subtotal[cont];

       var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[cont]+'</td></tr>';
       cont++;
       limpiar();
       $('#total').html("$/ " + total);
       evaluar();
       $('#detalles').append(fila);

    }
    else
    {
      alert("Error al ingresar el detalle del ingreso, revise los datos del articulo")
    }

  }
  function limpiar(){
    $("#pcantidad").val("");
    $("#pprecio_compra").val("");
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
    $("#fila" + index).remove();
    evaluar();

  }
         </script>
         @endpush
  
