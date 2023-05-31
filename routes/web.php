<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\RegistroController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\OrdenController;
use App\Http\Controllers\Admin\PerfilController;
use App\Http\Controllers\Admin\SellInPersonController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProveedorController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Admin\IngredienteController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\RecipeController;
use App\Http\Mail\NotificationEmail;

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
Route::post('searchproduct', [FrontendController::class, 'searchproduct']);
Route::get('productos/sort-by', [FrontendController::class, 'filter'])->name('products.filter');
// Route::get('productos/range-price', [FrontendController::class, 'range'])->name('products.range');

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
Route::get('carrito', [CartController::class, 'viewCart']);
Route::get('checkout', [CheckoutController::class, 'index']);
Route::any('confirmar_pago', [CheckoutController::class, 'confirmar_pago'])->name('confirmar_pago');
Route::get('wishlist', [WishlistController::class, 'index']);
Route::get('/check-guest-session', [WishlistController::class, 'checkGuestSession'])->name('check.guest.session');

Route::post('iniciar_compra', [CheckoutController::class, 'iniciar_compra']);
Route::post('iniciar-compra-presencial', [CheckoutController::class, 'iniciar_compra_presencial']);

Route::middleware(['auth'])->group(function () { //solo usuarios autenticados
   // Route::post('place-order',[CheckoutController::class, 'placeorder']);
   Route::post('iniciar_compra',[CheckoutController::class, 'iniciar_compra']);
   Route::any('confirmar_pago', [CheckoutController::class, 'confirmar_pago'])->name('confirmar_pago');


    Route::get('mis-ordenes', [UserController::class, 'index']);
    Route::get('ver-orden/{id}', [UserController::class, 'view']);

    Route::post('add-rating', [RatingController::class, 'add']);
    Route::get('add-review/{product_slug}/userreview', [ReviewController::class, 'add']);
    Route::post('add-review', [ReviewController::class, 'create']);
    Route::get('edit-review/{product_slug}/userreview', [ReviewController::class, 'edit']);
    Route::put('update-review', [ReviewController::class, 'update']);
});

