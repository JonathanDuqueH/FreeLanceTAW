<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = ['descripcion', 'fecha_creacion', 'idusrcrear', 'iduser', 'idtipofac', 'costo', 'fecha_vencimiento', 'idstatus'];
}
