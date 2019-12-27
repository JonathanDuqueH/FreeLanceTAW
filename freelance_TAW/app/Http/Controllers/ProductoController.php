<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $productos = Producto::select('id', 'nombre', 'costo','direccion_proveedor', 'condicion')
            ->orderBy('id')->paginate(4);
        }else{
            $productos = Producto::select('id', 'nombre', 'costo','direccion_proveedor', 'condicion')
            ->where('nombre', 'like', '%'. $buscar.'%')
            ->orderBy('id')->paginate(4);
        }
        return [
            'pagination' => [
                'total' =>        $productos->total(),
                'current_page' => $productos->currentPage(),
                'per_page' =>     $productos->perPage(),
                'last_page' =>    $productos->lastPage(),
                'from' =>         $productos->firstItem(),
                'to' =>           $productos->lastItem(),
            ],
            'productos'=>$productos
        ];
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
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->costo = $request->costo;
        $producto->direccion_proveedor = $request->direccion_proveedor;
        $producto->condicion = '1';
        $producto->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        //
        try {
            DB::beginTransaction();
            
            $producto = Producto::findOrFail($request->id);
            $producto->nombre = $request->nombre;
            $producto->costo = $request->costo;
            $producto->direccion_proveedor = $request->direccion_proveedor;
            $producto->condicion = '1';
            $producto->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /*DESACTIVAR PRODUCTO*/
    public function desactivar(Request $request){

        if(!$request->ajax()) return redirect('/');
        $user = Producto::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    /*ACTIVAR PRODUCTO*/
    public function activar(Request $request){

        if(!$request->ajax()) return redirect('/');
        $user = Producto::findOrFail($request->id);
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
