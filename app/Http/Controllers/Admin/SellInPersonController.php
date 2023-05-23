<?php
namespace App\Http\Controllers\Admin;

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
    
    public function completar_pago(Request $request){
        $order = New Order();
        $order->user_id     = Auth::id();
        $order->lname       = "No aplica";
        $order->email       = "No aplica";
        $order->fname       = "No aplica";
        $order->telefono    = "No aplica";
        $order->direccion1  = "No aplica";
        $order->direccion2  = "No aplica";
        $order->region      = "No aplica";
        $order->ciudad      = "No aplica";
        $order->comuna      = "No aplica";
        $order->tracking_number      = 'SALES'.rand(1111,9999);
        $total = 0;
        $cartItems_total = Cart::where('user_id', Auth::id())->get();
        foreach($cartItems_total as $prod){
            $total += $prod->products->selling_price * $prod->prod_qty;
        }
        $order->status = 2;
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
        Cart::destroy($cartItems);
        
        $notifications = new Notification();
        $notifications->detalle = 'Se agrego la orden de servicio: '. $order->id;
        $notifications->id_usuario = Auth::id();
        $notifications->tipo = 1;
        $notifications->save();
        
    }
}
