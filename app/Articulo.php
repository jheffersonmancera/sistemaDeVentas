<?php
//10-36
namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table='articulo';

    protected $primaryKey='idarticulo';

    public $timestamps=false;

    //campos que resiviran un valor para guardarse en la base de datos 4-36 6:51
    protected $fillable =[
    	'idcategoria',
    	'codigo',
    	'nombre',
        'stock',
        'descripcion',
        'imagen',
        'estado'        
    ];
    //campos que no se quieren asignados al modelo
    protected $guarded =[


    ];
}
