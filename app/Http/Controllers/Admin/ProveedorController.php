<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ingrediente;
use App\Models\Proveedor;
use Illuminate\Support\Facades\File;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('admin.proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor = new Proveedor();

        $proveedor->name = $request->input('name');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->email = $request->input('email');
        $proveedor->save();

        return redirect('/proveedores')->with('status', 'Proveedor añadido exitosamente!.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor = Proveedor::find($id);
        return view('admin.proveedor.edit', compact('proveedor'));
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
        $proveedor = Proveedor::find($id);

        $proveedor->name = $request->input('name');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->email = $request->input('email');
        $proveedor->update();

        return redirect('/proveedores')->with('status', 'Proveedor Editado exitosamente!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->delete();
        return redirect('/proveedores')->with('status','Proveedor eliminado Exitosamente');
    }
}
