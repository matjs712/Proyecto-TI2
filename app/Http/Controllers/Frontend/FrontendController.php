<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Category::all();
        $productos = Product::where('trending','1')->take('5')->get();
        $categorias = Category::where('popular','1')->take('5')->get();
        return view('frontend.index', compact('banners','categorias','productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewCategory($slug)
    {
        if(Category::where('slug',$slug)->exists()){
            $categoria = Category::where('slug',$slug)->first();
            $productos = Product::where('cate_id',$categoria->id)->where('status','1')->get();
            return view('frontend.products.index', compact('categoria','productos'));

        }else{
            return redirect('/')->with('status','Categoria no existe');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productview($cate_slug,$prod_slug)
    {
        if(Category::where('slug',$cate_slug)->exists()){
            if(Product::where('slug',$prod_slug)->exists()){
            
            $categoria = Category::where('slug',$cate_slug)->first();
            $producto = Product::where('slug',$prod_slug)->where('cate_id',$categoria->id)->first();
            return view('frontend.products.view', compact('producto'));
            
            }else{
                return redirect('/')->with('status','Producto no existe');        
            }
        }else{
            return redirect('/')->with('status','Categoria no existe');
        }
    }
    public function viewProducto($prod_slug)
    {
            if(Product::where('slug',$prod_slug)->exists()){
            
            $producto = Product::where('slug',$prod_slug)->first();
            return view('frontend.products.show', compact('producto'));
            
            }else{
                return redirect('/')->with('status','Producto no existe');        
            }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function footer()
    {
        $categorias = Category::all()->limit(4);
        return view('frontend.inc.footer', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
