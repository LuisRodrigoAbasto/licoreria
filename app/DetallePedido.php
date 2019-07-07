<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $primaryKey =['idPedido','idProducto'];    
    public $incrementing = false;
    
    protected $fillable = ['idPedido','idProducto','cantidad','precio','estado'];
    
    // public function pedido()
    // {
    //     return $this->belongsTo('App\Pedido');
    // }

    // public function producto()
    // {
    //     return $this->belongsTo('App\Producto');
    // }
}
