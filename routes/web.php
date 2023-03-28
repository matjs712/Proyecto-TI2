<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\OrdenController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IngredienteController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishlistController;

// FRONTEND ROUTES
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::get('/categorias', [FrontendController::class, 'category'])->name('category');
Route::get('/ver-categoria/{slug}', [FrontendController::class, 'viewCategory'])->name('viewCategory');
Route::get('/categorias/{cate_slug}/{prod_slug}', [FrontendController::class, 'productview'])->name('productview');

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
   Route::post('place-order',[CheckoutController::class, 'placeorder']);
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
    
    // PRODUCTOS
    Route::get('productos',        'Admin\ProductController@index');
    Route::get('crear-producto',   'Admin\ProductController@create');
    Route::post('insert-producto',  'Admin\ProductController@store');
    Route::get('edit-prod/{id}',     [ProductController::class,'edit']);
    Route::put('update-prod/{id}',     [ProductController::class,'update']);
    Route::get('delete-prod/{id}',     [ProductController::class,'destroy']);
    
    //  INGREDIENTES
    Route::get('ingredientes',        'Admin\IngredienteController@index');
    Route::get('crear-ingrediente',   'Admin\IngredienteController@create');
    Route::post('insert-ingrediente',  'Admin\IngredienteController@store');
    Route::get('edit-ing/{id}',     [IngredienteController::class,'edit']);
    Route::put('update-ing/{id}',     [IngredienteController::class,'update']);
    Route::get('delete-ing/{id}',     [IngredienteController::class,'destroy']);

   //  ORDENES
    Route::get('ordenes', [OrdenController::class, 'index']);
    Route::get('admin/ver-orden/{id}', [OrdenController::class, 'view']);
    Route::put('update-order/{id}', [OrdenController::class, 'updateorder']);
   
    //  USUARIOS
    Route::get('usuarios', [DashboardController::class, 'index']);
    Route::get('ver-usuario/{id}', [DashboardController::class, 'view']);
    
 });