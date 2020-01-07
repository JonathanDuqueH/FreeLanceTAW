<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Colaborador;
use App\Proyecto;
use Illuminate\Support\Facades\DB;

class ColaboradorController extends Controller
{
    //
    public function index(Request $request){

       if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $colaboradores = Proyecto::select('id', 'titulo')
            ->orderBy('id')->paginate(4);
        }else{
            $colaboradores = Proyecto::select('id', 'titulo')
            ->orderBy('id')
            ->where($criterio, 'like', '%'. $buscar.'%')
            ->orderBy('id')->distinct()->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $colaboradores->total(),
                'current_page' => $colaboradores->currentPage(),
                'per_page' =>     $colaboradores->perPage(),
                'last_page' =>    $colaboradores->lastPage(),
                'from' =>         $colaboradores->firstItem(),
                'to' =>           $colaboradores->lastItem(),
            ],
            'colaboradores'=>$colaboradores
        ];
        
    }

    //
    public function indexAuthPM(Request $request){

       if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $colaboradores = Proyecto::join('users', 'proyectos.idresponsable', 'users.id')
            ->select('proyectos.id', 'proyectos.titulo', 'users.id as iduser')
            ->where('users.id', 'like', auth()->id())
            ->orderBy('proyectos.id')->paginate(4);
        }else{
            $colaboradores = join('users', 'proyectos.idresponsable', 'users.id')
            ->select('proyectos.id', 'proyectos.titulo', 'users.id as iduser')
            ->where('users.id', 'like', auth()->id())
            ->orderBy('proyectos.id')
            ->where('proyectos.'.$criterio, 'like', '%'. $buscar.'%')
            ->orderBy('proyectos.id')->distinct()->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $colaboradores->total(),
                'current_page' => $colaboradores->currentPage(),
                'per_page' =>     $colaboradores->perPage(),
                'last_page' =>    $colaboradores->lastPage(),
                'from' =>         $colaboradores->firstItem(),
                'to' =>           $colaboradores->lastItem(),
            ],
            'colaboradores'=>$colaboradores
        ];
        
    }

    public function indexUsers(Request $request){

        $colaboradores = DB::table('colaboradores')
            ->join('users', 'colaboradores.idcolaborador', '=', 'users.id')  
            ->select('users.id', 'colaboradores.idproyecto',
            'users.name', 'users.idrol as rol')
            ->orderBy('users.idrol')->get();
        
        return $colaboradores;
    }

    public function indexAuth(Request $request){

        if(!$request->ajax()) return redirect('/');
 
         $buscar = $request->buscar;
         $criterio = $request->criterio;
 
         //LO QUE SE MOSTRARÁ
         if($buscar==''){
             $colaboradores = Colaborador::join('proyectos', 'colaboradores.idproyecto', '=', 'proyectos.id')
                                         ->join('users as responsable', 'proyectos.idresponsable', '=', 'responsable.id')
                                         ->join('users as cliente', 'proyectos.iduser', '=', 'cliente.id')
             ->select('proyectos.titulo', 'responsable.name as pmanager', 'responsable.apellido_p as pmanager_ap',
                    'cliente.name as cliente', 'cliente.apellido_p as cliente_ap', 'proyectos.condicion',
                    'proyectos.descripcion')
             ->where('colaboradores.idcolaborador', 'like', auth()->id())
             ->orderBy('proyectos.id')->paginate(4);
         }else{
            $colaboradores = Colaborador::join('proyectos', 'colaboradores.idproyecto', '=', 'proyectos.id')
                                        ->join('users as responsable', 'proyectos.idresponsable', '=', 'responsable.id')
                                        ->join('users as cliente', 'proyectos.iduser', '=', 'cliente.id')
            ->select('proyectos.titulo', 'responsable.name as pmanager', 'responsable.apellido_p as pmanager_ap',
            'cliente.name as cliente', 'cliente.apellido_p as cliente_ap', 'proyectos.condicion',
            'proyectos.descripcion')
            ->where('colaboradores.idcolaborador', 'like', auth()->id())
            ->where('proyectos.'.$criterio, 'like', '%'. $buscar.'%')
            ->orderBy('proyectos.id')->paginate(4);
         }
 
         return [
             'pagination' => [
                 'total' =>        $colaboradores->total(),
                 'current_page' => $colaboradores->currentPage(),
                 'per_page' =>     $colaboradores->perPage(),
                 'last_page' =>    $colaboradores->lastPage(),
                 'from' =>         $colaboradores->firstItem(),
                 'to' =>           $colaboradores->lastItem(),
             ],
             'colaboradores'=>$colaboradores
         ];
         
     }

    /*REGISTRO DE COLABORADORES*/
    public function store(Request $request){

        if(!$request->ajax()) return redirect('/');

        try{
            //REGISTRO EN LA TABLA USERS
            DB::beginTransaction();
            $colaborador = new Colaborador();
            $colaborador->idproyecto = $request->idproyecto;
            $colaborador->idcolaborador = $request->iduser;
            $colaborador->save();

            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
        }
    }

    /*ELMINAR HITO*/
    public function eliminar(Request $request){
        DB::table('colaboradores')->where('id', 'like', $request->id)->delete();
    }
}
