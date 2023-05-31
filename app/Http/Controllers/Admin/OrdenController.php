<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Mail\NotificacionEmail;
use Illuminate\Support\Facades\Mail;

class OrdenController extends Controller
{
    public function __construct(){
        $this->middleware('can:ver ordenes')->only('index','view');
        $this->middleware('can:editar ordenes')->only('update');
    }

    public function index(){
        logo_sitio();
        secciones();
        
        $orders = Order::where('status','2')->orWhere('status','0')->get();
        $ordersOld = Order::where('status','1')->get();
        return view('admin.orders.index', compact('orders','ordersOld'));
    }
    public function view($id){
        $orders = Order::where('id',$id)->first();
        logo_sitio();
        secciones();
        
        return view('admin.orders.view', compact('orders'));
    }

    public function updateorder(Request $request, $id){
        $orders = Order::find($id);
        $orders->status = $request->input('orden_status');
        $orders->update();

        $notifications = new Notification();
        $aux='Pendiente de pago';
        if ($orders->status == 1) {
            $aux='Completado';
        } elseif($orders->status == 2 ) {
            $aux='Pago aprobado';
        }
        $notifications->detalle = 'Orden: ' . $orders->id.' puesta en '.$aux;
        $notifications->id_usuario = Auth::id();
        $notifications->tipo = 1;
        $notifications->save();

        if($orders->email != 'No aplica'){
            $correo = new NotificacionEmail($orders);
            Mail::to($orders->email)->send($correo);
        }
        return redirect('ordenes')->with('status', 'Orden actualizada exitosamente.');
    }
}
