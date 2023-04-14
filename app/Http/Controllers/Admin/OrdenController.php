<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class OrdenController extends Controller
{
    public function __construct(){
        $this->middleware('can:ver ordenes')->only('index','view');
        $this->middleware('can:editar ordenes')->only('update');
    }

    public function index(){
        $logo = Logo::first();
        $path = 'logo/'.$logo->logo;
        View::share('logo', $path);
        View::share('sitio', $logo->sitio);
        
        $orders = Order::where('status','2')->orWhere('status','0')->get();
        $ordersOld = Order::where('status','1')->get();
        return view('admin.orders.index', compact('orders','ordersOld'));
    }
    public function view($id){
        $orders = Order::where('id',$id)->first();
        $logo = Logo::first();
        $path = 'logo/'.$logo->logo;
        View::share('logo', $path);
        View::share('sitio', $logo->sitio);
        
        return view('admin.orders.view', compact('orders'));
    }

    public function updateorder(Request $request, $id){
        $orders = Order::find($id);
        $orders->status = $request->input('orden_status');
        $orders->update();
        
        return redirect('ordenes')->with('status', 'Orden actualizada exitosamente.');
    }
}
