<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\Admin\OrdenController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProveedorController;
use App\Http\Controllers\Admin\IngredienteController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Admin\RegistroController as AdminRegistroController;

// FRONTEND ROUTES
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// CATEGORIAS
Route::get('/todo-categorias', [FrontendController::class, 'categorias']);
Route::get('/ver-categoria/{slug}', [FrontendController::class, 'viewCategory']);
Route::get('/categorias/{cate_slug}/{prod_slug}', [FrontendController::class, 'productview']);

// PRODUCTOS
Route::get('/todo-productos', [FrontendController::class, 'productos']);
Route::get('/ver-producto/{slug}', [FrontendController::class, 'viewProducto']);
Route::get('product-list', [FrontendController::class, 'productList']);
// Route::get('/products/filter', [FrontendController::class, 'filter'])->name('products.filter');

// Route::get('/productos/filtrar', [FrontendController::class, 'filtrarProductos']);


Auth::routes();


// CARRITO
Route::get('load-cart-data', [CartController::class, 'cartCount']);
Route::post('add-to-cart', [CartController::class, 'addProduct']);
Route::post('delete-cart-item', [CartController::class, 'deleteProduct']);
Route::post('update-cart', [CartController::class, 'updateCart']);

//WISHLIST
Route::get('load-wish-data', [WishListController::class, 'wishCount']);
Route::post('add-to-wishlist', [WishlistController::class, 'add']);
Route::post('delete-wishlist-item', [WishlistController::class, 'destroy']);

Route::middleware(['auth'])->group(function(){ //solo usuarios autenticados
   Route::get('carrito', [CartController::class, 'viewCart']);
   Route::get('checkout',[CheckoutController::class, 'index']);
   // Route::post('place-order',[CheckoutController::class, 'placeorder']);
   Route::post('iniciar_compra',[CheckoutController::class, 'iniciar_compra']);
   Route::any('confirmar_pago', [CheckoutController::class, 'confirmar_pago'])->name('confirmar_pago');

   Route::get('mis-ordenes',[UserController::class, 'index']);
   Route::get('ver-orden/{id}', [UserController::class, 'view']);
   Route::get('wishlist', [WishlistController::class, 'index']);


});

// ADMIN ROUTES
 Route::middleware(['auth','isAdmin'])->group(function (){
    Route::get('/dashboard',  'Admin\FrontendController@index')->name('dashboard');
    
    // CATEGORIAS
    Route::get('categorias',        'Admin\CategoryController@index');
    Route::get('crear-categoria',   'Admin\CategoryController@create');
    Route::post('insert-category',  'Admin\CategoryController@store');
    Route::get('edit-cat/{id}',     [CategoryController::class,'edit']);
    Route::put('update-cat/{id}',     [CategoryController::class,'update']);
    Route::get('delete-cat/{id}',     [CategoryController::class,'destroy']);
    Route::get('modal-categorias/{id}', 'Admin\CategoryController@show');

    // PRODUCTOS
    Route::get('productos',        'Admin\ProductController@index');
    Route::get('crear-producto',   'Admin\ProductController@create');
    Route::post('insert-producto',  'Admin\ProductController@store');
    Route::get('edit-prod/{id}',     [ProductController::class,'edit']);
    Route::put('update-prod/{id}',     [ProductController::class,'update']);
    Route::get('delete-prod/{id}',     [ProductController::class,'destroy']);
    Route::get('/modal-productos/{id}', 'Admin\ProductController@show');

    
    //  INGREDIENTES
    Route::get('ingredientes',        'Admin\IngredienteController@index');
    Route::get('crear-ingrediente',   'Admin\IngredienteController@create');
    Route::post('insert-ingrediente',  'Admin\IngredienteController@store');
    Route::get('edit-ing/{id}',     [IngredienteController::class,'edit']);
    Route::put('update-ing/{id}',     [IngredienteController::class,'update']);
    Route::get('delete-ing/{id}',     [IngredienteController::class,'destroy']);
    
    //  PROVEEDORES
    Route::get('proveedores',        'Admin\ProveedorController@index');
    Route::get('crear-proveedor',   'Admin\ProveedorController@create');
    Route::post('insert-proveedor',  'Admin\ProveedorController@store');
    Route::get('edit-prov/{id}',     [ProveedorController::class,'edit']);
    Route::put('update-prov/{id}',     [ProveedorController::class,'update']);
    Route::get('delete-prov/{id}',     [ProveedorController::class,'destroy']);
    
    //  REGISTROS
    Route::get('registros',        'Admin\RegistroController@index');
    Route::get('crear-registro',   'Admin\RegistroController@create');
    Route::post('insert-registro',  'Admin\RegistroController@store');
    Route::get('edit-reg/{id}',     [AdminRegistroController::class,'edit']);
    Route::put('update-reg/{id}',     [AdminRegistroController::class,'update']);
    Route::get('delete-reg/{id}',     [AdminRegistroController::class,'destroy']);

   //  ORDENES
    Route::get('ordenes', [OrdenController::class, 'index']);
    Route::get('admin/ver-orden/{id}', [OrdenController::class, 'view']);
    Route::put('update-order/{id}', [OrdenController::class, 'updateorder']);
   
    //  USUARIOS
    Route::get('usuarios', [DashboardController::class, 'index']);
    Route::get('ver-usuario/{id}', [DashboardController::class, 'view']);
 });