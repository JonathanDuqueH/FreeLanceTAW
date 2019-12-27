<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use Illuminate\Support\Facades\DB;

class ServicioController extends Controller
{

    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $servicios = Servicio::join('productos', 'servicios.idproducto', '=', 'productos.id')
            ->select('servicios.id as idserv' , 'productos.id as idproducto', 'servicios.titulo', 'productos.nombre', 'servicios.tiempo',
                        'servicios.descripcion', 'servicios.costo as costoserv', 'servicios.estado')
            ->orderBy('servicios.id')->paginate(4);
        }else{
            $servicios = Servicio::join('productos', 'servicios.idproducto', '=', 'productos.id')
            ->select('servicios.id as idserv', 'productos.id as idproducto', 'servicios.titulo', 'productos.nombre', 'servicios.tiempo',
                        'servicios.descripcion', 'servicios.costo', 'servicios.estado')
            ->where('servicios.titulo', 'like', '%'. $buscar.'%')
            ->orderBy('servicios.id')->paginate(4);
        }
        return [
            'pagination' => [
                'total' =>        $servicios->total(),
                'current_page' => $servicios->currentPage(),
                'per_page' =>     $servicios->perPage(),
                'last_page' =>    $servicios->lastPage(),
                'from' =>         $servicios->firstItem(),
                'to' =>           $servicios->lastItem(),
            ],
            'servicios'=>$servicios
        ];
    }

    public function store(Request $request)
    {
        //
        $servicio = new Servicio();
        $servicio->titulo = $request->titulo;
        $servicio->idproducto = $request->idproducto;
        $servicio->tiempo = $request->tiempo;
        $servicio->descripcion = $request->descripcion;
        $servicio->costo = $request->costoserv;
        $servicio->estado = '1';
        $servicio->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        //
        try {
            DB::beginTransaction();
            
            $servicio = Servicio::findOrFail($request->servicio_id);
            $servicio->titulo = $request->titulo;
            $servicio->idproducto = $request->idproducto;
            $servicio->tiempo = $request->tiempo;
            $servicio->descripcion = $request->descripcion;
            $servicio->costo = $request->costoserv;
            $servicio->estado = '1';
            $servicio->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /*DESACTIVAR SERVICIO*/
    public function desactivar(Request $request){

        if(!$request->ajax()) return redirect('/');
        $servicio = Servicio::findOrFail($request->servicio_id);
        $servicio->estado = '0';
        $servicio->save();
    }

    /*ACTIVAR SERVICIO*/
    public function activar(Request $request){

        if(!$request->ajax()) return redirect('/');
        $servicio = Servicio::findOrFail($request->servicio_id);
        $servicio->estado = '1';
        $servicio->save();
    }
}
