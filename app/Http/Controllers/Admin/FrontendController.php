<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ver dashboard')->only('index');
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
        session()->flash('status', 'Bienvenido ' . Auth::user()->name);
        return view('admin.index', ['status' => 'Bienvenido ' . Auth::user()->name]);
    }

    public function ChartIngredientes()
    {
        $ingredientes = Ingrediente::Select('name', 'cantidad')->get();

        $registroProveedores = DB::table('registros')
            ->join('proveedors', 'proveedors.id', '=', 'registros.id_proveedor')
            ->join('ingredientes', 'ingredientes.id', '=', 'registros.id_ingrediente')
            ->select('proveedors.name as proveedor', 'ingredientes.name as ingrediente', 'registros.cantidad')
            ->get();

        $data = [
            "chart1" => $ingredientes,
            "chart2" => $registroProveedores
        ];

        return response()->json($data);
    }
    public function notificaciones(){
        

    }
    
}
