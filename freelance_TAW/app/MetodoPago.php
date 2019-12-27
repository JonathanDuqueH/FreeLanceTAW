<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $fillable = ['id', 'nombre_met', 'monto_min','monto_max','gasto_fijo',
    'porcentaje_cargo','tasa_interes','condicion','tipo_moneda','img','dias_de_proceso'];
}
