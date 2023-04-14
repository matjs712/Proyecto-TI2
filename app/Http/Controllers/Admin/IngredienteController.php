<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class IngredienteController extends Controller
{
    public function __construct(){
        $this->middleware('can:ver ingredientes')->only('index');
        $this->middleware('can:add ingredientes')->only('create','store');
        $this->middleware('can:edit ingredientes')->only('edit', 'update');
        $this->middleware('can:destroy ingredientes')->only('destroy');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        logo_sitio();
        secciones();
        
        $ingredientes = Ingrediente::all();
        return view('admin.ingrediente.index', compact('ingredientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        logo_sitio();
        secciones();
        
        return view('admin.ingrediente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingrediente = new Ingrediente();

        $ingrediente->name = $request->input('name');
        $ingrediente->cantidad = $request->input('cantidad');
        $ingrediente->save();

        return redirect('/ingredientes')->with('status', 'Ingrediente añadido exitosamente!.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        logo_sitio();
        secciones();
        
        $ingrediente = Ingrediente::find($id);
        return view('admin.ingrediente.edit', compact('ingrediente'));
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
        $ingrediente = Ingrediente::find($id);

        $ingrediente->name = $request->input('name');
        $ingrediente->cantidad = $request->input('cantidad');
        $ingrediente->update();

        return redirect('/ingredientes')->with('status', 'Ingrediente Editado exitosamente!.');
    }
    public function qty()
    {
        $ingredientes = Ingrediente::all()->pluck('cantidad', 'name');
        return response()->json($ingredientes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingrediente = Ingrediente::find($id);
        $ingrediente->delete();
        return redirect('/ingredientes')->with('status','Ingrediente eliminado Exitosamente');
    }
}
