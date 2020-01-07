<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hito extends Model
{   
    protected $table = 'hitos'; //Hace referencia a la tabla hitos
    protected $fillable = ['titulo', 'descripcion', 'inicio', 'fin', 'condicion', 'idproyecto'];

    #UN PROYECTO PUEDE TENER MUCHOS HITOS
    public function proyectos(){
        return $this->hasMany('App\Proyecto');
    }

    #UN HITO PUEDE TENER MUCHAS TAREAS
    public function tareaslista(){
        return $this->hasMany('App\Tarea');
    }

    #UN HITO PERTENECE A UN PROYECTO
    public function user(){
        return $this->belongsTo('App\Proyecto');
    }
}
