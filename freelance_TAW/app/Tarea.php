<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = ['titulo', 'descripcion', 'iduser', 'inicio', 'fin', 'idhito', 'condicion'];
}
