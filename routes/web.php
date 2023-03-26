<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;

// FRONTEND ROUTES
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/categorias', [FrontendController::class, 'category'])->name('category');
Route::get('/ver-categoria/{slug}', [FrontendController::class, 'viewCategory'])->name('viewCategory');
Route::get('/categorias/{cate_slug}/{prod_slug}', [FrontendController::class, 'productview'])->name('productview');

Route::post('add-to-cart', [CartController::class, 'addProduct'])->name('addProduct');
Route::post('delete-cart-item', [CartController::class, 'deleteProduct'])->name('deleteProduct');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('updateCart');

Route::middleware(['auth'])->group(function(){ //solo usuarios autenticados
   Route::get('carrito', [CartController::class, 'viewCart'])->name('viewCart');
   Route::get('checkout',[CheckoutController::class, 'index'])->name('checkout.index');
   Route::post('place-order',[CheckoutController::class, 'placeorder'])->name('placeorder');
   Route::get('mis-ordenes',[UserController::class, 'index'])->name('ordenes.index');
   Route::get('ver-orden/{id}', [UserController::class, 'view'])->name('ordenes.view');

});

Auth::routes();

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
    
 });