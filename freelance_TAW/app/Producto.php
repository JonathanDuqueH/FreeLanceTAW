<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //asignacion en masa
    protected $fillable = ['nombre', 'costo', 'direccion_proveedor', 'condicion'];
}
