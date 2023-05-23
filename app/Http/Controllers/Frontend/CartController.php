<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Logo;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewCart()
    {
        logo_sitio();
        secciones();
        $cartItems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.cart', compact('cartItems'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        if(Auth::check()){
            $prod_check = Product::where('id', $product_id)->first();
            if($prod_check){
                if(Cart::where('prod_id',$product_id)->where('user_id', Auth::id())->exists()){
                    return response()->json(['status' => $prod_check->name."Ya esta añadido al carrito!!"]);
                }else{
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->user_id = Auth::id(); 
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->save();
                    return response()->json(['status' => $prod_check->name." añadido al carrito!!"]);
                }
            }
        }else{
            return response()->json(['status' => "Inicia sesión para continuar."]);
        }
    }

    function updateCart (Request $request){
        $prod_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check()){
            if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cart = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cart->prod_qty = $product_qty;
                $cart->update(); 
                return response()->json(['status' => "Cantidad actualizada"]);
            }
        }
    }

    function deleteProduct (Request $request){
        if(Auth::check()){
            $prod_id = $request->input('product_id');
            if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cartItem = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Producto eliminado Correctamente"]);    
            }

        }else{
            return response()->json(['status' => "Inicia sesión para continuar."]);
        }
    }

    function cartCount(){
        $count = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count' => $count]);
    }

 
}
