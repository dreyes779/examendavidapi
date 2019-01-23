<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    	protected $table = "empleados";
        protected $fillable = [
        'id', 'nombre', 'email', 'puesto', 'fecha_nacimiento', 'domicilio',
    ];
}
