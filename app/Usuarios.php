<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
		protected $table = "usuario";
        protected $fillable = [
        'id', 'usuario', 'apellidos', 'email', 'telefono', 'created_at', 'updated_at',
    ];
}
