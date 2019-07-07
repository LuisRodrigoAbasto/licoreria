<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use DB;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $clientes = Cliente::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(5);

        return [
            'pagination' => [
                'total'        => $clientes->total(),
                'current_page' => $clientes->currentPage(),
                'per_page'     => $clientes->perPage(),
                'last_page'    => $clientes->lastPage(),
                'from'         => $clientes->firstItem(),
                'to'           => $clientes->lastItem(),
            ],
            'clientes' => $clientes
        ];

    }

    public function selectCliente(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $clientes = Cliente::where('estado','=','1')
        ->where('nombre','like','%'.$filtro.'%')
        ->orwhere('apellido','like','%'.$filtro.'%')
        ->select('id',DB::raw("concat(nombre,' ',apellido) as cliente"))        
        ->orderBy('nombre','asc')
        ->get();
        return ['clientes'=>$clientes];
        
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;        
        $cliente->telefono = $request->telefono;
        $cliente->ci = $request->ci;
        $cliente->sexo= $request->sexo;
        $cliente->direccion=$request->direccion;
        $cliente->estado = 1;
        $cliente->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $mytime= Carbon::now('America/La_Paz');

        $cliente = Cliente::findOrFail($request->id);
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->sexo= $request->sexo;
        $cliente->telefono = $request->telefono;
        $cliente->ci = $request->ci;
        $cliente->estado = '1';
        $cliente->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cliente = Cliente::findOrFail($request->id);
        $cliente->estado = '0';
        $cliente->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cliente = Cliente::findOrFail($request->id);
        $cliente->estado = '1';
        $cliente->save();
    }
}
