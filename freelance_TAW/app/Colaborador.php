<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    //
    protected $table = 'colaboradores'; //Hace referencia a la tabla roles
    protected $fillable = ['idproyecto', 'idcolaborador']; //Campos de obtencion de datos

    #UN COLABORADOR PERTENECE A UN PROYECTO
    public function proyecto(){
        return $this->belongsTo('App\Proyecto');
    }

    #UN PROYECTO PUEDE TENER MUCHOS COLABORADORES
    public function responsable(){
        return $this->hasMany('App\User');
    }
}