// ADMIN ROUTES
Route::middleware(['auth', 'isAdmin'])->group(function () {
   Route::get('/dashboard',  'Admin\FrontendController@index')->name('dashboard');

   //ESTADISTICAS
   Route::get('/usuarios-nuevos',  'Admin\FrontendController@UsuariosNuevos');
   Route::get('/productos-comprados',  'Admin\FrontendController@ProductosComprados');
   Route::get('/ordenes-nuevas',  'Admin\FrontendController@OrdenesNuevas');
   Route::get('/ingresos-mes',  'Admin\FrontendController@IngresosMes');
   Route::get('/ventas-mes',  'Admin\FrontendController@VentasMes');
   Route::get('/ingresos-diarios',  'Admin\FrontendController@IngresosDiarios');
   Route::get('/productos-top',  'Admin\FrontendController@ProductosTop');

   //GRAFICOS
   Route::get('/datos-graficos',  'Admin\FrontendController@ChartIngredientes');
   Route::get('/grafico-productos',  'Admin\FrontendController@GraficoProductos');
   Route::get('/grafico-ordenes',  'Admin\FrontendController@GraficoOrdenes');
   Route::get('/grafico-registros',  'Admin\FrontendController@GraficoRegistro');


   //VENTA PRESENCIAL
   Route::get('venta-presencial', 'Admin\SellInPersonController@index');
   Route::get('agregar-producto', 'Admin\SellInPersonController@agregarProducto');
   Route::post('completar-pago',[SellInPersonController::class, 'completar_pago']);
   Route::post('generar-pdf',[SellInPersonController::class, 'generatePDF']);
   Route::post('enviar-correo',[SellInPersonController::class, 'enviar_email']);
   Route::post('iniciar-compra-presencial',[SellInPersonController::class, 'iniciar_compra_presencial']);
   Route::any('confirmar_pago_qr', [SellInPersonController::class, 'confirmar_pago'])->name('confirmar_pago_qr');

    //NOTIFICAIONES
    Route::get('/notificaciones', 'Admin\NotificationController@index');
    Route::put('update-notification/{id}', [NotificationController::class, 'updatenotification']);
    Route::post('actualizar-notificaciones', [NotificationController::class, 'actualizarNotificaciones']);
    Route::get('notificationsajax', [NotificationController::class, 'notificacionajax']);

    // CATEGORIAS
    Route::get('categorias', 'Admin\CategoryController@index');
    Route::get('crear-categoria', 'Admin\CategoryController@create');
    Route::post('insert-category', 'Admin\CategoryController@store');
    Route::get('edit-cat/{id}', [CategoryController::class, 'edit']);
    Route::put('update-cat/{id}', [CategoryController::class, 'update']);
    Route::get('delete-cat/{id}', [CategoryController::class, 'destroy']);
    Route::get('modal-categorias/{id}', 'Admin\CategoryController@show');

    // PRODUCTOS
    Route::get('productos', 'Admin\ProductController@index');
    Route::get('crear-producto', 'Admin\ProductController@create');
    Route::post('insert-producto', 'Admin\ProductController@store');
    Route::get('edit-prod/{id}', [ProductController::class, 'edit']);
    Route::put('update-prod/{id}', [ProductController::class, 'update']);
    Route::get('delete-prod/{id}', [ProductController::class, 'destroy']);
    Route::get('/modal-productos/{id}', 'Admin\ProductController@show');


    //  INGREDIENTES
    Route::get('ingredientes', 'Admin\IngredienteController@index');
    Route::get('crear-ingrediente', 'Admin\IngredienteController@create');
    Route::post('insert-ingrediente', 'Admin\IngredienteController@store');
    Route::get('edit-ing/{id}', [IngredienteController::class, 'edit']);
    Route::put('update-ing/{id}', [IngredienteController::class, 'update']);
    Route::get('delete-ing/{id}', [IngredienteController::class, 'destroy']);
    Route::get('cantidad-ingredientes', [IngredienteController::class, 'qty']);

    //  PROVEEDORES
    Route::get('proveedores', 'Admin\ProveedorController@index');
    Route::get('crear-proveedor', 'Admin\ProveedorController@create');
    Route::post('insert-proveedor', 'Admin\ProveedorController@store');
    Route::get('edit-prov/{id}', [ProveedorController::class, 'edit']);
    Route::put('update-prov/{id}', [ProveedorController::class, 'update']);
    Route::get('delete-prov/{id}', [ProveedorController::class, 'destroy']);

    //  REGISTROS
    Route::get('registros', 'Admin\RegistroController@index');
    Route::get('crear-registro', 'Admin\RegistroController@create');
    Route::post('insert-registro', 'Admin\RegistroController@store');
    Route::get('edit-reg/{id}', [AdminRegistroController::class, 'edit']);
    Route::put('update-reg/{id}', [AdminRegistroController::class, 'update']);
    Route::get('delete-reg/{id}', [AdminRegistroController::class, 'destroy']);
    Route::get('/modal-registros/{id}', 'Admin\RegistroController@show');

    //  ORDENES
    Route::get('ordenes', [OrdenController::class, 'index']);
    Route::get('admin/ver-orden/{id}', [OrdenController::class, 'view']);
    Route::put('update-order/{id}', [OrdenController::class, 'updateorder']);

    //  USUARIOS
    Route::get('usuarios', [DashboardController::class, 'index']);
    Route::get('add-usuario', [DashboardController::class, 'create']);
    Route::post('insert-usuario', [DashboardController::class, 'store']);
    Route::get('usuarios/{user}/edit', [DashboardController::class, 'edit'])->name('usuarios.edit');
    Route::put('usuarios/{user}', [DashboardController::class, 'update'])->name('usuarios.update');
    Route::get('ver-usuario/{id}', [DashboardController::class, 'view']);
    Route::get('delete-usuario/{id}', [DashboardController::class, 'destroy']);

    //  CONFIGURACIÓN
    Route::get('configuracion', [DashboardController::class, 'configuracion']);
    Route::put('update-general', [DashboardController::class, 'updateConfiguracion']);
    Route::put('update-admin', [DashboardController::class, 'updateCredenciales']);

    //ROLES Y PERMISOS
    Route::get('roles', [RoleController::class, 'index']);
    Route::get('add-roles', [RoleController::class, 'create']);
    Route::post('store-roles', [RoleController::class, 'store'])->name('roles.store');
    ;
    Route::get('roles/{rol}/show', [RoleController::class, 'show'])->name('roles.show');
    Route::get('roles/{rol}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles/{rol}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('delete-rol/{id}', [RoleController::class, 'destroy']);

    //PERFIL
    Route::get('perfil', [PerfilController::class, 'index']);
    Route::put('update-perfil-general/{id}', [PerfilController::class, 'update']);
    Route::put('update-credenciales-perfil/{id}', [PerfilController::class, 'updateCredential']);

    //RECETAS
    Route::get('recetas', 'Admin\RecipeController@index');
    Route::get('crear-receta', 'Admin\RecipeController@create');
    Route::post('insert-receta', 'Admin\RecipeController@store');
    Route::get('edit-receta/{id}', [RecipeController::class, 'edit']);
    Route::put('update-receta/{id}', [RecipeController::class, 'update']);
    Route::get('delete-receta/{id}', [RecipeController::class, 'destroy']);
    Route::get('/modal-recetas/{id}', 'Admin\RecipeController@show');
});
