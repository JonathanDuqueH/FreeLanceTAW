<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    
    protected $table = 'page'; //Hace referencia a la tabla hitos
    protected $fillable = ['correo', 
        'telefono',
        'horario',
        'imagen_1',
        'imagen_2',
        'titulo_1',
        'titulo_2',
        'parrafo_t2',
        'imagen_3',
        'titulo_3',
        'parrafo_t3',
        'titulo_4',
        'parrafo_t4',
        'titulo_5',
        'parrafo_t5',
        'titulo_1pp',
        'contenido_1pp',
        'imagen_pp',
        'contenido_2pp'
    ];
}
