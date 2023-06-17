<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Logo;
use App\Models\User;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class WishlistController extends Controller
{
    public function index()
    {
        logo_sitio();
        secciones();

        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id', Auth::id())->get();
        }

        return view('frontend.wishlist', compact('wishlist'));
    }

    public function add(Request $request)
    {
        $prod_id = $request->input('prod_id');
        if (Product::find($prod_id)) {
            if (Auth::check()) {
                $wish = new Wishlist();
                $wish->prod_id = $prod_id;
                $wish->user_id = Auth::id();
                $wish->save();

                return response()->json(['status' => "Producto añadido a la lista."]);
            }
        } else {
            return response()->json(['status' => "Producto no existe."]);
        }
    }

    public function destroy(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('prod_id');
            if (Wishlist::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $wish = Wishlist::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $wish->delete();
                return response()->json(['status' => "Producto eliminado correctamente"]);
            } else {
                return response()->json(['status' => "El producto no existe en la lista de deseos"]);
            }
        }
    }

    public function wishCount()
    {
        if (Auth::check()) {
            $count = Wishlist::where('user_id', Auth::id())->count();
            return response()->json(['count' => $count]);
        }
    }
}
