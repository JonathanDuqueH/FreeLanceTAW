<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MetodoPago;

class MetodoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MetodoPago = MetodoPago::all();
        return $MetodoPago;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $MetodoPago = new MetodoPago();
        $MetodoPago->nombre_met = $request->nombre_met;
        $MetodoPago->monto_min = $request->monto_min;
        $MetodoPago->monto_max = $request->monto_max;
        $MetodoPago->gasto_fijo = $request->gasto_fijo;
        $MetodoPago->porcentaje_cargo = $request->porcentaje_cargo;
        $MetodoPago->tasa_interes = $request->tasa_interes;
        $MetodoPago->tipo_moneda = $request->tipo_moneda;
        $MetodoPago->img = $request->img;
        $MetodoPago->dias_de_proceso = $request->dias_de_proceso;
        $MetodoPago->save();
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
        $MetodoPago = MetodoPago::findOrFail($request->id);
        $MetodoPago->nombre_met = $request->nombre_met;
        $MetodoPago->monto_min = $request->monto_min;
        $MetodoPago->monto_max = $request->monto_max;
        $MetodoPago->gasto_fijo = $request->gasto_fijo;
        $MetodoPago->porcentaje_cargo = $request->porcentaje_cargo;
        $MetodoPago->tasa_interes = $request->tasa_interes;
        $MetodoPago->tipo_moneda = $request->tipo_moneda;
        $MetodoPago->img = $request->img;
        $MetodoPago->dias_de_proceso = $request->dias_de_proceso;
        $MetodoPago->save();
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


}
