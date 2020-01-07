<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    //
    protected $table = 'proyectos'; //Hace referencia a la tabla roles
    protected $fillable = ['id','titulo', 'descripcion', 'iduser', 'inicio', 'fin', 'condicion']; //Campos de obtencion de datos

    #UN PROYECTO PERTENECE A UN USUARIO
    public function user(){
        return $this->belongsTo('App\User');
    }
    #UN USUARIO PUEDE TENER MUCHOS PROYECTOS
    public function responsable(){
        return $this->hasMany('App\User', 'id', 'idresponsable');
    }
    #UN CLIENTE PUEDE TENER MUCHOS PROYECTOS
    public function cliente(){
        return $this->hasMany('App\User', 'id', 'iduser');
    }
}
