<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use DB;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $usuarios = Usuario::where('estado','=','1')->where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(10);

        return [
            'pagination' => [
                'total'        => $usuarios->total(),
                'current_page' => $usuarios->currentPage(),
                'per_page'     => $usuarios->perPage(),
                'last_page'    => $usuarios->lastPage(),
                'from'         => $usuarios->firstItem(),
                'to'           => $usuarios->lastItem(),
            ],
            'usuarios' => $usuarios
        ];

    }

    public function selectUsuario(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $usuarios = Usuario::where('estado','=','1')
        ->where('estado','=','1')
        ->where('nombre','like','%'.$filtro.'%')
        ->orwhere('apellido','like','%'.$filtro.'%')
        ->select('id',DB::raw("concat(nombre,' ',apellido) as usuario"))        
        ->orderBy('nombre','asc')
        ->get();
        return ['usuarios'=>$usuarios];
        
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $mytime= Carbon::now('America/La_Paz');

        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->sexo= $request->sexo;
        $usuario->telefono = $request->telefono;
        $usuario->ci = $request->ci;
        $usuario->email= $request->email;
        $usuario->password= $request->password;
        $usuario->tipo= $request->tipo;
        $usuario->estado = '1';
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $mytime= Carbon::now('America/La_Paz');

        $usuario = Usuario::findOrFail($request->id);
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->sexo= $request->sexo;
        $usuario->telefono = $request->telefono;
        $usuario->ci = $request->ci;
        $usuario->email= $request->email;
        $usuario->password= $request->password;
        $usuario->tipo= $request->tipo;
        $usuario->estado = '1';
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $usuario = Usuario::findOrFail($request->id);
        $usuario->estado = '0';
        $usuario->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $usuario = Usuario::findOrFail($request->id);
        $usuario->estado = '1';
        $usuario->save();
    }
}
