<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request){
        $stars_rated = $request->input('product_rating');
        $product_id = $request->input('product_id');
        $product = Product::where('id',$product_id)->where('status','1')->first();
        if($product){
            $verified_purchase = Order::where('orders.user_id', Auth::id())
                                 ->join('order_items','orders.id','order_items.order_id')
                                 ->where('order_items.prod_id', $product_id)->get();
            if($verified_purchase->count() > 0){

                $existing_rating = Rating::where('user_id',Auth::id())->where('product_id',$product_id)->first();
                if($existing_rating){

                    $existing_rating->stars_rated = $stars_rated;
                    $existing_rating->update();

                }else{
                    Rating::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$product_id,
                        'stars_rated'=>$stars_rated
                    ]);
                }
                return redirect()->back()->with('status','Producto Calificado!, gracias por calificar este producto!!');
            }else{
                return redirect()->back()->with('status','No puedes calificar este producto si no lo haz comprado');
            }
        }else{
            return redirect()->back()->with('status','No exite el producto');
        }
    }
}
