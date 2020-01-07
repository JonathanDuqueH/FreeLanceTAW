<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hito;
use App\Tarea;
use Illuminate\Support\Facades\DB;

class HitoController extends Controller
{
    //
    public function index(Request $request){

        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $hitos = Hito::join('proyectos', 'hitos.idproyecto','=', 'proyectos.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
            ->select('hitos.id', 'hitos.titulo', 'hitos.descripcion','hitos.inicio', 'hitos.fin',
                    'hitos.condicion', 'proyectos.titulo as titulo_proyecto', 'hitos.idproyecto')
            ->orderBy('hitos.id')->paginate(4);
        }else{
            $hitos = Hito::join('proyectos', 'hitos.idproyecto','=', 'proyectos.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
            ->select('hitos.id', 'hitos.titulo', 'hitos.descripcion','hitos.inicio', 'hitos.fin',
                    'hitos.condicion', 'proyectos.titulo as titulo_proyecto', 'hitos.idproyecto')
            ->where('hitos.'.$criterio, 'like', '%'. $buscar.'%')
            ->orderBy('hitos.id')->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $hitos->total(),
                'current_page' => $hitos->currentPage(),
                'per_page' =>     $hitos->perPage(),
                'last_page' =>    $hitos->lastPage(),
                'from' =>         $hitos->firstItem(),
                'to' =>           $hitos->lastItem(),
            ],
            'hitos'=>$hitos
        ];
    }

    //
    public function indexAuth(Request $request){

        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $hitos = Hito::join('proyectos', 'hitos.idproyecto','=', 'proyectos.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
            ->select('hitos.id', 'hitos.titulo', 'hitos.descripcion','hitos.inicio', 'hitos.fin',
                    'hitos.condicion', 'proyectos.titulo as titulo_proyecto', 'hitos.idproyecto')
            ->where('proyectos.idresponsable', 'like', auth()->id())
            ->orderBy('hitos.id')->paginate(4);
        }else{
            $hitos = Hito::join('proyectos', 'hitos.idproyecto','=', 'proyectos.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
            ->select('hitos.id', 'hitos.titulo', 'hitos.descripcion','hitos.inicio', 'hitos.fin',
                    'hitos.condicion', 'proyectos.titulo as titulo_proyecto', 'hitos.idproyecto')
            ->where('proyectos.idresponsable', 'like', auth()->id())
            ->where('hitos.'.$criterio, 'like', '%'. $buscar.'%')
            ->orderBy('hitos.id')->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $hitos->total(),
                'current_page' => $hitos->currentPage(),
                'per_page' =>     $hitos->perPage(),
                'last_page' =>    $hitos->lastPage(),
                'from' =>         $hitos->firstItem(),
                'to' =>           $hitos->lastItem(),
            ],
            'hitos'=>$hitos
        ];
    }

    //REGISTRAR HITO
    public function store(Request $request){

        if(!$request->ajax()) return redirect('/');

        try{
            //REGISTRO EN LA TABLA HITOS
            DB::beginTransaction();
            $hito = new Hito();
            $hito->titulo = $request->titulo;
            $hito->descripcion = $request->descripcion;
            $hito->inicio = $request->inicio;
            $hito->fin = $request->fin;
            $hito->condicion = '0';
            $hito->idproyecto = $request->idproyecto;
            $hito->save();

            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
        }
    }

    /*ACTUALIZACION DE HITO*/
    public function update(Request $request){

        if(!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $hito = Hito::findOrFail($request->id);

            $hito->titulo = $request->titulo;
            $hito->descripcion = $request->descripcion;
            $hito->inicio = $request->inicio;
            $hito->fin = $request->fin;
            $hito->condicion = '0';
            $hito->idproyecto = $request->idproyecto;
            $hito->save();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /*ELMINAR HITO*/
    public function cancelar(Request $request){

        DB::table('hitos')->where('id', 'like', $request->id)->delete();
    }

    /*COMPLETAR HITO*/
    public function completar(Request $request){

        if(!$request->ajax()) return redirect('/');
        $hito = Hito::findOrFail($request->id);
        $hito->condicion = '1';
        $hito->save();
    }
}
