<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reportes;
class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request){

        if(!$request->ajax()) return redirect('/');
    
        $buscar = $request->buscar;
        $criterio = $request->criterio;
    
        if($buscar==''){
            $reporte = Reportes::join('proyectos','proyectos.id','=','reportes.idproyecto')->select('reportes.id','proyectos.titulo as tp','reportes.titulo','reportes.mensaje','reportes.condicion')->where('reportes.iduser','=',auth()->id())->paginate(4);
        } 
        
        return [
                'pagination' => [
                    'total' =>        $reporte->total(),
                    'current_page' => $reporte->currentPage(),
                    'per_page' =>     $reporte->perPage(),
                    'last_page' =>    $reporte->lastPage(),
                    'from' =>         $reporte->firstItem(),
                    'to' =>           $reporte->lastItem(),
                ],
                'reporte'=>$reporte
            ];
      }


      public function indexm(Request $request){

        if(!$request->ajax()) return redirect('/');
    
        $buscar = $request->buscar;
        $criterio = $request->criterio;
    
        if($buscar==''){
            $reporte = Reportes::join('proyectos','proyectos.id','=','reportes.idproyecto')->select('reportes.id','proyectos.titulo as tp','reportes.titulo','reportes.mensaje','reportes.condicion')->where('proyectos.idresponsable','=',auth()->id())->paginate(4);
        } 
        
        return [
                'pagination' => [
                    'total' =>        $reporte->total(),
                    'current_page' => $reporte->currentPage(),
                    'per_page' =>     $reporte->perPage(),
                    'last_page' =>    $reporte->lastPage(),
                    'from' =>         $reporte->firstItem(),
                    'to' =>           $reporte->lastItem(),
                ],
                'reporte'=>$reporte
            ];
      }
    public function store(Request $request){
        
        if(!$request->ajax()) return redirect('/');
   
            $reporte = new Reportes();
            $reporte->titulo = $request->titulo;
            $reporte->mensaje = $request->mensaje;
            $reporte->idproyecto = $request->idproyecto;
            $reporte->iduser = auth()->id();
            $reporte->condicion = 1;
            $reporte->save();
      }

      public function atender(Request $request)
      {
          $reporte = Reportes::findOrFail($request->id);
          $reporte->condicion = '0';
          $reporte->save();
      }
}
