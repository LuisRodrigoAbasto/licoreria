<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['idUsuario','idCliente','fecha','descripcion','monto','estado'];

    public function cliente(){
        return $this->belongsTo('App\Cliente');
    }
    public function usuario(){
        return $this->belongsTo('App\Usuario');
    }
    public function detalle_venta()
    {
        return $this->hasMany('App\DetalleVenta');
    }
}
