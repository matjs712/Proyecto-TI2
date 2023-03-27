<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('wishlist'));
    }
    public function add(Request $request){

        if(Auth::check()){
            $prod_id = $request->input('prod_id');
            if(Product::find($prod_id)){
                $wish = new Wishlist();
                $wish->prod_id = $prod_id;
                $wish->user_id = Auth::id();
                $wish->save();
                
                return response()->json(['status' => "Producto añadido a la lista."]);    

            }else{
                return response()->json(['status' => "Producto no existe."]);    
            }
        }else{
            return response()->json(['status' => "Inicia sesión para continuar."]);
        }

        return view('frontend.wishlist', compact('wishlist'));
    }

    public function destroy(Request $request){
        if(Auth::check()){
            $prod_id = $request->input('prod_id');
            if(Wishlist::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $wish = Wishlist::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $wish->delete();
                return response()->json(['status' => "Producto eliminado Correctamente"]);    
            }

        }else{
            return response()->json(['status' => "Inicia sesión para continuar."]);
        }
    }
}
