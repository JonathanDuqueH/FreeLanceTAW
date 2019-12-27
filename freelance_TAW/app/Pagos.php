<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    //asignacion en masa
    protected $fillable = ['id','codigo_retiro','monto','monto_final','monto_final','id_metodo','id_usuario'];
}
