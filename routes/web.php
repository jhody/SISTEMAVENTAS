<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\MedioPagoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/Site/index', [SiteController::class, 'index'])->name('site.index');

Route::get('/login', function () {
    return redirect('/');
});
Route::post('/logout', [SiteController::class, 'logout']);

Route::post('/ingresar', [SiteController::class, 'ingresar'])->name('ingresar');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/MedioPago/index', [MedioPagoController::class, 'index'])->name('mediopago.index');
Route::post('/MedioPago/buscar', [MedioPagoController::class, 'buscar'])->name('mediopago.buscar');
Route::post('mediopago/store', [MedioPagoController::class, 'store'])->name('mediopago.store');
Route::put('/mediopago/{id}', [MedioPagoController::class, 'update'])->name('mediopago.update');
Route::delete('/mediopago/{id}', [MedioPagoController::class, 'destroy'])->name('mediopago.destroy');

Route::get('/Cliente/index', [ClienteController::class, 'index'])->name('cliente.index');
Route::post('/Cliente/buscar', [ClienteController::class, 'buscar'])->name('cliente.buscar');
Route::post('cliente/store', [ClienteController::class, 'store'])->name('cliente.store');
Route::put('/cliente/{id}', [ClienteController::class, 'update'])->name('cliente.update');
Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');

Route::get('/Producto/index', [ProductoController::class, 'index'])->name('producto.index');
Route::post('/Producto/buscar', [ProductoController::class, 'buscar'])->name('producto.buscar');
Route::post('producto/store', [ProductoController::class, 'store'])->name('producto.store');
Route::put('/producto/{id}', [ProductoController::class, 'update'])->name('producto.update');
Route::delete('/producto/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');

Route::get('/Venta/index', [VentaController::class, 'index'])->name('venta.index');
Route::post('/Venta/buscar', [VentaController::class, 'buscar'])->name('venta.buscar');
Route::post('venta/store', [VentaController::class, 'store'])->name('venta.store');
Route::put('/venta/{id}', [VentaController::class, 'update'])->name('venta.update');
Route::delete('/venta/{id}', [VentaController::class, 'destroy'])->name('venta.destroy');

Route::get('/Compra/index', [CompraController::class, 'index'])->name('compra.index');
Route::post('/Compra/buscar', [CompraController::class, 'buscar'])->name('compra.buscar');
Route::post('compra/store', [CompraController::class, 'store'])->name('compra.store');
Route::put('/compra/{id}', [CompraController::class, 'update'])->name('compra.update');
Route::delete('/compra/{id}', [CompraController::class, 'destroy'])->name('compra.destroy');

Route::get('/Categoria/index', [CategoriaController::class, 'index'])->name('categoria.index');
Route::post('/Categoria/buscar', [CategoriaController::class, 'buscar'])->name('categoria.buscar');
Route::post('categoria/store', [CategoriaController::class, 'store'])->name('categoria.store');
Route::put('/categoria/{id}', [CategoriaController::class, 'update'])->name('categoria.update');
Route::delete('/categoria/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');

Route::get('/Usuario/index', [UsuarioController::class, 'index'])->name('usuario.index');
Route::post('/Usuario/buscar', [UsuarioController::class, 'buscar'])->name('usuario.buscar');
Route::post('usuario/store', [UsuarioController::class, 'store'])->name('usuario.store');
Route::put('/usuario/{id}', [UsuarioController::class, 'update'])->name('usuario.update');
Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');
Route::post('/usuario/reset-password', [UsuarioController::class, 'resetPassword'])->name('usuario.resetPassword');

Route::get('/cargar-years-de-ordenes', [VentaController::class, 'cargarYearsDeOrdenes']);
Route::get('/cargar-datos-cabecera-sistema', [VentaController::class, 'cargarDatosCabeceraSistema']);
Route::get('/ver-json-grafico-ingresos-meses', [VentaController::class, 'verJsonGraficoIngresosXMeses']);


