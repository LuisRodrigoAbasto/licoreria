<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    public function mostrar(Request $reques){
        $ubicacion=$reques->ubicacion;
        $longitud=$reques->longitud;
        $latitud=$reques->latitud;

        return['ubicacion'=>$ubicacion,'longitud'=>$longitud,'latitud'=>$latitud];
    }
}
