<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\Registro;
use App\Models\Proveedor;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\FileUploadController;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class RegistroController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ver registros')->only('index');
        $this->middleware('can:add registros')->only('create', 'store');
        $this->middleware('can:edit registros')->only('edit', 'update');
        $this->middleware('can:destroy registros')->only('destroy');
    }


    public function index()
    {
        logo_sitio();
        secciones();
        $proveedores = Proveedor::all();
        $registros = Registro::all();
        $ingredientes = Ingrediente::all();
        return view('admin.registro.index', compact('registros', 'proveedores', 'ingredientes'));
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

        $proveedores = Proveedor::all();
        $ingredientes = Ingrediente::all();
        return view('admin.registro.create', compact('proveedores', 'ingredientes'));
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
            'fecha' => 'required|date',
            'id_proveedor' => 'required',
            'id_ingrediente' => 'required',
            'cantidad' => 'required',
            'medida' => 'required',
            'factura' => 'required',

        ];

        $messages = [
            'required' => 'El campo es requerido.',


        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if (!$validator->fails()) {

            try {
                $registro = new Registro();

                if ($request->hasFile('factura')) {
                    $file = $request->file('factura');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;

                    if ($ext == 'pdf') {
                        $file->move(storage_path('app/public/uploads/facturas/'), $filename);
                    } else {
                        $factura = Image::make($file);
                        $factura->resize(800, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->encode('jpg', 70);
                        $factura->save(storage_path('app/public/uploads/facturas/' . $filename));
                    }

                    $registro->factura = $filename;
                }

                $registro->fecha = $request->input('fecha');
                $registro->id_proveedor = $request->input('id_proveedor');
                $registro->id_ingrediente = $request->input('id_ingrediente');

                $registro->medida = $request->input('medida');
                if($medida == 'kilogramos'){
                    $registro->cantidad = $request->input('cantidad') * 1000;
                } else{
                    $registro->cantidad = $request->input('cantidad');
                }
                $registro->medida = 'gramos';

                $registro->save();

                $ingrediente = Ingrediente::find($request->input('id_ingrediente'));
                $cantidadagregada = $registro->cantidad;
                $ingrediente->cantidad = $ingrediente->cantidad + $cantidadagregada;
                $ingrediente->save();

                $notifications = new Notification();
                $notifications->detalle = 'Se añadio ' . $ingrediente->cantidad . ' de ' . $ingrediente->name . ' a nuestros registros';
                $notifications->id_usuario = 1;
                $notifications->tipo = 0;
                $notifications->save();

                DB::commit();
                return redirect('/registros')->with('status', 'Registro añadido exitosamente!.');
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
    public function show($id)
    {
        $registros = Registro::findOrFail($id);


        return view('admin.registro.show', compact('registros'));
    }

    public function edit($id)
    {
        logo_sitio();
        secciones();

        $registro = Registro::find($id);
        $proveedores = Proveedor::all();
        $ingredientes = Ingrediente::all();
        return view('admin.registro.edit', compact('registro', 'proveedores', 'ingredientes'));
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
            'fecha' => 'required|date',
            'id_proveedor' => 'required',
            'id_ingrediente' => 'required',
            'cantidad' => 'required|integer',
            'medida' => 'required',
            'factura' => 'required'


        ];

        $messages = [
            'required' => 'El campo es requerido.',


        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if (!$validator->fails()) {

            try {

                $registro = Registro::find($id);

                if ($request->hasFile('factura')) {
                    $path = storage_path('app/public/uploads/facturas/' . $registro->factura);
                    if (File::exists($path)) {
                        File::delete($path);
                    }

                    $file = $request->file('factura');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;

                    if ($ext == 'pdf') {
                        $file->move(storage_path('app/public/uploads/facturas/'), $filename);
                    } else {
                        $factura = Image::make($file);
                        $factura->resize(800, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->encode('jpg', 70);
                        $factura->save(storage_path('app/public/uploads/facturas/' . $filename));
                    }
                    $registro->factura = $filename;
                }



                $ingrediente = Ingrediente::find($request->input('id_ingrediente'));


                $registro->medida = $request->input('medida');
                if($medida == 'kilogramos'){
                    $nuevaCantidad = $request->input('cantidad') * 1000;
                } else{
                    $nuevaCantidad = $request->input('cantidad');
                }

                
                if ($nuevaCantidad < $registro->cantidad) {
                    $ingrediente->decrement('cantidad', $registro->cantidad - $nuevaCantidad);
                } else if ($nuevaCantidad > $registro->cantidad) {
                    $ingrediente->increment('cantidad', $nuevaCantidad - $registro->cantidad);
                }

                $ingrediente->save();

                $registro->fecha = $request->input('fecha');
                $registro->id_proveedor = $request->input('id_proveedor');
                $registro->id_ingrediente = $request->input('id_ingrediente');
                $registro->cantidad = $nuevaCantidad;
                $registro->medida = 'gramos';

                $registro->update();
                DB::commit();
                return redirect('/registros')->with('status', 'Registro Editado exitosamente!.');
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
        $registro = Registro::find($id);
        $registro->delete();

        $ingrediente = Ingrediente::find($registro->id_ingrediente);
        $ingrediente->cantidad = $ingrediente->cantidad - $registro->cantidad;
        $ingrediente->update();


        if ($registro->factura) {
            $path = storage_path('app/public/uploads/facturas/' . $registro->factura);

            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $notifications = new Notification();
        $notifications->detalle = 'Se elimino ' . $ingrediente->cantidad . ' de ' . $ingrediente->name . ' de nuestros registros';
        $notifications->id_usuario = 1;
        $notifications->tipo = 2;
        $notifications->save();

        return redirect('/registros')->with('status', 'Registro eliminado Exitosamente');
    }
}