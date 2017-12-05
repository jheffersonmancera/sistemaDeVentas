<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categoria';

    protected $primaryKey='idcategoria';

    public $timestamps=false;

    //campos que resiviran un valor para guardarse en la base de datos 4-36 6:51
    protected $fillable =[
    	'nombre',
    	'descripcion',
    	'condicion'
    ];
    //campos que no se quieren asignados al modelo
    protected $guarded =[


    ];
}
