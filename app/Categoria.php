<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre','estado'];
    
    // public function productos(){
    //     return $this->hasMany('App\Producto');
    // }
    
}
