<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    public function index(){
        $orders = Order::where('status','2')->orWhere('status','0')->get();
        $ordersOld = Order::where('status','1')->get();
        return view('admin.orders.index', compact('orders','ordersOld'));
    }
    public function view($id){
        $orders = Order::where('id',$id)->first();
        return view('admin.orders.view', compact('orders'));
    }

    public function updateorder(Request $request, $id){
        $orders = Order::find($id);
        $orders->status = $request->input('orden_status');
        $orders->update();
        
        return redirect('ordenes')->with('status', 'Orden actualizada exitosamente.');
    }
}
