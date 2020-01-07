<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportes extends Model
{
    protected $table = 'reportes'; //Hace referencia a la tabla roles
    protected $fillable = ['id','titulo','mensaje',	'iduser','idrproyecto','condicion']; //Campos de obtencion de datos
   // public $timestamps = false;

    /* RELACIONAR A TABLA USER, UN ROL PUEDE TENER MUCHOS USUARIOS */
    public function users(){
        return $this->hasMany('App\User');
    }
}
