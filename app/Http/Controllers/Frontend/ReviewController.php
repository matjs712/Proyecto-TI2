<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Logo;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ReviewController extends Controller
{
    public function add($product_slug){

        logo_sitio();
        secciones();

        $producto = Product::where('slug', $product_slug)->where('status','1')->first();
        if($producto){
            $product_id = $producto->id;
            $review = Review::where('user_id', Auth::id())->where('product_id', $producto->id)->first();
            if($review){
                return view('frontend.reviews.edit', compact('review'));
            }else{
                $verified_purchase = Order::where('orders.user_id', Auth::id())
                ->join('order_items','orders.id','order_items.order_id')
                ->where('order_items.prod_id', $product_id)->get();
                return view('frontend.reviews.index', compact('producto','verified_purchase'));
            }
        }else{
            return redirect()->back()->with('status','El producto no existe');
        }     
    }

    public function create(Request $request){
        $product_id = $request->input('product_id');
        $product = Product::where('id', $product_id)->where('status',1)->first();
        if($product){
            $user_review = $request->input('user_review');
            $new_review = Review::create([
                'user_id'=>Auth::id(),
                'product_id'=>$product_id,
                'user_review'=>$user_review
            ]);
            $category_slug = $product->category->slug;
            $prod_slug = $product->slug;
            if($new_review){
                return redirect('categorias/'.$category_slug.'/'.$prod_slug)->with('status','Gracias por la reseña!!');    
            }
        }else{
            return redirect()->back()->with('status','El producto no existe');
        }
    }
    public function edit($product_slug){
        logo_sitio();
        secciones();
        
        $producto = Product::where('slug', $product_slug)->where('status','1')->first();

        if($producto){
            $review = Review::where('user_id', Auth::id())->where('product_id',$producto->id)->first();
            if($review){
                return view('frontend.reviews.edit', compact('review'));
            }else{
                return redirect()->back()->with('status','No haz escrito esta reseña.');    
            }
        }else{
            return redirect()->back()->with('status','El producto no existe');
        }

    }
    public function update(Request $request){
        
        $user_review = $request->input('user_review');
        if($user_review != ''){
            $review_id = $request->input('review_id');
            $review = Review::find($review_id)->where('user_id', Auth::id())->first();
            if($review){
                $review->user_review = $request->input('user_review');
                $review->update();
                return redirect('categorias/'.$review->products->category->slug.'/'.$review->products->slug)->with('status','Reseña actualizada');    
            }else{
                return redirect()->back()->with('status','No estas autorizado');    
            }
        }
        
        
    }
}
