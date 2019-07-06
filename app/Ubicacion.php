<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $fillable = ['localizacion','estado'];
    
    public function pedido()
    {
        return $this->hasMany('App\DetallePedido');
    }
}
