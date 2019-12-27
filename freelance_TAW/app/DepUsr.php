<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepUsr extends Model
{
    protected $fillable = ['iduser', 'iddep', 'condicion'];
}
