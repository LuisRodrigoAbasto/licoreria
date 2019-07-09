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
        $productos = Producto::join('categorias','productos.idCategoria','=','categorias.id')
        ->select('productos.id','idCategoria','categorias.nombre as categoria','productos.nombre','descripcion','productos.precio','imagen','stock','productos.estado')
        ->where('productos.estado','=','1')->where('productos.'.$criterio, 'like','%'.$buscar.'%')->orderBy('productos.id','desc')->paginate(10);
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
        // if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $criterio = $request->criterio;
        $productos = Producto::join('categorias','productos.idCategoria','=','categorias.id')
        ->select('productos.id','idCategoria','categorias.nombre as categoria','productos.nombre as producto','descripcion','imagen','productos.precio','stock','productos.estado')
        ->where('productos.estado','=','1')
        ->Where($criterio.'.nombre','like','%'.$filtro.'%')
        ->orderBy('productos.nombre','asc')
        ->get();
        return ['productos'=>$productos];
        
    }


    public function listarProducto(Request $request)
    {
       // if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $productos = Producto::join('categorias','productos.idCategoria','=','categorias.id')
        ->select('productos.id','idCategoria','categorias.nombre as categoria','productos.nombre as producto','descripcion','productos.precio','imagen','stock','productos.estado')
        ->where('productos.estado','=','1')->where($criterio.'.nombre', 'like','%'.$buscar.'%')->orderBy('productos.id','desc')->paginate(5);
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


    public function store(Request $request)
    {
        \Log::info($request->all());
        if(!$request->ajax()) return redirect('/');
        $productos = new Producto();
        $productos->idCategoria= $request->idCategoria;
        $productos->nombre = $request->nombre;
        $productos->descripcion = $request->descripcion;
        // $productos->imagen = $request->imagen;
        $productos->precio=$request->precio;
        $productos->stock = $request->stock;
        $productos->estado = '1';
        if($request->imagen==null){//si no tiene imagen entonces se le asigna una imagen por defecto
            $productos->imagen ='defecto.png';
            }else{
                    /*guardando la super imagen */
                    $explode=explode(',',$request->imagen);
                    $decoded=\base64_decode($explode[1]);
                    if(str_contains($explode[0],'jpeg')){
                        $extension='jpg';
                    }else{
                        $extension='png';
                    }
                    $fileName = \str_random().'.'.$extension;
                    $path= 'imagenes/productos'.'/'.$fileName;
                    \file_put_contents($path,$decoded);
                    /*terminando de guardar la superImagen */
                    $productos->imagen=$fileName;   
            }
        $productos->save();
    }

    public function update(Request $request)
    {
        \Log::info($request->all());
        if(!$request->ajax()) return redirect('/');
        $productos = Producto::findOrFail($request->id);
        $productos->idCategoria= $request->idCategoria;
        $productos->nombre = $request->nombre;
        $productos->descripcion = $request->descripcion;
        // $productos->imagen = $request->imagen;
        $productos->precio=$request->precio;
        $productos->stock = $request->stock;
        $productos->estado = '1';
        if($request->imagen==null){//si no tiene imagen entonces se le asigna una imagen por defecto
            $productos->imagen ='defecto.png';
            }else{
                    /*guardando la super imagen */
                    $explode=explode(',',$request->imagen);
                    $decoded=\base64_decode($explode[1]);
                    if(str_contains($explode[0],'jpeg')){
                        $extension='jpg';
                    }else{
                        $extension='png';
                    }
                    $fileName = \str_random().'.'.$extension;
                    $path= 'imagenes/productos'.'/'.$fileName;
                    \file_put_contents($path,$decoded);
                    /*terminando de guardar la superImagen */
                    $productos->imagen=$fileName;   
            }
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
