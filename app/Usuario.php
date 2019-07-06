<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ['nombre','apellido','sexo','telefono','ci','email','password','tipo','estado'];

    public function usuario()
    {
        return $this->hasMany('App\Usuario');
    }
    public function cliente()
    {
        return $this->hasMany('App\Usuario');
    }
}
