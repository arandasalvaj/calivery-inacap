<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StoreTimeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebhooksController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Cliente.homeCliente');
});

Auth::routes();

//VISITANTE
Route::get('/registro-vendedor', [App\Http\Controllers\UserController::class, 'showRegistrationFormD'])->name('registerD');
Route::get('/registro-vendedor', [App\Http\Controllers\UserController::class, 'showRegistrationFormS'])->name('registerS');

Route::post('/registro-vendedor', [App\Http\Controllers\Auth\RegisterController::class, 'registerSeller'])->name('registerSS');
Route::post('/registro-repartidor', [App\Http\Controllers\Auth\RegisterController::class, 'registerDelivery'])->name('registerDD');

//TIENDA O VENDEDOR
Route::group(['middleware' => ['role:Seller|Store']], function () {
    Route::get('/dashboard', [App\Http\Controllers\StoreController::class, 'index'])->name('dashboard');
    Route::get('tienda/miTienda', [App\Http\Controllers\StoreController::class, 'verTienda'])->name('verTienda');
    Route::resource('/tienda',StoreController::class);
    Route::get('dfasdas', [App\Http\Controllers\StoreController::class, 'verorden'])->name('tienda.orden');
    Route::resource('/producto',ProductController::class);
    Route::resource('/horario',StoreTimeController::class);
    Route::get('tienda/orden/{id}/detalle', [App\Http\Controllers\OrderController::class, 'detalleOrdenVendedor'])->name('tienda.orden.detalle');
    Route::post('tienda/producto/{id}/estado', [App\Http\Controllers\ProductController::class, 'cambiarEstadoProducto'])->name('tienda.producto.status');
    Route::post('tienda/orden/{id}/estado', [App\Http\Controllers\OrderController::class, 'cambiarEstadoOrden'])->name('tienda.orden.status');
    Route::get('tienda/horario/crear', [App\Http\Controllers\StoreTimeController::class, 'create'])->name('tienda.horario.crear');
    Route::post('tienda/horario/almacenar', [App\Http\Controllers\StoreTimeController::class, 'store'])->name('tienda.horario.store');
    Route::get('tienda/horario/mishorarios', [App\Http\Controllers\StoreTimeController::class, 'index'])->name('tienda.horario.index');
    Route::get('tienda/horario/ver', [App\Http\Controllers\StoreTimeController::class, 'showIndex'])->name('tienda.horario.show');
    Route::post('cargar/categoria', [App\Http\Controllers\CategoryController::class, 'index'])->name('tienda.categoria');
    
});
Route::get('tienda/estadistica/grafico1', [App\Http\Controllers\StoreTimeController::class, 'totalOrdenes'])->name('tienda.estadisticas.show');
Route::get('seguimiento/', [App\Http\Controllers\ShippingController::class, 'paginaSeguimiento'])->name('seguimiento');
Route::post('seguimiento/resultado', [App\Http\Controllers\ShippingController::class, 'paginaSeguimientoBuscar'])->name('seguimiento.resultado');
Route::post('/ajax/Prueba', [App\Http\Controllers\CartController::class, 'pruebaAjax'])->name('ajax.prueba');
//REPARTIDOR
Route::group(['middleware' => ['role:Delivery']], function () {
    Route::resource('repartidor',DeliveryController::class);
    Route::get('/dashboard-repartidor', [App\Http\Controllers\DeliveryController::class, 'index'])->name('dashboard.repartidor');
    Route::post('repartidor/vehiculo', [App\Http\Controllers\DeliveryController::class, 'agregarVehiculo'])->name('repartidor.vehiculo.crear');
    
    Route::get('pedidos', [App\Http\Controllers\DeliveryController::class, 'buscarOrdenes'])->name('repartidor.pedido.buscar');
    Route::post('repartidor/{id}/orden/crear', [App\Http\Controllers\DeliveryController::class, 'crearOrdenEnvio'])->name('repartidor.orden.crear');
    Route::post('repartidor/{id}/orden/detalle', [App\Http\Controllers\DeliveryController::class, 'detalleOrden'])->name('repartidor.orden.detalle');
    Route::get('repartidor/orden/activa', [App\Http\Controllers\DeliveryController::class, 'ordenActiva'])->name('repartidor.orden.activa');
    Route::post('repartidor/orden/{id}/reparto', [App\Http\Controllers\ShippingController::class, 'store'])->name('repartidor.orden.reparto');
    Route::get('buscar', [App\Http\Controllers\DeliveryController::class, 'buscarOrden'])->name('repartidor.orden.buscar');
    Route::post('repartidor/orden/estado', [App\Http\Controllers\ShippingController::class, 'estadoEnvioCambio'])->name('repartidor.orden.estado');
    Route::get('historial', [App\Http\Controllers\DeliveryController::class, 'historialOrden'])->name('repartidor.orden.historial');
    Route::get('perfil/repartidor', [App\Http\Controllers\DeliveryController::class, 'perfil'])->name('repartidor.perfil.bla');
    
});
//CLIENTE
Route::group(['middleware' => ['role:Customer']], function () {
    Route::resource('/cart',CartController::class);
    Route::resource('/usuario',UserController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/cart-vacio', [App\Http\Controllers\CartController::class, 'destroyCart'])->name('destroyCart');
    Route::get('/cart-detalle', [App\Http\Controllers\CartController::class, 'showCart'])->name('showcart');
    Route::get('/ordenes', [App\Http\Controllers\OrderController::class, 'ordenesCliente'])->name('ordenesCliente');
    Route::get('/ordenes/detalle/{order}', [App\Http\Controllers\OrderController::class, 'detalleOrden'])->name('cliente.orden.detalle');
    Route::get('/perfil/', [App\Http\Controllers\UserController::class, 'index'])->name('cliente.perfil');
    Route::get('/orden/{order}/pay', [App\Http\Controllers\OrderController::class, 'pay'])->name('orden.pay');
    Route::post('perfil/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('cliente.perfil.update');
});
Route::post('/cart/cart', [App\Http\Controllers\CartController::class, 'storeAjax'])->name('cart.save');
    

Route::get('tienda/{id}/info', [App\Http\Controllers\StoreController::class, 'tiendaInfo'])->name('cliente.tienda.info');
Route::get('/productos/{id}', [App\Http\Controllers\ProductController::class, 'productoindex'])->name('cliente.product.detalle');
Route::get('/categoria/{id}/producto', [App\Http\Controllers\ProductController::class, 'categoriaProducto'])->name('cliente.categoria.producto');

Route::resource('/item',ItemController::class);
Route::resource('/orden',OrderController::class);
Route::post('webhooks',WebhooksController::class);
Route::get('/productos/{id}', [App\Http\Controllers\ProductController::class, 'productoindex'])->name('cliente.product.detalle');



