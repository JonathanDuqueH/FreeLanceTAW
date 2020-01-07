<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarea;
use App\Cartera;
use App\Pago;
use Illuminate\Support\Facades\DB;

class TareaController extends Controller
{
    //
    public function index(Request $request){
        
        /*if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $tareas = Tarea::join('hitos', 'tareas.idhito', '=', 'hitos.id')
                        ->join('users', 'tareas.iduser', '=', 'users.id')
            ->select('tareas.id', 'tareas.titulo', 'tareas.descripcion', 'tareas.iduser', 'users.name',
                    'tareas.inicio', 'tareas.fin', 'tareas.idhito', 'hitos.titulo as hito', 'tareas.condicion')
            ->orderBy('tareas.id')->paginate(4);
        }else{
            $tareas = Tarea::join('hitos', 'tareas.idhito', '=', 'hitos.id')
                        ->join('users', 'tareas.iduser', '=', 'users.id')
            ->select('tareas.id', 'tareas.titulo', 'tareas.descripcion', 'tareas.iduser', 'users.name',
                    'tareas.inicio', 'tareas.fin', 'tareas.idhito', 'hitos.titulo as hito', 'tareas.condicion')
            ->orderBy('tareas.id')->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $tareas->total(),
                'current_page' => $tareas->currentPage(),
                'per_page' =>     $tareas->perPage(),
                'last_page' =>    $tareas->lastPage(),
                'from' =>         $tareas->firstItem(),
                'to' =>           $tareas->lastItem(),
            ],
            'tareas'=>$tareas
        ];*/

        $tareas = DB::table('tareas')->join('hitos', 'tareas.idhito', '=', 'hitos.id')
                        ->join('users', 'tareas.iduser', '=', 'users.id')
            ->select('tareas.id', 'tareas.titulo', 'tareas.descripcion', 'tareas.iduser', 'users.name',
                    'tareas.inicio', 'tareas.fin', 'tareas.idhito', 'hitos.titulo as hito', 'tareas.condicion')
            ->orderBy('tareas.id')->get();

            return $tareas;
    }

