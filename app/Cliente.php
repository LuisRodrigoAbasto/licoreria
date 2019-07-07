<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nombre','apellido','telefono','ci','sexo','direccion','estado'];
    
    // public function ventas()
    // {
    //     return $this->hasMany('App\Venta');
    // }
}
