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
use App\Mail\NotificacionEmail;
use Illuminate\Support\Facades\Mail;
use TCPDF;

class SellInPersonController extends Controller
{
    //
    public function index()
    {
        logo_sitio();
        secciones();
        return view('admin.sell_in_person')->with('pago', '0');
    }

    public function notificationStock(Product $product){
        $notifications = new Notification();
        $notifications->detalle = 'El producto: '. $product->name . ' no tiene stock.';
        $notifications->id_usuario = Auth::id();
        $notifications->tipo = 1;
        $notifications->save();
    }
    //CARRITO DE COMPRA
    public function agregarProducto(Request $request){
        $codigo_barra = $request->input('codigo');
        $id = substr($codigo_barra, 0, 1);
        $producto = Product::find($id);
        return response()->json($producto);
    }

    //PAGO POR EFECTIVO
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
            if($prod->qty > 0)
                    $prod->qty = $prod->qty - $item->prod_qty;
                else{
                    // notificationStock($prod);
                    $prod->qty = 0;
                }
                $prod->update();
        }
        Cart::destroy($cartItems);

        $notifications = new Notification();
        $notifications->detalle = 'Se agrego la orden de servicio: '. $order->id;
        $notifications->id_usuario = Auth::id();
        $notifications->tipo = 1;
        $notifications->save();
    }

    public function generatePDF($order)
    {
           // Crear una instancia de TCPDF
        $pdf = new TCPDF();

        // Establecer la configuración del PDF
        $pdf->SetCreator('DeSabelle');
        $pdf->SetAuthor('Administrador');
        $pdf->SetTitle('Comprobante de pago');
        $pdf->SetSubject('Asunto');

        // Agregar una nueva página al PDF
        $pdf->AddPage();

        // Definir el contenido HTML
        $html = view('admin.orders.pdf.comprobante', compact('order'))->render();

        // Escribir el contenido HTML en el PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Generar el PDF y guardarlo en una ruta específica
        $pdf->Output(storage_path('app/public/pdf/example.pdf'), 'F');
    }

    public function enviar_email(Request $request){
        $order = Order::where('user_id', Auth::id())->latest()->first();

        self::generatePDF($order);
        $correo = new NotificacionEmail($order);
        Mail::to($request->input('email'))->send($correo);

        return $request->input('email');
    }

    //PAGO POR QR
    public function iniciar_compra_presencial(Request $request){
        $order              = new Order();
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

        $user = User::where('id', Auth::user()->id)->first();

        $total = 0;
        $cartItems_total = Cart::where('user_id', Auth::id())->get();
        foreach($cartItems_total as $prod){
            $total += $prod->products->selling_price * $prod->prod_qty;
        }
        $order->total_price = $total;

        $order->save();
        $url_to_pay = self::start_web_pay_plus_transaction( $order);
        return $url_to_pay;

    }

    public function start_web_pay_plus_transaction($order){
        $transaction = (new Transaction)->create(
            $order->id,
            $order->user_id,
            $order->total_price,
            route('confirmar_pago_qr')
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
                if($prod->qty > 0)
                    $prod->qty = $prod->qty - $item->prod_qty;
                else{
                    // notificationStock($prod);
                    $prod->qty = 0;
                }
                $prod->update();
            }
            $order->update();

            $notifications = new Notification();
            $notifications->detalle = 'Se agrego la orden de servicio: '. $order->id;
            $notifications->id_usuario = Auth::id();
            $notifications->tipo = 1;
            $notifications->save();

            $cartItems = Cart::where('user_id', Auth::id())->get();
            Cart::destroy($cartItems);

            return redirect('/')->with('pago','1');
            // return 'compra exitosa!';
        }
        return redirect('/mis-ordenes')->with('status','La compra no se ha podido realizar!!');
    }


}