    //
    public function indexAll(Request $request){
        
        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $tareas = Tarea::join('hitos', 'tareas.idhito', '=', 'hitos.id')
                        ->join('users', 'tareas.iduser', '=', 'users.id')
            ->select('tareas.id', 'tareas.titulo', 'tareas.descripcion', 'tareas.iduser', 'users.name',
                    'tareas.inicio', 'tareas.fin', 'tareas.idhito', 'hitos.titulo as hito', 'tareas.condicion',
                    'tareas.pagado')
            ->orderBy('tareas.id')->paginate(4);
        }else{
            $tareas = Tarea::join('hitos', 'tareas.idhito', '=', 'hitos.id')
                        ->join('users', 'tareas.iduser', '=', 'users.id')
            ->select('tareas.id', 'tareas.titulo', 'tareas.descripcion', 'tareas.iduser', 'users.name',
                    'tareas.inicio', 'tareas.fin', 'tareas.idhito', 'hitos.titulo as hito', 'tareas.condicion',
                    'tareas.pagado')
            ->where('tareas.'.$criterio, 'like', '%'. $buscar.'%')
            ->orderBy('tareas.id')->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $tareas->total(),
                'current_page' => $tareas->currentPage(),
                'per_page' =>     $tareas->perPage(),
                'last_page' =>    $tareas->lastPage(),
                'from' =>         $tareas->firstItem(),
                'to' =>           $tareas->lastItem(),
            ],
            'tareas'=>$tareas
        ];
    }

    //
    public function indexAllAuth(Request $request){
        
        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $tareas = Tarea::join('hitos', 'tareas.idhito', '=', 'hitos.id')
                        ->join('users', 'tareas.iduser', '=', 'users.id')
                        ->join('proyectos', 'hitos.idproyecto', '=', 'proyectos.id')
            ->select('tareas.id', 'tareas.titulo', 'tareas.descripcion', 'tareas.iduser', 'users.name',
                    'tareas.inicio', 'tareas.fin', 'tareas.idhito', 'hitos.titulo as hito', 'tareas.condicion',
                    'tareas.pagado', 'proyectos.idresponsable as idresposable')
            ->where('proyectos.idresponsable', 'like', auth()->id())
            ->orderBy('tareas.id')->paginate(4);
        }else{
            $tareas = Tarea::join('hitos', 'tareas.idhito', '=', 'hitos.id')
            ->join('users', 'tareas.iduser', '=', 'users.id')
            ->join('proyectos', 'hitos.idproyecto', '=', 'proyectos.id')
            ->select('tareas.id', 'tareas.titulo', 'tareas.descripcion', 'tareas.iduser', 'users.name',
                    'tareas.inicio', 'tareas.fin', 'tareas.idhito', 'hitos.titulo as hito', 'tareas.condicion',
                    'tareas.pagado', 'proyectos.idresponsable as idresposable')
            ->where('proyectos.idresponsable', 'like', auth()->id())
                        ->where('tareas.'.$criterio, 'like', '%'. $buscar.'%')
            ->orderBy('tareas.id')->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $tareas->total(),
                'current_page' => $tareas->currentPage(),
                'per_page' =>     $tareas->perPage(),
                'last_page' =>    $tareas->lastPage(),
                'from' =>         $tareas->firstItem(),
                'to' =>           $tareas->lastItem(),
            ],
            'tareas'=>$tareas
        ];
    }

    //
    public function indexAuth(Request $request){
        
        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $tareas = Tarea::join('hitos', 'tareas.idhito', '=', 'hitos.id')
                        ->join('users', 'tareas.iduser', '=', 'users.id')
            ->select('tareas.id', 'tareas.titulo', 'tareas.descripcion', 'tareas.iduser', 'users.name',
                    'tareas.inicio', 'tareas.fin', 'tareas.idhito', 'hitos.titulo as hito', 'tareas.condicion',
                    'tareas.pagado')
            ->where('tareas.iduser', 'like', auth()->id())
            ->orderBy('tareas.id')->paginate(4);
        }else{
            $tareas = Tarea::join('hitos', 'tareas.idhito', '=', 'hitos.id')
                        ->join('users', 'tareas.iduser', '=', 'users.id')
            ->select('tareas.id', 'tareas.titulo', 'tareas.descripcion', 'tareas.iduser', 'users.name',
                    'tareas.inicio', 'tareas.fin', 'tareas.idhito', 'hitos.titulo as hito', 'tareas.condicion',
                    'tareas.pagado')
            ->where('tareas.iduser', 'like', auth()->id())
            ->where('tareas.'.$criterio, 'like', '%'. $buscar.'%')
            ->orderBy('tareas.id')->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $tareas->total(),
                'current_page' => $tareas->currentPage(),
                'per_page' =>     $tareas->perPage(),
                'last_page' =>    $tareas->lastPage(),
                'from' =>         $tareas->firstItem(),
                'to' =>           $tareas->lastItem(),
            ],
            'tareas'=>$tareas
        ];
    }

    /*REGISTRO DE TAREAS*/
    public function store(Request $request){

        if(!$request->ajax()) return redirect('/');

        try{
            //REGISTRO EN LA TABLA TAREAS
            DB::beginTransaction();
            $tarea = new Tarea();
            $tarea->titulo = $request->titulo;
            $tarea->descripcion = $request->descripcion;
            $tarea->iduser = $request->iduser;
            $tarea->inicio = $request->inicio;
            $tarea->fin = $request->fin;
            $tarea->idhito = $request->idhito;
            $tarea->condicion = '0';
            $tarea->save();

            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
        }
    }

    /*ACTUALIZACION DE TAREA*/
    public function update(Request $request){

        if(!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $tarea = Tarea::findOrFail($request->id);

            $tarea->titulo = $request->titulo;
            $tarea->descripcion = $request->descripcion;
            $tarea->iduser = $request->iduser;
            $tarea->inicio = $request->inicio;
            $tarea->fin = $request->fin;
            $tarea->condicion = $request->condicion;
            $tarea->save();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /*ELMINAR TAREA*/
    public function cancelar(Request $request){

        DB::table('tareas')->where('id', 'like', $request->id)->delete();
    }

    /*COMPLETAR TAREA*/
    public function completar(Request $request){

        if(!$request->ajax()) return redirect('/');
        $tarea = Tarea::findOrFail($request->id);
        $tarea->condicion = '1';
        $tarea->save();
    }

    public function pagar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();
            $tarea = Tarea::findOrFail($request->id);
            $tarea->pagado = '1';
            $tarea->save();

            DB::update('update cartera set dinero = dinero - ? where iduser = ? ',[$request->cantidad, auth()->id()]);
            DB::update('update cartera set dinero = dinero + ? where iduser = ? ',[$request->cantidad, $request->iduser]);
            
            $now = new \DateTime();

            $pago = new Pago();
            $pago->fecha_pago = $now->format('Y-m-d');
            $pago->asunto = 'Pago';
            $pago->descripcion = $request->titulo.': '.$request->descripcion;
            $pago->idacreedor = $request->iduser;
            $pago->idpaga = auth()->id();
            $pago->idmetodo = $request->idmetodo;
            $pago->monto = $request->cantidad;
            $pago->save();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}
