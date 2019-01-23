<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skillss extends Model
{
    	protected $table = "skillss";
        protected $fillable = [
        'id', 'id_empleado', 'nombre', 'calificacion',
    ];
}
