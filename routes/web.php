<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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