<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
     // if(!$request->ajax()) return redirect('/');
      $anio=date('Y');
      $pedidos=DB::table('pedidos')
      ->select(DB::raw('MONTH(pedidos.fechaPedido) as mes'),
      DB::raw('YEAR(pedidos.fechaPedido) as anio'),
      DB::raw('SUM(pedidos.monto) as total')     )
      ->whereYear('pedidos.fechaPedido',$anio)
      ->groupBy(DB::raw('MONTH(pedidos.fechaPedido)'),DB::raw('YEAR(pedidos.fechaPedido)'))
      ->get();
 
      $ventas=DB::table('ventas')
         ->select(DB::raw('MONTH(ventas.fecha) as mes'),
         DB::raw('YEAR(ventas.fecha) as anio'),
         DB::raw('SUM(ventas.monto) as total'))
         ->whereYear('ventas.fecha',$anio)
         ->groupBy(DB::raw('MONTH(ventas.fecha)'),DB::raw('YEAR(ventas.fecha)'))
         ->get();
 
        
         return ['pedidos'=>$pedidos,'ventas'=>$ventas,'anio'=>$anio];      
  
     }
 }