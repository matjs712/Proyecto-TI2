<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\Product;
use App\Models\Category;
use App\Models\Ingrediente;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\ProductoIngrediente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ver productos')->only('index');
        $this->middleware('can:add productos')->only('create', 'store');
        $this->middleware('can:edit productos')->only('edit', 'update');
        $this->middleware('can:destroy productos')->only('destroy');
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

        $productos = Product::all();
        $categorias = Category::all();
        $ingredientes = Ingrediente::all();
        return view('admin.product.index', compact('productos', 'categorias', 'ingredientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        logo_sitio();
        secciones();

        $categorias = Category::all();
        $ingredientes = Ingrediente::all();
        return view('admin.product.create', compact('categorias', 'ingredientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //AQUI VA LA VALIDACIÒN DEL FORMULARIO
        // dd($request);
        $rules = [
            'categoria' => 'required',
            'name' => 'required',
            'slug' => 'required||unique:products',
            'description' => 'required',
            'small_description' => 'required',
            'price' => 'required',
            'selling_price' => 'required',
            'image' => 'required|image|mimes:jpg,png',
            'qty' => 'required',
        ];

        $messages = [
            'categoria.required' => 'La categoría es obligatoria.',
            'name.required' => 'El nombre es obligatorio.',
            'slug.required' => 'El slug es obligatorio.',
            'slug.unique' => 'El slug ya está en uso.',
            'description.required' => 'La Descripción es obligatoria.',
            'small_description.required' => 'La Descripción pequeña es obligatoria.',
            'price.required' => 'El precio es obligatorio.',
            'selling_price.required' => 'El precio en oferta es obligatorio.',
            'image.required' => 'Debe seleccionar una imagen.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'El archivo debe tener un formato de imagen válido (jpg, png).',
            'qty.required' => 'La cantidad es obligatoria.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if (!$validator->fails()) {

            try {
                $producto = new Product();
                $ingredientes = Ingrediente::all();
                $ingredientesCount = count(preg_grep('/^ingrediente/', array_keys($request->all())));
                $ingredienteFaltante = '';

                //COMPROBAR QUE HAY INGREDIENTES SUFICIENTES PARA CREAR EL PRODUCTO
                if ($ingredientesCount >= 1) {
                    if ($request->ingrediente1 != '') {
                        for ($i = 1; $i <= $ingredientesCount; $i++) {
                            $idIngrediente = $request->input('ingrediente' . $i);
                            $medida = $request->input('medida' . $i);
                            if ($medida == 'kilogramos') {
                                $cantidadRequerida = $request->input('cantidad' . $i) * $request->qty * 1000;
                            } else {
                                $cantidadRequerida = $request->input('cantidad' . $i) * $request->qty;
                            }
                            $ingrediente = $ingredientes->firstWhere('id', $idIngrediente);
                            if (!$ingrediente || $cantidadRequerida > $ingrediente->cantidad) {
                                $ingredienteFaltante = $ingrediente->name;
                                return redirect('/productos')->with('status', 'Cantidad de ' . $ingredienteFaltante . ' supera la del inventario!.');
                            }
                        }
                    }
                }


                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;
                    $image = Image::make($file);
                    $image->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode('jpg', 70);
                    $image->save(storage_path('app/public/uploads/productos/' . $filename));
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
                // $producto->tax = $request->input('tax');
                $producto->status = $request->input('status') == TRUE ? '1' : '0';
                $producto->trending = $request->input('trending') == TRUE ? '1' : '0';
                // $producto->meta_title = $request->input('meta_title');
                // $producto->meta_description = $request->input('meta_description');
                // $producto->meta_keywords = $request->input('meta_keywords');
                $producto->save();


                if ($ingredientesCount >= 1) {
                    if ($request->ingrediente1 != '') {
                        for ($i = 1; $i <= $ingredientesCount; $i++) {
                            $idIngrediente = $request->input('ingrediente' . $i);

                            $medida = $request->input('medida' . $i);
                            if ($medida == 'kilogramos') {
                                $cantidadRequerida = $request->input('cantidad' . $i) * $request->qty * 1000;
                            } else {
                                $cantidadRequerida = $request->input('cantidad' . $i) * $request->qty;
                            }

                            $productoIngrediente = new ProductoIngrediente();
                            $productoIngrediente->id_producto = $producto->id;
                            $productoIngrediente->id_ingrediente = $idIngrediente;
                            $productoIngrediente->cantidad = $cantidadRequerida;
                            $productoIngrediente->save();

                            $ingrediente = Ingrediente::find($idIngrediente);
                            $ingrediente->cantidad = $ingrediente->cantidad - $cantidadRequerida;

                            if ($ingrediente->cantidad <= 1000) {
                                $notifications = new Notification();
                                $notifications->detalle = 'Ingrediente: ' . $ingrediente->name . 'en estado crítico, solo quedan ' . $ingrediente->cantidad;
                                $notifications->id_usuario = 1;
                                $notifications->tipo = 2;
                                $notifications->save();
                            }

                            if ($producto->qty <= 2) {
                                $notifications = new Notification();
                                $notifications->detalle = 'Producto: ' . $producto->name . 'en estado crítico, solo quedan ' . $producto->qty;
                                $notifications->id_usuario = 1;
                                $notifications->tipo = 2;
                                $notifications->save();
                            }

                            $ingrediente->update();
                        }
                    }
                }

                $notifications = new Notification();
                $notifications->detalle = 'Producto añadido: ' . $producto->name;
                $notifications->id_usuario = 1;
                $notifications->tipo = 0;
                $notifications->save();

                DB::commit();
                return redirect('/productos')->with('status', 'Producto añadido exitosamente!.');
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return back()->withErrors($validator)->withInput();
            }
        }
        return back()->withErrors($validator)->withInput()->with('error', 'Existe un error en el formulario');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Product::findOrFail($id);
        $productoIngrediente = ProductoIngrediente::where('id_producto', $producto->id)->get();
        return view('admin.product.show', compact('producto', 'productoIngrediente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        logo_sitio();
        secciones();

        $producto = Product::find($id);
        $categorias = Category::all();
        $ingredientes = Ingrediente::all();
        $productoIngredientes = ProductoIngrediente::where('id_producto', $id)->get();
        $productoIngredientesCount = ProductoIngrediente::where('id_producto', $id)->count();
        return view('admin.product.edit', compact('producto', 'categorias', 'productoIngredientes', 'ingredientes', 'productoIngredientesCount'));
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
        $products = Product::find($id);
        $rules = [
            'categoria' => 'required',
            'name' => 'required',
            'slug' => ['required', Rule::unique('products')->ignore($products->id)],
            'description' => 'required',
            'small_description' => 'required',
            'price' => 'required',
            'selling_price' => 'required',
            'image' => 'required|image|mimes:jpg,png',
            'qty' => 'required',

        ];

        $messages = [
            'required' => 'El campo es requerido.',
            'image' => 'El archivo debe ser una imagen.',
            'mimes' => 'Solo se adminten los siguientes formatos :mimes.',
            'slug.required' => 'El slug es obligatorio.',
            'slug.unique' => 'El slug ya ha sido utilizado por otro producto.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if (!$validator->fails()) {
            try {
                $producto = Product::find($id);
                $ingredientesCount = count(preg_grep('/^ingrediente/', array_keys($request->all())));
                $ingredienteFaltante = '';
                if ($ingredientesCount >= 1) {
                    if ($request->ingrediente1 != '') {
                        for ($i = 1; $i <= $ingredientesCount; $i++) {
                            $idIngrediente = $request->input('ingrediente' . $i);

                            $medida = $request->input('medida' . $i);
                            if ($medida == 'kilogramos') {
                                $cantidadRequerida = $request->input('cantidad' . $i) * $request->qty * 1000;
                            } else {
                                $cantidadRequerida = $request->input('cantidad' . $i) * $request->qty;
                            }

                            $ingrediente = Ingrediente::find($idIngrediente);
                            if (!$ingrediente || $cantidadRequerida > $ingrediente->cantidad) {
                                $ingredienteFaltante = $ingrediente->name;
                                return redirect('/productos')->with('status', 'Cantidad de ' . $ingredienteFaltante . ' supera la del inventario!.');
                            }
                        }
                    }
                }

                if ($request->hasFile('image')) {
                    $path = storage_path('app/public/uploads/productos/' . $producto->image);
                    if (File::exists($path)) {
                        File::delete($path);
                    }

                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;

                    $image = Image::make($file);
                    $image->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode('jpg', 70);
                    $image->save(storage_path('app/public/uploads/productos/' . $filename));
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
                $producto->status = $request->input('status') == TRUE ? '1' : '0';
                $producto->trending = $request->input('trending') == TRUE ? '1' : '0';
                $producto->update();

                if ($producto->qty <= 2) {
                    $notifications = new Notification();
                    $notifications->detalle = 'Producto: ' . $producto->name . 'en estado crítico, solo quedan ' . $producto->qty;
                    $notifications->id_usuario = 1;
                    $notifications->tipo = 2;
                    $notifications->save();
                }





                if ($ingredientesCount == 0) {
                    $ingredientesNoEntregados = ProductoIngrediente::where('id_producto', $producto->id)->get();

                    foreach ($ingredientesNoEntregados as $ingredienteNoEntregado) {
                        $ingrediente = Ingrediente::find($ingredienteNoEntregado->id_ingrediente);
                        $cantidadRequerida = $ingredienteNoEntregado->cantidad;

                        $ingrediente->cantidad += $cantidadRequerida;
                        $ingrediente->save();

                        $ingredienteNoEntregado->delete();
                    }
                }

                if ($ingredientesCount >= 1) {
                    if ($request->ingrediente1 != '') {
                        $ingredientesEntregados = [];
                        for ($i = 1; $i <= $ingredientesCount; $i++) {
                            $idIngrediente = $request->input('ingrediente' . $i);
                            $ingredientesEntregados[] = $idIngrediente;

                            $medida = $request->input('medida' . $i);

                            if ($medida == 'kilogramos') {
                                $cantidadRequerida = $request->input('cantidad' . $i) * $request->qty * 1000;
                            } else {
                                $cantidadRequerida = $request->input('cantidad' . $i) * $request->qty;
                            }
                            $ingrediente = Ingrediente::find($idIngrediente);

                            $productoIngrediente = ProductoIngrediente::where('id_producto', $producto->id)
                                ->where('id_ingrediente', $idIngrediente)->first();

                            if (!$productoIngrediente) {
                                $productoIngredienteNew = new ProductoIngrediente();
                                $productoIngredienteNew->id_producto = $producto->id;
                                $productoIngredienteNew->id_ingrediente = $idIngrediente;
                                $productoIngredienteNew->cantidad = $cantidadRequerida;
                                $productoIngredienteNew->save();
                                $ingrediente->cantidad = $ingrediente->cantidad - $cantidadRequerida;
                                $ingrediente->update();
                            }

                            if ($productoIngrediente) {
                                if ($cantidadRequerida < $productoIngrediente->cantidad) {
                                    $ingrediente->increment('cantidad', $productoIngrediente->cantidad - $cantidadRequerida);
                                } else if ($cantidadRequerida > $productoIngrediente->cantidad) {
                                    $ingrediente->decrement('cantidad', $cantidadRequerida - $productoIngrediente->cantidad);
                                }

                                $productoIngrediente->id_producto = $producto->id;
                                $productoIngrediente->id_ingrediente = $idIngrediente;
                                $productoIngrediente->cantidad = $cantidadRequerida;
                                $productoIngrediente->update();

                                // Para eliminar ingredientes que ya no estan asociados al producto
                                // dd($request);
                                $ingredientesNoEntregados = ProductoIngrediente::where('id_producto', $producto->id)
                                    ->whereNotIn('id_ingrediente', $ingredientesEntregados)
                                    ->get();

                                foreach ($ingredientesNoEntregados as $ingredienteNoEntregado) {
                                    $productoIngrediente = ProductoIngrediente::where('id_producto', $producto->id)
                                        ->where('id_ingrediente', $ingredienteNoEntregado->id_ingrediente)
                                        ->first();

                                    if ($productoIngrediente) {

                                        $ingrediente = Ingrediente::find($ingredienteNoEntregado->id_ingrediente);
                                        $cantidadRequerida = $ingredienteNoEntregado->cantidad;

                                        $ingrediente->cantidad += $cantidadRequerida;
                                        $ingrediente->save();
                                        $productoIngrediente->delete();
                                    }
                                }




                                if ($ingrediente->cantidad <= 1000) {
                                    $notifications = new Notification();
                                    $notifications->detalle = 'Ingrediente: ' . $ingrediente->name . 'en estado crítico, solo quedan ' . $ingrediente->cantidad;
                                    $notifications->id_usuario = 1;
                                    $notifications->tipo = 2;
                                    $notifications->save();
                                }

                                $ingrediente->update();
                            }
                        }
                    }
                }




                DB::commit();

                return redirect('/productos')->with('status', 'Producto Editado exitosamente!.');
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return back()->withErrors($validator)->withInput();
            }
        }
        return back()->withErrors($validator)->withInput()->with('error', 'Existe un error en el formulario');
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
        $producto_ingredientes = ProductoIngrediente::all()->where('id_producto', $id);

        if (count($producto_ingredientes) > 0) {
            $cantidad = $producto->qty;

            foreach ($producto_ingredientes as $producto_ingrediente) {
                $ingrediente = Ingrediente::find($producto_ingrediente->id_ingrediente);
                $ingrediente->cantidad += $producto_ingrediente->cantidad;
                // dd($ingrediente->cantidad);
                $ingrediente->update();
            }
        }

        if ($producto->image) {
            $path = storage_path('app/public/uploads/productos/' . $producto->image);

            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $notifications = new Notification();
        $notifications->detalle = 'Producto eliminado: ' . $producto->name;
        $notifications->id_usuario = 1;
        $notifications->tipo = 2;
        $notifications->save();

        $producto->delete();
        return redirect('/productos')->with('status', 'Producto eliminado Exitosamente');
    }
}
