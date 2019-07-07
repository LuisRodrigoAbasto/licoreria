<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['idCategoria','nombre','descripcion','imagen','stock','precio','estado'];

    // public function categoria(){
    //     return $this->belongsTo('App\Categoria');
    // }

    // public function pedidos(){
    //     return $this->hasMany('App\DetallePedido');
    // }
    // public function ventas(){
    //     return $this->hasMany('App\DetalleVenta');
    // }
}
