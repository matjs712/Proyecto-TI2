<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\Ingrediente;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ver dashboard')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        logo_sitio();
        secciones();
        session()->flash('logged', 'Bienvenido ' . Auth::user()->name);
        return view('admin.index')->with('isLogged');
    }

    public function ChartIngredientes()
    {
        $ingredientes = Ingrediente::Select('name', 'cantidad')->get();

        $registroProveedores = DB::table('registros')
            ->join('proveedors', 'proveedors.id', '=', 'registros.id_proveedor')
            ->join('ingredientes', 'ingredientes.id', '=', 'registros.id_ingrediente')
            ->select('proveedors.name as proveedor', 'ingredientes.name as ingrediente', 'registros.cantidad')
            ->get();

        $data = [
            "chart1" => $ingredientes,
            "chart2" => $registroProveedores
        ];

        return response()->json($data);
    }
    public function UsuariosNuevos(){
        $users = User::Select('id', 'created_at')->get();
        $groupedUsers = [];

        foreach ($users as $user) {
            $date = substr($user->created_at, 0, 10);

            if (!isset($groupedUsers[$date])) {
                $groupedUsers[$date] = 0;
            }

            $groupedUsers[$date]++;
        }

        $jsonData = [];

        foreach ($groupedUsers as $date => $users) {
            $jsonData[] = [
                'fecha' => $date,
                'usuarios' => $users
            ];
        }
        return json_encode($jsonData);
    }
    public function ProductosComprados(){
        $products = OrderItem::Select('prod_id', 'qty', 'created_at')->get();
        $groupedProducts = [];

        foreach ($products as $product) {
            $date = substr($product->created_at, 0, 10);
            $id = $product->prod_id;
                if(!isset($groupedProducts[$date][$id])){
                    $groupedProducts[$date][$id] = $product->qty;
                }
                else{
                    $groupedProducts[$date][$id] += $product->qty;
                }
        }
        $jsonData = [];

        foreach ($groupedProducts as $date => $products) {
            $productData = [];
            foreach ($products as $id => $count) {
                $productData[] = [
                    'id' => $id,
                    'count' => $count
                ];
            }
        
            $jsonData[] = [
                'fecha' => $date,
                'productos' => $productData
            ];
        }
        return json_encode($jsonData);
    }
    public function OrdenesNuevas(){
        $orders = Order::Select('id', 'created_at')->get();
        $groupedOrders = [];

        foreach ($orders as $order) {
            $date = substr($order->created_at, 0, 10);

            if (!isset($groupedOrders[$date])) {
                $groupedOrders[$date] = 0;
            }

            $groupedOrders[$date]++;
        }

        $jsonData = [];

        foreach ($groupedOrders as $date => $orders) {
            $jsonData[] = [
                'fecha' => $date,
                'ordenes' => $orders
            ];
        }
        return json_encode($jsonData);
    }
    public function IngresosMes(){
        $orders = Order::Select('id','total_price', 'created_at')->get();
        $groupedOrders = [];
        
        foreach ($orders as $order) {
            $date = substr($order->created_at, 5, 2);

            if (!isset($groupedOrders[$date])) {
                $groupedOrders[$date] = 0;
            }
            
                $groupedOrders[$date] += $order->total_price;
            
        }

        $jsonData = [];

        foreach ($groupedOrders as $date => $orders) {
            $jsonData[] = [
                'fecha' => $date,
                'total' => $orders
            ];
        }
        return json_encode($jsonData);
    }
    public function VentasMes(){
        $sellProducts = OrderItem::Select('id', 'qty', 'created_at')->get();
        $groupedProducts = [];
        
        foreach ($sellProducts as $sellProduct) {
            $date = substr($sellProduct->created_at, 5, 2);

            if (!isset($groupedProducts[$date])) {
                $groupedProducts[$date] = 0;
            }
            
                $groupedProducts[$date] += $sellProduct->qty;
            
        }

        $jsonData = [];

        foreach ($groupedProducts as $date => $sellProduct) {
            $jsonData[] = [
                'fecha' => $date,
                'total' => $sellProduct
            ];
        }
        return json_encode($jsonData);
    }
    public function IngresosDiarios(){
        $orders = Order::Select('id','total_price', 'created_at')->get();
        $groupedOrders = [];
        
        foreach ($orders as $order) {
            $date = substr($order->created_at, 0, 10);
            
            if($date == date("Y-m-d")){
                if (!isset($groupedOrders[$date])) {
                    $groupedOrders[$date] = 0;
                }
            
                $groupedOrders[$date] += $order->total_price;
            }
        }

        $jsonData = [];

        foreach ($groupedOrders as $date => $orders) {
            $jsonData[] = [
                'fecha' => $date,
                'total' => $orders
            ];
        }
        return json_encode($jsonData);
    }
    public function ProductosTop(){
        $sellProducts = OrderItem::Select('prod_id', 'qty', 'created_at')->get();
        $groupedProducts = [];
        
        foreach ($sellProducts as $sellProduct) {
            $id = $sellProduct->prod_id;
            if (!isset($groupedProducts[$id])) {
                $groupedProducts[$id] = 0;
            }
            
            $groupedProducts[$id] += $sellProduct->qty;
            
        }

        $jsonData = [];

        foreach ($groupedProducts as $idProduct => $sellProduct) {
            $product = Product::where('id', $idProduct)->first();
            $productName = $product->name;
            $jsonData[] = [
                'id' => $idProduct,
                'name' => $productName,
                'total' => $sellProduct
            ];
        }
        usort($jsonData, function ($a, $b) {
            return $b['total'] - $a['total'];
        });
        
        return json_encode($jsonData);
    }
    
}
