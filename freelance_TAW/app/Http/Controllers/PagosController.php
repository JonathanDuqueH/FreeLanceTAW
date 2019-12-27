<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pagos;
use App\User;
use App\MetodoPago;
use Illuminate\Support\Facades\DB;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pagos::all();
        $datos = [];
        $usuarios = [];
        $metodos = [];
      foreach($pagos as $key => $pago){
          $usuario = User::where('id', $pago->id_usuario)->first();
          $nombre = $usuario->nombre . ' ' . $usuario->apellido_p . ' ' . $usuario->apellido_m;
          $metodo = MetodoPago::where('id', $pago->id_metodo)->first()->nombre_met;
          
          array_push($datos, ['id'=> $pago->id, 'codigo_retiro'=>$pago->codigo_retiro, 'monto'=>$pago->monto, 'condicion'=>$pago->condicion, 'monto_final'=> $pago->monto_final, 'usuario'=>$nombre, 'metodo'=>$metodo, 'id_usuario'=>$pago->id_usuario, 'id_metodo'=> $pago->id_metodo]);
        }
    
        
//       dd($usuarios, $metodos);
//         dd($datos);
        
        return $datos;
    }

  
    public function usuarios(){
      $users = User::all();
      $usuarios = [];
      foreach($users as $key => $user){
        $nombre = $user->nombre . ' ' . $user->apellido_p . ' ' . $user->apellido_m;
        array_push($usuarios, ['id'=> $user->id, 'nombre' => $nombre]);
      }
      return $usuarios;
    }
  
    public function metodos(){
      $metodos = [];
      $metodos_ = MetodoPago::all();
      
      foreach($metodos_ as $key => $metodo){
        array_push($metodos, ['id'=> $metodo->id, 'nombre_metodo' => $metodo->nombre_met]);
      }
      return $metodos;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//         dd($request->all());
        $pago = new Pagos();
        $pago->codigo_retiro = $request->codigo_retiro;
        $pago->monto = $request->monto;
        $pago->monto_final = $request->monto_final;
        $pago->id_usuario = '3';
        $pago->id_metodo = '1';
        $pago->condicion = '1';
        $pago->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        //
        try {
//           dd($request->all());
            DB::beginTransaction();
            
            $pago = Pagos::findOrFail($request->id);
            $pago->codigo_retiro = $request->codigo_retiro;
            $pago->monto = $request->monto;
            $pago->monto_final = $request->monto_final;
            $pago->id_usuario = '3';
            $pago->id_metodo = '1';
            $pago->condicion = '1';
            $pago->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /*DESACTIVAR PRODUCTO*/
    public function desactivar(Request $request){

        if(!$request->ajax()) return redirect('/');
        $user = Pagos::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    /*ACTIVAR PRODUCTO*/
    public function activar(Request $request){

        if(!$request->ajax()) return redirect('/');
        $user = Pagos::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }

    //LISTA SIMPLE
    public function selectProducto(Request $request){
        $productos = Producto::select('id', 'nombre')
        ->orderBy('id', 'asc')->get();

        return ['productos' => $productos];
    }
}
