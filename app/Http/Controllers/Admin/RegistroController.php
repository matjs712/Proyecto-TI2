<?php

namespace App\Http\Controllers\Admin;

use App\Models\Registro;
use App\Models\Proveedor;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistroController extends Controller
{
    public function index()
    {
        $registros = Registro::all();
        return view('admin.registro.index', compact('registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        $ingredientes = Ingrediente::all();
        return view('admin.registro.create', compact('proveedores','ingredientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $registro = new Registro();

        $registro->fecha = $request->input('fecha');
        $registro->id_proveedor = $request->input('id_proveedor');
        $registro->id_ingrediente = $request->input('id_ingrediente');
        $registro->cantidad = $request->input('cantidad');
        $registro->save();

        $ingrediente = Ingrediente::find($request->input('id_proveedor'));
        $ingrediente->cantidad = $ingrediente->cantidad + $request->input('cantidad');
        $ingrediente->save();


        return redirect('/registros')->with('status', 'Registro añadido exitosamente!.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registro = Registro::find($id);
        $proveedores = Proveedor::all();
        $ingredientes = Ingrediente::all();
        return view('admin.registro.edit', compact('registro','proveedores','ingredientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $registro = Registro::find($id);
        
        $ingrediente = Ingrediente::find($request->input('id_proveedor'));
        if($request->input('cantidad') < $registro->cantidad){
            $ingrediente->cantidad = $ingrediente->cantidad - ($registro->cantidad - $request->input('cantidad') );
        }else if($request->input('cantidad') > $registro->cantidad){
            $ingrediente->cantidad = $ingrediente->cantidad + ($request->input('cantidad') - $registro->cantidad);
        }

        $ingrediente->save();
        
        $registro->fecha = $request->input('fecha');
        $registro->id_proveedor = $request->input('id_proveedor');
        $registro->id_ingrediente = $request->input('id_ingrediente');
        $registro->cantidad = $request->input('cantidad');

        $registro->update();

        return redirect('/registros')->with('status', 'Registro Editado exitosamente!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registro = Registro::find($id);
        $registro->delete();

        $ingrediente = Ingrediente::find($registro->id_ingrediente);
        $ingrediente->cantidad = $ingrediente->cantidad - $registro->cantidad;
        $ingrediente->update();

        return redirect('/registros')->with('status','Registro eliminado Exitosamente');
    }
}
