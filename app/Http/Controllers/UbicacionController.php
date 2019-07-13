<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    public function mostrar(Request $reques){
        $longitud=$reques->longitud;
        $latitud=$reques->latitud;

        return['longitud'=>$longitud,'latitud'=>$latitud];
    }
}
