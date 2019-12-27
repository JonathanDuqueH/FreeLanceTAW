<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;
class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Clientes::all();
        return $clientes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clientes = new Clientes();
        $clientes->nombre_compañia = $request->nombre_compañia;
        $clientes->telefono = $request->telefono;
        $clientes->correo = $request->correo;
        $clientes->direccion = $request->direccion;
        $clientes->save();
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
        //dd($request->all());
        $clientes = Clientes::findOrFail($request->id);
        $clientes->nombre_compañia = $request->nombre_compañia;
        $clientes->telefono = $request->telefono;
        $clientes->correo = $request->correo;
        $clientes->direccion = $request->direccion;
        $clientes->save();
    }

    public function desactivar(Request $request)
    {
        $clientes = Clientes::findOrFail($request->id);
        $clientes->condicion = '0';
        $clientes->save();
    }

    public function activar(Request $request)
    {
        $clientes = Clientes::findOrFail($request->id);
        $clientes->condicion = '1';
        $clientes->save();
    }
}
