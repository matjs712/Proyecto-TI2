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

}