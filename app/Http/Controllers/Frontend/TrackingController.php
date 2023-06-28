<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Logo;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class TrackingController extends Controller
{
    public function index()
    {
        logo_sitio();
        secciones();
        return view('frontend.puchase_tracking.index');
    }
    public function view(Request $request)
    {
        logo_sitio();
        secciones();
        $rules = [
            'tracking_number' => 'required|exists:orders,tracking_number'
        ];

        $messages = [
            'required' => 'El campo es requerido.',
            'exists' => 'El número de seguimiento ingresado no es válido.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if (!$validator->fails()) {

            $order = Order::where('tracking_number', $request->tracking_number)->first();

            return view('frontend.puchase_tracking.view', compact('order'));
        }
        return back()->withErrors($validator)->withInput()->with('error', 'Existe un error en el formulario');
    }
}
