<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    public function __construct()
    {
        if(app()->environment('production')){
            WebpayPlus::configureForProduction(
                env('webpay_plus_cc'),
                env('webpay_plus_api_key')
            );
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    public function index(){

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach($cartItems as $item){
            if(!Product::where('id',$item->prod_id)->where('qty', '>=', $item->prod_qty)->exists()){
                $removeItem = Cart::where('user_id', Auth::id())->where('prod_id', $item->prod_id)->first();
                $removeItem->delete();
            }
        }
        $cartItems = Cart::where('user_id', Auth::id())->get();
        
        return view('frontend.checkout', compact('cartItems'));
    }

    public function placeorder(Request $request){

        $order              = new Order();
        $order->user_id     = Auth::id();
        $order->fname       = $request->input('fname');
        $order->lname       = $request->input('lname');
        $order->email       = $request->input('email');
        $order->telefono    = $request->input('telefono');
        $order->direccion1  = $request->input('direccion1');
        $order->direccion2  = $request->input('direccion2');
        $order->region      = $request->input('region');
        $order->ciudad      = $request->input('ciudad');
        $order->comuna      = $request->input('comuna');
        $order->tracking_number      = 'SALES'.rand(1111,9999);
        
        $total = 0;
        $cartItems_total = Cart::where('user_id', Auth::id())->get();
        foreach($cartItems_total as $prod){
            $total += $prod->products->selling_price * $prod->prod_qty;
        }
        $order->total_price = $total;

        $order->save();
        
        $cartItems = Cart::where('user_id', Auth::id())->get();
        
        foreach($cartItems as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id'  => $item->prod_id,
                'qty'      => $item->prod_qty,
                'price'    => $item->products->selling_price,
            ]);
            $prod = Product::where('id', $item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->update();
        }

        if(Auth::user()->direccion1 == NULL){
            $user = User::where('id', Auth::user()->id)->first();
            $user->name       = $request->input('fname');
            $user->lname       = $request->input('lname');
            $user->telefono    = $request->input('telefono');
            $user->direccion1  = $request->input('direccion1');
            $user->direccion2  = $request->input('direccion2');
            $user->region      = $request->input('region');
            $user->ciudad      = $request->input('ciudad');
            $user->comuna      = $request->input('comuna'); 
            $user->update();           
        }
        $cartItems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItems);
        
        // return redirect()->away($redirectUrl);
        return redirect('/')->with('status','Orden realizada correctamente!!');
    }


    public function iniciar_compra(Request $request){
        $order              = new Order();
        $order->user_id     = Auth::id();
        $order->fname       = $request->input('fname');
        $order->lname       = $request->input('lname');
        $order->email       = $request->input('email');
        $order->telefono    = $request->input('telefono');
        $order->direccion1  = $request->input('direccion1');
        $order->direccion2  = $request->input('direccion2');
        $order->region      = $request->input('region');
        $order->ciudad      = $request->input('ciudad');
        $order->comuna      = $request->input('comuna');
        $order->tracking_number      = 'SALES'.rand(1111,9999);
        
        $total = 0;
        $cartItems_total = Cart::where('user_id', Auth::id())->get();
        foreach($cartItems_total as $prod){
            $total += $prod->products->selling_price * $prod->prod_qty;
        }
        $order->total_price = $total;

        $order->save();

        $url_to_pay = self::start_web_pay_plus_transaction( $order );
        return $url_to_pay;

    }

    public function start_web_pay_plus_transaction($order){
        $transaction = (new Transaction)->create(
            $order->id,
            $order->user_id,
            $order->total_price,
            route('confirmar_pago')
        );
        $url = $transaction->getUrl().'?token_ws='.$transaction->getToken();
        
        return $url;
    }

    public function confirmar_pago(Request $request){
        $confirmacion = (new Transaction)->commit( $request->get('token_ws'));
        $order = Order::where('id', $confirmacion->buyOrder)->first();
        if($confirmacion->isApproved()){
            $order->status = 2;
            
            $cartItems = Cart::where('user_id', Auth::id())->get();
            
            foreach($cartItems as $item){
                OrderItem::create([
                    'order_id' => $order->id,
                    'prod_id'  => $item->prod_id,
                    'qty'      => $item->prod_qty,
                    'price'    => $item->products->selling_price,
                ]);
                $prod = Product::where('id', $item->prod_id)->first();
                $prod->qty = $prod->qty - $item->prod_qty;
                $prod->update();
            }
            $order->update();
            
            if(Auth::user()->direccion1 == NULL){
                $user = User::where('id', Auth::user()->id)->first();
                $user->name       = $request->input('fname');
                $user->lname       = $request->input('lname');
                $user->telefono    = $request->input('telefono');
                $user->direccion1  = $request->input('direccion1');
                $user->direccion2  = $request->input('direccion2');
                $user->region      = $request->input('region');
                $user->ciudad      = $request->input('ciudad');
                $user->comuna      = $request->input('comuna'); 
                $user->update();           
            }
            $cartItems = Cart::where('user_id', Auth::id())->get();
            Cart::destroy($cartItems);

            return redirect('/mis-ordenes')->with('status','Compra realizada con exito!!');
            // return 'compra exitosa!';
        }
        return redirect('/mis-ordenes')->with('status','La compra no se ha podido realizar!!');
    }

}

