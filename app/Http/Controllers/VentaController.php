<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Venta;
use App\DetalleVenta;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        $ventas= Venta::where('estado','=','1')->orderBy('ventas.id','desc')->paginate(10);

        return [
            'pagination' => [
                'total'        => $ventas->total(),
                'current_page' => $ventas->currentPage(),
                'per_page'     => $ventas->perPage(),
                'last_page'    => $ventas->lastPage(),
                'from'         => $ventas->firstItem(),
                'to'           => $ventas->lastItem(),
            ],
            'ventas' => $ventas
        ];
        
    }

    
    public function store(Request $request)
    {   
        if (!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try{            
            $mytime= Carbon::now('America/La_Paz');
            $venta = new Venta();
            $venta->idCliente = $request->idCliente;
            $venta->idUsuario =$request->idUsuario;
            $venta->fecha = $mytime->toDateTimeString();
            $venta->monto = $request->monto;
            $venta->descripcion = $request->descripcion;
            $venta->estado = '1';
            $venta->save();

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos
           
            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetalleVenta();
                $detalle->idVenta= $venta->id;
                $detalle->idProducto= $det['idProducto'];
                $detalle->cantidad = $det['cantidad'];   
                $detalle->precio = $det['precioTotal']; 
                $detalle->save();
            } 

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
       
        DB::beginTransaction();
        try{      
            $venta = Venta::findOrFail($request->id);
            $mytime= Carbon::now('America/La_Paz');
            $venta = new Venta();
            $venta->idCliente = $request->idCliente;
            $venta->idUsuario =$request->idUsuario;
            $venta->fecha = $mytime->toDateTimeString();
            $venta->monto = $request->monto;
            $venta->descripcion = $request->descripcion;
            $venta->estado = '1';
            $venta->save();

       $detalle = DetalleVenta::where('idVenta','=',$venta->id)->update(['estado'=>'0']);

       $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos           
            foreach($detalles as $ep=>$det)
            {             
                $detalle_venta=DetalleVenta::updateOrInsert(['idVenta' =>$venta->id,'idProducto'=>$det['idProducto']],['cantidad'=>$det['cantidad'],'precio'=>$det['precio'],'estado'=>'1']);
            }          
        DB::commit();    
    }
     catch (Exception $e){
        DB::rollBack();
    }
    }
    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $ventas = Venta::findOrFail($request->id);
        $ventas->estado = '0';
        $ventas->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $ventas = Venta::findOrFail($request->id);
        $ventas->estado = '1';
        $ventas->save();
    }
}
