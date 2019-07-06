<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['idCliente','idUbicacion','idUsuario','fechaPedido','fechaEntrega','monto','estado'];

    public function detalle_pedido()
    {
        return $this->hasMany('App\DetallePedido');
    }

    public function ubicacion(){
        return $this->belongsTo('App\Ubicacion');
    }
    public function cliente(){
        return $this->belongsTo('App\Usuario');
    }
    public function usuario(){
        return $this->belongsTo('App\Usuario');
    }
}
