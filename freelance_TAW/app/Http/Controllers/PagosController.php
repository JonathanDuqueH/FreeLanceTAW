<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pago;
use App\User;
use App\MetodoPago;
use Illuminate\Support\Facades\DB;

class PagosController extends Controller
{
    public function index(Request $request){

      if(!$request->ajax()) return redirect('/');

      $buscar = $request->buscar;
      $criterio = $request->criterio;

      if($buscar == ''){
        
        $pagos = Pago::join('users as acreedor', 'pagos.idacreedor', '=', 'acreedor.id')
                     ->join('users as paga', 'pagos.idpaga', '=', 'paga.id')
                     ->join('metodos_pago as metodo', 'pagos.idmetodo', '=', 'metodo.id')
        ->select('pagos.id', 'pagos.fecha_pago', 'pagos.asunto', 'pagos.descripcion',
          'acreedor.id as acreedor_id', 'acreedor.name as a_name', 'acreedor.apellido_p as a_ap',
          'paga.id as paga_id', 'paga.name as p_name', 'paga.apellido_p as p_ap', 'metodo.id',
          'metodo.nombre', 'pagos.monto')
        ->orderBy('pagos.id')->paginate(4);
      }else{
        $pagos = Pago::join('users as acreedor', 'pagos.idacreedor', '=', 'acreedor.id')
                     ->join('users as paga', 'pagos.idpaga', '=', 'paga.id')
                     ->join('metodos_pago as metodo', 'pagos.idmetodo', '=', 'metodo.id')
        ->select('pagos.id', 'pagos.fecha_pago', 'pagos.asunto', 'pagos.descripcion',
          'acreedor.id as acreedor_id', 'acreedor.name as a_name', 'acreedor.apellido_p as a_ap',
          'paga.id as paga_id', 'paga.name as p_name', 'paga.apellido_p as p_ap', 'metodo.id',
          'metodo.nombre', 'pagos.monto')
        ->where('pagos.'.$criterio, 'like', '%'. $buscar.'%')
        ->orderBy('pagos.id')->paginate(4);
      }

      return [
          'pagination' => [
              'total' =>        $pagos->total(),
              'current_page' => $pagos->currentPage(),
              'per_page' =>     $pagos->perPage(),
              'last_page' =>    $pagos->lastPage(),
              'from' =>         $pagos->firstItem(),
              'to' =>           $pagos->lastItem(),
          ],
          'pagos'=>$pagos
      ];
    }

    public function listarPdf(Request $request){
      $pagos = Pago::join('users as acreedor', 'pagos.idacreedor', '=', 'acreedor.id')
                     ->join('users as paga', 'pagos.idpaga', '=', 'paga.id')
                     ->join('metodos_pago as metodo', 'pagos.idmetodo', '=', 'metodo.id')
        ->select('pagos.id', 'pagos.fecha_pago', 'pagos.asunto', 'pagos.descripcion',
          'acreedor.id as acreedor_id', 'acreedor.name as a_name', 'acreedor.apellido_p as a_ap',
          'paga.id as paga_id', 'paga.name as p_name', 'paga.apellido_p as p_ap', 'metodo.id',
          'metodo.nombre', 'pagos.monto')
        ->orderBy('pagos.fecha_pago')->get();

      $cont = Pago::count();

      $pdf = \PDF::loadView('pdf.pagospdf', ['pagos'=>$pagos, 'count'=>$cont]);
      return $pdf->download('pagos.pdf');
    }

    public function indexAuth(Request $request){

      if(!$request->ajax()) return redirect('/');

      $buscar = $request->buscar;
      $criterio = $request->criterio;

      if($buscar == ''){
        
        $pagos = Pago::join('users as acreedor', 'pagos.idacreedor', '=', 'acreedor.id')
                     ->join('users as paga', 'pagos.idpaga', '=', 'paga.id')
                     ->join('metodos_pago as metodo', 'pagos.idmetodo', '=', 'metodo.id')
        ->select('pagos.id', 'pagos.fecha_pago', 'pagos.asunto', 'pagos.descripcion',
          'acreedor.id as acreedor_id', 'acreedor.name as a_name', 'acreedor.apellido_p as a_ap',
          'paga.id as paga_id', 'paga.name as p_name', 'paga.apellido_p as p_ap', 'metodo.id',
          'metodo.nombre', 'pagos.monto')
        ->where('acreedor.id', 'like', auth()->id())
        ->orWhere('paga.id', 'like', auth()->id())
        ->orderBy('pagos.id')->paginate(4);
      }else{
        $pagos = Pago::join('users as acreedor', 'pagos.idacreedor', '=', 'acreedor.id')
                     ->join('users as paga', 'pagos.idpaga', '=', 'paga.id')
                     ->join('metodos_pago as metodo', 'pagos.idmetodo', '=', 'metodo.id')
        ->select('pagos.id', 'pagos.fecha_pago', 'pagos.asunto', 'pagos.descripcion',
          'acreedor.id as acreedor_id', 'acreedor.name as a_name', 'acreedor.apellido_p as a_ap',
          'paga.id as paga_id', 'paga.name as p_name', 'paga.apellido_p as p_ap', 'metodo.id',
          'metodo.nombre', 'pagos.monto')
        -where('acreedor_id', 'like', auth()->id())
        ->where('pagos.'.$criterio, 'like', '%'. $buscar.'%')
        ->orderBy('pagos.id')->paginate(4);
      }

      return [
          'pagination' => [
              'total' =>        $pagos->total(),
              'current_page' => $pagos->currentPage(),
              'per_page' =>     $pagos->perPage(),
              'last_page' =>    $pagos->lastPage(),
              'from' =>         $pagos->firstItem(),
              'to' =>           $pagos->lastItem(),
          ],
          'pagos'=>$pagos
      ];
    }
}
