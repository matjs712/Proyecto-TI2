<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\Proveedor;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;


class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ver proveedores')->only('index');
        $this->middleware('can:add proveedores')->only('create', 'store');
        $this->middleware('can:edit proveedores')->only('edit', 'update');
        $this->middleware('can:destroy proveedores')->only('destroy');
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
        logo_sitio();
        secciones();

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
        $rules = [
            'name' => 'required',
            'telefono' => 'required|numeric|digits:9',
            'email' => 'required',

        ];

        $messages = [
            'required' => 'El campo es requerido.',
            'digits' => 'El campo debe tener :digits caracteres.',
            'email.email' => 'Ingrese un Email valido.',
            'numeric' => 'El campo debe ser de tipo numerico.'

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if (!$validator->fails()) {

            try {
                $proveedor = new Proveedor();

                $proveedor->name = $request->input('name');
                $proveedor->telefono = $request->input('telefono');
                $proveedor->email = $request->input('email');
                $proveedor->save();

                $notifications = new Notification();
                $notifications->detalle = 'Se añadio al proveedor: ' . $proveedor->name;
                $notifications->id_usuario = Auth::id();
                $notifications->tipo = 0;
                $notifications->save();

                DB::commit();
                return redirect('/proveedores')->with('status', 'Proveedor añadido exitosamente!.');
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
        $rules = [
            'name' => 'required',
            'telefono' => 'required|numeric|digits:9',
            'email' => 'required|email',

        ];

        $messages = [
            'required' => 'El campo es requerido.',
            'digits' => 'El campo debe tener :digits caracteres.',
            'email.email' => 'Ingrese un Email valido.',
            'numeric' => 'El campo debe ser de tipo numerico.',
            'email' => 'Ingrese un Email valido'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if (!$validator->fails()) {

            try {
                $proveedor = Proveedor::find($id);

                $proveedor->name = $request->input('name');
                $proveedor->telefono = $request->input('telefono');
                $proveedor->email = $request->input('email');
                $proveedor->update();


                DB::commit();
                return redirect('/proveedores')->with('status', 'Proveedor Editado exitosamente!.');
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
        $proveedor = Proveedor::find($id);

        $notifications = new Notification();
        $notifications->detalle = 'Se elimino al proveedor: ' . $proveedor->name;
        $notifications->id_usuario = Auth::id();
        $notifications->tipo = 2;
        $notifications->save();

        $proveedor->delete();
        return redirect('/proveedores')->with('status', 'Proveedor eliminado Exitosamente');
    }
}
