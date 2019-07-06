<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
       // if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $productos = Producto::where('estado','=','0')->where($criterio, 'like','%'.$buscar.'%')->orderBy('id','desc')->paginate(10);
        return [
            'pagination' => [
                'total'        => $productos->total(),
                'current_page' => $productos->currentPage(),
                'per_page'     => $productos->perPage(),
                'last_page'    => $productos->lastPage(),
                'from'         => $productos->firstItem(),
                'to'           => $productos->lastItem(),
            ],
            'productos' => $productos
        ];
        
    }

    public function listarPdf(Request $request)
    {
        $productos=Producto::orderBy('id','desc')->get();

        $cont=Producto::count();
        $pdf = \PDF::loadView('pdf.productospdf',['productos'=>$productos,'cont'=>$cont]);
        return $pdf->download('productos.pdf');
    }

    public function selectProducto(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $productos = Producto::where('estado','=','1')
        ->orWhere('nombre','like','%'.$filtro.'%')
        ->orderBy('nombre','asc')
        ->get();
        return ['productos'=>$productos];
        
    }


    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $productos = new Producto();
        $productos->idCategori= $request->idCategoria;
        $productos->nombre = $request->nombre;
        $productos->descripcion = $request->descripcion;
        $productos->imagen = $request->imagen;
        $productos->stock = $request->stock;
        $productos->estado = '1';
        $productos->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $productos = Producto::findOrFail($request->id);
        $productos->idCategori= $request->idCategoria;
        $productos->nombre = $request->nombre;
        $productos->descripcion = $request->descripcion;
        $productos->imagen = $request->imagen;
        $productos->stock = $request->stock;
        $productos->estado = '1';
        $productos->save();
    }
    
    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $productos = Producto::findOrFail($request->id);
        $productos->estado = '0';
        $productos->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $productos = Producto::findOrFail($request->id);
        $productos->estado = '1';
        $productos->save();
    }
       
}
