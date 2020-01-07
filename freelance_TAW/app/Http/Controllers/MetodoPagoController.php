<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MetodoPago;
use Illuminate\Support\Facades\DB;

class MetodoPagoController extends Controller
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

        if($buscar==''){
            $metodos = MetodoPago::select('id', 'nombre', 'logo', 'condicion')
              ->orderBy('id')->paginate(4);
        }else{
            $metodos = MetodoPago::select('id', 'nombre', 'logo', 'condicion')
            ->where($criterio, 'like', '%'. $buscar.'%')
            ->orderBy('id')->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $metodos->total(),
                'current_page' => $metodos->currentPage(),
                'per_page' =>     $metodos->perPage(),
                'last_page' =>    $metodos->lastPage(),
                'from' =>         $metodos->firstItem(),
                'to' =>           $metodos->lastItem(),
            ],
            'metodos'=>$metodos
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
        /*Guardar imagen en carpeta public*/
        if(!$request->ajax()) return redirect('/');

        $exploded = explode(',', $request->logo);
        
        $decoded = base64_decode($exploded[1]);

        if(str_contains($exploded[0], 'jpeg')){
            $extension = 'jpg';
        }else{
            $extension = 'png';
        }

        $fileName = str_replace(' ', '_',$request->nombre).'.'.$extension;

        $path = public_path().'/'.$fileName;
        file_put_contents($path, $decoded);

        try{
            //REGISTRO EN LA TABLA METODOS DE PAGO
            DB::beginTransaction();
                
                $MetodoPago = new MetodoPago();
                $MetodoPago->nombre = $request->nombre;
                $MetodoPago->logo = $fileName;
                $MetodoPago->condicion = '1';
                $MetodoPago->save();
            
            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
        }
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

        try {
            DB::beginTransaction();
            $MetodoPago = MetodoPago::findOrFail($request->id);
            $MetodoPago->nombre = $request->nombre;
            $MetodoPago->logo = $request->logo;
            $MetodoPago->condicion = '1';
            $MetodoPago->save();
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        $MetodoPago = MetodoPago::findOrFail($request->id);
        $MetodoPago->condicion = '0';
        $MetodoPago->save();
    }

    public function activar(Request $request)
    {
        $MetodoPago = MetodoPago::findOrFail($request->id);
        $MetodoPago->condicion = '1';
        $MetodoPago->save();
    }

    //LISTA SIMPLE
    public function selectMetodo(Request $request){
        $metodos = MetodoPago::select('id', 'nombre')
        ->orderBy('id', 'asc')->get();
        return ['metodos' => $metodos];
    }

    
}
