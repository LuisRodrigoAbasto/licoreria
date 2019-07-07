<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{

    protected $primaryKey =['idVenta','idProducto'];    
    public $incrementing = false;

    protected $fillable = ['idPedido','idProducto','cantidad','precio','estado'];
    
    // public function venta()
    // {
    //     return $this->belongsTo('App\Pedido');
    // }

    // public function producto()
    // {
    //     return $this->belongsTo('App\Producto');
    // }
}
