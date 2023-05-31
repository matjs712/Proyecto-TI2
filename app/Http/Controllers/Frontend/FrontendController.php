<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Logo;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        logo_sitio();
        secciones();
        Cache::increment('contador-visitas');
        $banners = Category::all();
        $productos = Product::where('trending', '1')->take('4')->get();
        $categorias = Category::where('popular', '1')->take('5')->get();

        return view('frontend.index', compact('banners', 'categorias', 'productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categorias()
    {
        logo_sitio();
        secciones();
        $categorias = Category::where('status', 1)->paginate(9);
        $categorias->setPath('todo-categorias');

        return view('frontend.categorias.categorias', compact('categorias'));
    }
    public function productos()
    {
        $productos = Product::where('status', 1)->paginate(9);
        $productos->setPath('todo-productos');
        $categorias = Category::all();
        $ingredientes = Ingrediente::all();
        logo_sitio();
        secciones();

        return view('frontend.products.productos', compact('productos', 'categorias', 'ingredientes'));
    }
    public function filter(Request $request)
    {
        $category = null;
        $ingredient = null;
        $order = null;
        if ($request->filter_by_category != '') {
            $category = Category::where('slug', $request->filter_by_category)->first();
        }
        if ($request->filter_by_ingredient != '') {
            $ingredient = Ingrediente::where('id', $request->filter_by_ingredient)->first();
        }
        if ($request->sort_by == 'precio_bajo') {
            $order = 'asc';
        } else {
            $order = 'desc';
        }

        $productos = Product::where('status', 1)
            ->when($category, function ($query) use ($category) {
                $query->where('cate_id', $category->id);
            })
            ->when($ingredient, function ($query) use ($ingredient) {
                $query->whereHas('ingredientes', function ($q) use ($ingredient) {
                    $q->where('producto_ingredientes.id_ingrediente', $ingredient->id);
                });
            })
            ->when($order, function ($query) use ($order) {
                $query->orderBy('selling_price', $order);
            })
            ->paginate(9);

        return view('frontend.products.filter_result', compact('productos'));
    }

    public function viewCategory($slug)
    {
        logo_sitio();
        secciones();

        if (Category::where('slug', $slug)->exists()) {
            $categoria = Category::where('slug', $slug)->first();
            $productos = Product::where('cate_id', $categoria->id)->where('status', '1')->paginate(9);
            return view('frontend.products.index', compact('categoria', 'productos'));
        } else {
            return redirect('/')->with('status', 'Categoria no existe');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productview($cate_slug, $prod_slug)
    {
        logo_sitio();
        secciones();

        if (Category::where('slug', $cate_slug)->exists()) {
            if (Product::where('slug', $prod_slug)->exists()) {

                $categoria = Category::where('slug', $cate_slug)->first();
                $producto = Product::where('slug', $prod_slug)->where('cate_id', $categoria->id)->first();
                $rating = Rating::where('product_id', $producto->id)->get();
                $rating_sum = Rating::where('product_id', $producto->id)->sum('stars_rated');
                $user_rating = Rating::where('product_id', $producto->id)->where('user_id', Auth::id())->first();
                $reviews = Review::where('product_id', $producto->id)->get();
                if ($rating->count() > 0) {
                    $rating_value = $rating_sum / $rating->count();
                } else {
                    $rating_value = 0;
                }
                return view('frontend.products.view', compact('producto', 'rating', 'rating_value', 'user_rating', 'reviews'));
            } else {
                return redirect('/')->with('status', 'Producto no existe');
            }
        } else {
            return redirect('/')->with('status', 'Categoria no existe');
        }
    }
    public function viewProducto($prod_slug)
    {

        logo_sitio();
        secciones();

        if (Product::where('slug', $prod_slug)->exists()) {

            $producto = Product::where('slug', $prod_slug)->first();
            $rating = Rating::where('product_id', $producto->id)->get();
            $rating_sum = Rating::where('product_id', $producto->id)->sum('stars_rated');
            $user_rating = Rating::where('product_id', $producto->id)->where('user_id', Auth::id())->first();
            $reviews = Review::where('product_id', $producto->id)->get();
            if ($rating->count() > 0) {
                $rating_value = $rating_sum / $rating->count();
            } else {
                $rating_value = 0;
            }
            return view('frontend.products.show', compact('producto', 'rating', 'rating_value', 'user_rating', 'reviews'));
        } else {
            return redirect('/')->with('status', 'Producto no existe');
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
    public function productList()
    {
        $products = Product::select('name')->where('status', 1)->get();
        $data = [];
        foreach ($products as $item) {
            $data[] = $item['name'];
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchproduct(Request $request)
    {
        $searched_product = $request->nameProduct;
        if ($searched_product !== "") {
            $product = Product::where('name', 'LIKE', "%$searched_product%")->first();
            if ($product) {
                return redirect('categorias/' . $product->category->slug . '/' . $product->slug);
            } else {
                return redirect()->back()->with('status', 'No hay producto relacionados con tu busqueda');
            }
        } else {
            return redirect()->back();
        }
    }
}
