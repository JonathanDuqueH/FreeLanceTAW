<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Colaborador;
use App\Cartera;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /*MOSTRAR USUARIOS*/
    public function index(Request $request){

        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $users = User::join('roles', 'users.idrol','=', 'roles.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
            ->select('users.id', 'users.name', 'users.apellido_p','users.apellido_m', 'users.telefono',
                    'users.email', 'users.password', 'users.condicion', 'users.idrol', 
                    'roles.tipo')
            ->where('users.idrol', '<>', '4')
            ->orderBy('users.id')->paginate(4);
        }else{
            $users = User::join('roles', 'users.idrol','=', 'roles.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
            ->select('users.id', 'users.name', 'users.apellido_p','users.apellido_m', 'users.telefono',
                    'users.email', 'users.password', 'users.condicion', 'users.idrol', 
                    'roles.tipo')
            ->where('users.'.$criterio, 'like', '%'. $buscar.'%')
            ->where('users.idrol', '<>', '4')
            ->orderBy('users.id')->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $users->total(),
                'current_page' => $users->currentPage(),
                'per_page' =>     $users->perPage(),
                'last_page' =>    $users->lastPage(),
                'from' =>         $users->firstItem(),
                'to' =>           $users->lastItem(),
            ],
            'users'=>$users
        ];
    }
    
     /*MOSTRAR USUARIOS*/
    public function indexCliente(Request $request){

        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $users = User::join('roles', 'users.idrol','=', 'roles.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
            ->select('users.id', 'users.name', 'users.apellido_p','users.apellido_m', 'users.telefono',
                    'users.email', 'users.password', 'users.condicion', 'users.idrol', 
                    'roles.tipo')
            ->where('users.idrol', 'like', '4')
            ->orderBy('users.id')->paginate(4);
        }else{
            $users = User::join('roles', 'users.idrol','=', 'roles.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
            ->select('users.id', 'users.name', 'users.apellido_p','users.apellido_m', 'users.telefono',
                    'users.email', 'users.password', 'users.condicion', 'users.idrol', 
                    'roles.tipo')
            ->where('users.'.$criterio, 'like', '%'. $buscar.'%')
            ->where('users.idrol', 'like', '4')
            ->orderBy('users.id')->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $users->total(),
                'current_page' => $users->currentPage(),
                'per_page' =>     $users->perPage(),
                'last_page' =>    $users->lastPage(),
                'from' =>         $users->firstItem(),
                'to' =>           $users->lastItem(),
            ],
            'users'=>$users
        ];
    } 
  
    /*REGISTRO DE USUARIOS*/
    public function store(Request $request){

        if(!$request->ajax()) return redirect('/');

        try{
            //REGISTRO EN LA TABLA USERS
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->apellido_p = $request->apellido_p;
            $user->apellido_m = $request->apellido_m;
            $user->telefono = $request->telefono;
            $user->email = $request->email;
            $user->password = bcrypt($request->password); //ENCRIPTADA
            $user->condicion = '1';
            $user->idrol = $request->idrol;
            $user->save();

            $cartera = new Cartera();
            $cartera->iduser = $user->id;
            $cartera->dinero = '0';
            $cartera->save();

            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
        }
    }

    /*ACTUALIZACION DE USUARIO*/
    public function update(Request $request){

        if(!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $user = User::findOrFail($request->id);

            $user->name = $request->name;
            $user->apellido_p = $request->apellido_p;
            $user->apellido_m = $request->apellido_m;
            $user->telefono = $request->telefono;
            $user->email = $request->email;
            $user->password = bcrypt($request->password); //ENCRIPTADA
            $user->condicion = '1';
            $user->idrol = $request->idrol;
            $user->save();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /*DESACTIVAR USUARIO*/
    public function desactivar(Request $request){

        if(!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    /*ACTIVAR USUARIO*/
    public function activar(Request $request){

        if(!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }

    //LISTA SIMPLE
    public function selectUser(Request $request){
        $users = User::select('id', 'name')
        ->where('idrol', 'like', '4')
        ->orderBy('id', 'asc')->get();
        return ['users' => $users];
    }

    //LISTA SIMPLE
    public function selectProgramador(Request $request){
        $users = User::select('id', 'name')
        ->where('idrol', 'like', '3')
        ->orderBy('id', 'asc')->get();
        return ['users' => $users];
    }
    
    //LISTA SIMPLE
    public function selectProgramadorTarea(Request $request){

        $idproyecto = $request->idproyecto;

        $users = Colaborador::join('users', 'colaboradores.idcolaborador', '=', 'users.id')
        ->select('users.id', 'users.name')
        ->where('users.idrol', 'like', '3')
        ->where('colaboradores.idproyecto', 'like', $idproyecto)
        ->orderBy('users.id', 'asc')->get();
        return ['users' => $users];
    }
}
