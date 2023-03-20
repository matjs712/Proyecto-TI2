<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Product::all();
        return view('admin.product.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Category::all();
        return view('admin.product.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Product();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/productos/', $filename);
            $producto->image = $filename;
        }

        $producto->cate_id = $request->input('categoria');
        $producto->name = $request->input('name');
        $producto->slug = $request->input('slug');
        $producto->description = $request->input('description');
        $producto->small_description = $request->input('small_description');
        $producto->original_price = $request->input('price');
        $producto->selling_price = $request->input('selling_price');
        $producto->qty = $request->input('qty');
        $producto->tax = $request->input('tax');
        $producto->status = $request->input('status') == TRUE ? '1':'0';
        $producto->trending = $request->input('trending') == TRUE ? '1':'0';
        $producto->meta_title = $request->input('meta_title');
        $producto->meta_description = $request->input('meta_description');
        $producto->meta_keywords = $request->input('meta_keywords');
        $producto->save();

        return redirect('/productos')->with('status', 'Producto añadido exitosamente!.');
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
        $producto = Product::find($id);
        $categorias = Category::all();
        return view('admin.product.edit', compact('producto','categorias'));
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
        $producto = Product::find($id);

        if($request->hasFile('image')){
            $path = 'assets/uploads/productos/'.$producto->image;
            
            if(File::exists($path)){
                File::delete($path); 
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/productos/', $filename);
            $producto->image = $filename;
        }

        $producto->cate_id = $request->input('categoria');
        $producto->name = $request->input('name');
        $producto->slug = $request->input('slug');
        $producto->description = $request->input('description');
        $producto->small_description = $request->input('small_description');
        $producto->original_price = $request->input('price');
        $producto->selling_price = $request->input('selling_price');
        $producto->qty = $request->input('qty');
        $producto->tax = $request->input('tax');
        $producto->status = $request->input('status') == TRUE ? '1':'0';
        $producto->trending = $request->input('trending') == TRUE ? '1':'0';
        $producto->meta_title = $request->input('meta_title');
        $producto->meta_description = $request->input('meta_description');
        $producto->meta_keywords = $request->input('meta_keywords');
        $producto->update();

        return redirect('/productos')->with('status', 'Producto Editado exitosamente!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Product::find($id);

        if($producto->image){
            $path = 'assets/uploads/productos/'.$producto->image;
            
            if(File::exists($path)){
                File::delete($path); 
            }
        }

        $producto->delete();
        return redirect('/productos')->with('status','Producto eliminado Exitosamente');
    }
}
