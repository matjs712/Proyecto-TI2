<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
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

        // Crear una instancia de la configuración de Transbank
        // $config = new Configuration();
        // $config->setEnvironment(env('TRANSBANK_ENVIRONMENT'));
        // $config->setCommerceCode(env('TRANSBANK_COMMERCE_CODE'));
        // $config->setPrivateKey(env('TRANSBANK_PRIVATE_KEY'));
        // $config->setPublicCert(env('TRANSBANK_PUBLIC_CERT'));
        // $config->setWebpayCert(env('TRANSBANK_WEBPAY_CERT'));


        // // Crear una instancia de Webpay
        // $webpay = new Webpay($config);
        // $transaction = $webpay->getNormalTransaction();
        // $amount = $total; // monto de la transacción
        // $sessionId = $order->id; // identificador único de la sesión de compra
        // $returnUrl = url('/order/confirmation'); // URL a la que se redirecciona al usuario después del pago
        // $initResult = $transaction->initTransaction($amount, $sessionId, $returnUrl);
        
        // // Guardar los datos de la transacción en la tabla Order
        // $order->token_ws = $initResult->getToken();
        // $order->url_confirmacion = $initResult->getUrl();
        // $order->save();

        // // Redirigir al usuario a la página de pago de Transbank
        // $redirectUrl = $initResult->getUrl();
        
        
        
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
}
