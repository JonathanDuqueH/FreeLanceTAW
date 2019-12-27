<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $fillable = ['id','nombre_compañia','telefono','correo','direccion','condicion'];
}
