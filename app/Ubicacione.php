<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacione extends Model
{
    protected $fillable = ['ubicacion','longitud','latitud','estado'];
    
    // public function pedido()
    // {
    //     return $this->hasMany('App\DetallePedido');
    // }
}
