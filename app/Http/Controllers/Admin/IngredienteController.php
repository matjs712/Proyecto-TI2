<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class IngredienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ver ingredientes')->only('index');
        $this->middleware('can:add ingredientes')->only('create', 'store');
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
        $rules = [

            'name' => 'required|string|min:3',
            'cantidad' => 'required|numeric',
            'medida' => 'required',
        ];

        $messages = [

            'required' => 'El campo es requerido.',
            'min' => 'El campo debe tener al menos :min caracteres.',
            'numeric' => 'El campo debe ser númerico',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if (!$validator->fails()) {


            try {
                $ingrediente = new Ingrediente();

                $ingrediente->name = $request->input('name');
                $ingrediente->medida = $request->input('medida');
                if($ingrediente->medida == 'kilogramos'){
                    $ingrediente->cantidad = $request->input('cantidad')*1000;
                } else {
                    $ingrediente->cantidad = $request->input('cantidad')*1000;
                }
                $ingrediente->medida = 'gramos';
                $ingrediente->save();

                $notifications = new Notification();
                $notifications->detalle = 'Ingrediente añadido: ' . $ingrediente->name;
                $notifications->id_usuario = Auth::id();
                $notifications->tipo = 0;
                $notifications->save();

                DB::commit();
                return redirect('/ingredientes')->with('status', 'Ingrediente añadido exitosamente!.');
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return back()->withErrors($validator)->withInput();
            }
        }
        return back()->withErrors($validator)->withInput()->with('error', 'Existe un error en el formulario');
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
        $rules = [

            'name' => 'required|string|min:3',
            'cantidad' => 'required',
            'medida' => 'required',
        ];

        $messages = [

            'required' => 'El campo es requerido.',
            'min' => 'El campo debe tener al menos :min caracteres.',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if (!$validator->fails()) {


            try {
                $ingrediente = Ingrediente::find($id);

                $ingrediente->name = $request->input('name');
                $ingrediente->medida = $request->input('medida');
                if($ingrediente->medida == 'kilogramos'){
                    $ingrediente->cantidad = $request->input('cantidad')*1000;
                } else {
                    $ingrediente->cantidad = $request->input('cantidad')*1000;
                }
                $ingrediente->medida = 'gramos';
                $ingrediente->update();

                if($ingrediente->cantidad <= 1000){
                    $notifications = new Notification();
                    $notifications->detalle = 'Ingrediente: ' . $ingrediente->name. ' en estado crítico, solo quedan '. $ingrediente->cantidad.' '.$ingrediente->medida;
                    $notifications->id_usuario = Auth::id();
                    $notifications->tipo = 2;
                    $notifications->save();
                }

                DB::commit();
                return redirect('/ingredientes')->with('status', 'Ingrediente Editado exitosamente!.');
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return back()->withErrors($validator)->withInput();
            }
        }
        return back()->withErrors($validator)->withInput()->with('error', 'Existe un error en el formulario');
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

        $notifications = new Notification();
        $notifications->detalle = 'Ingrediente eliminado: ' . $ingrediente->name;
        $notifications->id_usuario = Auth::id();
        $notifications->tipo = 2;
        $notifications->save();

        return redirect('/ingredientes')->with('status', 'Ingrediente eliminado Exitosamente');
    }
}
