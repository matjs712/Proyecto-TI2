<?php
namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SellInPersonController extends Controller
{
    //
    public function index()
    {
        logo_sitio();
        secciones();
        return view('admin.sell_in_person');
    }

    public function agregarProducto(Request $request){
        $codigo_barra = $request->input('codigo');
        $id = substr($codigo_barra, 0, 1);
        $producto = Product::find($id);
        return response()->json($producto);
    }
}
