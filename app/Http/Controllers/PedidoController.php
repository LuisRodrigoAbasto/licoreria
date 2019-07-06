<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Pedido;
use App\DetallePedido;
use App\Ubicacion;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        $pedidos= Pedido::where('estado','=','1')->orderBy('pedidos.id','desc')->paginate(10);

        return [
            'pagination' => [
                'total'        => $pedidos->total(),
                'current_page' => $pedidos->currentPage(),
                'per_page'     => $pedidos->perPage(),
                'last_page'    => $pedidos->lastPage(),
                'from'         => $pedidos->firstItem(),
                'to'           => $pedidos->lastItem(),
            ],
            'pedidos' => $pedidos
        ];
        
    }

    
    public function store(Request $request)
    {   
        if (!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try{            
            $mytime= Carbon::now('America/La_Paz');
            $pedido = new Pedido();
            $pedido->idCliente = $request->idCliente;
            $pedido->idUbicacion=$request->idUbicacion;
            $pedido->idUsuario =$request->idUsuario;
            $pedido->fechaPedido = $mytime->toDateTimeString();
            $pedido->fechaEntrega= $request->fechaEntrega;
            $pedido->monto = $request->monto;
            $pedido->estado = '1';
            $pedido->save();

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos
           
            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetallePedido();
                $detalle->idPedido= $pedido->id;
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
            $pedido = Pedido::findOrFail($request->id);
            $mytime= Carbon::now('America/La_Paz');
            $pedido->idCliente = $request->idCliente;
            $pedido->idUbicacion=$request->idUbicacion;
            $pedido->idUsuario =$request->idUsuario;
            $pedido->fechaPedido = $mytime->toDateTimeString();
            $pedido->fechaEntrega= $request->fechaEntrega;
            $pedido->monto = $request->monto;
            $pedido->estado = '1';
            $pedido->save();

            $detalle = DetallePedido::where('idPedido','=',$pedido->id)->update(['estado'=>'0']);

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos           
            foreach($detalles as $ep=>$det)
            {             
                $detalle_pedido=DetallePedido::updateOrInsert(['idPedido' =>$pedido->id,'idProducto'=>$det['idProducto']],['cantidad'=>$det['cantidad'],'precio'=>$det['precio'],'estado'=>'1']);
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
        $pedido = Pedido::findOrFail($request->id);
        $pedido->estado = '0';
        $pedido->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $pedido = Pedido::findOrFail($request->id);
        $pedido->estado = '1';
        $pedido->save();
    }
}
