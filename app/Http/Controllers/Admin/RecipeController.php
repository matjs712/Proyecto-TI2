<?php

namespace App\Http\Controllers\Admin;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;


class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ver recetas')->only('index');
        $this->middleware('can:add recetas')->only('create', 'store');
        $this->middleware('can:edit recetas')->only('edit', 'update');
        $this->middleware('can:destroy recetas')->only('destroy');
    }
    public function index()
    {
        logo_sitio();
        secciones();

        $recetas = Recipe::all();
        return view('admin.recipe.index', compact('recetas'));
    }
    public function create()
    {
        logo_sitio();
        secciones();

        return view('admin.recipe.create');
    }

    public function store(Request $request)
    {


        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|unique:categorias|max:255',
            'description' => 'nullable|max:65535',

        ];
        $messages = [
            'name.required' => 'El nombre de la receta es requerido.',
            'name.max' => 'El nombre de la receta no puede exceder los 255 caracteres.',
            'slug.required' => 'El slug de la receta es requerido.',
            'slug.unique' => 'El slug de la receta ya está en uso.',
            'slug.max' => 'El slug de la receta no puede exceder los 255 caracteres.',
            'description.max' => 'La descripción de la receta no puede exceder los 65535 caracteres.',

        ];


        $validator = Validator::make($request->all(), $rules, $messages);
        if (!$validator->fails()) {
            try {

                $receta = new Recipe();
                $receta->name = $request->input('name');
                $receta->slug = $request->input('slug');
                $receta->description = $request->input('description');
                $receta->save();
                DB::commit();
                return redirect('/recetas')->with('status', 'Receta añadida exitosamente!.');
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return back()->withErrors($validator)->withInput();
            }
        }
        return back()->withErrors($validator)->withInput()->with('error', 'Existe un error en el formulario');
    }

    public function show($id)
    {
        $receta = Recipe::findOrFail($id);

        return view('admin.recipe.show', compact('receta'));
    }
    public function edit($id)
    {
        $receta = Recipe::find($id);
        logo_sitio();
        secciones();

        return view('admin.recipe.edit', compact('receta'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|unique:categorias|max:255',
            'description' => 'nullable|max:65535',

        ];
        $messages = [
            'name.required' => 'El nombre de la receta es requerido.',
            'name.max' => 'El nombre de la receta no puede exceder los 255 caracteres.',
            'slug.required' => 'El slug de la receta es requerido.',
            'slug.unique' => 'El slug de la receta ya está en uso.',
            'slug.max' => 'El slug de la receta no puede exceder los 255 caracteres.',
            'description.max' => 'La descripción de la receta no puede exceder los 65535 caracteres.',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if (!$validator->fails()) {
            try {

                $receta = Recipe::find($id);
                $receta->name = $request->input('name');
                $receta->slug = $request->input('slug');
                $receta->description = $request->input('description');
                $receta->update();
                DB::commit();
                return redirect('/recetas')->with('status', 'Receta se a actualizado exitosamente!.');
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return back()->withErrors($validator)->withInput();
            }
        }
        return back()->withErrors($validator)->withInput()->with('error', 'Existe un error en el formulario');
    }

    public function destroy($id)
    {
        $receta = Recipe::find($id);
        $receta->delete();

        return redirect('/recetas')->with('status', 'Receta eliminada Exitosamente');
    }
}