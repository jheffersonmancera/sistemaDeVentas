<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;//sube imagen del cliente al servidor
use sisVentas\Http\Requests\ArticuloFormRequest;
use sisVentas\Articulo;//modelo
use DB;
/*10-36 7:28*/
class ArticuloController extends Controller
{
    
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if($request)
                {
                    $query=trim($request->get('searchText'));//campo que queremos filtrar
                    $articulos=DB::table('articulo as a')
                    ->join('categoria as c','a.idcategoria','=','c.idcategoria')   
                    ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
                    ->where('a.nombre','LIKE','%'.$query.'%')
                    ->orwhere('a.codigo','LIKE','%'.$query.'%')
                    ->orderBy('a.idarticulo'/*,'desc'*/)
                    ->paginate(7);
                    return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
                }
    }
    public function create()//11-36 
    {
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();/*obtiene las categorias en la base de 
        //datos activas mediante el metodo GET para mostrarlas en un selecte para poderlas escoger a la hora de crear
        // un nuevo articulo*/
        return view("almacen.articulo.create",["categorias"=>$categorias]);//se envia con el parametro que contiene las categorias
    }
    public function store(ArticuloFormRequest $request)
    {
        $articulo= new Articulo;
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->estado='Activo';
        if (Input::hasFile('imagen')){
                $file=Input::file('imagen');
                $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
                $articulo->imagen=$file->getClientOriginalName();
        }    
        $articulo->save();
        return Redirect::to('almacen/articulo');  
    }
    public function show($id)
    {
        return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);//Articulo tabla para traer todo del articulo
    } 
    public function edit($id)
    {
        $articulo=Articulo::findOrFail($id);
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
    }
    public function update(ArticuloFormRequest $request,$id)
    {
        $articulo=Articulo::findOrFail($id);
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->estado='Activo';
        if (Input::hasFile('imagen')){
                $file=Input::file('imagen');
                $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
                $articulo->imagen=$file->getClientOriginalName();
        }    
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
    public function destroy($id)
    {
        $articulo=Articulo::findOrFail($id);
        $articulo->estado='Inactivo';
        $articulo->update();
        return Redirect::to('almacen/articulo ');
    }
}
