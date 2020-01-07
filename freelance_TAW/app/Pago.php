<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos'; //Hace referencia a la tabla hitos
    protected $fillable = ['fecha_pago', 'asunto', 'descripcion', 'idacreedor', 'idpaga', 'idmetodo', 'monto'];
}
