<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\User;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    //
  public function index(Request $request){

    if(!$request->ajax()) return redirect('/');

    $buscar = $request->buscar;
    $criterio = $request->criterio;

    if($buscar==''){
      $proyecto = Proyecto::join('users as cliente', 'proyectos.iduser', '=', 'cliente.id')
                          ->join('users as responsable', 'proyectos.idresponsable', '=', 'responsable.id')
        ->select('proyectos.id', 'proyectos.iduser', 'proyectos.titulo', 'proyectos.descripcion', 'cliente.name', 'proyectos.inicio', 'proyectos.fin'
                  , 'proyectos.condicion', 'responsable.name as name_res', 'proyectos.idresponsable')
        ->orderBy('proyectos.id')->paginate(4);
    }else{
      $proyecto = Proyecto::join('users as cliente', 'proyectos.iduser', '=', 'cliente.id')
                          ->join('users as responsable', 'proyectos.idresponsable', '=', 'responsable.id')
      ->select('proyectos.id', 'proyectos.iduser', 'proyectos.titulo', 'proyectos.descripcion', 'cliente.name', 'proyectos.inicio', 'proyectos.fin'
                , 'proyectos.condicion', 'responsable.name as name_res', 'proyectos.idresponsable')
      ->where('proyectos.'.$criterio, 'like', '%'. $buscar.'%')
      ->orderBy('proyectos.id')->paginate(4);
    }
    
    return [
            'pagination' => [
                'total' =>        $proyecto->total(),
                'current_page' => $proyecto->currentPage(),
                'per_page' =>     $proyecto->perPage(),
                'last_page' =>    $proyecto->lastPage(),
                'from' =>         $proyecto->firstItem(),
                'to' =>           $proyecto->lastItem(),
            ],
            'proyecto'=>$proyecto
        ];
  }

  /*REGISTRO DE PROYECTOS*/
  public function store(Request $request){

    if(!$request->ajax()) return redirect('/');

    try{
        //REGISTRO EN LA TABLA PORYECTOS
        DB::beginTransaction();
        $proyecto = new Proyecto();
        $proyecto->titulo = $request->titulo;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->iduser = $request->iduser;
        $proyecto->idresponsable = auth()->id();
        $proyecto->inicio = $request->inicio;
        $proyecto->fin = $request->fin;
        $proyecto->condicion = '1';
        $proyecto->save();

        $user = new User();
        $user = User::findOrFail($request->iduser);
        $user->condicion = '1';
        $user->save();

        DB::commit();

    }catch(Exception $e){
        DB::rollBack();
    }
  }

  /*ACTUALIZACION DE PROYECTO*/
  public function update(Request $request){

    if(!$request->ajax()) return redirect('/');

    try {
        DB::beginTransaction();

        $proyecto = Proyecto::findOrFail($request->id);

        $proyecto->titulo = $request->titulo;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->iduser = $request->iduser;
        $proyecto->idresponsable = Auth::user()->id;
        $proyecto->inicio = $request->inicio;
        $proyecto->fin = $request->fin;
        $proyecto->condicion = $request->condicion;
        $proyecto->save();

        DB::commit();

    } catch (Exception $e) {
        DB::rollBack();
    }
  }

  /*CANCELAR PROYECTO*/
  public function cancelar(Request $request){

    if(!$request->ajax()) return redirect('/');
    $proyecto = Proyecto::findOrFail($request->id);
    $proyecto->condicion = '0';
    $proyecto->save();
  }

  /*ACTIVAR PROYECTO*/
  public function activar(Request $request){

    if(!$request->ajax()) return redirect('/');
    $proyecto = Proyecto::findOrFail($request->id);
    $proyecto->condicion = '1';
    $proyecto->save();

    $user = User::findOrFail($request->iduser);
    $user->condicion = '1';
    $user->save();
  }
}
