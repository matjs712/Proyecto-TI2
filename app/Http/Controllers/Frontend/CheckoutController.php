<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Logo;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Transbank\Webpay\WebpayPlus\Transaction;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;
use App\Mail\NotificacionEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    public function __construct()
    {
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(
                env('webpay_plus_cc'),
                env('webpay_plus_api_key')
            );
        } else {
            WebpayPlus::configureForTesting();
        }
    }
    public function index()
    {
        logo_sitio();
        secciones();

        $user_id = Auth::check() ? Auth::id() : null;
        $guest_id = session('guest_id');

        if ($user_id) {
            $cartItems = Cart::where('user_id', $user_id)->get();
        } elseif ($guest_id) {
            $cartItems = Cart::where('user_id', $guest_id)->get();
        } else {
            $cartItems = collect(); // Sin elementos en el carrito si no hay usuario autenticado ni guest_id en la sesión
        }

        foreach ($cartItems as $item) {
            if (!Product::where('id', $item->prod_id)->where('qty', '>=', $item->prod_qty)->exists()) {
                $removeItem = Cart::where('user_id', $user_id)->where('prod_id', $item->prod_id)->first();
                $removeItem->delete();
            }
        }

        $cartItems = $user_id ? Cart::where('user_id', $user_id)->get() : $cartItems;
        return view('frontend.checkout', compact('cartItems'));
    }



    // public function placeorder(Request $request){

    //     $order              = new Order();
    //     $order->user_id     = Auth::id();
    //     $order->fname       = $request->input('fname');
    //     $order->lname       = $request->input('lname');
    //     $order->email       = $request->input('email');
    //     $order->telefono    = $request->input('telefono');
    //     $order->direccion1  = $request->input('direccion1');
    //     $order->direccion2  = $request->input('direccion2');
    //     $order->region      = $request->input('region');
    //     $order->ciudad      = $request->input('ciudad');
    //     $order->comuna      = $request->input('comuna');
    //     $order->tracking_number      = 'SALES'.rand(1111,9999);

    //     $total = 0;
    //     $cartItems_total = Cart::where('user_id', Auth::id())->get();
    //     foreach($cartItems_total as $prod){
    //         $total += $prod->products->selling_price * $prod->prod_qty;
    //     }
    //     $order->total_price = $total;

    //     $order->save();

    //     $cartItems = Cart::where('user_id', Auth::id())->get();

    //     foreach($cartItems as $item){
    //         OrderItem::create([
    //             'order_id' => $order->id,
    //             'prod_id'  => $item->prod_id,
    //             'qty'      => $item->prod_qty,
    //             'price'    => $item->products->selling_price,
    //         ]);
    //         $prod = Product::where('id', $item->prod_id)->first();
    //         $prod->qty = $prod->qty - $item->prod_qty;
    //         $prod->update();
    //     }

    //     if(Auth::user()->direccion1 != NULL){
    //         $user = User::where('id', Auth::user()->id)->first();
    //         $user->name       = $request->input('fname');
    //         $user->lname       = $request->input('lname');
    //         $user->telefono    = $request->input('telefono');
    //         $user->direccion1  = $request->input('direccion1');
    //         $user->direccion2  = $request->input('direccion2');
    //         $user->region      = $request->input('region');
    //         $user->ciudad      = $request->input('ciudad');
    //         $user->comuna      = $request->input('comuna');
    //         $user->update();
    //     }
    //     $cartItems = Cart::where('user_id', Auth::id())->get();
    //     Cart::destroy($cartItems);

    //     // return redirect()->away($redirectUrl);
    //     return redirect('/')->with('status','Orden realizada correctamente!!');
    // }


    public function iniciar_compra(Request $request)
    {


        $rules = [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required|max:255',
            'telefono' => 'required|numeric|digits:9',
            'direccion1' => 'required|max:255',
            'direccion2' => 'max:255',
            'region' => 'required|max:255',
            'ciudad' => 'required|max:255',
            'comuna' => 'required|max:255',
        ];
        $messages = [
            'fname.required' => 'El nombre del usuario es requerido.',
            'fname.max' => 'El nombre del usuario no puede exceder los :max caracteres.',
            'lname.required' => 'El apellido del usuario es requerido.',
            'lname.max' => 'El apellido del usuario no puede exceder los :max caracteres.',
            'email.required' => 'El correo es requerido.',
            'telefono.required' => 'El numero es requerido.',
            'telefono.digits' => 'El numero debe tener :digits caracteres.',
            'direccion1.required' => 'La direccion es requerida',
            'direccion1.max' => 'La direccion no puede exceder los :max caracteres',
            'direccion2.max' => 'La direccion no puede exceder los :max caracteres',
            'region.required' => 'la region es requerido.',
            'ciudad.required' => 'La ciudad es requerido.',
            'comuna.required' => 'La comuna es requerido.',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if (!$validator->fails()) {
            // DB::beginTransaction();
            try {
                if (Auth::check()) {

                    $user = Auth::user();
                    $order = new Order();
                    $order->user_id = Auth::id();
                    $order->fname = $request->input('fname');
                    $order->lname = $request->input('lname');
                    $order->email = $request->input('email');
                    $order->telefono = $request->input('telefono');
                    $order->direccion1 = $request->input('direccion1');
                    $order->direccion2 = $request->input('direccion2');
                    $order->region = $request->input('region');
                    $order->ciudad = $request->input('ciudad');
                    $order->comuna = $request->input('comuna');
                    $order->tracking_number = 'SALES' . rand(1111, 9999);

                    $user = User::where('id', Auth::user()->id)->first();
                    $user->name = $request->input('fname');
                    $user->lname = $request->input('lname');
                    $user->telefono = $request->input('telefono');
                    $user->direccion1 = $request->input('direccion1');
                    $user->direccion2 = $request->input('direccion2');
                    $user->region = $request->input('region');
                    $user->ciudad = $request->input('ciudad');
                    $user->comuna = $request->input('comuna');
                    $user->update();

                    $total = 0;
                    $cartItems_total = Cart::where('user_id', Auth::id())->get();
                    foreach ($cartItems_total as $prod) {
                        $total += $prod->products->selling_price * $prod->prod_qty;
                    }
                    $order->total_price = $total;
                    $order->save();
                    DB::commit();
                    $url_to_pay = self::start_web_pay_plus_transaction($order);
                    return redirect($url_to_pay);

                } else {

                    $guest_id = session('guest_id');

                    $user = new User();
                    $user->id = $guest_id;
                    $user->password = 'password';
                    $user->name = $request->input('fname');
                    $user->lname = $request->input('lname');
                    $user->telefono = $request->input('telefono');
                    $user->email = $request->input('email');
                    $user->direccion1 = $request->input('direccion1');
                    $user->direccion2 = $request->input('direccion2');
                    $user->region = $request->input('region');
                    $user->ciudad = $request->input('ciudad');
                    $user->comuna = $request->input('comuna');
                    $user->save();

                    $order = new Order();
                    $order->user_id = $guest_id;
                    $order->fname = $request->input('fname');
                    $order->lname = $request->input('lname');
                    $order->email = $request->input('email');
                    $order->telefono = $request->input('telefono');
                    $order->direccion1 = $request->input('direccion1');
                    $order->direccion2 = $request->input('direccion2');
                    $order->region = $request->input('region');
                    $order->ciudad = $request->input('ciudad');
                    $order->comuna = $request->input('comuna');
                    $order->tracking_number = 'SALES' . rand(1111, 9999);

                    $total = 0;
                    $cartItems_total = Cart::where('user_id', $guest_id)->get();
                    foreach ($cartItems_total as $prod) {
                        $total += $prod->products->selling_price * $prod->prod_qty;
                    }
                    $order->total_price = $total;
                    $order->save();
                    DB::commit();

                    $url_to_pay = self::start_web_pay_plus_transaction($order);
                    return redirect($url_to_pay);
                }

            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return back()->withErrors($validator)->withInput();
            }
        }
        return back()->withErrors($validator)->withInput()->with('error', 'Existe un error en el formulario');
    }




    public function start_web_pay_plus_transaction($order)
    {
        $transaction = (new Transaction)->create(
            $order->id,
            $order->user_id,
            $order->total_price,
            route('confirmar_pago')
        );
        $url = $transaction->getUrl() . '?token_ws=' . $transaction->getToken();
        return $url;
    }

    public function confirmar_pago(Request $request)
    {
        $confirmacion = (new Transaction)->commit($request->get('token_ws'));
        $order = Order::where('id', $confirmacion->buyOrder)->first();
        if ($confirmacion->isApproved()) {
            $order->status = 2;

            $user_id = Auth::check() ? Auth::id() : session('guest_id');
            $cartItems = Cart::where('user_id', $user_id)->get();

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'prod_id' => $item->prod_id,
                    'qty' => $item->prod_qty,
                    'price' => $item->products->selling_price,
                ]);
                $prod = Product::where('id', $item->prod_id)->first();
                $prod->qty = $prod->qty - $item->prod_qty;
                $prod->update();
            }
            $order->update();

            $notifications = new Notification();
            $notifications->detalle = 'Se agrego la orden de servicio: ' . $order->id;
            $notifications->id_usuario = 1;
            $notifications->tipo = 1;
            $notifications->save();
            $correo = new NotificacionEmail($order);
            Mail::to($order->email)->send($correo);

            $cartItems = Cart::where('user_id', Auth::id())->get();
            Cart::destroy($cartItems);
            if (Auth::check()) {
                return redirect('/mis-ordenes')->with('status', 'Compra realizada con exito!!');
            } else {
                return redirect('/')->with('status', 'Compra realizada con exito!!');
            }
        }
        return redirect('/mis-ordenes')->with('status', 'La compra no se ha podido realizar!!');
    }
}
