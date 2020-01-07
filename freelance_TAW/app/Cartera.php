<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
    protected $table = 'cartera'; //Hace referencia a la tabla hitos
    protected $fillable = ['iduser', 'dinero'];
}
