<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cartera;
use Illuminate\Support\Facades\DB;

class CarteraController extends Controller
{
    public function index(Request $request){

        //if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if($buscar==''){
            $cartera = Cartera::join('users', 'cartera.iduser', '=', 'users.id')
            ->select('cartera.id', 'cartera.iduser', 'cartera.dinero', 'users.name', 'users.apellido_p')
            ->orderBy('users.id')->paginate(4);
        }else{
            $cartera = Cartera::join('users', 'cartera.iduser', '=', 'users.id')
            ->select('cartera.id', 'cartera.iduser', 'cartera.dinero', 'users.name', 'users.apellido_p')
            ->where('users.'.$criterio, 'like', '%'.$buscar.'%')
            ->orderBy('users.id')->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $cartera->total(),
                'current_page' => $cartera->currentPage(),
                'per_page' =>     $cartera->perPage(),
                'last_page' =>    $cartera->lastPage(),
                'from' =>         $cartera->firstItem(),
                'to' =>           $cartera->lastItem(),
            ],
            'cartera'=>$cartera
        ];
    }

    public function indexAuth(Request $request){
        
        $cartera = Cartera::all()->where('iduser', 'like', auth()->id());

        return $cartera;
    }
}
