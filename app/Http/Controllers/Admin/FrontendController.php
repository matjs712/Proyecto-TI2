<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ingrediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logo = Logo::first();
        $path = 'logo/'.$logo->logo;
        View::share('logo', $path);
        View::share('sitio', $logo->sitio);

        return view('admin.index');
    }

    public function ChartIngredientes(){
        $ingredientes = Ingrediente::Select('name', 'cantidad')->get();

        $registroProveedores = DB::table('registros')
                               ->join('proveedors', 'proveedors.id', '=', 'registros.id_proveedor')
                               ->join('ingredientes', 'ingredientes.id', '=', 'registros.id_ingrediente')
                               ->select('proveedors.name as proveedor', 'ingredientes.name as ingrediente', 'registros.cantidad')
                               ->get();

        $data = [
            "chart1" =>$ingredientes,
            "chart2" =>$registroProveedores
        ];
        return response()->json($data);
    }
}
