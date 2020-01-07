<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $table = 'metodos_pago'; //Hace referencia a la tabla roles
    protected $fillable = ['id','nombre','logo','condicion']; //Campos de obtencion de datos
    // public $timestamps = false;
}
