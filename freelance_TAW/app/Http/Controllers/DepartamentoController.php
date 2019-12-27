<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamento;
use App\DepUsr;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    public function index(Request $request){

        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $departamentos = DepUsr::join('departamentos', 'dep_usrs.iddep', '=', 'departamentos.id')
            ->join('users', 'dep_usrs.iduser', '=', 'users.id')
            ->select('departamentos.titulo', 'users.name as nombre_usr', 'users.id as iduser')
            ->orderBy('departamentos.id')->paginate(4);
        }else{
            $departamentos = DepUsr::join('departamentos', 'dep_usrs.iddep', '=', 'departamentos.id')
            ->join('users', 'dep_usrs.iduser', '=', 'users.id')
            ->select('departamentos.titulo', 'users.name as nombre_usr', 'users.id as iduser')
            ->where('departamentos.titulo', 'like', '%'. $buscar.'%')
            ->orderBy('departamentos.id')->paginate(4);
        }
        return [
            'pagination' => [
                'total' =>        $departamentos->total(),
                'current_page' => $departamentos->currentPage(),
                'per_page' =>     $departamentos->perPage(),
                'last_page' =>    $departamentos->lastPage(),
                'from' =>         $departamentos->firstItem(),
                'to' =>           $departamentos->lastItem(),
            ],
            'departamentos'=>$departamentos
        ];
    }

    public function store(Request $request){
        
        if(!$request->ajax()) return redirect('/');

        try{
            //REGISTRO EN LA TABLA DEPARTAMENTOS
            DB::beginTransaction();
            $departamentos = new Departamento();
            $departamentos->titulo = $request->titulo;
            $departamentos->save();
            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
        }
    }

    public function storeDepUsr(Request $request){
        
        if(!$request->ajax()) return redirect('/');

        try{
            //REGISTRO EN LA TABLA DEPARTAMENTOS
            DB::beginTransaction();
            $departamentos = new DepUsr();
            $departamentos->iduser = $request->idusr;
            $departamentos->iddep = $request->iddep;
            $departamentos->condicion = '0';
            $departamentos->save();
            
            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        //
        try {
            DB::beginTransaction();
            
            $departamentos = Departamento::findOrFail($request->id);
            $departamentos->titulo = $request->titulo;
            $departamentos->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function borrar(Request $request){

        if(!$request->ajax()) return redirect('/');
        
        try {
            DB::beginTransaction();

            $departamentos = Departamento::findOrFail($request->id);
            DB::table('departamentos')->where('id', 'like', $request->id)->delete();
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}
