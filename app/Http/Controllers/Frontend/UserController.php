<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Logo;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function index(){
        $logo = Logo::first();
        $path = 'logo/'.$logo->logo;
        View::share('logo', $path);
        View::share('sitio', $logo->sitio);

        $orders = Order::where('user_id', Auth::id())->get();
        return view('frontend.orders.index', compact('orders'));
    }
    public function view($id){
        $logo = Logo::first();
        $path = 'logo/'.$logo->logo;
        View::share('logo', $path);
        View::share('sitio', $logo->sitio);

        $orders = Order::where('id', $id)->where('user_id', Auth::id())->first();
        return view('frontend.orders.view', compact('orders'));
    }

}
