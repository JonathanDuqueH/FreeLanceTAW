<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;

class RolController extends Controller
{
    //LISTA DE ROLES CON DETALLES
    public function index(Request $request)
    {
        /*Mostrar roles
        if(!$request->ajax()) return redirect('/');
        
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $roles = Rol::orderBy('id', 'desc')->paginate(4);
        }else{
            $roles = Rol::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(4);
        }

        return [
            'pagination' => [
                'total' => $roles->total(),
                'current_page' => $roles->currentPage(),
                'per_page' => $roles->perPage(),
                'last_page' => $roles->lastPage(),
                'from' => $roles->firstItem(),
                'to' => $roles->lastItem(),
            ],
            'roles'=>$roles
        ];*/

        $productos = Rol::all();
        return $productos;
    }

    //LISTA SIMPLE
    public function selectRol(Request $request){
        $roles = Rol::select('id', 'tipo')
        ->orderBy('id', 'asc')->get();

        return ['roles' => $roles];
    }
}
