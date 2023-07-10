<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\InfoNutricional;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class NutritionalController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ver nutricionales')->only('index');
        $this->middleware('can:add nutricionales')->only('create', 'store');
        $this->middleware('can:edit nutricionales')->only('edit', 'update');
        $this->middleware('can:destroy nutricionales')->only('destroy');
    }

    public function index()
    {
        logo_sitio();
        secciones();

        $nutricionales = InfoNutricional::all();
        $productos = Product::all();

        return view('admin.info_nutricional.index', compact('nutricionales', 'productos'));
    }
    public function create()
    {
        logo_sitio();
        secciones();
        $productos = Product::all();
        return view('admin.info_nutricional.create', compact('productos'));
    }
    public function store(Request $request)
    {

        //AQUI VA LA VALIDACIÒN DEL FORMULARIO
        // dd($request);
        $rules = [];

        $messages = [
            'producto.required' => 'El producto es obligatorio.',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if (!$validator->fails()) {
            session()->flash('loading', true);
            try {
                $nutricional = new InfoNutricional();

                $nutricional->id_producto = $request->input('id_producto');
                $nutricional->valor_energetico = $request->input('valor_energetico');
                $nutricional->grasa_saturada = $request->input('grasa_saturada');
                $nutricional->grasa_total = $request->input('grasa_total');
                $nutricional->sal = $request->input('sal');
                $nutricional->yodo = $request->input('yodo');
                $nutricional->azucar = $request->input('azucar');
                $nutricional->proteina = $request->input('proteina');


                $nutricional->save();


                DB::commit();
                return redirect('/nutricionales')->with('status', 'Informacion nutricional añadida exitosamente!.');
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return back()->withErrors($validator)->withInput();
            }
        }
        return back()->withErrors($validator)->withInput()->with('error', 'Existe un error en el formulario');
    }

    public function show($id)
    {
        $nutricional = InfoNutricional::findOrFail($id);
        return view('admin.info_nutricional.show', compact('nutricional'));
    }

    public function edit($id)
    {
        logo_sitio();
        secciones();

        $nutricional = InfoNutricional::find($id);
        $producto = Product::all();

        return view('admin.info_nutricional.edit', compact('nutricional', 'producto'));
    }

    public function update(Request $request, $id)
    {

        $rules = [];

        $messages = [
            'required' => 'El campo es requerido.',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if (!$validator->fails()) {
            try {
                $nutricional = InfoNutricional::find($id);

                $nutricional->id_producto = $request->input('id_producto');
                $nutricional->valor_energetico = $request->input('valor_energetico');
                $nutricional->grasa_saturada = $request->input('grasa_saturada');
                $nutricional->grasa_total = $request->input('grasa_total');
                $nutricional->sal = $request->input('sal');
                $nutricional->yodo = $request->input('yodo');
                $nutricional->azucar = $request->input('azucar');
                $nutricional->proteina = $request->input('proteina');

                $nutricional->update();

                DB::commit();

                return redirect('/nutricionales')->with('status', 'Informacion nutricional Editado exitosamente!.');
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return back()->withErrors($validator)->withInput();
            }
        }
        return back()->withErrors($validator)->withInput()->with('error', 'Existe un error en el formulario');
    }

    public function destroy($id)
    {
        $nutricional = InfoNutricional::find($id);




        $nutricional->delete();
        return redirect('/nutricionales')->with('status', 'Infromacion Nutricional eliminada Exitosamente');
    }
}
