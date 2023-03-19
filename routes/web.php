<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CarsController;


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
    
    // Autos
    Route::get('auto',        'Admin\CarsController@index');
    Route::get('crear-auto',   'Admin\CarsController@create');
    Route::post('insert-auto',  'Admin\CarsController@store');
    Route::get('edit-auto/{id}',     [CarsController::class,'edit']);
    Route::put('update-auto/{id}',     [CarsController::class,'update']);
    Route::get('delete-auto/{id}',     [CarsController::class,'destroy']);
        
 });