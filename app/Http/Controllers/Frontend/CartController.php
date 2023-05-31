<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Logo;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Str;
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

        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->get();
        } else {
            $guest_id = session('guest_id');
            if (!$guest_id) {
                $cartItems = [];
            } else {
                $cartItems = Cart::where('user_id', $guest_id)->get();
            }
        }
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

        if (Auth::check()) {
            $prod_check = Product::find($product_id);

            if ($prod_check) {
                $user_id = Auth::id();

                if (Cart::where('prod_id', $product_id)->where('user_id', $user_id)->exists()) {
                    return response()->json(['status' => $prod_check->name . ' ya está añadido al carrito.']);
                } else {
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->user_id = $user_id;
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->save();

                    return response()->json(['status' => $prod_check->name . ' añadido al carrito.']);
                }
            }
        } else {
            $guest_id = session()->get('guest_id');
            $count = 0;

            if (!$guest_id) {
                $guest_id = User::count() + 1;
                session()->put('guest_id', $guest_id);
                $count++;
            }

            $prod_check = Product::find($product_id);

            if ($prod_check) {
                if (Cart::where('prod_id', $product_id)->where('user_id', $guest_id)->exists()) {
                    return response()->json(['status' => $prod_check->name . ' ya está añadido al carrito.']);
                } else {
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->user_id = $guest_id;
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->save();
                    $count++;


                    return response()->json(['status' => $prod_check->name . ' añadido al carrito.']);
                }
            }
        }

        return response()->json(['status' => 'El producto no existe.']);
    }



    function updateCart(Request $request)
    {
        $prod_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if (Auth::check()) {
            if (Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cart = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(['status' => "Cantidad actualizada"]);
            } else {
                return response()->json(['status' => "El producto no existe en el carrito"]);
            }
        } else {
            $guest_id = session('guest_id');
            if (!$guest_id) {
                return response()->json(['status' => "Inicia sesión para continuar."]);
            }

            if (Cart::where('prod_id', $prod_id)->where('user_id', $guest_id)->exists()) {
                $cart = Cart::where('prod_id', $prod_id)->where('user_id', $guest_id)->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(['status' => "Cantidad actualizada"]);
            } else {
                return response()->json(['status' => "El producto no existe en el carrito"]);
            }
        }
    }


    function deleteProduct(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('product_id');
            if (Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cartItem = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Producto eliminado correctamente"]);
            } else {
                return response()->json(['status' => "El producto no existe en el carrito"]);
            }
        } else {
            $guest_id = session('guest_id');
            if (!$guest_id) {
                return response()->json(['status' => "Inicia sesión para continuar."]);
            }

            $prod_id = $request->input('product_id');
            if (Cart::where('prod_id', $prod_id)->where('user_id', $guest_id)->exists()) {
                $cartItem = Cart::where('prod_id', $prod_id)->where('user_id', $guest_id)->first();
                $cartItem->delete();
                return response()->json(['status' => "Producto eliminado correctamente"]);
            } else {
                return response()->json(['status' => "El producto no existe en el carrito"]);
            }
        }
    }

    function cartCount()
    {
        if (Auth::check()) {
            $count = Cart::where('user_id', Auth::id())->count();
        } else {
            $guest_id = session('guest_id');
            $count = Cart::where('user_id', $guest_id)->count();
        }

        return response()->json(['count' => $count]);
    }
}
