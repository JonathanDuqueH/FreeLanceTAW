<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $usuarios = DB::table('users as u')
        ->select(DB::raw('SUM(u.id) as total'))
        ->where('u.idrol', 'Administrador')
        ->get();

        return ['usuarios'=>$usuarios];
    }
}
