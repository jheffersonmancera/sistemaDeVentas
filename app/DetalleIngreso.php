<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table='detalle_ingreso';

    protected $primaryKey='iddetalle_ingreso';

    public $timestamps=false;

    //campos que resiviran un valor para guardarse en la base de datos 4-36 6:51
    protected $fillable =[
    	'idingreso',
    	'idarticulo',
    	'cantidad',
    	'precio_compra',
    	'precio_venta'
    ];
    //campos que no se quieren asignados al modelo
    protected $guarded =[


    ];
}
