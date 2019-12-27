<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles'; //Hace referencia a la tabla roles
    protected $fillable = ['tipo', 'descripcion', 'condicion']; //Campos de obtencion de datos
    public $timestamps = false;

    /* RELACIONAR A TABLA USER, UN ROL PUEDE TENER MUCHOS USUARIOS */
    public function users(){
        return $this->hasMany('App\User');
    }
}
